<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EntryRepository;
use App\Entry;
use Excel;
use DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class EntryController extends Controller
{
    protected $entry;

    public function __construct(EntryRepository $entry, EntryRepository $entries) {
    	$this->entry = $entry;
        $this->entries = $entries->getAllWithTrashed(); 
    }

    public function index() {
    	// return $this->entry->getAllWithTrashed();
        return $this->entry->getTodaysEntries();
    }

    public function show($id) {
    	return $this->entry->getPeriodEntries($id);
    }

    public function showWinners() {
        return $this->entry->getWinners();
    }

    public function store(Request $request) {
        $keys = $this->makeRandomKeys();
        $rndKey = array_rand($keys);

        $userId = Auth::id();
    	$periodId = $request->get('period_id');
    	$key = $rndKey;
    	$ip = $request->ip();

        $winningKey = DB::table('periods')->select('winningKey')->where('id', $periodId)->pluck('winningKey');
        $winningKeyValue = $winningKey[0];

        if($winningKeyValue == $key) {
            $isWinningEntry = true;
            $this->emailWinner($request);
        }
        else {
            $isWinningEntry = false;
            $this->emailContestant($request);
        }
        
    	$entry = new Entry;
    	$entry->user_id = $userId;
    	$entry->period_id = $periodId;
    	$entry->key = $key;
    	$entry->ip = $ip;
        $entry->isWinningEntry = $isWinningEntry;
        $userName = $entry->user->name;

    	$entry->save();

    	return redirect('/contest')->with('status', "Thanks for participating $userName, please check your email!");  	
    }

    public function emailWinner(Request $request) {
        $userId = Auth::id();
        $winningUser = DB::table('users')->select('email', 'name')->where('id', $userId)->get();
        $emailUser = $winningUser[0]->email;
        $nameUser = $winningUser[0]->name;
        $data = ['name' => $nameUser, 'email' => $emailUser, 'userId' => $userId];

        Mail::send('email.winner', $data, function($message) use ($data) {
            $emailUser = $data['email'];
            $nameUser = $data['name'];

            $message->to($emailUser, $nameUser)->subject('Congratulations, you have won!');
        });
    }

    public function emailContestant(Request $request) {
        $userId = Auth::id();
        $winningUser = DB::table('users')->select('email', 'name')->where('id', $userId)->get();
        $emailUser = $winningUser[0]->email;
        $nameUser = $winningUser[0]->name;
        $data = ['name' => $nameUser, 'email' => $emailUser, 'userId' => $userId];

        Mail::send('email.entry', $data, function($message) use ($data) {
            $emailUser = $data['email'];
            $nameUser = $data['name'];

            $message->to($emailUser, $nameUser)->subject('Too bad, you lost!');
        });
    }

    public function destroy(Request $request, Entry $entry) {
    	$userName = $entry->user->name;
        $periodName = $entry->period->name;
        $entry->delete();

        return redirect('/dashboard')->with('status', "Entry of $userName from $periodName successfully deleted!");
    }

    public function restore(Request $request, $id) {
    	$entry = Entry::withTrashed()->where('id', $id)->first();
        $userName = $entry->user->name;
        $periodName = $entry->period->name;
        $entry->restore();

        return redirect('/dashboard')->with('status', "Entry of $userName from $periodName successfully restored!");
    }

    public function exportEntries() {
        $currentTime = date('Y-m-d H:i:s');

        Excel::create("Entries_$currentTime", function($excel) {
                $excel->sheet("Entries", function($sheet)
                {
                    $sheet->loadView("Excel.entry", array("entries" => $this->entries));
                });
            })->export("xls");
    }

    public function makeRandomKeys() {
        $keys = [];

        for ($i=1; $i <= 10; $i++) { 
            array_push($keys, $i);
        }

        return $keys;
    }
}

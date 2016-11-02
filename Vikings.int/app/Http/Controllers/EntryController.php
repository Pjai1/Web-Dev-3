<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EntryRepository;
use App\Entry;
use Excel;

class EntryController extends Controller
{
    protected $entry;

    public function __construct(EntryRepository $entry, EntryRepository $entries) {
    	$this->entry = $entry;
        $this->entries = $entries->getAllWithTrashed(); 
    }

    public function index() {
    	return $this->entry->getAllWithTrashed();
    }

    public function show($id) {
    	return $this->entry->getPeriodEntries($id);
    }

    public function showWinners() {
        return $this->entry->getWinners();
    }

    public function store(Request $request) {
    	$userId = $request->get('user_id');
    	$periodId = $request->get('period_id');
    	$key = $request->get('key');
    	$ip = $request->ip();

    	$entry = new Entry;
    	$entry->user_id = $userId;
    	$entry->period_id = $periodId;
    	$entry->key = $key;
    	$entry->ip = $ip;

    	$entry->save();

    	return $entry;    	
    }

    public function destroy(Request $request, $id) {
    	$entry = $this->entry->find($id);

    	$entry->delete();
    }

    public function restore(Request $request, $id) {
    	$entry = Entry::withTrashed()->where('id', $id)->restore();

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
}

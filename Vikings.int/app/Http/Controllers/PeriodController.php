<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PeriodRepository;
use App\Period;
use Excel;

class PeriodController extends Controller
{
    protected $period;

    public function __construct(PeriodRepository $period, PeriodRepository $periods) {
        // $this->middleware('admin');

    	$this->period = $period;
        $this->periods = $periods->getAllWithTrashed();
    }



    public function index() {
    	return $this->period->getAllWithTrashed();
    }

    public function show($id) {
    	return $this->period->find($id);
    }

    public function store(Request $request) {
        $this->validate($request, [ 'name' => 'required|unique:periods',
                                        'startDate' => 'required|date_format:Y-m-d H:i:s',
                                        'endDate' => 'required|date_format:Y-m-d H:i:s|after:startDate'
                                        ]);

    	$name = $request->get('name');
    	$startDate = $request->get('startDate');
    	$endDate = $request->get('endDate');
        $winningKey = $this->makeRandomWinningKey();

    	$period = new Period;
    	$period->name = $name;
    	$period->startDate = $startDate;
    	$period->endDate = $endDate;
        $period->winningKey = $winningKey;

    	$period->save();

    	return redirect('/dashboard')->with('status', "$period->name successfully created!");
    }

    public function destroy(Request $request, Period $period) {
    	$period->delete();

        return redirect('/dashboard')->with('status', "$period->name successfully deleted!");
    }

    public function restore(Request $request, $id) {
    	$period = Period::withTrashed()->where('id', $id)->first();

        $period->restore();

        return redirect('/dashboard')->with('status', "$period->name successfully restored!");
    }

    public function exportPeriods() {
        $currentTime = date('Y-m-d H:i:s');

        Excel::create("Periods_$currentTime", function($excel) {
                $excel->sheet("Periods", function($sheet)
                {
                    $sheet->loadView("Excel.period", array("periods" => $this->periods));
                });
            })->export("xls");
    }

   public function makeRandomWinningKey() {
        $keys = [];

        for ($i=1; $i <= 10; $i++) { 
            array_push($keys, $i);
        }
        $rndKey = array_rand($keys);

        return $rndKey;
    }
}

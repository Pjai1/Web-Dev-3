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
        $this->middleware('admin');

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
    	$name = $request->get('name');
    	$startDate = $request->get('startDate');
    	$endDate = $request->get('endDate');

    	$period = new Period;
    	$period->name = $name;
    	$period->startDate = $startDate;
    	$period->endDate = $endDate;

    	$period->save();

    	return $period;
    }

    public function destroy(Request $request, $id) {
    	$period = $this->period->find($id);

    	$period->delete();
    }

    public function restore(Request $request, $id) {
    	$period = Period::withTrashed()->where('id', $id)->restore();

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
}

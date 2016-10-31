<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PeriodRepository;
use App\Period;

class PeriodController extends Controller
{
    protected $period;

    public function __construct(PeriodRepository $period) {
    	$this->period = $period;
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
}

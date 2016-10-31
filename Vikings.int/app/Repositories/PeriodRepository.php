<?php

namespace App\Repositories;
use App\Period;

class PeriodRepository {

	protected $period;

	public function __construct(Period $period) {
	    $this->period = $period;
	}

	public function getAllWithTrashed() {
		return $this->period->withTrashed()->orderBy('startDate', 'asc')->get();
	}

	public function find($id) {
		return $this->period->find($id);
	}
}
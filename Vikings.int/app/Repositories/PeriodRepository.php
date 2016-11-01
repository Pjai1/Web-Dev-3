<?php

namespace App\Repositories;
use App\Period;

class PeriodRepository {

	protected $period;

	public function __construct(Period $period) {
	    $this->period = $period;
	}

	public function getAll() {
		return $this->period->get();
	}

	public function getAllWithTrashed() {
		return $this->period->withTrashed()->orderBy('startDate', 'asc')->get();
	}

	public function find($id) {
		return $this->period->find($id);
	}

	public function getCurrentPeriod($periods) {
		$currentTime = date('Y-m-d H:i:s');
		$period->name = "Inactive period";

		foreach($periods as $p) {
			if($p->startDate < $currentTime && $p->endDate > $currentTime) {
				$period = $p;
			}
		}

		return $period;
	}
}
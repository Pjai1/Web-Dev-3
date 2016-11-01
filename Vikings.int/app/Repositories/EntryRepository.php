<?php

namespace App\Repositories;
use App\Entry;

class EntryRepository {

	protected $entry;

	public function __construct(Entry $entry) {
	    $this->entry = $entry;
	}

	public function getAll() {
		return $this->entry->get();
	}

	public function getAllWithTrashed() {
		return $this->entry->withTrashed()->with('user', 'period')->get();
	}

	public function find($id) {
		return $this->entry->find($id);
	}

	public function getWinners() {
		return $this->entry->where('isWinningEntry', 1)->get();
	}

	public function getPeriodEntries($id) {
		return $this->entry->withTrashed()->where('period_id', $id)->with('user', 'period')->get();
	}

	public function getUserEntries($id) {
		return $this->entry->withTrashed()->where('user_id', $id)->with('period')->get();
	}

}
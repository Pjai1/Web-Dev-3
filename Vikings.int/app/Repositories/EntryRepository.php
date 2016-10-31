<?php

namespace App\Repositories;
use App\Entry;

class EntryRepository {

	protected $entry;

	public function __construct(Entry $entry) {
	    $this->entry = $entry;
	}

	public function getAllWithTrashed() {
		return $this->entry->withTrashed()->with('user', 'period')->get();
	}

	public function find($id) {
		return $this->entry->find($id);
	}
}
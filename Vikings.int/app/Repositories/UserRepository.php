<?php

namespace App\Repositories;

use App\User;

class UserRepository {

	protected $user;

	public function __construct(User $user) {
	    $this->user = $user;
	}

	public function getAll() {
		return $this->user->get();
	}

	public function getAllWithTrashed() {
		return $this->user->withTrashed()->get();
	}

	public function find($id) {
		return $this->user->find($id);
	}

	public function getAllAdmins() {
		return $this->user->where('isAdmin', 1)->get();
	}
}
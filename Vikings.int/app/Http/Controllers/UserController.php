<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Repositories\UserRepository;
use App\User;
use DB;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user) {
    	$this->user = $user;
    }

    public function index() {
    	return $this->user->getAllWithTrashed();
    }

    public function show($id) {
    	return $this->user->find($id);
    }

    public function update(Request $request, $id) {
    	$user = User::withTrashed()->where('id', $id)->first();

    	$isAdmin = $request->get('isAdmin');
    	$user->isAdmin = $isAdmin;

    	$user->save();

    	return $user;
    }

    public function destroy(Request $request, $id) {
    	$user = $this->user->find($id);

    	$user->delete();
    }

    public function restore(Request $request, $id) {
    	$user = User::withTrashed()->where('id', $id)->restore();

    }
}

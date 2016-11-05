<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Repositories\UserRepository;
use App\User;
use DB;
use Excel;

class UserController extends Controller
{
    protected $user;
    protected $users;

    public function __construct(UserRepository $user, UserRepository $users) {
        $this->middleware('admin');
    	$this->user = $user;
        $this->users = $users->getAllWithTrashed();
    }

    public function index() {
    	return $this->user->getAllWithTrashed();
    }

    public function show($id) {
    	return $this->user->find($id);
    }

    public function showAdmins() {
        return $this->user->getAllAdmins();
    }

    public function update(Request $request, User $user) {

    	$user->isAdmin = !$user->isAdmin;

    	$user->save();

    	return redirect('/dashboard')->with('status', "$user->name successfully updated!");
    }

    public function destroy(Request $request, User $user) {
    	// $user = User::withTrashed()->where('id', $user->id)->first();
        $this->authorize('destroy', $user);
    	$user->delete();

        return redirect('/dashboard')->with('status', "$user->name successfully deleted!");
    }

    public function restore(Request $request, $id) {
    	$user = User::withTrashed()->where('id', $id)->first();

        $user->restore();

        return redirect('/dashboard')->with('status', "$user->name successfully restored!");
    }

    public function exportUsers() {
        $currentTime = date('Y-m-d H:i:s');

        Excel::create("Users_$currentTime", function($excel) {
                $excel->sheet("Users", function($sheet)
                {
                    $sheet->loadView("Excel.user", array("users" => $this->users));
                });
            })->export("xls");
    }
}

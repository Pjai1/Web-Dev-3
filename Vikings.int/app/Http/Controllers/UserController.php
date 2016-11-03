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
        // $this->middleware('admin');
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

    public function update(Request $request, $id) {
    	$user = User::withTrashed()->where('id', $id)->first();

    	$isAdmin = $request->get('isAdmin');
    	$user->isAdmin = $isAdmin;

    	$user->save();

    	return $user;
    }

    public function destroy($id) {
    	$user = User::withTrashed()->where('id', $id)->first();
        var_dump($user);
    	$user->delete();

        // return redirect("/dashboard")->with("success", "Successfully deleted user");
    }

    public function restore(Request $request, $id) {
    	$user = User::withTrashed()->where('id', $id)->restore();

        return $user;
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

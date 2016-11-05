<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\PeriodRepository;
use App\Repositories\EntryRepository;

class DashboardController extends Controller
{
    protected $users;
    protected $periods;
    protected $entries;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $users, PeriodRepository $periods, EntryRepository $entries)
    {
        // $this->middleware('admin');
        $this->users = $users->getAllWithTrashed();
        $this->periods = $periods->getAllWithTrashed();
        $this->entries = $entries->getAllWithTrashed();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('dashboard', [
                'users' => $this->users,
                'periods' => $this->periods,
                'entries' => $this->entries
            ]);
    }
}

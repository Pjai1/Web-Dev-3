<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\PeriodRepository;
use App\Repositories\EntryRepository;

class DashboardController extends Controller
{
    private $users;
    private $periods;
    private $entries;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $users, PeriodRepository $periods, EntryRepository $entries)
    {
        $this->middleware('admin');
        $this->users = $users;
        $this->periods = $periods;
        $this->entries = $entries;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->users->getAllWithTrashed();
        $periods = $this->periods->getAllWithTrashed();
        $entries = $this->entries->getAllWithTrashed();

        return view('dashboard', [
                'users' => $users,
                'periods' => $periods,
                'entries' => $entries
            ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\PeriodRepository;
use App\Repositories\EntryRepository;
use Illuminate\Support\Facades\Auth;


class ContestController extends Controller
{
    protected $users;
    protected $periods;
    protected $currentPeriod;
    protected $currentEntries;
    protected $entries;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $users, PeriodRepository $periods, EntryRepository $entries)
    {
        $this->middleware('auth');
        $this->users = $users->getAllWithTrashed();
        $this->periods = $periods->getAllWithTrashed();
        $this->currentPeriod = $periods->getCurrentPeriod($this->periods);
        $this->entries = $entries->getAllWithTrashed();
        $this->currentEntries = $entries->getPeriodEntries();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('contest', [
                'users' => $this->users,
                'periods' => $this->periods,
                'currentPeriod' => $this->currentPeriod,
                'entries' => $this->entries
            ]);
    }
}

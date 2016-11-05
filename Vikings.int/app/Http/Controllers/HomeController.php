<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\EntryRepository;
use App\Repositories\PeriodRepository;


class HomeController extends Controller
{
    protected $users;
    protected $entryWinners;
    protected $periods;
    protected $currentPeriod;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $users, EntryRepository $entryWinners, PeriodRepository $periods)
    {
        $this->middleware('auth');
        $this->users = $users->getAllWithTrashed();
        $this->entryWinners = $entryWinners->getAllWithTrashed();
        $this->periods = $periods->getAllWithTrashed();
        $this->currentPeriod = $periods->getCurrentPeriod($this->periods);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('home', [
                'users' => $this->users,
                'entryWinners' => $this->entryWinners,
                'periods' => $this->periods,
                'currentPeriod' => $this->currentPeriod
            ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\EntryRepository;
use App\Repositories\PeriodRepository;


class HomeController extends Controller
{
    private $users;
    private $entryWinners;
    private $periods;
    private $currentPeriod;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $users, EntryRepository $entryWinners, PeriodRepository $periods)
    {
        $this->middleware('auth');
        $this->users = $users;
        $this->entryWinners = $entryWinners;
        $this->periods = $periods;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->users->getAllWithTrashed();
        $entryWinners = $this->entryWinners->getAllWithTrashed();
        $periods = $this->periods->getAll();
        $currentPeriod = $this->periods->getCurrentPeriod($periods);

        return view('home', [
                'users' => $users,
                'entryWinners' => $entryWinners,
                'periods' => $periods,
                'currentPeriod' => $currentPeriod
            ]);
    }
}

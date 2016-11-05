<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon\Carbon; 
use Excel;
use Illuminate\Support\Facades\Mail;

class DailyMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'do:dailymail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Daily Mail to Admins with New Entries';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $entries = DB::table('entries')->where('created_at', '>=', Carbon::now()->startOfDay())->get();

        foreach ($entries as $entry) {
            $data[] = (array)$entry;
        }

        Excel::create('Entries', function($excel)  use($data){
                $excel->setTitle('Daily Entrylist');
                $excel->sheet('Entries', function($sheet)  use($data){
                    $sheet->fromArray($data);
                });
        })->store('xlsx');

        Mail::send('email.dailymail', $data, function($message) use ($data) {

            $message->to("jonas.vaneeckhout@student.kdg.be", "Jos")->subject('Daily Entry List');
            $message->attachment(storage_path('/exports'));
        });
    }
}

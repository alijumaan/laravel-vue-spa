<?php

namespace App\Console\Commands;

use App\Mail\CheckedBuilding;
use App\Models\Building;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CheckExtinguishers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:extinguishers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Checked at field in buildings table';

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
     * @return int
     */
    public function handle()
    {
//        $buildings = Building::where('checked_at', '<=', Carbon::now())->whereStatus(0);
//        $buildings = $buildings->get();
//
//        $buildings = $buildings->each(function ($q) {
//            $q->checked_at = Carbon::now();
//            $q->save();
//        });


//         $now = Carbon::now()->toDateTimeString();
//         $buildings = Building::with('periods')
//             ->where('checked_at', '<=', $now)
//             ->orWhere('status', 0)->get();
//
//        if ($buildings) {
//            Mail::to('alila3883@gmail.com')->send(new CheckedBuilding($buildings));
//            Log::info('schedule is done at: ' . $now);
//        }


        $buildings = Building::with('periods')
            ->where('checked_at', '<=', now()->format('Y-m-d'))
            ->orWhere('status', 0)->get();

        foreach ($buildings as $building) {
            if ($building['checked_at'] < now()->format('Y-m-d')) {
                Mail::to($building->user)->send(new CheckedBuilding($buildings));
            }
        }

    }
}

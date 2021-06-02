<?php

namespace App\Console\Commands;

use App\Mail\CheckedBuilding;
use App\Models\Building;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckExtinguishers extends Command
{
    private $building;

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
    public function __construct(Building $building)
    {
        parent::__construct();
        $this->building = $building;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $buildings = Building::with('periods')
            ->where('checked_at', '<=', now()->format('Y-m-d'))
            ->orWhere('status', 0)->get();

        if ($this->building['checked_at'] < now()->format('Y-m-d')) {
            Mail::to(auth()->user() ?? 'alila3883@gmail.com')->send(new CheckedBuilding($buildings));
        }

    }
}

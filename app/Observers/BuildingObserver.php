<?php

namespace App\Observers;

use App\Models\Building;
use Illuminate\Support\Facades\Artisan;

class BuildingObserver
{
    public function updated(Building $building)
    {
//        if ($building->wasChanged()) {
//            Artisan::call('check:extinguishers');
//        }
    }
}

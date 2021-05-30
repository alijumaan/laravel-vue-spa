<?php

namespace App\Observers;

use App\Mail\CheckedBuilding;
use App\Models\Building;
use Illuminate\Support\Facades\Mail;

class BuildingObserver
{
    public function updated(Building $building)
    {
        if ($building->wasChanged()) {

            $buildings = Building::with('periods')
                ->where('checked_at', '<=', now()->format('Y-m-d'))
                ->orWhere('status', 0)->get();

            if ($building['checked_at'] < now()->format('Y-m-d')) {
                Mail::to('alila3883@gmail.com')->send(new CheckedBuilding($buildings));
            }

        }
    }
}

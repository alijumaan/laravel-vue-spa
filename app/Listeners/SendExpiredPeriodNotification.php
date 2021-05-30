<?php

namespace App\Listeners;

use App\Events\ExtinguisherExpiredPeriod;
use App\Mail\CheckedBuilding;
use App\Models\Building;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SendExpiredPeriodNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ExtinguisherExpiredPeriod  $event
     * @return void
     */
    public function handle(ExtinguisherExpiredPeriod $event)
    {
        $buildings = Building::with('periods')
            ->where('checked_at', '<', now()->format('Y-m-d'))
            ->orWhere('status', 0)
            ->get();

        Notification::send($buildings, new SendExpiredPeriodNotification($event->building));
//        Mail::to('alila3883@gmail.com')->send(new CheckedBuilding($buildings));


    }
}

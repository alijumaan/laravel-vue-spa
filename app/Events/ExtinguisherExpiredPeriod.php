<?php

namespace App\Events;

use App\Models\Building;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExtinguisherExpiredPeriod
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $building;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Building $building)
    {
        $this->building = $building;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

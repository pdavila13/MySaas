<?php

namespace App\Events;

use App\Events\Event;
use App\ShoutOut;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ShotoutAdded extends Event implements ShouldBroadcast
{
    use SerializesModels;
    /**
     * @var ShoutOut
     */
    public $shoutout;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ShoutOut $shoutout)
    {
        $this->shoutout = $shoutout;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['shoutout-added'];
    }
}

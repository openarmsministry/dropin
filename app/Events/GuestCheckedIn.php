<?php

namespace App\Events;

use App\Attendance;
use App\Guest;
use App\Support\HasPayloadTrait;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class GuestCheckedIn
{
    use InteractsWithSockets, SerializesModels, HasPayloadTrait;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Attendance $attendance)
    {
        $this->setPayload($attendance);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

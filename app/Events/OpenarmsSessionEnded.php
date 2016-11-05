<?php

namespace App\Events;

use App\Support\HasPayloadTrait;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OpenarmsSessionEnded
{
    use InteractsWithSockets, SerializesModels, HasPayloadTrait;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($session)
    {
        $this->setPayload($session);
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

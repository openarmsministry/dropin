<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Support\HasPayloadTrait;

class NewGuestRegistered
{
    use InteractsWithSockets, SerializesModels, HasPayloadTrait;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\App\Guest $guest)
    {
        $this->setPayload($guest);
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

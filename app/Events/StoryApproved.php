<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Log;

class StoryApproved implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $story;

    public function __construct($story)
    {
        $this->story = $story;
    }
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('approved-stories'),
        ];
    }
}

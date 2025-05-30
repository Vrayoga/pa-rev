<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationEvent
{
    use SerializesModels;

    public $receiverId;
    public $message;
    public $title;

    /**
     * Create a new event instance.
     *
     * @param  int  $receiverId
     * @param  string  $title
     * @param  string  $message
     * @return void
     */
    public function __construct($receiverId, $title, $message)
    {
        $this->receiverId = $receiverId;
        $this->title = $title;
        $this->message = $message;
    }
}

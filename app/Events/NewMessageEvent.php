<?php

namespace App\Events;

use App\Events\Event;
use App\Models\Trainer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewMessageEvent extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $trainer;
    public $message;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($trainer, $message)
    {
        $this->trainer = $trainer;
        $this->message = $message;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['new-message'];
    }

    public function broadcastWith(){
        return [
            'sender' => $this->trainer,
            'message' => $this->message

        ];
    }
}

<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewTrainerEvent extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $trainer;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($trainer)
    {
        $this->trainer = $trainer;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['new-trainer'];
    }

    public function broadcastWith(){
        return [
            'trainer' => $this->trainer
        ];
    }
}

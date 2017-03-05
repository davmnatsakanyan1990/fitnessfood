<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewCardOrderEvent extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $card_order;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($card_order)
    {
        $this->card_order = $card_order;

    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['new-card-order'];
    }

    public function broadcastWith(){
        return [
            'card_order' => $this->card_order
        ];
    }
}

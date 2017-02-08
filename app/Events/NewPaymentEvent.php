<?php

namespace App\Events;

use App\Events\Event;
use App\Models\Trainer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewPaymentEvent extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $trainer;
    public $payment;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($trainer, $payment)
    {
        $this->trainer = $trainer;
        $this->payment = $payment;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['new-payment'];
    }

    public function broadcastWith(){
        return [
            'sender' => $this->trainer,
            'payment' => $this->payment

        ];
    }
}

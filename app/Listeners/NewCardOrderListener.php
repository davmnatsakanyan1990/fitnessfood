<?php

namespace App\Listeners;

use App\Events\NewCardOrderEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewCardOrderListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewCardOrderEvent  $event
     * @return void
     */
    public function handle(NewCardOrderEvent $event)
    {
        //
    }
}

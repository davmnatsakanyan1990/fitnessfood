<?php

namespace App\Listeners;

use App\Events\NewTrainerEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewTrainerListener
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
     * @param  NewTrainerEvent  $event
     * @return void
     */
    public function handle(NewTrainerEvent $event)
    {
        //
    }
}

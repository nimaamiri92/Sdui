<?php

namespace App\Listeners;

use App\Events\NewsCreatedListener;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewsCreatedListener
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
     * @param  \App\Events\NewsCreatedListener  $event
     * @return void
     */
    public function handle(NewsCreatedListener $event)
    {
        //
    }
}

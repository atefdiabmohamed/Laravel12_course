<?php

namespace App\Listeners;

use App\Events\CancelOrderCart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailOnCancelOorder
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CancelOrderCart $event): void
    {
        //
    }
}

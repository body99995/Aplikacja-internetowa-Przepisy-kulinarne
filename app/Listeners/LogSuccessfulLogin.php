<?php

namespace App\Listeners;

use Illuminate\Events\Logined;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LogSuccessfulLogin
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
     * @param  Logined  $event
     * @return void
     */
    public function handle(Logined $event)
    {
        /*$event->id_user = Auth::user()->id;
        $event->user_logs->date = Carbon::now();
        $event->user_logs->save();*/
    }
}

<?php

namespace App\Listeners;

use App\Events\UserLoged;
use Cache;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserUpdateLastLogin{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(){
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserLoged  $event
     * @return void
     */
    public function handle(UserLoged $event){
        //
    }
}

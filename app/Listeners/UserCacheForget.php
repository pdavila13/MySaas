<?php

namespace App\Listeners;

use App\Events\UserHasChanged;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserCacheForget{

    protected $user;

    /**
     * UserCacheForget constructor.
     * @param $user
     */
    public function __construct($user){
        $this->user = $user;
    }

    /**
     * Handle the event.
     *
     * @param  UserHasChanged  $event
     * @return void
     */
    public function handle(UserHasChanged $event){
        //id: $event->user->id
    }
}

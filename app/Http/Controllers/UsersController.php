<?php

namespace App\Http\Controllers;

use App\Events\UserHasChanged;
use App\User;
use Cache;
use Event;
use Illuminate\Http\Request;

use App\Http\Requests;

class UsersController extends Controller {

    /**
     * UsersController constructor.
     */
    public function __construct() {
        //$this->middleware('auth');
    }

    public function index() {

        //$user = Cache::remember('users',10, function(){
        $user = Cache::remember('query.users', 10, function(){
            return User::all();
        });

        return $user;
    }

    public function store() {
        User::create([
            'name'=>'Pepito',
            'email'=>'pepito@pepitos.com'
        ]);

        //Event::fire('user.change');
        $this->fireUserHasChanged();
    }

    public function update() {
        $user = User::first();

        $user->name="Pepita";
        $user->save();

        //Event::fire('user.change');
        $this->fireUserHasChanged();
    }

    public function destroy($id) {
        User::destroy($id);

        //Event::fire('user.change');
        $this->fireUserHasChanged();
    }

    public function fireUserHasChanged(){
        Event::fire(new UserHasChanged());
    }
}

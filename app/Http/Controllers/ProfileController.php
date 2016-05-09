<?php

namespace App\Http\Controllers;

use App\CreadorDePerfilesHTML;
use App\Profile;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProfileController extends Controller {

    public function preShow(){
//        if ($json){
//
//        }
    }
    public function show(Profile $profile) {
        return $profile->show(Auth::user());
    }
}

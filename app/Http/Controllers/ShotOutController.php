<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ShotOutController extends Controller {

    public function shotout() {
        //venim de processar un formulari smple amn un botó (submit) i un text area
        // 1) Validar formulari
        // 2) Persistencia: migracio/seed etc: shotout/notification, model
        // 3) Crear el esdeveniment

        $shoutout = new ShoutProves('Hola', 'Pepito');
        event(new ShotoutAdded($shoutout));

    }
}

class ShoutProves {
    public $user;
    public $content;

    /**
     * ShoutProves constructor.
     * @param $user
     * @param $content
     */
    public function __construct($user, $content) {
        $this->user = $user;
        $this->content = $content;
    }


}
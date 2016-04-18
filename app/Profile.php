<?php
/**
 * Created by PhpStorm.
 * User: pdavila
 * Date: 18/04/16
 * Time: 17:15
 */

namespace App;


interface Profile{
    /**
     * @param $user
     * @return mixed
     */
    public function show($user);
}
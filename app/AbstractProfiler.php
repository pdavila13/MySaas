<?php
/**
 * Created by PhpStorm.
 * User: pdavila
 * Date: 18/04/16
 * Time: 17:31
 */

namespace App;


abstract class AbstractProfiler implements Profile{

    /**
     * @param $user
     * @return mixed
     */
    abstract public function show($user);

    protected function getUserId($user){
        return $user->id;
    }
}
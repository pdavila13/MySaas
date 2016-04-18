<?php
/**
 * Created by PhpStorm.
 * User: pdavila
 * Date: 18/04/16
 * Time: 16:58
 */

namespace App;


class ProfilerCreatorHTML extends AbstractProfiler{
    public function show($user){
        return "<div>
                    Id: <b> " . $this->getUserId() . "</b><br/>
                    Nom: " . $user->name . "
                </div>";
    }
}
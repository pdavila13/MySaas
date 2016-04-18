<?php
/**
 * Created by PhpStorm.
 * User: pdavila
 * Date: 18/04/16
 * Time: 17:09
 */

namespace App;


class ProfilerCreatorJson extends AbstractProfiler
{
    public function show($user)
    {
        return "<json>
                    Id: <b> " . $this->getUserId() . "</b><br/>
                    Nom: " . $user->name . "
                </json>";
    }
}
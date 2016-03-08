<?php
/**
 * Created by PhpStorm.
 * User: pdavila
 * Date: 7/03/16
 * Time: 20:49
 */

namespace App;
trait OAuthIdentities {
    /**
     * Get OAuth identities
     */
    public function oauthIdentities() {
        return $this->hasMany(OAuthIdentity::class);
    }
}
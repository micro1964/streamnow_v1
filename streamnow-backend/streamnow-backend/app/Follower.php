<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    //

    /**
     * Load follower using relation model
     */
    public function getUser()
    {
        return $this->hasOne('App\User', 'id', 'follower');
    }

    
}

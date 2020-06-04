<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayPerView extends Model
{
    //

    /**
     * Get the video record associated with the flag.
     */
    public function vodVideo()
    {
        return $this->hasOne('App\VodVideo', 'id', 'video_id');
    }

    /**
     * Get the video record associated with the flag.
     */
    public function userVideos()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}

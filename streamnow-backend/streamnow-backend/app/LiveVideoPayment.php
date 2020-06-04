<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiveVideoPayment extends Model
{
    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function paiduser() {
        return $this->belongsTo('App\User' , 'live_video_viewer_id');
    }

    public function getUser() {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function video() {
    	return $this->belongsTo('App\LiveVideo' , 'id');
    }

     public function getVideo() {
    	return $this->belongsTo('App\LiveVideo' , 'live_video_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Follower;

class BlockList extends Model
{


    //

    /**
     * Boot function for using with User Events
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
           
            $user_follower = Follower::where('follower', $model->user_id)
            	->where('user_id', $model->block_user_id)->first();

            if ($user_follower) {

            	$user_follower->delete();

            }

            $user_following = Follower::where('follower', $model->block_user_id)
            	->where('user_id', $model->user_id)->first();

            if ($user_following) {

            	$user_following->delete();
            	
            }

        });

    }
}

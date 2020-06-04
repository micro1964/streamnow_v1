<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\UserNotification;

class UserNotification extends Model
{
    //

    public static function save_notification($user_id, $content, $link_id, $type = "" , $notifier_user_id) {

    	$model = new UserNotification;

    	$model->user_id = $user_id;

    	$model->notification = $content;

        $model->type = $type;

        $model->link_id = $link_id;

        $model->notifier_user_id = $notifier_user_id;

    	$model->status = 0;

    	$model->save();

    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}

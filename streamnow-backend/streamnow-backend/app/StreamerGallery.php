<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Helpers\Helper;

class StreamerGallery extends Model
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

         //delete your related models here, for example
        static::deleting(function($model)
        {

        	if ($model->image) {
         
         		Helper::delete_avatar('uploads/streamer_gallery', $model->image); // Delete the old pic

         	}
         
        });
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Helpers\Helper;

class LiveVideo extends Model
{


    public function setUniqueIdAttribute($value){

		$this->attributes['unique_id'] = uniqid(str_replace(' ', '-', $value));

	}

	public function payments() {

		return $this->hasMany('App\LiveVideoPayment');
		
	}

	public function user() {

		return $this->belongsTo('App\User');
		
	}


	/**
     * Load viewers using relation model
     */
    public function getViewers()
    {
        return $this->hasMany('App\Viewer', 'video_id', 'id');
    }

    /**
     * Load viewers using relation model
     */
    public function getVideosPayments()
    {
        return $this->hasMany('App\LiveVideoPayment', 'live_video_id', 'id');
    }

    public function getLiveGroup()
    {
        return $this->belongsTo('App\LiveGroup', 'live_group_id', 'id');
    }

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
        	if (count($model->getViewers) > 0) {

                foreach($model->getViewers as $viewer)
                {
                    $viewer->delete();
                } 

            }

            if (count($model->getVideosPayments) > 0) {

                foreach($model->getVideosPayments as $video)
                {
                    $video->delete();
                } 

            }

            if($model->snapshot) {

                Helper::delete_picture($model->snapshot, "uploads/rooms");

            }

        });
    }

    /**
     * Scope a query to only include active users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVideoResponse($query) {

        return $query->leftJoin('live_groups' , 'live_groups.id' ,'=' , 'live_videos.live_group_id')
                ->select(
                 'users.id as id',
                 'users.name as name', 
                 'users.email as email',
                 'users.picture as user_picture',
                 'users.chat_picture as chat_picture',
                 'live_videos.id as video_id',
                 'live_videos.title as title',
                 'live_videos.type as type',
                 'live_videos.description as description',
                 'live_videos.amount as amount',
                 'live_videos.snapshot as snapshot',
                 'live_videos.viewer_cnt as viewers',
                 'live_videos.no_of_minutes as no_of_minutes',
                 'live_videos.payment_status as payment_status',
                 'live_videos.status as video_stopped_status',
                \DB::raw('DATE_FORMAT(live_videos.created_at , "%e %b %y") as date'),
                 'live_videos.live_group_id as live_group_id',
                \DB::raw('IFNULL(live_groups.name,"") as live_group_name'),
                \DB::raw('IFNULL(live_groups.picture,"") as live_group_picture')
            );
    }
}

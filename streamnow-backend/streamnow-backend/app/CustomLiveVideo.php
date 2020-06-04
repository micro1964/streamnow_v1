<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomLiveVideo extends Model
{
    public function toArray() {

    	$array = parent::toArray();

        $array['created_time'] = $this->created_at ? $this->created_at->diffForHumans() : '-';

        return $array;
    }

        /**
     * Scope a query to only include active users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLiveVideoResponse($query)
    {
        return $query
            ->leftJoin('users', 'users.id', '=', 'custom_live_videos.user_id')
            ->select(
                'custom_live_videos.id as custom_live_video_id' ,
                'custom_live_videos.title' ,
                'custom_live_videos.description',
                'custom_live_videos.hls_video_url',
                'custom_live_videos.rtmp_video_url',
                'custom_live_videos.status',
                'custom_live_videos.image',
                'custom_live_videos.user_id' ,
                \DB::raw('IFNULL(users.picture,"") as user_picture'),
                \DB::raw('IFNULL(users.name,"") as user_name'),
                \DB::raw('DATE_FORMAT(custom_live_videos.created_at , "%e %b %y") as created_date'),
                'custom_live_videos.created_at',
                \DB::raw('("live") as category_name')
            );
    }

    public function user() {

        return $this->belongsTo('App\User');
        
    }
}

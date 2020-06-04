<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Helpers\Helper;

use Setting;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setUniqueIdAttribute($value){

        $this->attributes['unique_id'] = uniqid(str_replace(' ', '-', $value));

    }


    /**
     * Boot function for using with User Events
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
           
            $model->pushStatus($model);

            $model->generateToken($model);

            if(Setting::get('email_verify_control')) {

                if($model->login_by == 'manual') {

                    $model->generateEmailCode();

                } else {

                    $model->attributes['is_verified'] = 1;
                    
                }

            } else {

                $model->attributes['is_verified'] = 1;

            }
        });
        
        /*static::updating(function ($model) {
           
            $model->generateToken($model);
        });*/

         //delete your related models here, for example
        static::deleting(function($model)
        {
            if (count($model->getUserSubscriptions) > 0) {

                foreach($model->getUserSubscriptions as $subscription)
                {
                    $subscription->delete();
                } 

            }

            if (count($model->getBlockUsers) > 0) {

                foreach($model->getBlockUsers as $blockUser)
                {
                    $blockUser->delete();
                } 

            }

            if (count($model->getFollowers) > 0) {

                foreach($model->getFollowers as $follower)
                {
                    $follower->delete();
                } 

            }

            if (count($model->getFollowing) > 0) {

                foreach($model->getFollowing as $following)
                {
                    $following->delete();
                } 

            }

            if (count($model->getLiveVideos) > 0) {

                foreach($model->getLiveVideos as $liveVideo)
                {

                    $liveVideo->delete();
                } 

            }

            if (count($model->getVodvideos) > 0) {

                foreach($model->getVodvideos as $vodVideo)
                {
                    $vodVideo->delete();
                } 

            }

            if (count($model->getUserSubscriptions) > 0) {

                foreach($model->getUserSubscriptions as $userSubscription)
                {
                    $userSubscription->delete();
                } 

            }

            if (count($model->getLiveVideoPayments) > 0) {

                foreach($model->getLiveVideoPayments as $videoPayments)
                {
                    $videoPayments->delete();
                } 

            }


            if (count($model->getViewers) > 0) {

                foreach($model->getViewers as $viewer)
                {
                    $viewer->delete();
                } 

            }

            if(count($model->getStreamerGalleries) > 0) {

                foreach($model->getStreamerGalleries as $gallery) {

                    $gallery->delete();

                }
            }
        });
    }

    /**
     * Generates Token and Token Expiry
     * 
     * @return bool returns true if successful. false on failure.
     */

    protected function pushStatus() {

        $this->attributes['push_status'] = 1;

        return true;
    }


    /**
     * Generates Token and Token Expiry
     * 
     * @return bool returns true if successful. false on failure.
     */

    protected function generateEmailCode() {

        $this->attributes['verification_code'] = Helper::generate_email_code();

        $this->attributes['verification_code_expiry'] = Helper::generate_email_expiry();

        if(!Setting::get('email_verify_control') || !envfile('MAIL_USERNAME') || !envfile('MAIL_PASSWORD')) {

            $this->attributes['is_verified'] = 1;

        } else {

            $this->attributes['is_verified'] = 0;

        }


        return true;
    }


    /**
     * Generates Token and Token Expiry
     * 
     * @return bool returns true if successful. false on failure.
     */

    protected function generateToken($model) {


        $this->attributes['token'] = Helper::generate_token();

        $this->attributes['token_expiry'] = Helper::generate_token_expiry();

        return true;
    }

    /**
     * Load user subscription using relation model
     */
    public function getUserSubscriptions()
    {
        return $this->hasMany('App\UserSubscription', 'user_id', 'id');
    }

    /**
     * Load streamer gallery using relation model
     */
    public function getStreamerGalleries()
    {
        return $this->hasMany('App\StreamerGallery', 'user_id', 'id');
    }

    /**
     * Load user subscription using relation model
     */
    public function getViewers()
    {
        return $this->hasMany('App\Viewer', 'user_id', 'id');
    }


    /**
     * Load user subscription using relation model
     */
    public function getLiveVideos()
    {
        return $this->hasMany('App\LiveVideo', 'user_id', 'id');
    }

     /**
     * Load user subscription using relation model
     */
    public function getLiveVideoPayments()
    {
        return $this->hasMany('App\LiveVideoPayment', 'user_id', 'id');
    }

    /**
    * Load user payment videos count
     */
    public function getPaymentvideos()
    {
        return $this->hasMany('App\LiveVideo', 'user_id', 'id')->where('payment_status',1);
    }

    /**
    * Load user free videos count
     */
    public function getFreevideos()
    {
        return $this->hasMany('App\LiveVideo', 'user_id', 'id')->where('payment_status',0);
    }

     /**
    * Load user free videos count
     */
    public function getVodvideos()
    {
        return $this->hasMany('App\VodVideo', 'user_id', 'id');
    }

    /**
     * Load follower using relation model
     */
    public function getFollowers()
    {
        return $this->hasMany('App\Follower', 'user_id', 'id');
    }

       /**
     * Load follower using relation model
     */
    public function getBlockUsers()
    {
        return $this->hasMany('App\BlockList', 'user_id', 'id');
    }


    /**
     * Load follower using relation model
     */
    public function getFollowing()
    {
        return $this->hasMany('App\Follower', 'follower', 'id');
    }

    /**
     * Load follower using relation model
     */
    public function blockedUsersByme()
    {
        return $this->hasMany('App\BlockList', 'user_id', 'id');
    }

    public function blockedMeByOthers() {
        return $this->hasmany('App\BlockList' , 'block_user_id')->where('status' , 1);
    }

    
    /**
     * Get the Redeems
     */

    public function userRedeem() {
        return $this->hasOne('App\Redeem' , 'user_id' , 'id');
    }

    /**
     * Get the Redeems
     */
    
    public function userRedeemRequests() {
        return $this->hasMany('App\RedeemRequest')->orderBy('status' , 'asc');
    }


    /**
     * Scope a query to only include active users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUserResponse($query,$user_id)
    {
        return $query->where('users.id' , $user_id)->select('users.id as user_id', 
                'users.name as user_name' , 
                'users.email as email' , 
                'users.social_unique_id as social_unique_id' , 
                'users.token as token' , 
                'users.picture as user_picture' , 
                'users.login_by' , 
                'users.device_type' , 
                'users.description' , 
                'users.mobile' , 
                'users.latitude' , 
                'users.longitude' , 
                'users.payment_mode' , 
                'users.card_id' , 
                'users.status',
                'users.unique_id',
                'users.user_type',
                'users.one_time_subscription'
                );
    }
}



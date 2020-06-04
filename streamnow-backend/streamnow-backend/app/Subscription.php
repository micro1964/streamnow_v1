<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{

	//public $currency;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('title', 'description', 'plan' , 'amount');

    /**
	 * Save the unique ID 
	 *
	 *
	 */
    public function setUniqueIdAttribute($value){

		$this->attributes['unique_id'] = uniqid(str_replace(' ', '-', $value));

	}

	public function userSubscription() {
		return $this->hasMany('App\UserSubscription');
	}

	/**
     * Scope a query to basic subscription details
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBaseResponse($query) {

        $currency = \Setting::get('currency' , '$');

        return $query->select('subscriptions.id as subscription_id', 
                'subscriptions.title', 
                'subscriptions.description', 
                'subscriptions.plan',
                'subscriptions.amount', 
                'subscriptions.popular_status', 
                'subscriptions.status', 
                'subscriptions.created_at' , 
                \DB::raw("'$currency' as currency")
                );
    }
}

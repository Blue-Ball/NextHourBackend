<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable, Billable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image', 'email', 'password', 'is_admin', 'stripe_id', 'card_brand', 'card_last_four', 'trial_ends_at','google_id','facebook_id','gitlab_id','verifyToken','dob','age','is_blocked','code','dob','mobile','status',
        'braintree_id','is_assistant','amazon_id','google2fa_secret','google2fa_enable'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function wishlist()
    {
      return $this->hasMany('App\Wishlist');
    }

      public function paypal_subscriptions()
      {
        return $this->hasMany('App\PaypalSubscription');
      }

    public function subscriptions()
    {
        return $this->hasMany('Laravel\Cashier\Subscription');
    }
    
    public function watch_history()
    {
        return $this->hasMany('App\WatchHistory');
    }

   
    public function routeNotificationForOneSignal()
    {
        return ['include_external_user_ids' => [$this->id.""]];
    }

    

   

}

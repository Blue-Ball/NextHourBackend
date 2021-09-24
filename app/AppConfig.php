<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppConfig extends Model
{
    protected $fillable = [
      'logo',
      'title',
      'stripe_payment',
      'paypal_payment',
      'razorpay_payment',
      'brainetree_payment',
      'paystack_payment',
      'bankdetails',
      'fb_check',
      'google_login',
      'amazon_login',
      'git_lab_check',
      'ADMOB_APP_KEY',
      'banner_admob',
      'banner_id',
      'interstitial_admob',
      'interstitial_id',
      'rewarded_admob',
      'rewarded_id',
      'native_admob',
      'native_id',
      'inapp_payment',
      'push_key',
      // 'primaryColor',
      // 'secondaryColor',
      'remove_ads',
      'paytm_payment'
    ];
}

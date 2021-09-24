<?php

function getPlan() {

	$userplan = auth()->user()->subscriptions()->orderBy('id','DESC')->first();

	$subscription =  \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    $subscription = \Stripe\Subscription::retrieve($userplan->stripe_id);

    if(isset($subscription) && $subscription->canceled_at == '' && $subscription->pause_collection == ''){

    	return 1;

    }else{
    	return 0;
    }


}
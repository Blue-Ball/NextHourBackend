<?php

namespace App\Http\Controllers;

use App\Config;
use App\Mail\SendInvoiceMailable;
use App\Menu;
use App\Package;
use App\PaypalSubscription;
use App\PricingText;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Stripe\Customer;
use Stripe\Subscription;
use \Stripe\Coupon;
use \Stripe\Invoice;
use \Stripe\Stripe;
use Laravel\Cashier\Cashier;
use Session;
use App\User;
use App\ManualPaymentMethod;
use App\PackageFeature;

class UserAccountController extends Controller
{

    public function index()
    {
        // Set your secret key: remember to change this to your live secret key in production
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $auth = Auth::user();
        if ($auth->stripe_id != null) {
            // $customer = Customer::retrieve($auth->stripe_id);
           $customer = Cashier::findBillable($auth->stripe_id);
        }
        $paypal = $auth->paypal_subscriptions->sortBy('created_at');
        $plans = Package::all();
        $current_subscription = null;
        $method = null;
        $current_date = Carbon::now()->toDateString();
        if (isset($customer)) {
            //return $alldata = $user->asStripeCustomer()->subscriptions->data;
            $alldata = $auth->subscriptions;
            $data = $alldata->last();
        }
        if (isset($paypal) && $paypal != null && count($paypal) > 0) {
            $last = $paypal->last();
        }
        $stripedate = isset($data) ? $data->created_at : null;
        $paydate = isset($last) ? $last->created_at : null;
        if ($stripedate > $paydate) {
            if ($auth->subscribed($data->name)) {
                if (date($current_date) <= date($data->subscription_to)) {
                    $current_subscription = $data;
                    $method = 'stripe';
                }
            }
        } elseif ($stripedate < $paydate) {
            if (date($current_date) <= date($last->subscription_to)) {
                $current_subscription = $last;
                $method = 'paypal';
            }
        }



        $paypal_subscriptions = PaypalSubscription::where('user_id', $auth->id)->get();
        $customer = Cashier::findBillable($auth->stripe_id);

       // $customer = Invoice::retrieve($auth->stripe_id);
        // if($customer){
        //   $invoices = $customer->invoices();

        // }else{
        //     $invoices = NULL;
        // }
       
        if($customer){
         $invoices = $customer->subscriptions;
        }else{
            $invoices = NULL;
        }

        
        
        return view('user.index', compact('auth','plans', 'current_subscription', 'method','invoices','paypal_subscriptions'));
    }

    public function purchase_plan()
    {
        $plans = Package::all();
        $pricingTexts = PricingText::all();
        $package_feature = PackageFeature::get();
        return view('user.purchaseplan', compact('plans', 'pricingTexts','package_feature'));
    }

    public function get_payment(Request $request,$id)
    {
        $plan = Package::findOrFail($id);
        $config = Config::find(1);
        if(!isset($config) && $config == NULL){
            return back()->with('deleted','Default Settings not found !');
        }
        $bankdetails = $config->bankdetails;
        $razorpay_payment = $config->razorpay_payment;
        $instamojo_payment = $config->instamojo_payment;
        $stripe_payment = $config->stripe_payment;
        $mollie_payment = $config->mollie_payment;
        $cashfree_payment = $config->cashfree_payment;
        $omise_payment = $config->omise_payment;
       $flutterrave_payment = $config->flutterrave_payment;
        $account_name = $config->account_name;
        $account_no = $config->account_no;
        $ifsc_code = $config->ifsc_code;
        $bank = $config->bank_name;
        $manualpaymentmethod = ManualPaymentMethod::where('status',1)->get();
        $intent = '';
        if(env('STRIPE_SECRET') != NULL && env('STRIPE_KEY') != NULL && $stripe_payment == 1){
            $paymentMethods = $request->user()->paymentMethods();

            $intent = $request->user()->createSetupIntent();
        }
        //Session::forget('coupon_applied');     

        return view('subscribe', compact('plan', 'bankdetails', 'account_no', 'account_name', 'ifsc_code', 'bank','razorpay_payment','intent','instamojo_payment','mollie_payment','cashfree_payment','omise_payment','flutterrave_payment','manualpaymentmethod'));
    }

    public function subscribe(Request $request)
    {
        // require_once base_path().'/vendor/stripe/stripe-php/init.php';

        $menus = Menu::all();
        ini_set('max_execution_time', 80);
        // Set your secret key: remember to change this to your live secret key in production
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $auth = Auth::user();
        $token = $request->stripeToken;
        $coupon_valid = false;
        $coupon = $request->coupon;
        $plan = Package::find($request->plan);
        $paymentMethod = $request->paymentMethod;

        
        if(!$plan){
            return back()->with('delete','Plan not found !');
           
        }

        if ($coupon != null) {
            try
            {
                $stripe_coupon = Coupon::retrieve($coupon);
                $coupon_valid = true;
                if ($stripe_coupon->valid == false) {
                    $coupon_valid = false;
                    return back()->with('deleted', 'Coupon has been expired');
                }
            } catch (\Exception $e) {
                $error =  $e->getMessage();
                $coupon_valid = false;
            }
        }

        if($coupon_valid == false && $request->coupon){
            return back()->with('deleted', $error);
        }

        
            $plan_id = $plan->plan_id;
            $plan_name = $plan->name;

            if($coupon_valid == true && $request->coupon){
                try{
                    $purchased = $auth->newSubscription($plan_name, $plan_id)->withCoupon($request->coupon)->create($paymentMethod, [
                    'email' => $auth->email,
                    ]);
    
                    $last_plan = $auth->subscriptions->last(); 
                       $current_date = Carbon::now();
                        $end_date = null;
    
                        if ($plan->interval == 'month') {
                            $end_date = Carbon::now()->addMonths($plan->interval_count);
                        } else if($plan->interval == 'year') {
                            $end_date = Carbon::now()->addYears($plan->interval_count);
                        } else if($plan->interval == 'week') {
                            $end_date = Carbon::now()->addWeeks($plan->interval_count);
                        } else if($plan->interval == 'day') {
                            $end_date = Carbon::now()->addDays($plan->interval_count);
                        }
    
                   \DB::table('subscriptions')->where('id','=',$last_plan->id)->update([
                        'subscription_from'=>$current_date,
                        'subscription_to'=> $end_date,
                        'amount' => $plan->amount
                   ]);
                   
                   if (isset($purchased) || $purchased != null) {
                        Mail::to($auth->email)->send(new SendInvoiceMailable());
                        if (isset($menus) && count($menus) > 0) {
                            return redirect()->route('home', $menus[0]->slug)->with('added', 'Your are now a subscriber !');
                        }
                        return redirect('/')->with('added', 'Your are now a subscriber !');
                    } else {
                        return back()->with('deleted', 'Subscription failed ! Please check your debit or credit card.');
                    }
                }
                catch(\Exception $e){
                    return back()->with('deleted', $e->getMessage());
                }
                 

            }
            else{

                try{
                    $purchased = $auth->newSubscription($plan_name, $plan_id)
                        ->create($paymentMethod, [
                        'email' => $auth->email
                    ]);
    
                       $last_plan = $auth->subscriptions->last(); 
                       $current_date = Carbon::now();
                        $end_date = null;
    
                        if ($plan->interval == 'month') {
                            $end_date = Carbon::now()->addMonths($plan->interval_count);
                        } else if($plan->interval == 'year') {
                            $end_date = Carbon::now()->addYears($plan->interval_count);
                        } else if($plan->interval == 'week') {
                            $end_date = Carbon::now()->addWeeks($plan->interval_count);
                        } else if($plan->interval == 'day') {
                            $end_date = Carbon::now()->addDays($plan->interval_count);
                        }
    
                   \DB::table('subscriptions')->where('id','=',$last_plan->id)->update([
                        'subscription_from'=>$current_date,
                        'subscription_to'=> $end_date,
                        'amount' => $plan->amount
                   ]);
                   
                   if (isset($purchased) || $purchased != null) {
                        Mail::to($auth->email)->send(new SendInvoiceMailable());
                        if (isset($menus) && count($menus) > 0) {
                            return redirect()->route('home', $menus[0]->slug)->with('added', 'Your are now a subscriber !');
                        }
                        return redirect('/')->with('added', 'Your are now a subscriber !');
                    } else {
                        return back()->with('deleted', 'Subscription failed ! Please check your debit or credit card.');
                    }
                

                }catch(\Exception $e){
                    return back()->with('deleted', $e->getMessage());
                }
            }
    }

    public function edit_profile()
    {
        return view('user.edit_profile');
    }

    public function update_profile(Request $request)
    {
        //return $request;
        $auth = Auth::user();

        if($request->image != NULL){
            //return $request->file('image');
            if ($file = $request->file('image')) {
                $name = 'user_' . time() . $file->getClientOriginalName();
                if ($auth->image != null) {
                    $content = @file_get_contents(public_path() . '/images/users/' . $auth->image);
                    if ($content) {
                        unlink(public_path() . '/images/users/' . $auth->image);
                    }
                }
                $file->move('images/users/', $name);
                $input['image'] = $name;
                $auth->update([
                    'image' => $input['image'],
                ]);
                return back()->with('updated', 'Profile image has been updated');
               
            }
        }

        if (Hash::check($request->current_password, $auth->password)) {
            if ($request->new_email !== null) {
                $request->validate([
                    'new_email' => 'required|email',
                    'current_password' => 'required',
                ]);
                $auth->update([
                    'email' => $request->new_email,
                ]);
                return back()->with('updated', 'Email has been updated');
            }

            if ($request->new_name !== null) {
                $request->validate([
                    'new_name' => 'required|',
                    'current_password' => 'required',
                ]);
                $auth->update([
                    'name' => $request->new_name,
                ]);
                return back()->with('updated', 'Name has been updated');
            }

            if ($request->new_password !== null) {
                $request->validate([
                    'new_password' => 'required|min:6',
                    'current_password' => 'required',
                ]);
                $auth->update([
                    'password' => bcrypt($request->new_password),
                ]);
                return back()->with('updated', 'Password has been updated');
            }

        } 
        // else {
        //     return back()->with("deleted", "Your password doesn't match");
        // }


           
        //return back();
    }

    public function history()
    {
        $auth = Auth::user();
        // Set your secret key: remember to change this to your live secret key in production
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $paypal_subscriptions = PaypalSubscription::where('user_id', $auth->id)->get();
        $customer = Cashier::findBillable($auth->stripe_id);

       // $customer = Invoice::retrieve($auth->stripe_id);
       //  if($customer){
       //      $invoices = $customer->invoices();
       //  }

       $invoices = $auth->subscriptions;
        return view('user.history', compact('invoices', 'paypal_subscriptions'));
    }
    public function cancelSub($plan_id)
    {

     
        try{
              $subs = auth()->user()->subscriptions()->orderBY('id','DESC')->first();

                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

             

                \Stripe\Subscription::update(
                      $subs->stripe_id,
                      [
                        'pause_collection' => [
                          'behavior' => 'mark_uncollectible',
                        ],
                      ]
                );

            // $stripe->subscriptions->cancel(
            //   $subs->stripe_id,
            //   []
            // );
        }catch(\Exception $e){

        }

    

        return back()->with('deleted', 'Subscription has been cancelled');
    }

    public function resumeSub($plan_id)
    {
        


        $subs = auth()->user()->subscriptions()->orderBY('id','DESC')->first();



        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

         //return $subscription = \Stripe\Subscription::retrieve($subs->stripe_id);


       \Stripe\Subscription::update(
          $subs->stripe_id,
          [
            'pause_collection' => ''
          ]
        );

        return back()->with('updated', 'Subscription has been resumed');
    }

    public function PaypalCancel()
    {
        $auth = Auth::user();
        $auth->paypal_subscriptions->last()->status = 0;
        $auth->paypal_subscriptions->last()->save();
        return back()->with('deleted', 'Subscription has been cancelled');
    }

    public function PaypalResume()
    {
        $auth = Auth::user();
        $last = $auth->paypal_subscriptions->last();
        $last->status = 1;
        $last->save();
        return back()->with('updated', 'Subscription has been resumed');
    }
    public function watchhistory()
    {
        return view('search');
    }
}

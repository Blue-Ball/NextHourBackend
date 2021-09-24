<?php

namespace App\Http\Controllers;

use Session;

use App\Package;
use App\Multiplescreen;
use App\Menu;
use App\PaypalSubscription;
use Illuminate\Support\Carbon;
// use App\FailedTranscations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Button;


class OmiseController extends Controller
{
    public function pay(Request $request)
    {
        // return $request;

        // if (session()->get('currency')['id'] != 'THB' && session()->get('currency')['id'] != 'JPY') {
        //     notify()->warning('Currency not supported for this payment method !');
        //     return redirect(route('order.review'));
        // }

        require_once base_path() . '/vendor/omise/omise-php/lib/Omise.php';
        // require_once base_path() .'/vendor/autoload.php';

        // require_once 'price.php';

 

        define('OMISE_API_VERSION', env('OMISE_API_VERSION'));
        define('OMISE_PUBLIC_KEY', env('OMISE_PUBLIC_KEY'));
        define('OMISE_SECRET_KEY', env('OMISE_SECRET_KEY'));
        $plan = Package::find($request->plan_id);
      // Cookie::queue('plan', $plan,10);
        Session::put('plan',$plan);
        $menus=Menu::all();
      
        if(!isset($plan) && $plan == NULL){
            return back()->with('deleted','Plan Not Found !');
        }

        try {

            $charge = \OmiseCharge::create(array(
                'amount' => $plan->amount * 100,
                'currency' => 'thb',
                'card' => $_POST["omiseToken"],
            ));

        } catch (\Exception $e) {

            return back()->with('deleted',$e->getMessage());

        }

        if ($charge['status'] == 'successful') {

            $txn_id = $charge['id'];

            $payment_status = 'yes';

            $payment_id = $txn_id;
            $current_date = Carbon::now();
            $end_date = null;

            if ($plan->interval == 'month') {
                $end_date = Carbon::now()->addMonths($plan->interval_count);
            } else if ($plan->interval == 'year') {
                $end_date = Carbon::now()->addYears($plan->interval_count);
            } else if ($plan->interval == 'week') {
                $end_date = Carbon::now()->addWeeks($plan->interval_count);
            } else if ($plan->interval == 'day') {
                $end_date = Carbon::now()->addDays($plan->interval_count);
            }

            $auth = Auth::user();

            $created_subscription = PaypalSubscription::create([
                'user_id' => $auth->id,
                'payment_id' => $payment_id,
                'user_name' => $auth->name,
                'package_id' => $plan->id,
                'price' => $charge['amount'],
                'status' => 1,
                'method' => 'omise',
                'subscription_from' => $current_date,
                'subscription_to' => $end_date
            ]);
            if(isset($created_subscription)){
              Session::forget('coupon_applied');
              $multi_screen = Button::first()->multiplescreen;
              if(isset($multi_screen) && $multi_screen == 1){
                $auth = Auth::user();
                $screen = $plan->screens;
                if($screen > 0){
                  $multiplescreen = Multiplescreen::where('user_id',$auth->id)->first();
                   if(isset($multiplescreen)){
                      $multiplescreen->update([
                        'pkg_id' => $plan->id,
                        'user_id' => $auth->id,
                        'screen1' => $screen >= 1 ? $auth->name :  null,
                        'screen2' => $screen >= 2 ? 'Screen2' :  null,
                        'screen3' => $screen >= 3 ? 'Screen3' :  null,
                        'screen4' => $screen >= 4 ? 'Screen4' :  null
                      ]);
                  }
                  else{
                      $multiplescreen = Multiplescreen::create([
                        'pkg_id' => $plan->id,
                        'user_id' => $auth->id,
                        'screen1' => $screen >= 1 ? $auth->name :  null,
                        'screen2' => $screen >= 2 ? 'Screen2' :  null,
                        'screen3' => $screen >= 3 ? 'Screen3' :  null,
                        'screen4' => $screen >= 4 ? 'Screen4' :  null
                      ]);
                   }
                }
              }
                
            }

            // \Cookie::forget('plan');
            Session::forget('plan');


            if (isset($menus) && count($menus) > 0)
            {
               return redirect()->route('home', $menus[0]->slug)->with('added', 'Your are now a subscriber !');
            }else{
                return redirect('/')->with('added', 'Your are now a subscriber !');
            }

        } else {
          
            return back()->with('deleted','Payment Failed!');
        }
    }
}

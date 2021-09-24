<?php

namespace App\Http\Controllers;


use Auth;
use App\PaypalSubscription;
use App\Multiplescreen;
use App\Menu;
use App\Package;
use Carbon\Carbon;
use Session;
use App\Config;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendInvoiceMailable;
use Illuminate\Http\Request;
use KingFlamez\Rave\Facades\Rave as Flutterwave;
use App\Button;

class FlutterwaveController extends Controller
{
   public function initialize(Request $request)
  {

    //This initializes payment and redirects to the payment gateway
    //The initialize method takes the parameter of the redirect URL
    //Flutterwave::initialize(route('flutterrave.callback'));

            //This generates a payment reference
        $reference = Flutterwave::generateReference();
        // dd($reference);
        $plan = Package::find($request->plan_id);
        Session::put('plan',$plan);
        // Enter the details of the payment
        $data = [
            'payment_options' => 'card,banktransfer',
            'amount' => (request()->amount)*100,
            'email' => request()->email,
            'tx_ref' => $reference,
            'currency' => "NGN",

            'redirect_url' => route('flutterrave.callback'),
            'customer' => [
                'email' => request()->email,
                "phone_number" => request()->phone,
                "name" => request()->name
            ],

            "customizations" => [
                "title" => 'Subscription',
                "description" => "22th May"
            ]
        ];



        $payment = Flutterwave::initializePayment($data);

       
        if ($payment['status'] !== 'success') {
            // notify something went wrong
            return;
        }

        return redirect($payment['data']['link']);

  }

   public function callback()
   {

   		$status = request()->status;

        //if payment is successful
        if ($status ==  'successful') {
        
	        $transactionID = Flutterwave::getTransactionIDFromCallback();
	        $data = Flutterwave::verifyTransaction($transactionID);

	        //dd($data);
	        $current_date=Carbon::now();
		    $com_email = Config::findOrFail(1)->w_email;
		    $plan = Session::get('plan');
		    $customer=Auth::user();
		    $user_email = $customer->email;
		    $menus=Menu::all();

		    if (!is_null($plan)) {
		     	if ($plan->interval == 'month') {
			      $end_date = Carbon::now()->addMonths($plan->interval_count);
			    } else if ($plan->interval == 'year') {
			      $end_date = Carbon::now()->addYears($plan->interval_count);
			    } else if ($plan->interval == 'week') {
			      $end_date = Carbon::now()->addWeeks($plan->interval_count);
			    } else if ($plan->interval == 'day') {
			      $end_date = Carbon::now()->addDays($plan->interval_count);
			    }

			    $created_subscription = PaypalSubscription::create([
			      'user_id'    => $customer->id,
			      'payment_id' => $data['data']['tx_ref'],
			      'user_name' => $data['data']['customer']['name'],
			      'package_id' => $plan->id,
			      'price'      => $data['data']['amount'],
			      'status'     => '1',
			      'method'     => 'flutterwave',
			      'subscription_from' => $current_date,
			      'subscription_to' => $end_date
			    ]);
			    if ($created_subscription) {

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

          
			      try{
			        Mail::send('user.invoice', ['paypal_sub' => $created_subscription, 'invoice' => null], function($message) use ($com_email, $user_email) {
			          $message->from($com_email)->to($user_email)->subject('Invoice');
			        });
			      }catch(\Swift_TransportException $e){
			        header( "refresh:5;url=./" );
			        dd("Payment Successfully ! but Invoice will not sent because admin not updated the mail setting in admin dashboard ! Redirecting you to homepage... !");
			      }
			    }
			     Session::forget('plan');
			    if (isset($menus) && count($menus) > 0) {
			      return redirect()->route('home', $menus[0]->slug)->with('added', 'Your are now a subscriber !');
			    }else{
			      return redirect('/')->with('added', 'Your are now a subscriber !');
			    }
       		 }
       	}
        elseif ($status ==  'cancelled'){
            //Put desired action/code after transaction has been cancelled here
        }
        else{
            //Put desired action/code after transaction has failed here
        }
  	}
}

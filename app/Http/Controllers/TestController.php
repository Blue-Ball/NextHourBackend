<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Session;
use Exception;
use \Stripe\Stripe;
use \Stripe\Customer;
use App\PaypalSubscription;
use App\Config;
use Carbon\Carbon;
use Laravel\Cashier\Cashier;
use Menu;
use DB;
use Auth;
use Kutia\Larafirebase\Facades\Larafirebase;



class TestController extends Controller
{
    public function getVideo()
    {
        $movies = Movie::all();
        return view('video', compact('movies'));
    }

    public function index()
    {
        return view('subscription.create');
    }

    public function orderPost(Request $request)
    {
            $user = auth()->user();
            $input = $request->all();
            $token =  $request->stripeToken;
            $paymentMethod = $request->paymentMethod;

            
            try {

               Stripe::setApiKey(env('STRIPE_SECRET'));
                
                if (is_null($user->stripe_id)) {
                    $stripeCustomer = $user->createAsStripeCustomer();
                }

                Customer::createSource(
                    $user->stripe_id,
                    ['source' => $token]
                );

                $user->newSubscription('test',$input['plane'])
                    ->create($paymentMethod, [
                    'email' => $user->email,
                ]);

                return back()->with('success','Subscription is completed.');
            } catch (Exception $e) {
                return back()->with('success',$e->getMessage());
            }
            
    }
    public function test(){
        $auth = Auth::user();
        $subscribed = null;
        $withlogin= Config::findOrFail(1)->withlogin;
        $catlog = Config::findOrFail(1)->catlog;   
        Stripe::setApiKey(env('STRIPE_SECRET')); 
      if (isset($auth)) {
     
        $current_date = Carbon::now();
        $paypal=PaypalSubscription::where('user_id',$auth->id)->orderBy('created_at','desc')->first();

        if (isset($paypal)) {
          if (date($current_date) <= date($paypal->subscription_to)) {
            if ($paypal->package_id==0) {
              $nav_menus=Menu::all();
              $subscribed=1;
            }
          }
        }

        $auth = Auth::user();
        if ($auth->is_admin == 1) {
          $subscribed = 1;
          $nav_menus=Menu::orderBy('position','ASC')->get();
        } else{
           
          Stripe::setApiKey(env('STRIPE_SECRET'));
          if ($auth->stripe_id != null) {
          
             $customer = Cashier::findBillable($auth->stripe_id);
            
          }
          if (isset($customer)) {         
              $data = $auth->subscriptions->last(); 
              return $auth->subscription($data->stripe_plan)->endsAt;     
          } 
          if (isset($paypal) && $paypal != null && $paypal->count()>0) {
            $last = $paypal;
          } 
          $stripedate = isset($data) ? $data->created_at : null;
          $paydate = isset($last) ? $last->created_at : null;
          if($stripedate > $paydate){
            if($auth->subscribed($data->name) && date($current_date) <= date($data->subscription_to) && $data->ends_at == null){
              $subscribed = 1;
              $planmenus= DB::table('package_menu')->where('package_id',$data->stripe_plan)->get();
               if(isset($planmenus)){ 
                foreach ($planmenus as $key => $value) {
                  $menus[]=$value->menu_id;
                }
              }
              if(isset($menus)){ 
                $nav_menus=Menu::whereIn('id',$menus)->get();
              }
            }
          }
          elseif($stripedate < $paydate){
            if ((date($current_date) <= date($last->subscription_to)) && $last->status == 1){
              $subscribed = 1;
              $planmenus= DB::table('package_menu')->where('package_id', $last->plan['plan_id'])->get();
              if(isset($planmenus)){ 
                foreach ($planmenus as $key => $value) {
                  $menus[]=$value->menu_id;
                }
              }
              if(isset($menus)){ 
                $nav_menus=Menu::whereIn('id',$menus)->get();
              }
            }
          }
        }
      }
    }

    public function sendNotification()
    {
        $deviceTokens = [
            'fnXn1nH7AJo:APA91bGQ74NqMldyEtpNdx3ZTL39omH_mpO6O1FD3TPNx8kIIa38qI8rlMOcHfHRy3F-Co_ZW7jQ36kRN1fWwENuImkZ4XIUHfBaV1AJCJlFtqtOQrTxo6ktUg5_ujONcVekEGKGOxw2'
        ];
        
        return Larafirebase::withTitle('Nexthour Test Title')
            ->withBody('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. ')
            ->withImage('https://miro.medium.com/max/256/1*d69DKqFDwBZn_23mizMWcQ.png')
            ->withClickAction('admin/notifications')
            ->withPriority('high')
            ->sendNotification($deviceTokens);
        
        // Or
        //return Larafirebase::fromArray(['title' => 'Test Title', 'body' => 'Test body'])->sendNotification($deviceTokens);
    }
}

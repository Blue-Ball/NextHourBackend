@extends('layouts.theme')


@section('custom-meta')

@endsection

@section('title',"$audio->title")


@section('main-wrapper')
@php
$auth = Illuminate\Support\Facades\Auth::user();
  $subscribed = null;
  $withlogin= $configs->withlogin;
  $catlog = $configs->catlog;   
   Stripe\Stripe::setApiKey(env('STRIPE_SECRET')); 
  if (isset($auth)) {
    $current_date = Illuminate\Support\Carbon::now();
    $paypal=App\PaypalSubscription::where('user_id',$auth->id)->orderBy('created_at','desc')->first();

    if (isset($paypal)) {
      if (date($current_date) <= date($paypal->subscription_to)) {
        if ($paypal->package_id==0) {
          $nav_menus=App\Menu::all();
          $subscribed=1;
        }
      }
    }

    
    if ($auth->is_admin == 1) {
      $subscribed = 1;
      $nav_menus=App\Menu::orderBy('position','ASC')->get();
    } else{
      Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
      if ($auth->stripe_id != null) {
         $customer = \Laravel\Cashier\Cashier::findBillable($auth->stripe_id);
        // $customer = Stripe\Customer::retrieve($auth->stripe_id);
      }
      if (isset($customer)) {         
        $data = $auth->subscriptions->last();      
      } 
      if (isset($paypal) && $paypal != null && $paypal->count()>0) {
        $last = $paypal;
      } 
      $stripedate = isset($data) ? $data->created_at : null;
      $paydate = isset($last) ? $last->created_at : null;
      if($stripedate > $paydate){
        if($auth->subscribed($data->name) && date($current_date) <= date($data->subscription_to) && getPlan() == 1){
          $subscribed = 1;
          if(isset($data->stripe_plan)){
            $planmenus= DB::table('package_menu')->where('package_id',$data->stripe_plan)->get();
             if(isset($planmenus)){ 
              foreach ($planmenus as $key => $value) {
                $menus[]=$value->menu_id;
              }
            }
            if(isset($menus)){ 
              $nav_menus=App\Menu::whereIn('id',$menus)->get();
            }
          }
         
        }
      }
      elseif($stripedate < $paydate){
        if ((date($current_date) <= date($last->subscription_to)) && $last->status == 1){
          $subscribed = 1;
          if(isset($last->plan['plan_id'])){
            $planmenus= DB::table('package_menu')->where('package_id', $last->plan['plan_id'])->get();
            if(isset($planmenus)){ 
              foreach ($planmenus as $key => $value) {
                $menus[]=$value->menu_id;
              }
            }
            if(isset($menus)){ 
              $nav_menus=App\Menu::whereIn('id',$menus)->get();
            }
          }
          
        }
      }
    }
  }
         
@endphp
<!-- main wrapper -->
<section class="main-wrapper main-wrapper-single-movie-prime">
  <div class="background-main-poster-overlay">

    <!-- Modal -->


    @if(isset($audio))
      @if($audio->poster != null)
        <div class="background-main-poster col-md-offset-4 col-md-6" style="background-image: url('{{asset('images/audio/posters/'.$audio->poster)}}');">
      @else
        <div class="background-main-poster col-md-offset-4 col-md-6" style="background-image: url('{{asset('images/default-poster.jpg')}}');">
      @endif
     @endif
   </div>
        <div class="overlay-bg gredient-overlay-right"></div>
        <div class="overlay-bg"></div>
  </div>
  <div id="full-movie-dtl-main-block" class="full-movie-dtl-main-block">
    <div class="container-fluid">
      @if(isset($audio))
     
        <div class="row">
          <div class="col-md-8 small-screen-block">
            <div class="full-movie-dtl-block">
              <h2 class="section-heading">{{$audio->title}}</h2></br>
              <div class="">
               
                 <div id="wishlistelement" class="screen-play-btn-block">
                    
                  @if(Auth::check() && $subscribed ==1)

                   
                      @if(Auth::check() && Auth::user()->is_admin == '1')
                        <a  href="{{route('watchaudio',$audio->id)}}" class="btn btn-play play-btn-icon{{ $audio['id'] }}"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                          </a>
                      @else
                        <a href="{{url('/watch/audio/'.$audio->id)}}" class=" btn btn-play play-btn-icon{{ $audio['id'] }}"><span class="play-btn-icon "><i class="fa fa-play" ><span class="play-text"> {{__('staticwords.playnow')}}</span></a>
                      @endif
                   
                  @endif
                          
                  </div>
                  
              </div>
               
              <p>
                {{$audio->detail}}
              </p>
            </div>
          </div>
          <div class="col-md-4 small-screen-block">
            <div class="poster-thumbnail-block">
                @if($audio->thumbnail != null || $audio->thumbnail != '')
                <img src="{{asset('images/audio/thumbnails/'.$audio->thumbnail)}}" class="img-responsive" alt="genre-image">
                @else
                <img src="{{asset('images/default-thumbnail.jpg')}}" class="img-responsive" alt="genre-image">
                @endif
              </div>
          </div>
        </div>
      @endif
    </div>
  </div>
   

@endsection


@section('custom-script')


<script>
  $(document).ready(function(){

    $(".group1").colorbox({rel:'group1'});
    $(".group2").colorbox({rel:'group2', transition:"fade"});
    $(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
    $(".group4").colorbox({rel:'group4', slideshow:true});
    $(".ajax").colorbox();
    $(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
    $(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
    $(".iframe").colorbox({iframe:true, width:"100%", height:"100%"});
    $(".inline").colorbox({inline:true, width:"50%"});
    $(".callbacks").colorbox({
      onOpen:function(){ alert('onOpen: colorbox is about to open'); },
      onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
      onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
      onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
      onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
    });

    $('.non-retina').colorbox({rel:'group5', transition:'none'})
    $('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});


    $("#click").click(function(){ 
      $('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
      return false;
    });
  });
</script>

@endsection
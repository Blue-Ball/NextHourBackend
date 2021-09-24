@extends('layouts.theme')
@section('title',"Search result for $searchKey")
@section('main-wrapper')
  <!-- main wrapper -->
@php
  $age=0;
  if ($configs->age_restriction==1) {
    if(Auth::user()){
      $user_id=Auth::user()->id;
      $user=App\User::findOrfail($user_id);
      $age=$user->age;
    }
  }else{
    $age=100;
  }
 $withlogin= $configs->withlogin;
 $auth=Auth::user();
   $subscribed = null;

  
  if (isset($auth)) {

    $current_date = date("d/m/y");
        
    $auth = Illuminate\Support\Facades\Auth::user();
    if ($auth->is_admin == 1 || $auth->is_assistant == 1) {
      $subscribed = 1;
    } else if ($auth->stripe_id != null) {
      Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
      if(isset($invoices) && $invoices != null && count($invoices->data) > 0)
      
      {
      $user_plan_end_date = date("d/m/y", $invoice->lines->data[0]->period->end);
      $plans = App\Package::all();
      foreach ($plans as $key => $plan) {
        if ($auth->subscriptions($plan->plan_id)) {
         
        if($current_date <= $user_plan_end_date)
        {
        
            $subscribed = 1;
        }
            
        }
      } 
      }
      
      
    } else if (isset($auth->paypal_subscriptions)) {  
      //Check Paypal Subscription of user
      $last_payment = $auth->paypal_subscriptions->last();
      if (isset($last_payment) && $last_payment->status == 1) {
        //check last date to current date
        $current_date = Illuminate\Support\Carbon::now();
        if (date($current_date) <= date($last_payment->subscription_to)) {
          $subscribed = 1;
        }
      }
    }
  }

@endphp
  <section class="main-wrapper main-wrapper-single-movie-prime">
    @if(isset($filter_video))
      @if(count($filter_video) > 0)

        <div class="container-fluid movie-series-section search-section">
           @if(isset($actor))
              <div class="movie-series-block">
                <div class="row">
                  <div class="col-lg-2">

                    <div class="movie-series-img">
                      @if(!is_null($actor->image))
                        <img data-src="{{asset('images/actors/'.$actor->image)}}" class="img-responsive actor_image lazy" alt="genre-image">
                      @else
                        <img data-src="{{asset('images/default-thumbnail.jpg')}}" class="img-responsive actor_image lazy" alt="genre-image">
                     
                      @endif
                    </div>
                  </div>
                  <div class="col-lg-10">
                    <div class="movie-series-section search-actor">
                      <h5 class="movie-series-heading movie-series-name">
                          
                          {{$actor->name}}
                      
                      </h5>
                      <p>
                        {{__('staticwords.dob')}}- {{$actor->DOB}} </p>
                      <p>
                         {{__('staticwords.placeofbirth')}}- {{$actor->place_of_birth}} </p>
                     
                     
                      <p>
                      
                          {{$actor->biography}}
                      
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              
            <h5 class="movie-series-heading">{{count($filter_video)}} {{__('staticwords.foundfor')}} "{{$searchKey}}"</h5>
            <div>
         
    
            @endif

            @if(isset($director))
              <div class="movie-series-block">
                <div class="row">
                  <div class="col-lg-2">

                    <div class="movie-series-img">
                      @if(!is_null($director->image))
                        <img data-src="{{asset('images/directors/'.$director->image)}}" class="img-responsive actor_image lazy" alt="Director-image">
                      @else
                        <img data-src="{{asset('images/default-thumbnail.jpg')}}" class="img-responsive actor_image lazydata-src" alt="genre-image">
                     
                      @endif
                    </div>
                  </div>
                  <div class="col-lg-10">
                    <div class="movie-series-section search-actor">
                      <h5 class="movie-series-heading movie-series-name">
                          
                          {{$director->name}}
                      
                      </h5>
                        <p>
                        {{__('staticwords.dob')}}- {{$director->DOB}} </p>
                      <p>
                         {{__('staticwords.placeofbirth')}}- {{$director->place_of_birth}} </p>
                     
                     
                      <p>
                      
                          {{$director->biography}}
                      
                      </p>
                    </div>
                  </div>
                </div>
              </div>
          <h5 class="movie-series-heading">{{count($filter_video)}} {{__('staticwords.foundfor')}} "{{$searchKey}}"</h5>
          <div>
         
    
            @endif
            @foreach($filter_video->unique('id') as $key => $item)

              @php
              
              if($auth){
                if ($item->type == 'M')
                {
                  $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                            ['user_id', '=', $auth->id],
                                                                            ['movie_id', '=', $item->id],
                                                                           ])->first();
                } else {
                  $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                            ['user_id', '=', $auth->id],
                                                                            ['season_id', '=', $item->id],
                                                                           ])->first();
                }
              }
              @endphp

            
              <div class="movie-series-block">
                <div class="row">
                  <div class="col-lg-2">

                    <div class="movie-series-img home-prime-slider">
                      @if($item->type == 'M' && $item->thumbnail != null)
                        <img data-src="{{asset('images/movies/thumbnails/'.$item->thumbnail)}}" class="img-responsive actor_image lazy" alt="genre-image">
                        @if($item->is_custom_label == 1)
                          @if(isset($item->label_id))
                            <span class="badge bg-success">{{$item->label->name}}</span>
                          @endif
                        
                        @endif
                      @elseif($item->type == 'M' && $item->thumbnail == null)
                        <img data-src="{{asset('images/default-thumbnail.jpg')}}" class="img-responsive actor_image lazy" alt="genre-image">
                        @if($item->is_custom_label == 1)
                          @if(isset($item->label_id))
                            <span class="badge bg-success">{{$item->label->name}}</span>
                          @endif
                        @else

                          @if(isset($item->is_upcoming) && $item->is_upcoming == 1)
                            <span class="badge bg-success">Upcoming</span>
                          @endif
                        @endif
                      @elseif($item->type == 'S')
                        @if($item->thumbnail != null)
                          <img data-src="{{asset('images/tvseries/thumbnails/'.$item->thumbnail)}}" class="img-responsive actor_image lazy" alt="genre-image">
                        @if($item->tvseries->is_custom_label == 1)
                            @if(isset($item->tvseries->label_id))
                              <span class="badge bg-success">{{$item->tvseries->label->name}}</span>
                            @endif
                          @endif
                        @elseif($item->tvseries->thumbnail != null)
                          <img data-src="{{asset('images/tvseries/thumbnails/'.$item->tvseries->thumbnail)}}" class="img-responsive actor_image lazy" alt="genre-image">
                          @if($item->tvseries->is_custom_label == 1)
                            @if(isset($item->tvseries->label_id))
                              <span class="badge bg-success">{{$item->tvseries->label->name}}</span>
                            @endif
                          @endif
                        @else
                          <img data-src="{{asset('images/default-thumbnail.jpg')}}" class="img-responsive actor_image lazy" alt="genre-image">
                          @if($item->tvseries->is_custom_label == 1)
                            @if(isset($item->tvseries->label_id))
                              <span class="badge bg-success">{{$item->tvseries->label->name}}</span>
                            @endif
                          @endif
                        @endif
                      @endif
                    </div>
                  </div>
                  <div class="col-lg-10">
                    <div class="movie-series-section search-actor">
                      <div class="row">
                        <div class="col-lg-6"> 
                          <h5 class="movie-series-heading movie-series-name">
                            @if($item->type == 'M')
                              @if($auth && $subscribed == 1)
                                <a href="{{url('movie/detail', $item->slug)}}">{{$item->title}}</a>
                              @else
                                 <a href="{{url('movie/guest/detail', $item->slug)}}">{{$item->title}}</a>
                              @endif
                            @elseif($item->type == 'S')
                              @if($auth && $subscribed == 1)
                                <a href="{{url('show/detail', $item->season_slug)}}">{{$item->tvseries->title}}</a>
                              @else
                                <a href="{{url('show/guest/detail', $item->season_slug)}}">{{$item->tvseries->title}}</a>
                              @endif
                            @endif
                          </h5>
                        </div>
                        <div class="col-lg-6">
                          <ul class="movie-series-des-list">
                           
                            <li>
                              @if($item->type == 'M')
                                {{$item->duration}} {{__('staticwords.mins')}}
                              @else
                               {{__('staticwords.season')}} {{$item->season_no}} 
                              @endif
                            </li>
                           
                          </ul>
                        </div>
                      </div>
                      <p>
                        @if($item->type == 'M')
                          {{str_limit($item->detail, 360)}}
                          @if($auth && $subscribed == 1)
                            <a href="{{url('movie/detail', $item->slug)}}">{{__('staticwords.readmore')}}</a>
                          @else
                             <a href="{{url('movie/guest/detail', $item->slug)}}">{{__('staticwords.readmore')}}</a>
                          @endif

                        @else
                          @if ($item->detail != null || $item->detail != '')
                            {{str_limit($item->detail, 360)}}
                            @if($auth && $subscribed == 1)
                              <a href="{{url('show/detail', $item->season_slug)}}">{{__('staticwords.readmore')}}</a>
                            @else
                               <a href="{{url('show/guest/detail', $item->season_slug)}}">{{__('staticwords.readmore')}}</a>
                            @endif
                          @else
                            {{str_limit($item->tvseries->detail, 360)}}
                            @if($auth && $subscribed == 1)
                              <a href="{{url('show/detail', $item->season_slug)}}">{{__('staticwords.readmore')}}</a>
                            @else
                               <a href="{{url('show/guest/detail', $item->season_slug)}}">{{__('staticwords.readmore')}}</a>
                            @endif
                          @endif
                        @endif
                      </p>
                     
                      <div class="des-btn-block des-in-list">
                        @if($subscribed==1 && $auth)
                          @if($item->type == 'M' )
                            @if($item->is_upcoming != 1)
                              
                              @if($item->maturity_rating =='all age' || $age>=str_replace('+', '',$item->maturity_rating))
                                @if(isset($item->video_link['iframeurl']) && $item->video_link['iframeurl'] != null)
                              
                                  <a href="{{route('watchmovieiframe',$item->id)}}"class="btn btn-play search-btn iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                                  </a>

                                 @else 

                                 <a href="{{route('watchmovie', $item->id)}}" class="iframe btn btn-play search-btn"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                                 </a>

                                @endif
                              @else
                                <a onclick="myage({{$age}})" class="btn btn-play search-btn"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                                  </a>
                              @endif
                            @endif
                            @if($item->trailer_url != null || $item->trailer_url != '')
                              
                              <a href="{{ route('watchTrailer',$item->id) }}" class="iframe btn btn-default">{{__('staticwords.watchtrailer')}}</a>
                            @endif
                       

                         @else
                          @if(isset($item->episodes[0]))
                             @if(isset($item->episodes[0]->video_link->iframeurl) && $item->episodes[0]->video_link->iframeurl !="")

                              <a href="#" onclick="playoniframe('{{ $item->episodes[0]->video_link->iframeurl }}','{{ $item->id }}','tv')" class="btn btn-play search-btn"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                               </a>

                               @else 
                              <a href="{{route('watchTvShow', $item->id)}}" class="iframe btn btn-play search-btn"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span></a>
                              @endif
                            @endif
                         
                        @endif
                      </div>
                      @else
                       <div class="des-btn-block des-in-list">
                          @if($item->trailer_url != null || $item->trailer_url != '')
                            
                            <a href="{{ route('guestwatchtrailer',$item->id) }}" class="iframe btn btn-default">{{__('staticwords.watchtrailer')}}</a>
                          @endif
                         
                        </div>
                      @endif
                       @if($auth)
                         @if (isset($wishlist_check->added))
                              <a onclick="addWish({{$item->id}},'{{$item->type}}')" class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{$wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')}}</a>
                          @else
                            <a onclick="addWish({{$item->id}},'{{$item->type}}')" class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{__('staticwords.addtowatchlist')}}</a>
                            @endif
                       @endif
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
        </div>
      @else
        <div class="container-fluid movie-series-section search-section">
          <div class="search-box">
           <h5 class="movie-series-heading text-center">{{__('Sorry, there are no data that matched your search request')}} </h5>
           <p class="text-center">{{__('Please try diffrent criteria such as actor, director and genre etc !')}}</p>
         {{--  <h5 class="movie-series-heading">0 {{__('staticwords.foundfor')}} "{{$searchKey}}"</h5> --}}
          </div>
        </div>
      @endif
    @endif
  </section>
  <!-- end main wrapper -->
 



@endsection
@section('custom-script')
  <script>
  var app = new Vue({
    el: '.des-btn-block',
    data: {
      result: {
        id: '',
        type: '',
      },
    },
    methods: {
      addToWishList(id, type) {
        this.result.id = id;
        this.result.type = type;
        this.$http.post('{{route('addtowishlist')}}', this.result).then((response) => {
        }).catch((e) => {
          console.log(e);
        });
        this.result.item_id = '';
        this.result.item_type = '';
      }
    }
  });

    

    
    function playTrailer(url) {
      $('.video-player').css({
        "visibility" : "visible",
        "z-index" : "99999",
      });
      $('body').css({
        "overflow": "hidden"
      });
      $('#my_video').show();
      $('.vjs-control-bar').removeClass('hide-visible');
      let str = url;
      let youtube_slice_1 = str.slice(0, 14);
      let youtube_slice_2 = str.slice(0, 20);
      if (youtube_slice_1 == "https://youtu." || youtube_slice_2 == "https://www.youtube.")
      {
        $('.vjs-control-bar').addClass('hide-visible');
        player.src({ type: "video/youtube", src: url});
      } else {
        player.src({ type: "video/mp4", src: url});
      }

      setTimeout(function(){
        player.play();
      }, 300);
    }

    

    function addWish(id, type) {
      app.addToWishList(id, type);
      setTimeout(function() {
        $('.addwishlistbtn'+id+type).text(function(i, text){
          return text == "{{__('staticwords.addtowatchlist')}}" ? "{{__('staticwords.removefromwatchlist')}}" : "{{__('staticwords.addtowatchlist')}}";
        });
      }, 100);
    }

</script>



    <script>

      function playoniframe(url,id,type){
        $(document).ready(function(){
          var SITEURL = '{{URL::to('')}}';
           $.ajax({
                type: "get",
                url: SITEURL + "/user/watchhistory/"+id+'/'+type,
                success: function (data) {
                 console.log(data);
                },
                error: function (data) {
                   console.log(data)
                }
            });
      
        });       
        $.colorbox({ href: url, width: '100%', height: '100%', iframe: true });
      }
      
    </script>
  <script>  
      function myage(age){
        if (age==0) {
        $('#ageModal').modal('show'); 
      }else{
          $('#ageWarningModal').modal('show');
      }
    }
      
    </script>

@endsection

@extends('layouts.theme')
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

    
    if ($auth->is_admin == 1 || $auth->is_assistant == 1) {
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
@if(isset($movie))
@section('custom-meta')

@section('title',$movie->title.' | ')
<link rel="canonical" href="{{ url()->full() }}"/>
<meta name="robots" content="all">
<meta property="og:title" content="{{$movie->title}}"/>
<meta property="og:description" content="{{substr(strip_tags($movie->detail), 0, 100)}}{{strlen(strip_tags($movie->detail))>100 ? '...' : ""}}" />
<meta property="og:type" content="website"/>
<meta property="og:url" content="{{ url()->full() }}" />
<meta property="og:image" content="{{url('public/images/movies/thumbnails/'.$movie->thumbnail)}}" />

<meta name="twitter:title" content="{{$movie->title}}" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="{{$movie->detail}}" />
<meta name="twitter:site" content="{{ url()->full() }}" />

@endsection

@elseif($season)

@php
 $title = $season->tvseries->title;
 @endphp
@section('custom-meta')
<meta property="og:title" content="{{$season->tvseries->title}}"/>
<meta property="og:description" content="{{substr(strip_tags($season->tvseries->description), 0, 100)}}{{strlen(strip_tags($season->tvseries->description))>100 ? '...' : ""}}" />
<meta property="og:type" content="website"/>
<meta property="og:url" content="{{ url()->full() }}" />
<meta property="og:image" content="{{url('public/images/movies/thumbnails/'.$season->thumbnail)}}" />

<meta name="twitter:title" content="{{$season->tvseries->title}}" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="{{$season->tvseries->description}}" />
<meta name="twitter:site" content="{{ url()->full() }}" />

{{-- <meta name="Description" content="{{$season->tvseries->description}}" />
<meta name="keyword" content="{{$season->tvseries->title}}, {{$season->tvseries->keyword}}"> --}}
@endsection

@section('title',"$title")

@endif
@section('main-wrapper')
<!-- Modal -->
@include('modal.agemodal')
<!-- Modal -->
@include('modal.agewarning')
<!-- main wrapper -->
  <section class="main-wrapper main-wrapper-single-movie-prime">
    <div class="background-main-poster-overlay">
      @if(isset($movie))
            @if($movie->poster != null)
              <div class="background-main-poster" style="background-image: url('{{url('images/movies/posters/'.$movie->poster)}}');">
            @else
              <div class="background-main-poster" style="background-image: url('{{url('images/default-poster.jpg')}}');">
            @endif
        @endif
        @if(isset($season))
          @if($season->poster != null)
            <div class="background-main-poster" style="background-image: url('{{url('images/tvseries/posters/'.$season->poster)}}');">
          @elseif($season->tvseries->poster != null)
            <div class="background-main-poster" style="background-image: url('{{url('images/tvseries/posters/'.$season->tvseries->poster)}}');">
          @else
            <div class="background-main-poster" style="background-image: url('{{url('images/default-poster.jpg')}}');">
          @endif
        @endif
      </div>
      <div class="overlay-bg gredient-overlay-right"></div>
      <div class="overlay-bg"></div>
    </div>
    <div id="full-movie-dtl-main-block" class="full-movie-dtl-main-block">
      <div class="container-fluid">
        @if(isset($movie))
          @php
            
            $a_languages = collect();
            if ($movie->a_language != null) {
              $a_lan_list = explode(',', $movie->a_language);
              for($i = 0; $i < count($a_lan_list); $i++) {
                try {
                  $a_language = App\AudioLanguage::find($a_lan_list[$i])->language;
                  $a_languages->push($a_language);
                } catch (Exception $e) {
                }
              }
            }
          if(isset($auth)){
            $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                        ['user_id', '=', $auth->id],
                                                                        ['movie_id', '=', $movie->id],
                                                                       ])->first();
                                                                     }
            // Directors list of movie from model
            $directors = collect();
            if ($movie->director_id != null) {
              $p_directors_list = explode(',', $movie->director_id);
              for($i = 0; $i < count($p_directors_list); $i++) {
                try {
                  $p_director = App\Director::find($p_directors_list[$i])->name;
                  $directors->push($p_director);
                } catch (Exception $e) {

                }
              }
            }

            // Actors list of movie from model
            $actors = collect();
            if ($movie->actor_id != null) {
              $p_actors_list = explode(',', $movie->actor_id);
              for($i = 0; $i < count($p_actors_list); $i++) {
                try {
                  $p_actor = App\Actor::find($p_actors_list[$i])->name;
                  $actors->push($p_actor);
                } catch (Exception $e) {

                }
              }
            }

            // Genre list of movie from model
            $genres = collect();
            if (isset($movie->genre_id)){
              $genre_list = explode(',', $movie->genre_id);
              for ($i = 0; $i < count($genre_list); $i++) {
                try {
                  $genre = App\Genre::find($genre_list[$i])->name;
                  $genres->push($genre);
                } catch (Exception $e) {

                }
              }
            }

          @endphp
          <div class="row">
            <div class="col-md-8">
              <div class="full-movie-dtl-block">
                <h2 class="section-heading">{{$movie->title}}
                  <span>
                  @if($movie->live == 1)
                    @if($movie->livetvicon != NULL)
                      @php
                          $livetv = App\Config::pluck('livetvicon')->first();
                      @endphp
                      <img src="{{url('images/livetvicon/'.$livetv)}}" alt="livetvicon-image" width="50">
                    @else
                      <img src="{{url('images/default-tvicon.png')}}"  alt="livetvicon-image" >
                    @endif
                  @endif
                  </span>
                </h2>
                <div class="imdb-ratings-block">
                  <ul>
                    @if(isset($movie->publish_year))<li>{{$movie->publish_year}}</li>@endif
                    @if($movie->live !=1)
                      @if(isset($movie->duration))<li>{{$movie->duration}} {{__('staticwords.mins')}}</li>@endif
                    @endif
                    @if(isset($movie->maturity_rating))<li>{{$movie->maturity_rating}}</li>@endif
                    @if($movie->live != 1)
                      @if($configs->user_rating != 1)
                        @if(isset($movie->rating))<li>{{__('staticwords.tmdbrating')}} {{$movie->rating}}</li>@endif
                      @endif
                    @endif

                    <li><i title="views" class="fa fa-eye"></i> {{ views($movie)
                      ->unique()
                      ->count() }}</li>

                      <li data-toggle="modal" href="#sharemodal">
                        
                        <i title="Share" class="fa fa-share-alt" aria-hidden="true"></i>

                      </li>
                      
                  </ul>
                </div>
                 @auth
                  @if($configs->user_rating==1)
                @php
                $uid=Auth::user()->id;
                $rating=App\UserRating::where('user_id',$uid)->
                where('movie_id',$movie->id)->first();
                $avg_rating=App\UserRating::where('movie_id',$movie->id)->avg('rating');
                @endphp
                   <h6>{{__('staticwords.averagerating')}}  <span style="margin-left: 10px;">{{ number_format($avg_rating, 2) }}</span></h6>
                    {!! Form::open(['method' => 'POST', 'id'=>'formrating', 'action' => 'UserRatingController@store']) !!}
                  <input type="text" hidden="" name="movie_id" value="{{$movie->id}}">
                    <input type="text" hidden="" name="user_id" value="{{$auth->id}}">
                  <input id="rating" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="0.5" onmouseover="mouseoverrating()" value="{{isset($rating)? $rating->rating: 0}}">
                  <button type="submit" hidden="" id="submitrating"> Submit Rating</button>
                  {!!Form::close()!!} 
                 {{--  <a href="javascript:video(0)" onclick="myrate()">Give Rating</a>
                  <button onclick="myrate()">Click me</button> --}}
                  @endif
                 @endauth

                <div id="wishlistelement" class="screen-play-btn-block ">
                
                @if($subscribed==1 && $auth)
                @if($movie->is_upcoming != 1)
                  @if($movie->maturity_rating == 'all age' || $age>=str_replace('+', '',$movie->maturity_rating))
                    @if(isset($movie->video_link['iframeurl']) && $movie->video_link['iframeurl'] != null)
                      
                      <a href="{{route('watchmovieiframe',$movie->id)}}"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                       </a>
             
                    @else

                      <a href="{{route('watchmovie',$movie->id)}}" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                        </a>
                        
                    @endif
                  @else

                    <a onclick="myage({{$age}})"  class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                    </a>
                    
                  @endif
                @endif
                  @if($movie->trailer_url != null || $movie->trailer_url != '')
                    <a href="{{ route('watchTrailer',$movie->id)  }}" class="watch-trailer-btn iframe btn btn-default">{{__('staticwords.watchtrailer')}}</a>
                  @endif
                @else
                   @if($movie->trailer_url != null || $movie->trailer_url != '')
                    <a href="{{ route('guestwatchtrailer',$movie->id)  }}" class="watch-trailer-btn iframe btn btn-default">{{__('staticwords.watchtrailer')}}</a>
                  @endif
                @endif
                @if($catlog ==0 && $subscribed ==1)
                  @if (isset($wishlist_check->added))
                    <a onclick="addWish({{$movie->id}},'{{$movie->type}}')" class="watch-trailer-btn addwishlistbtn{{$movie->id}}{{$movie->type}} btn-default">{{$wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')}}</a>
                  @else
                    <a onclick="addWish({{$movie->id}},'{{$movie->type}}')" class="watch-trailer-btn addwishlistbtn{{$movie->id}}{{$movie->type}} btn-default">{{__('staticwords.addtowatchlist')}}</a>
                  @endif
                @elseif($catlog ==1 && $auth)
                  @if (isset($wishlist_check->added))
                    <a onclick="addWish({{$movie->id}},'{{$movie->type}}')" class="watch-trailer-btn addwishlistbtn{{$movie->id}}{{$movie->type}} btn-default">{{$wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')}}</a>
                  @else
                    <a onclick="addWish({{$movie->id}},'{{$movie->type}}')" class="watch-trailer-btn addwishlistbtn{{$movie->id}}{{$movie->type}} btn-default">{{__('staticwords.addtowatchlist')}}</a>
                  @endif
                @endif
                 
                @php
                 $mlc = array();
                  if(isset($movie->multilinks)){
                    foreach ($movie->multilinks as $key => $value) {
                       if($value->download == 1){
                        $mlc[] = 1;
                       }else{
                          $mlc[] = 0;
                       }
                    }
                  }
                @endphp

                @if(isset($movie->multilinks) && count($movie->multilinks) > 0 )   
                  @if(Auth::user() && $subscribed==1)
                  @if(in_array(1, $mlc))
                     <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#downloadmovie">{{__('staticwords.download')}}</button>

                    <div id="downloadmovie" class="collapse">
                      <table  class=" text-center table table-bordered table-responsive detail-multiple-link">
                        <thead>
                          <th align="center">#</th>
                          <th align="center">{{__('staticwords.download')}}</th>
                          <th align="center">{{__('staticwords.quality')}}</th>
                          <th align="center">{{__('staticwords.size')}}</th>
                          <th align="center">{{__('staticwords.language')}}</th>
                          <th align="center">{{__('staticwords.clicks')}}</th>
                          <th align="center">{{__('staticwords.user')}}</th>
                          <th align="center">{{__('staticwords.added')}}</th>
                        </thead>
                   
                        <tbody>
                          
                         @foreach($movie->multilinks as $key=> $link)
                          
                            @if($link->download == 1)
                              <tr>
                                @php
                                  $lang = App\AudioLanguage::where('id',$link->language)->first();
                                @endphp

                                <td align="center">{{$key+1}}</td>
                                <td align="center"><a data-id="{{$link->id}}" class="download btn btn-sm btn-success" title="{{__('staticwords.download')}}" href="{{$link->url}}" ><i class="fa fa-download"></i></td>
                                <td align="center">{{$link->quality}}</td>
                                <td align="center">{{$link->size}}</td>
                                <td align="center">@if(isset($lang)){{$lang->language}}@endif</td>
                                <td>{{$link->clicks}}</td>
                                <td align="center">{{$link->movie->user->name}}</td>
                                <td align="center">{{date('Y-m-d',strtotime($link->created_at))}}</td>
                                
                              </tr>

                            @endif

                        @endforeach
                        
                        </tbody>
                        
                      </table>
                    </div>
                  @endif
                  @endif
                @endif
 

              </div>
                <p>
                  {{$movie->detail}}
                </p>
              </div>
              <div class="screen-casting-dtl">
                <ul class="casting-headers">
                  @if($movie->live!=1)
                    @if (count($directors) > 0)
                      <li>{{__('staticwords.directors')}} :
                        <span class="categories-count">
                            @for($i = 0; $i < count($directors); $i++)
                              @if($i == count($directors)-1)
                                <a href="{{url('video/detail/director_search', trim($directors[$i]))}}">{{$directors[$i]}}</a>
                              @else
                                <a href="{{url('video/detail/director_search', trim($directors[$i]))}}">{{$directors[$i]}}</a>,
                              @endif
                            @endfor
                        </span>
                      </li>
                    @endif
                    @if (count($actors) > 0)
                      <li>{{__('staticwords.starring')}} :
                        <span class="categories-count">
                            @for($i = 0; $i < count($actors); $i++)
                              @if($i == count($actors)-1)
                                <a href="{{url('video/detail/actor_search', trim($actors[$i]))}}">{{$actors[$i]}}</a>
                              @else
                                <a href="{{url('video/detail/actor_search', trim($actors[$i]))}}">{{$actors[$i]}}</a>,
                              @endif
                            @endfor
                        </span>
                      </li>
                    @endif
                  @endif
                  @if (count($genres) > 0)
                    <li>{{__('staticwords.genres')}} :
                      <span class="categories-count">
                          @for($i = 0; $i < count($genres); $i++)
                            @if($i == count($genres)-1)
                              <a href="{{url('video/detail/genre_search', trim($genres[$i]))}}">{{$genres[$i]}}</a>
                            @else
                              <a href="{{url('video/detail/genre_search', trim($genres[$i]))}}">{{$genres[$i]}}</a>,
                            @endif
                          @endfor
                      </span>
                    </li>
                  @endif
                  @if(count($movie->subtitles)>0)
                    <li>{{__('staticwords.subtitles')}}
                      <span class="categories-count">
                          @foreach($movie->subtitles as $key=> $sub)
                           @if($key == count($movie->subtitles)-1)
                            {{ $sub['sub_lang'] }}
                           @else
                             {{ $sub['sub_lang'] }},
                           @endif
                          @endforeach  
                      </span>
                    </li>
                  @endif
                  @if (count($a_languages) > 0)
                    <li>{{__('staticwords.audiolanguage')}}
                      <span class="categories-count">
                          @if($movie->a_language != null && isset($a_languages))
                            @for($i = 0; $i < count($a_languages); $i++)
                              @if($i == count($a_languages)-1)
                                {{$a_languages[$i]}}
                              @else
                                {{$a_languages[$i]}},
                              @endif
                            @endfor
                          @endif
                      </span>
                    </li>
                  @endif
                </ul>
               
              </div>
              
            </div>
  
        
            <div class="col-md-4">
              <div class="poster-thumbnail-block home-prime-slider">
                @if($movie->thumbnail != null || $movie->thumbnail != '')
                  <img data-src="{{url('images/movies/thumbnails/'.$movie->thumbnail)}}" class="img-responsive lazy" alt="genre-image">
                @else
                  <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-responsive lazy" alt="genre-image">
                @endif
               
              </div>
            </div>
          </div>

        </div>

        @elseif(isset($season))
          @php
           
            $a_languages = collect();
            if ($season->a_language != null) {
              $a_lan_list = explode(',', $season->a_language);
              for($i = 0; $i < count($a_lan_list); $i++) {
                try {
                  $a_language = App\AudioLanguage::find($a_lan_list[$i])->language;
                  $a_languages->push($a_language);
                } catch (Exception $e) {
                }
              }
            }
             if(isset($auth)){
            $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                          ['user_id', '=', $auth->id],
                                                                          ['season_id', '=', $season->id],
                                                                         ])->first();
                                                                       }
            // Actors list of movie from model
            $actors = collect();
            if ($season->actor_id != null) {
              $p_actors_list = explode(',', $season->actor_id);
              for($i = 0; $i < count($p_actors_list); $i++) {
                try {
                  $p_actor = App\Actor::find(trim($p_actors_list[$i]))->name;
                  $actors->push($p_actor);
                } catch (Exception $e) {
                }
              }
            }

            // Genre list of movie from model
            $genres = collect();
            if ($season->tvseries->genre_id != null){
              $genre_list = explode(',', $season->tvseries->genre_id);
              for ($i = 0; $i < count($genre_list); $i++) {
                try {
                  $genre = App\Genre::find($genre_list[$i])->name;
                  $genres->push($genre);
                } catch (Exception $e) {
                }
              }
            }
          @endphp
          <div class="row">
            <div class="col-md-8">
              <div class="full-movie-dtl-block">
                <h2 class="section-heading">{{$season->tvseries->title}}</h2>
                 <br/>
                <select style="border-radius:8px!important;width:20%;-webkit-box-shadow: none;box-shadow: none;color: #FFF;background: rgba(17, 17, 17, 0.5);display: block;clear: both;border: 1px solid rgba(17, 17, 17, 0.5);border-radius: 0;" name="" id="selectseason" class="form-control">
                  @foreach($season->tvseries->seasons as $allseason)

                    <option {{ $season->season_slug == $allseason->season_slug ? "selected" : "" }} value="{{ $allseason->season_slug }}">{{__('staticwords.season')}} {{ $allseason->season_no }}</option>
                  
                  @endforeach
                </select>
                <br>
                <div class="imdb-ratings-block">
                  <ul>
                    @if(isset($season->publish_year))<li>{{$season->publish_year}}</li>@endif
                    @if(isset($season->season_no))<li>{{$season->season_no}} {{__('staticwords.season')}}</li>@endif
                    @if(isset($season->tvseries->age_req))<li>{{$season->tvseries->age_req}}</li>@endif
                    @if($configs->user_rating != 1)
                      @if(isset($season->tvseries->rating))<li>{{__('staticwords.tmdbrating')}} {{$season->tvseries->rating}}</li>@endif
                    @endif
                    <li><i title="views" class="fa fa-eye"></i> {{ views($season)
                        ->unique()
                        ->count() }}</li>
                  
                  </ul>
                </div>
                    @auth
                  @if($configs->user_rating==1)
                   @php
                $uid=Auth::user()->id;
                $rating=App\UserRating::where('user_id',$uid)->
                where('tv_id',$season->tvseries->id)->first();
                $avg_rating=App\UserRating::where('tv_id',$season->tvseries->id)->avg('rating');
                @endphp
                  <h6>{{__('staticwords.averagerating')}}  <span style="margin-left: 10px;"> {{ number_format($avg_rating, 2) }}</span></h6>
                    {!! Form::open(['method' => 'POST', 'id'=>'formratingtv', 'action' => 'UserRatingController@store']) !!}
                  <input type="text" hidden="" name="tv_id" 
                  value="{{$season->tvseries->id}}">
                    <input type="text" hidden="" name="user_id" value="{{$auth->id}}">
                  <input id="rating" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="0.5" onmouseover ="mouseoverratingtv()" 
                  value="{{isset($rating)? $rating->rating: 0}}">
                  <button type="submit" hidden="" id="submitrating"> Submit Rating</button>
                  {!!Form::close()!!}
                 {{--  <a href="javascript:video(0)" onclick="myrateTv()">Give Rating</a>
                  <button onclick="myrateTv()">Click me</button> --}}
                  @endif
                 @endauth

                 <div class="screen-play-btn-block movie-single-play-btn">
                @if($subscribed==1 && $auth)
                  @if(isset($season->episodes[0]))
                    @if($season->tvseries->age_req =='all age' || $age>=str_replace('+', '',$season->tvseries->age_req))
                      @if($season->episodes[0]->video_link['iframeurl'] !="")
                       
                        <a href="#" onclick="playoniframe('{{ $season->episodes[0]->video_link['iframeurl'] }}','{{ $season->tvseries->id }}','tv')" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                        </a>
                      @else
                        <a href="{{ route('watchTvShow',$season->id)  }}" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span></a>
                      @endif
                    @else
                      <a  onclick="myage({{$age}})" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span></a>
                    @endif
                  @endif
                   @if($season->trailer_url != null || $season->trailer_url != '')
                    <a href="{{ route('watchtvTrailer',$season->id)  }}" class="watch-trailer-btn iframe btn btn-default">{{__('staticwords.watchtrailer')}}</a>
                  @endif
                @else
                   @if($season->trailer_url != null || $season->trailer_url != '')
                    <a href="{{ route('guestwatchtvtrailer',$season->id)  }}" class="watch-trailer-btn iframe btn btn-default">{{__('staticwords.watchtrailer')}}</a>
                  @endif
                @endif
                @if($catlog == 0 && $subscribed==1)
                  @if (isset($wishlist_check->added))
                    <a onclick="addWish({{$season->id}},'{{$season->type}}')" class="watch-trailer-btn addwishlistbtn{{$season->id}}{{$season->type}} btn-default">{{$wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')}}</a>
                  @else
                    <a onclick="addWish({{$season->id}},'{{$season->type}}')" class="watch-trailer-btn addwishlistbtn{{$season->id}}{{$season->type}} btn-default">{{__('staticwords.addtowatchlist')}}</a>
                  @endif
                @elseif($catlog ==1 && $auth)
                  @if (isset($wishlist_check->added))
                    <a onclick="addWish({{$season->id}},'{{$season->type}}')" class="watch-trailer-btn addwishlistbtn{{$season->id}}{{$season->type}} btn-default">{{$wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')}}</a>
                  @else
                    <a onclick="addWish({{$season->id}},'{{$season->type}}')" class="watch-trailer-btn addwishlistbtn{{$season->id}}{{$season->type}} btn-default">{{__('staticwords.addtowatchlist')}}</a>
                  @endif
                @endif
              </div>
                <p>
                  @if ($season->detail != null || $season->detail != '')
                    {{$season->detail}}
                  @else
                    {{$season->tvseries->detail}}
                  @endif
                </p>
              </div>
              <div class="screen-casting-dtl">
                <ul class="casting-headers">
                  @if (count($actors) > 0)
                    <li>{{__('staticwords.starring')}}
                      <span class="categories-count">
                        @for($i = 0; $i < count($actors); $i++)
                          @if($i == count($actors)-1)
                            <a href="{{url('video/detail/actor_search', trim($actors[$i]))}}">{{$actors[$i]}}</a>
                          @else
                            <a href="{{url('video/detail/actor_search', trim($actors[$i]))}}">{{$actors[$i]}}</a>,
                          @endif
                        @endfor
                      </span>
                    </li>
                  @endif
                  @if (count($genres) > 0)
                    <li>{{__('staticwords.genres')}}
                       <span class="categories-count">
                          @for($i = 0; $i < count($genres); $i++)
                            @if($i == count($genres)-1)
                              <a href="{{url('video/detail/genre_search', trim($genres[$i]))}}">{{$genres[$i]}}</a>
                            @else
                              <a href="{{url('video/detail/genre_search', trim($genres[$i]))}}">{{$genres[$i]}}</a>,
                            @endif
                          @endfor
                       </span>
                    </li>
                  @endif
                  @if(count($season->episodes)>0)
                    @php
                      $subtitles = collect();
                      foreach ($season->episodes as $e) {
                          foreach ($e->subtitles as $sub) {
                              $subtitles->push($sub->sub_lang);
                          }
                      }

                      $subtitles = $subtitles->unique();
                    @endphp
                    @if(count($subtitles)>0)
                      <li>{{__('staticwords.subtitles')}}
                        <span class="categories-count">
                          @foreach($subtitles as $key=> $sub)
                            @if($key == count($subtitles)-1)
                                    {{ $sub }}
                            @else
                                      {{ $sub }},
                            @endif
                          @endforeach
                        </span>
                      </li>
                    @endif
                  @endif
                  @if($season->a_language != null && isset($a_languages))
                    <li>{{__('staticwords.audiolanguage')}}
                     <span class="categories-count">
                        @for($i = 0; $i < count($a_languages); $i++)
                          @if($i == count($a_languages)-1)
                            {{$a_languages[$i]}}
                          @else
                            {{$a_languages[$i]}},
                          @endif
                        @endfor
                      </span>
                   </li>
                  @endif
                </ul>
                
              </div>
              
            </div>
            <div class="col-md-4">
              <div class="poster-thumbnail-block home-prime-slider">
                @if($season->thumbnail != null)
                  <img data-src="{{url('images/tvseries/thumbnails/'.$season->thumbnail)}}" class="img-responsive lazy" alt="genre-image">
                @elseif($season->tvseries->thumbnail != null)
                  <img data-src="{{url('images/tvseries/thumbnails/'.$season->tvseries->thumbnail)}}" class="img-responsive lazy" alt="genre-image">
                @else
                  <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-responsive lazy" alt="genre-image">
                @endif
                
              </div>
            </div>
          </div>
        @endif
      </div>
    </div>

    @if(isset($actors) && count($actors) > 0)
    <div class="genre-prime-block movie-series-section search-section starring-section">
      <div class="container-fluid">
        <h5 class="section-heading">{{__('staticwords.starring')}} </h5>
        <div class="genre-prime-slide owls-item">
          <ul>
             @foreach($actors as $key => $actor)
                @php
                  $actor_detail = App\Actor::where('name',$actor)->first();
                @endphp
            <li>
              <div class="genre-slide-image actor_detail">
                <a href="{{url('video/detail/actor_search',$actor_detail->name)}}">
                  @if($actor_detail->image != null || $actor_detail->image != '')
                  <img src="{{url('/images/actors/'.$actor_detail->image)}}" class="img-fluid" alt="{{$actor_detail->name}}">
                  @else
                   <img src="{{Avatar::create($actor_detail->name)->toBase64()}}" class="img-fluid" alt="">
                  @endif
                </a>
              </div>
            </li>
            @endforeach
          </ul>  
        </div>
       
      </div>
    </div>
    @endif

    <!-- movie series -->
    @if(isset($movie->movie_series) && $movie->series != 1)
      @if(count($movie->movie_series) > 0)
        <div class="container-fluid movie-series-section search-section">
          <h5 class="movie-series-heading">Series {{count($movie->movie_series)}}</h5>
          <div>
            @foreach($movie->movie_series as $series)
              @php
                $single_series = \App\Movie::where('id', $series->series_movie_id)->first();
                 if(isset($auth)){
                $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                      ['user_id', '=', $auth->id],
                      ['movie_id', '=', $single_series->id],
                     ])->first();
                   }
              @endphp
              <div class="movie-series-block movie-section">
                <div class="row">
                  <div class="col-lg-2">
                    <div class="movie-series-img home-prime-slider">
                      @if($single_series->thumbnail != null || $single_series->thumbnail != '')
                        <img src="{{url('images/movies/thumbnails/'.$single_series->thumbnail)}}" class="img-responsive lazy" alt="movie-image">
                      @else
                        <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-responsive lazy" alt="movie-image">
                      @endif
                    
                    </div>
                  </div>
                  <div class="col-lg-10">
                    <div class="movie-series-section">
                      <div class="row">
                        <div class="col-lg-8"> 
                          @if($auth && $subscribed == 1)
                          <h5 class="movie-series-heading movie-series-name"><a href="{{url('movie/detail', $single_series->slug)}}">{{$single_series->title}}</a></h5>
                          @else
                             <h5 class="movie-series-heading movie-series-name"><a href="{{url('movie/guest/detail', $single_series->slug)}}">{{$single_series->title}}</a></h5>
                          @endif
                        </div>
                        <div class="col-lg-4">
                          <ul class="movie-series-des-list movie-series-des-list-two">
                            <li>{{$single_series->duration}} {{__('staticwords.mins')}}</li>
                          </ul>
                        </div>
                      </div>
                      <p>
                         {{str_limit($single_series->detail,360)}}
                       
                      </p>
                       @if($auth && $subscribed ==1)
                          <a href="{{url('movie/detail', $single_series->slug)}}">{{__('staticwords.readmore')}}</a>
                        @else
                          <a href="{{url('movie/guest/detail', $single_series->slug)}}">{{__('staticwords.readmore')}}</a>
                        @endif
                       
                      <div class="des-btn-block des-in-list">
                        @if($subscribed==1 && $auth)
                          @if($single_series->is_upcoming != 1)
                            @if($single_series->maturity_rating == 'all age' || $age>=str_replace('+', '',$single_series->maturity_rating))
                              @if(isset($single_series->video_link['iframeurl']) && $single_series->video_link['iframeurl'] != null)
                                
                                <a href="{{route('watchmovieiframe',$single_series->id)}}"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                                 </a>
                       
                              @else

                                <a href="{{route('watchmovie',$single_series->id)}}" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                                  </a>
                                  
                              @endif
                            @else

                              <a onclick="myage({{$age}})"  class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                              </a>
                              
                            @endif
                          @endif
                          @if($single_series->trailer_url != null || $single_series->trailer_url != '')
                            <a href="{{ route('watchTrailer',$single_series->id)  }}" class="iframe btn btn-default">{{__('staticwords.watchtrailer')}}</a>
                          @endif
                        @else
                           @if($single_series->trailer_url != null || $single_series->trailer_url != '')
                            <a href="{{ route('guestwatchtrailer',$single_series->id)  }}" class="iframe btn btn-default">{{__('staticwords.watchtrailer')}}</a>
                          @endif
                        @endif
                        @if($catlog ==0 && $subscribed ==1)
                          @if (isset($wishlist_check->added))
                            <a onclick="addWish({{$single_series->id}},'{{$single_series->type}}')" class="watch-trailer-btn addwishlistbtn{{$single_series->id}}{{$single_series->type}} btn-default">{{$wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')}}</a>
                          @else
                            <a onclick="addWish({{$single_series->id}},'{{$single_series->type}}')" class="watch-trailer-btn addwishlistbtn{{$single_series->id}}{{$single_series->type}} btn-default">{{__('staticwords.addtowatchlist')}}</a>
                          @endif
                        @elseif($catlog ==1 && $auth)
                          @if (isset($wishlist_check->added))
                            <a onclick="addWish({{$single_series->id}},'{{$single_series->type}}')" class="watch-trailer-btn addwishlistbtn{{$single_series->id}}{{$single_series->type}} btn-default">{{$wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')}}</a>
                          @else
                            <a onclick="addWish({{$single_series->id}},'{{$single_series->type}}')" class="watch-trailer-btn addwishlistbtn{{$single_series->id}}{{$single_series->type}} btn-default">{{__('staticwords.addtowatchlist')}}</a>
                          @endif
                        @endif
                         
                        @php
                         $mlc = array();
                          if(isset($single_series->multilinks)){
                            foreach ($single_series->multilinks as $key => $value) {
                               if($value->download == 1){
                                $mlc[] = 1;
                               }else{
                                  $mlc[] = 0;
                               }
                            }
                          }
                        @endphp

                        @if(isset($single_series->multilinks) && count($single_series->multilinks) > 0 )   
                          @if(Auth::user() && $subscribed==1)
                            @if(in_array(1, $mlc))
                               <button type="button" class="btn btn-sm btn-default" data-toggle="collapse" data-target="#downloadmovie">{{__('staticwords.download')}}</button>

                              <div id="downloadmovie" class="collapse">
                                <table  class=" text-center table table-bordered table-responsive detail-multiple-link">
                                  <thead>
                                    <th align="center">#</th>
                                    <th align="center">{{__('staticwords.download')}}</th>
                                    <th align="center">{{__('staticwords.quality')}}</th>
                                    <th align="center">{{__('staticwords.size')}}</th>
                                    <th align="center">{{__('staticwords.language')}}</th>
                                    <th align="center">{{__('staticwords.clicks')}}</th>
                                    <th align="center">{{__('staticwords.user')}}</th>
                                    <th align="center">{{__('staticwords.added')}}</th>
                                  </thead>
                             
                                  <tbody>
                                    
                                   @foreach($single_series->multilinks as $key=> $link)
                                    
                                      @if($link->download == 1)
                                        <tr>
                                          @php
                                            $lang = App\AudioLanguage::where('id',$link->language)->first();
                                          @endphp

                                          <td align="center">{{$key+1}}</td>
                                          <td align="center"><a data-id="{{$link->id}}" class="download btn btn-sm btn-success" title="{{__('staticwords.download')}}" href="{{$link->url}}" ><i class="fa fa-download"></i></td>
                                          <td align="center">{{$link->quality}}</td>
                                          <td align="center">{{$link->size}}</td>
                                          <td align="center">@if(isset($lang)){{$lang->language}}@endif</td>
                                          <td>{{$link->clicks}}</td>
                                          <td align="center">{{$link->movie->user->name}}</td>
                                          <td align="center">{{date('Y-m-d',strtotime($link->created_at))}}</td>
                                        </tr>
                                      @endif
                                    @endforeach
                                  </tbody>
                                  
                                </table>
                              </div>
                            @endif
                          @endif
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endif
    @endif
    @if(isset($filter_series) && $movie->series == 1)
      @if(count($filter_series) > 0)
        <div class="container-fluid movie-series-section search-section">
          <h5 class="movie-series-heading">{{__('staticwords.series')}} {{count($filter_series)}}</h5>
          <div>
            @foreach($filter_series as $key => $series)
              @php
               if(isset($auth)){
                $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                    ['user_id', '=', $auth->id],
                    ['movie_id', '=', $series->id],
                   ])->first();
                 }
              @endphp
              <div class="movie-series-block movie-section">
                <div class="row">
                  <div class="col-lg-2">
                    <div class="movie-series-img home-prime-slider">
                      @if($series->thumbnail != null)
                        <img src="{{url('images/movies/thumbnails/'.$series->thumbnail)}}" class="img-responsive lazy" alt="movie-image">
                      @else
                        <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-responsive lazy" alt="movie-image">
                      @endif
                    
                    </div>
                  </div>
                  <div class="col-lg-10">
                    <div class="movie-series-section">
                      <div class="row">
                        <div class="col-lg-8"> 
                          @if($auth && $subscribed ==1)
                          <h5 class="movie-series-heading movie-series-name"><a href="{{url('movie/detail', $series->slug)}}">{{$series->title}}</a></h5>
                          @else
                            <h5 class="movie-series-heading movie-series-name"><a href="{{url('movie/guest/detail', $series->slug)}}">{{$series->title}}</a></h5>
                          @endif
                        </div>
                        <div class="col-lg-4">
                          <ul class="movie-series-des-list movie-series-des-list-two">
                            <li>{{$series->duration}} {{__('staticwords.mins')}}</li>
                          </ul>
                        </div>
                      </div>
                      <p>
                        {{str_limit($series->detail,360)}}

                      </p>
                      @if($auth && $subscribed ==1)
                          <a href="{{url('movie/detail', $series->slug)}}">{{__('staticwords.readmore')}}</a>
                        @else
                          <a href="{{url('movie/guest/detail', $series->slug)}}">{{__('staticwords.readmore')}}</a>
                        @endif
                      <div class="des-btn-block des-in-list">
                        @if($subscribed==1 && $auth)
                        @if($series->is_upcoming != 1)
                          @if($series->maturity_rating == 'all age' || $age>=str_replace('+', '',$series->maturity_rating))
                            @if(isset($series->video_link['iframeurl']) && $series->video_link['iframeurl'] != null)
                              
                              <a href="{{route('watchmovieiframe',$series->id)}}"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                               </a>
                     
                            @else

                              <a href="{{route('watchmovie',$series->id)}}" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                                </a>
                                
                            @endif
                          @else

                            <a onclick="myage({{$age}})"  class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                            </a>
                            
                          @endif
                        @endif
                          @if($series->trailer_url != null || $series->trailer_url != '')
                            <a href="{{ route('watchTrailer',$series->id)  }}" class="iframe btn btn-default">{{__('staticwords.watchtrailer')}}</a>
                          @endif
                        @else
                           @if($series->trailer_url != null || $series->trailer_url != '')
                            <a href="{{ route('guestwatchtrailer',$series->id)  }}" class="iframe btn btn-default">{{__('staticwords.watchtrailer')}}</a>
                          @endif
                        @endif
                        @if($catlog ==0 && $subscribed ==1)
                          @if (isset($wishlist_check->added))
                            <a onclick="addWish({{$series->id}},'{{$series->type}}')" class="watch-trailer-btn addwishlistbtn{{$series->id}}{{$series->type}} btn-default">{{$wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')}}</a>
                          @else
                            <a onclick="addWish({{$series->id}},'{{$series->type}}')" class="watch-trailer-btn addwishlistbtn{{$series->id}}{{$series->type}} btn-default">{{__('staticwords.addtowatchlist')}}</a>
                          @endif
                        @elseif($catlog ==1 && $auth)
                          @if (isset($wishlist_check->added))
                            <a onclick="addWish({{$series->id}},'{{$series->type}}')" class="watch-trailer-btn addwishlistbtn{{$series->id}}{{$series->type}} btn-default">{{$wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')}}</a>
                          @else
                            <a onclick="addWish({{$series->id}},'{{$series->type}}')" class="watch-trailer-btn addwishlistbtn{{$series->id}}{{$series->type}} btn-default">{{__('staticwords.addtowatchlist')}}</a>
                          @endif
                        @endif
                         
                        @php
                         $mlc = array();
                          if(isset($series->multilinks)){
                            foreach ($series->multilinks as $key => $value) {
                               if($value->download == 1){
                                $mlc[] = 1;
                               }else{
                                  $mlc[] = 0;
                               }
                            }
                          }
                        @endphp

                        @if(isset($series->multilinks) && count($series->multilinks) > 0 )   
                          @if(Auth::user() && $subscribed==1)
                            @if(in_array(1, $mlc))
                               <button type="button" class="btn btn-sm btn-default" data-toggle="collapse" data-target="#downloadmovie">{{__('staticwords.download')}}</button>

                              <div id="downloadmovie" class="collapse">
                                <table  class=" text-center table table-bordered table-responsive detail-multiple-link">
                                  <thead>
                                    <th align="center">#</th>
                                    <th align="center">{{__('staticwords.download')}}</th>
                                    <th align="center">{{__('staticwords.quality')}}</th>
                                    <th align="center">{{__('staticwords.size')}}</th>
                                    <th align="center">{{__('staticwords.language')}}</th>
                                    <th align="center">{{__('staticwords.clicks')}}</th>
                                    <th align="center">{{__('staticwords.user')}}</th>
                                    <th align="center">{{__('staticwords.added')}}</th>
                                  </thead>
                             
                                  <tbody>
                                    
                                   @foreach($series->multilinks as $key=> $link)
                                    
                                      @if($link->download == 1)
                                        <tr>

                                          @php
                                        
                                            $lang = App\AudioLanguage::where('id',$link->language)->first();
                                          @endphp

                                          <td align="center">{{$key+1}}</td>
                                          <td align="center"><a data-id="{{$link->id}}" class="download btn btn-sm btn-success" title="{{__('staticwords.download')}}" href="{{$link->url}}" ><i class="fa fa-download"></i></td>
                                          <td align="center">{{$link->quality}}</td>
                                          <td align="center">{{$link->size}}</td>
                                          <td align="center">@if(isset($lang)){{$lang->language}}@endif</td>
                                          <td>{{$link->clicks}}</td>
                                          <td align="center">{{$link->movie->user->name}}</td>
                                          <td align="center">{{date('Y-m-d',strtotime($link->created_at))}}</td>
                                         
                                          
                                        </tr>

                                      @endif

                                    @endforeach
                                  
                                  </tbody>
                                  
                                </table>
                              </div>
                            @endif
                          @endif
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endif
    @endif
    <!-- end movie series -->


<br/>
<br/>
  
   <!-- episodes -->
    @if(isset($season->episodes))
      @if(count($season->episodes) > 0)
        <div class="container-fluid movie-series-section search-section">
          <h5 class="movie-series-heading">{{__('staticwords.episodes')}} {{count($season->episodes)}}</h5>
          <div>
            @foreach($season->episodes as $key => $episode)

              <div class="movie-series-block movie-section">
                <div class="row">
                  <div class="col-lg-2">
                    <div class="movie-series-img home-prime-slider">
                      @if($episode->thumbnail != null)
                        <img data-src="{{url('images/tvseries/episodes/'.$episode->thumbnail)}}" class="img-responsive lazy" alt="genre-image">
                      @elseif($episode->thumbnail != null)
                        <img data-src="{{url('images/tvseries/episodes/'.$episode->thumbnail)}}" class="img-responsive lazy" alt="genre-image">
                      @else
                        <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-responsive lazy" alt="genre-image">
                      @endif
                     
                    </div>
                  </div>
                    
                  <div class="col-lg-10">
                    <div class="movie-series-section">
                      <div class="row">
                        <div class="col-lg-8"> 
                          @if($auth && $subscribed==1)
                             @if($episode->seasons->tvseries->maturity_rating =='all age' || $age>=str_replace('+', '',$episode->seasons->tvseries->maturity_rating))
                              @if(isset($episode->video_link['iframeurl']) && $episode->video_link['iframeurl'] !="")
                                 <a onclick="playoniframe('{{ $episode->video_link['iframeurl'] }}','{{ $episode->seasons->tvseries->id }}','tv')" class="btn btn-play btn-sm-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><h5 class="movie-series-heading movie-series-name">{{$key+1}}. {{$episode->title}}</h5></span></a>
                              @else
                                 <a href="{{ route('watch.Episode', $episode->id) }}" class="iframe btn btn-play btn-sm-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><h5 class="movie-series-heading movie-series-name">{{$key+1}}. {{$episode->title}}</h5></span></a>
                              @endif
                            @else
                              <a onclick="myage({{$age}})" class="btn btn-play btn-sm-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><h5 class="movie-series-heading movie-series-name">{{$key+1}}. {{$episode->title}}</h5></span></a>
                            @endif
                          @else
                            <h5 class="movie-series-heading movie-series-name">{{$key+1}}. {{$episode->title}}</h5>
                          @endif
                        </div>
                        @if(isset($episode->duration) && $episode->duration > 0)
                        <div class="col-lg-4">
                          <ul class="movie-series-des-list">
                            <li>{{$episode->duration}}{{__('staticwords.mins')}}</li>
                          </ul>
                        </div>
                        @endif
                      </div>
                      @php
                        $a_languages = collect();
                        if ($episode->a_language != null) {
                          $a_lan_list = explode(',', $episode->a_language);
                          for($i = 0; $i < count($a_lan_list); $i++) {
                            try {
                              $a_language = App\AudioLanguage::find($a_lan_list[$i])->language;
                              $a_languages->push($a_language);
                            } catch (Exception $e) {
                            }
                          }
                        }
                      @endphp
                      <p>
                        {{str_limit($episode->detail, 480)}} 
                       
                      </p>
                      @php
                         $elc = array();
                        if(isset($episode->multilinks)){
                          foreach ($episode->multilinks as $key => $value) {
                             if($value->download == 1){
                              $elc[] = 1;
                             }else{
                                $elc[] = 0;
                             }
                          }
                        }
                      @endphp
                      @if(isset($episode->multilinks) &&  count($episode->multilinks) >0)
                        @if(Auth::user() && $subscribed==1)
                          @if(in_array(1, $elc))

                            <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#downloadtvseries">{{__('staticwords.download')}}</button>

                            <div id="downloadtvseries" class="collapse">
                              <br/>
                              <table   class=" text-center table table-bordered table-responsive detail-multiple-link">
                                <thead>
                                  <th align="center">#</th>
                                  <th align="center">{{__('staticwords.download')}}</th>
                                  <th align="center">{{__('staticwords.quality')}}</th>
                                  <th align="center">{{__('staticwords.size')}}</th>
                                  <th align="center">{{__('staticwords.language')}}</th>
                                  <th align="center">{{__('staticwords.clicks')}}</th>
                                  <th align="center">{{__('staticwords.user')}}</th>
                                  <th align="center">{{__('staticwords.added')}}</th>
                                </thead>
                           
                                <tbody>
                                  @foreach($episode->multilinks as $key=> $link)
                                    @if($link->download == 1)
                                      <tr>
                                        @php
                                          $lang = App\AudioLanguage::where('id',$link->language)->first();
                                        @endphp

                                        <td align="center">{{$key+1}}</td>
                                        <td align="center"><a data-id="{{$link->id}}" class="download btn btn-sm btn-success" title="download" href="{{$link->url}}" ><i class="fa fa-download"></i></td>
                                        <td align="center">{{$link->quality}}</td>
                                        <td align="center">{{$link->size}}</td>
                                        <td align="center">@if(isset($lang)){{$lang->language}}@endif</td>
                                        <td>{{$link->clicks}}</td>
                                        <td align="center">{{$link->episode->seasons->tvseries->user->name}}</td>
                                        <td align="center">{{date('Y-m-d',strtotime($link->created_at))}}</td>
                                      </tr>
                                    @endif
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                          @endif
                        @endif
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      
      @endif
    @endif
    <!-- end episode -->




   
<br/>


{{-- comments section start from here --}}
@if(isset($movie))
  @if($configs->comments == 1)
    
    <div class="container-fluid movie-series-section comment-nav-tabs">
       <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist" >
       
        <li role="presentation" class="active"><a href="#showcomment" aria-controls="showcomment" role="tab" data-toggle="tab" style="z-index:999;">{{__('staticwords.comment')}}</a></li>
      

        @if($subscribed ==1)
        <li role="presentation" style="z-index:999;"><a href="#postcomment" aria-controls="postcomment" role="tab" data-toggle="tab">{{__('staticwords.postcomment')}}</a></li>
        @endif
      </ul>
      <br/>
      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="showcomment">
          @if(isset($movie->comments) && $movie->comments->isEmpty())
           <div class="row text-center" style="color:#B1B1B1;">
             <h4 class="text-center"><i class="fa fa-comment-o"></i> &nbsp;{{__('No comments yet!')}}</h4>&nbsp;
              <small class="text-center">{{__('Be the first to share what you think !')}}</small>
           </div>
            
          @else
             
            <h4 class="title" style="color:#B1B1B1;"><span class="glyphicon glyphicon-comment"></span> {{$movie->comments->where('status',1)->count()}} {{__('staticwords.comment')}} </h4> <br/>
             
              @foreach ($movie->comments->where('status','1') as $comment)

                  <div class="comment">
                    <div class="author-info">
                      <img src="{{ Avatar::create($comment->name )->toBase64() }}" class="author-image">
                      <div class="author-name">
                        <h4 class="author-heading">{{$comment->name}}</h4>
                        <p class="author-time">{{date('F jS, Y - g:i a',strtotime($comment->created_at))}}</p>
                      </div>
                       @if(Auth::check() && (Auth::user()->is_admin == 1 || $comment->user_id == Auth::user()->id))  
                      <button type="button" class="btn btn-danger btn-floating pull-right" data-toggle="modal" data-target="#deleteModal{{$comment->id}}" style="left:10px;position:relative;"><i class="fa fa-trash-o"></i></button>
                      @endif
                      @if($subscribed == 1)
                      <button type="button" class="btn btn-danger comment-btn btn-floating pull-right" data-toggle="modal" data-target="#{{$comment->id}}deleteModal"><i class="fa fa-reply"></i></button>
                      @endif
                    </div>

                    <div class="comment-content">
                     {{$comment->comment}}
                    </div>
                  </div>
                  <!-- ---------------- comment delete ------------>
                      <div id="deleteModal{{$comment->id}}" class="delete-modal  modal fade" role="dialog">
                        <div class="modal-dialog modal-sm">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <div class="delete-icon"></div>
                            </div>
                            <div class="modal-body text-center">
                              <h4 class="modal-heading comment-delete-heading">{{__('staticwords.areyousure')}}</h4>
                              <p class="comment-delete-detail">{{__('staticwords.modelmessage')}}</p>
                            </div>
                             <div class="modal-footer">
                              {!! Form::open(['method' => 'DELETE', 'action' => ['MovieCommentController@deletecomment', $comment->id]]) !!}
                                  <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('staticwords.no')}}</button>
                                  <button type="submit" class="btn btn-danger">{{__('staticwords.yes')}}</button>
                              {!! Form::close() !!}
                            </div>
                          </div>
                        </div>
                      </div>
                    <!-------------------- end comment delete ------------------->
                 
                      
                        <!-- Modal -->
                      
                       
                 

                  @foreach($comment->subcomments->where('status',1) as $subcomment)

                    <div class="comment" style="margin-left:50px;">
                      <div class="author-info">
                         @php
                             $name=App\user::where('id',$subcomment->user_id)->first();
                           @endphp
                        <img src="{{ Avatar::create($name->name )->toBase64() }}" class="author-image">
                        <div class="author-name">
                         
                          <h5 class="author-heading">{{$name->name}}</h5>
                          <p class="author-time">{{date('F jS, Y - g:i a',strtotime($subcomment->created_at))}}</p>
                        </div>
                         @if(Auth::check() && (Auth::user()->is_admin == 1 || $subcomment->user_id == Auth::user()->id))
                       
                           <button type="button" class="btn btn-danger btn-floating comment-btn pull-right" data-toggle="modal" data-target="#subdeleteModal{{$subcomment->id}}"><i class="fa fa-trash-o"></i></button>
                         <div id="subdeleteModal{{$subcomment->id}}" class="delete-modal modal fade" role="dialog">
                        <div class="modal-dialog modal-sm">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <div class="delete-icon"></div>
                            </div>
                            <div class="modal-body text-center">
                              <h4 class="modal-heading comment-delete-heading ">{{__('staticwords.areyousure')}}</h4>
                              <p class="comment-delete-detail">{{__('staticwords.modelmessage')}}</p>
                            </div>
                             <div class="modal-footer">
                              {!! Form::open(['method' => 'DELETE', 'action' => ['MovieCommentController@deletesubcomment', $subcomment->id]]) !!}
                                  <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('staticwords.no')}}</button>
                                  <button type="submit" class="btn btn-danger">{{__('staticwords.yes')}}</button>
                              {!! Form::close() !!}
                            </div>
                          </div>
                        </div>
                      </div>

                       
                      @endif
                      </div>

                      <div class="comment-content">
                       {{$subcomment->reply}}
                      </div>
                     
                    </div>
                  
                  @endforeach
                  <div id="{{$comment->id}}deleteModal" class="comment-modal modal fade" role="dialog"  style="margin-top: 20px;">
                          <div class="modal-dialog modal-md" style="margin-top:70px;">
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                 
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <div class="delete-icon"></div>
                               <h4 style="color:#FFF;"> {{__('staticwords.replyfor')}} {{$comment->name}}</h4>
                              </div>
                              <div class="modal-body text-center">
                                 
                                  <form action="{{route('movie.comment.reply', ['cid' =>$comment->id])}}" method ="POST">
                                    {{ csrf_field() }}
                                  {{Form::label('reply',__('staticwords.yourreply'))}}
                                  {{Form::textarea('reply', null, ['class' => 'form-control', 'rows'=> '5','cols' => '10'])}} 
                                  <br/>
                                    <button type="submit" class="btn btn-danger">{{__('staticwords.submit')}}</button>
                               </form>
                              </div>
                              <div class="modal-footer">
                               
                              </div>
                            </div>
                          </div>
                  </div>
              @endforeach
          @endif
        </div>

        @auth
        <div role="tabpanel" class="tab-pane fade" id="postcomment">
            <div style="width: 90%;color:#B1B1B1;" class=" " >
                <h3 class="author-heading">{{__('staticwords.postcomment')}}:</h3><br/>
                 
                    {{Form::open( ['route' => ['movie.comment.store', $movie->id], 'method' => 'POST'])}}
                    {{Form::label('name', __('staticwords.name'))}}
                    {{Form::text('name', Auth::user()->name, ['class' => 'form-control','disabled'])}}
                    <br/>
                    {{Form::label('email', __('staticwords.email'))}}
                     {{Form::email('email', Auth::user()->email, ['class' => 'form-control','disabled'])}}
                    <br/>
                    {{Form::label('comment',__('staticwords.comment'))}}
                    {{Form::textarea('comment', null, ['class' => 'form-control', 'rows'=> '5','cols' => '10'])}}
                    <br/>
                    {{Form::submit(__('staticwords.addcomment'), ['class' => 'btn btn-md btn-default'])}}
            </div>

        </div>
        @endauth
      </div>
    </div>
    <br/>
  @endif
@endif


{{-- comments section start from here --}}
@if(isset($season))
  @if($configs->comments == 1)
    <div class="container-fluid movie-series-section comment-nav-tabs">
     <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
       
        <li role="presentation" class="active"><a href="#showcomment" aria-controls="showcomment" role="tab" data-toggle="tab" style="z-index:999;">{{__('staticwords.comment')}}</a></li>
        
        @if($subscribed == 1)
        <li role="presentation"><a href="#postcomment" aria-controls="postcomment" role="tab" data-toggle="tab" style="z-index:999;">{{__('staticwords.postcomment')}}</a></li>
        @endif
      </ul>
      <br/>
    <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="showcomment">
          @if(isset($season->tvseries->comments) && $season->tvseries->comments->isEmpty())
           <div class="row text-center" style="color:#B1B1B1;">
             <h4 class="text-center"><i class="fa fa-comment-o"></i> &nbsp;{{__('No comments yet!')}}</h4>&nbsp;
              <small class="text-center">{{__('Be the first to share what you think !')}}</small>
           </div>
          @else
          <h4 class="title" style="color:#B1B1B1;"><span class="glyphicon glyphicon-comment"></span> {{$season->tvseries->comments->where('status',1)->count()}} {{__('staticwords.comment')}} </h4> <br/>
            
            @foreach ($season->tvseries->comments->where('status',1) as $comment)

                <div class="comment">
                  <div class="author-info">
                    <img src="{{ Avatar::create($comment->name )->toBase64() }}" class="author-image">
                    <div class="author-name">
                      <h4 class="author-heading">{{$comment->name}}</h4>
                      <p class="author-time">{{date('F jS, Y - g:i a',strtotime($comment->created_at))}}</p>
                    </div>
                     @if(Auth::check() && (Auth::user()->is_admin == 1 || $comment->user_id == Auth::user()->id))  
                    <button type="button" class="btn btn-danger comment-btn btn-floating pull-right" data-toggle="modal" data-target="#deleteModal{{$comment->id}}" style="left:10px;position:relative;"><i class="fa fa-trash-o"></i></button>


                      <!-- ---------------- comment delete ------------>
                    <div id="deleteModal{{$comment->id}}" class="delete-modal comment-modal modal fade" role="dialog">
                      <div class="modal-dialog modal-sm">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="delete-icon"></div>
                          </div>
                          <div class="modal-body text-center">
                            <h4 class="modal-heading comment-delete-heading">{{__('staticwords.areyousure')}}</h4>
                            <p class="comment-delete-detail">{{__('staticwords.modelmessage')}}</p>
                          </div>
                           <div class="modal-footer">
                            {!! Form::open(['method' => 'DELETE', 'action' => ['TVCommentController@deletecomment', $comment->id]]) !!}
                                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('staticwords.no')}}</button>
                                <button type="submit" class="btn btn-danger">{{__('staticwords.yes')}}</button>
                            {!! Form::close() !!}
                          </div>
                        </div>
                      </div>
                    </div>
                  <!-------------------- end comment delete ------------------->


                    @endif
                    @if($subscribed == 1)
                     <button type="button" class=" btn btn-danger comment-btn btn-floating pull-right" data-toggle="modal" data-target="#{{$comment->id}}deleteModal"><i class="fa fa-reply"></i> </button>
                    @endif
                  </div>

                  <div class="comment-content">
                   {{$comment->comment}}
                  </div>
                </div>
                <div>
                   
                      <!-- Modal -->
                     
                      <div id="{{$comment->id}}deleteModal" class="delete-modal comment-modal modal fade" role="dialog"  style="margin-top: 20px;">
                        <div class="modal-dialog modal-md" style="margin-top:70px;">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                               
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <div class="delete-icon"></div>
                             <h4 style="color:#FFF;"> {{__('staticwords.replyfor')}} {{$comment->name}}</h4>
                            </div>
                            <div class="modal-body text-center">
                               
                                <form action="{{route('tv.comment.reply', ['cid' =>$comment->id])}}" method ="POST">
                                  {{ csrf_field() }}
                                {{Form::label('reply',__('staticwords.yourreply'))}}
                                {{Form::textarea('reply', null, ['class' => 'form-control', 'rows'=> '5','cols' => '10'])}} 
                                <br/>
                                  <button type="submit" class="btn btn-danger">{{__('staticwords.submit')}}</button>
                             </form>
                            </div>
                            <div class="modal-footer">
                             
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
                 @foreach($comment->subcomments->where('status',1) as $subcomment)
                  
                    <div class="comment" style="margin-left:50px;">
                    <div class="author-info">
                       @php
                           $name=App\user::where('id',$subcomment->user_id)->first();
                         @endphp
                      <img src="{{ Avatar::create($name->name )->toBase64() }}" class="author-image">
                      <div class="author-name">
                       
                        <h5 class="author-heading">{{$name->name}}</h5>
                        <p class="author-time">{{date('F jS, Y - g:i a',strtotime($subcomment->created_at))}}</p>
                      </div>
                        @if(Auth::check() && (Auth::user()->is_admin == 1 || $subcomment->user_id == Auth::user()->id))
                     
                         <button type="button" class="btn btn-danger comment-btn btn-floating pull-right" data-toggle="modal" data-target="#subdeleteModal{{$subcomment->id}}"><i class="fa fa-trash-o"></i></button>    
                       <div id="subdeleteModal{{$subcomment->id}}" class="delete-modal comment-modal modal fade" role="dialog">
                      <div class="modal-dialog modal-sm">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="delete-icon"></div>
                          </div>
                          <div class="modal-body text-center">
                            <h4 class="modal-heading comment-delete-heading">{{__('staticwords.areyousure')}}</h4>
                            <p class="comment-delete-detail">{{__('staticwords.modalmessage')}}</p>
                          </div>
                           <div class="modal-footer">
                            {!! Form::open(['method' => 'DELETE', 'action' => ['TVCommentController@deletesubcomment', $subcomment->id]]) !!}
                                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('staticwords.no')}}</button>
                                <button type="submit" class="btn btn-danger">{{__('staticwords.yes')}}</button>
                            {!! Form::close() !!}
                          </div>
                        </div>
                      </div>
                    </div>

                     
                    @endif
                      


                    </div>

                    <div class="comment-content">
                     {{$subcomment->reply}}
                    </div>
                  </div>

                @endforeach
            @endforeach
          @endif
        </div>
        @auth
        <div role="tabpanel" class="tab-pane fade" id="postcomment">
            <div style="width: 90%;color:#B1B1B1;" class=" " >
                <h3>{{__('staticwords.postcomment')}}:</h3><br/>
              
                    {{Form::open( ['route' => ['tv.comment.store', $season->tvseries->id], 'method' => 'POST'])}}
                    {{Form::label('name', __('staticwords.name'))}}
                    {{Form::text('name', Auth::user()->name, ['class' => 'form-control','disabled'])}}
                    <br/>
                    {{Form::label('email', __('staticwords.email'))}}
                     {{Form::email('email', Auth::user()->email, ['class' => 'form-control','disabled'])}}
                    <br/>
                    {{Form::label('comment',__('staticwords.comment'))}}
                    {{Form::textarea('comment', null, ['class' => 'form-control', 'rows'=> '5','cols' => '10'])}}
                    <br/>
                    {{Form::submit(__('staticwords.addcomment'), ['class' => 'btn btn-md btn-default'])}}
            </div>

        </div>
        @endauth
      </div>
    </div>
  <br/>
  @endif
@endif
      
    <!-- end episodes -->
<br/>
    @if($prime_genre_slider == 1)
      @php
        $all = collect();
        $all_fil_movies = App\Movie::all();
        $all_fil_tv = App\TvSeries::all();
        if (isset($movie)) {
          $genres = explode(',', $movie->genre_id);
        } elseif (isset($season)) {
          $genres = explode(',', $season->tvseries->genre_id);
        }
        for($i = 0; $i < count($genres); $i++) {
          foreach ($all_fil_movies as $fil_movie) {
            $fil_genre_item = explode(',', trim($fil_movie->genre_id));
            for ($k=0; $k < count($fil_genre_item); $k++) {
              if (trim($fil_genre_item[$k]) == trim($genres[$i])) {
                if (isset($movie)) {
                  if ($fil_movie->id != $movie->id) {
                    $all->push($fil_movie);
                  }
                } else {
                  $all->push($fil_movie);
                }
              }
            }
          }
        }
        if (isset($movie)) {
          $all = $all->except($movie->id);
        }

        for($i = 0; $i < count($genres); $i++) {
          foreach ($all_fil_tv as $fil_tv) {
            $fil_genre_item = explode(',', trim($fil_tv->genre_id));
            for ($k=0; $k < count($fil_genre_item); $k++) {
              if (trim($fil_genre_item[$k]) == trim($genres[$i])) {
                $fil_tv = $fil_tv->seasons;
                if (isset($season)) {
                  $all->push($fil_tv->except($season->id));
                } else {
                  $all->push($fil_tv);
                }
              }
            }
          }
        }
        $all = $all->unique();
        $all = $all->flatten();
      @endphp
      @if (isset($all) && count($all) > 0)
        <div class="genre-prime-block">
          <div class="container-fluid">
            <h5 class="section-heading">{{__('staticwords.customeralsowatched')}}</h5>
            <div class="genre-prime-slider owl-carousel">
              @if(isset($all))
                @foreach($all as $key => $item)
                  @php
                   if(isset($auth)){
                    if ($item->type == 'S') {
                       $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                        ['user_id', '=', $auth->id],
                                                                        ['season_id', '=', $item->id],
                                                                       ])->first();
                    } elseif ($item->type == 'M') {
                      $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                        ['user_id', '=', $auth->id],
                                                                        ['movie_id', '=', $item->id],
                                                                       ])->first();
                    }

                  }
                  @endphp
                  @if($item->type == 'M')
                    @if(isset($movie))
                    <div class="genre-prime-slide owls-item">
                      <div class="genre-slide-image home-prime-slider protip" data-pt-placement="outside" data-pt-title="#prime-mix-description-block{{$item->id}}">
                        @if($auth && $subscribed == 1)
                          <a href="{{url('movie/detail/'.$item->slug)}}">
                            @if($item->thumbnail != null)
                              <img data-src="{{url('images/movies/thumbnails/'.$item->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                            @else
                               <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-responsive owl-lazy" alt="genre-image">
                            @endif
                          </a>
                          @else
                           <a href="{{url('movie/guest/detail/'.$item->slug)}}">
                            @if($item->thumbnail != null)
                              <img data-src="{{url('images/movies/thumbnails/'.$item->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                            @else
                              <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-responsive owl-lazy" alt="genre-image">
                            @endif
                          </a>
                          
                        @endif
                        @if($item->is_custom_label == 1)
                          @if(isset($item->label_id))
                            <span class="badge bg-success">{{$item->label->name}}</span>
                          @endif
                        @else

                         @if(isset($item->is_upcoming) && $item->is_upcoming == 1)
                            <span class="badge bg-success">Upcoming</span>
                          @endif
                        @endif
                      </div>
                      <div id="prime-mix-description-block{{$item->id}}" class="prime-description-block">
                        <h5 class="description-heading">{{$item->title}}</h5>
                        
                        <ul class="description-list">
                          <li>{{__('staticwords.tmdbrating')}} {{$item->rating}}</li>
                          <li>{{$item->duration}} {{__('staticwords.mins')}}</li>
                          <li>{{$item->publish_year}}</li>
                          <li>{{$item->maturity_rating}}</li>
                          @if($item->subtitle == 1)
                            <li>CC</li>
                            <li>
                             {{__('staticwords.subtitles')}}
                            </li>
                          @endif
                        </ul>
                        <div class="main-des">
                          <p>{{str_limit($item->detail,100,'...')}}</p>
                          @if($auth && $subscribed == 1)
                            <a href="{{url('movie/detail',$item->slug)}}">{{__('staticwords.readmore')}}</a>
                          @else
                            <a href="{{url('movie/guest/detail',$item->slug)}}">{{__('staticwords.readmore')}}</a>
                          @endif
                        </div>
                        <div class="des-btn-block">
                          @if($auth  && $subscribed==1)
                            @if(isset($item) && $item->is_upcoming != 1)
                              @if($item->maturity_ratin =='all age' || $age>=str_replace('+', '',$item->maturity_rating))

                                @if(isset($item->video_link['iframeurl']) && $item->video_link['iframeurl'] != null)
                            
                                  <a href="{{route('watchmovieiframe',$item->id)}}"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                                  </a>

                                @else 
                                  <a href="{{ route('watchmovie',$item->id) }}" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span></a>
                                @endif
                              @else
                                <a onclick="myage({{$age}})" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                                  </a>
                              @endif
                            @endif
                            @if($item->trailer_url != null || $item->trailer_url != '')
                              <a href="{{ route('watchTrailer',$item->id) }}" class="iframe btn-default">{{__('staticwords.watchtrailer')}}</a>
                            @endif
                          @else
                            @if($item->trailer_url != null || $item->trailer_url != '')
                              <a href="{{ route('guestwatchtrailer',$item->id) }}" class="iframe btn-default">{{__('staticwords.watchtrailer')}}</a>
                            @endif
                          @endif

                          @if($catlog ==0 && $subscribed ==1)
                        
                            @if (isset($wishlist_check->added))
                              <a onclick="addWish({{$item->id}},'{{$item->type}}')" class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{$wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')}}</a>
                            @else
                              <a onclick="addWish({{$item->id}},'{{$item->type}}')" class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{__('staticwords.addtowatchlist')}}</a>
                            @endif
                          @elseif($catlog ==1 && $auth)
                            @if (isset($wishlist_check->added))
                              <a onclick="addWish({{$item->id}},'{{$item->type}}')" class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{$wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')}}</a>
                            @else
                              <a onclick="addWish({{$item->id}},'{{$item->type}}')" class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{__('staticwords.addtowatchlist')}}</a>
                            @endif
                          @endif
                        </div>
                      </div>
                    </div>
                  @endif
                  @endif

                  @if($item->type == "S")
                    @if(!isset($movie))
                    <div class="genre-prime-slide owls-item">
                      <div class="genre-slide-image home-prime-slider protip" data-pt-placement="outside" data-pt-title="#prime-mix-description-block{{$item->id}}{{$item->type}}">
                        @if($auth && $subscribed == 1)
                          <a href="{{url('show/detail/'.$item->season_slug)}}">
                            @if($item->thumbnail != null)
                              <img data-src="{{url('images/tvseries/thumbnails/'.$item->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                            @elseif($item->tvseries->thumbnail != null)
                              <img data-src="{{url('images/tvseries/thumbnails/'.$item->tvseries->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                            @else
                              <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-responsive owl-lazy" alt="genre-image">
                            @endif
                          </a>
                          @else
                          <a href="{{url('show/guest/detail/'.$item->season_slug)}}">
                            @if($item->thumbnail != null)
                              <img data-src="{{url('images/tvseries/thumbnails/'.$item->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                            @elseif($item->tvseries->thumbnail != null)
                              <img data-src="{{url('images/tvseries/thumbnails/'.$item->tvseries->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                            @else
                              <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-responsive owl-lazy" alt="genre-image">
                            @endif
                          </a>
                        @endif
                        @if($item->tvseries->is_custom_label == 1)
                          @if(isset($item->tvseries->label_id))
                            <span class="badge bg-success">{{$item->tvseries->label->name}}</span>
                          @endif
                        @endif
                      
                      </div>
                      <div id="prime-mix-description-block{{$item->id}}{{$item->type}}" class="prime-description-block">
                        <h5 class="description-heading">{{$item->tvseries->title}}</h5>
                        <div class="movie-rating">{{__('staticwords.tmdbrating')}} {{$item->tvseries->rating}}</div>
                        <ul class="description-list">
                          <li>Season {{$item->season_no}}</li>
                          <li>{{$item->publish_year}}</li>
                          <li>{{$item->tvseries->age_req}}</li>
                          @if($item->subtitle == 1)
                            <li>CC</li>
                            <li>
                             {{__('staticwords.subtitles')}}
                            </li>
                          @endif
                        </ul>
                        <div class="main-des">
                          @if ($item->detail != null || $item->detail != '')
                            <p>{{str_limit($item->detail,100,'...')}}</p>
                          @else
                            <p>{{str_limit($item->tvseries->detail,100,'...')}}</p>
                          @endif
                          @if($auth && $subscribed == 1)
                            <a href="{{url('show/detail',$item->season_slug)}}">{{__('staticwords.readmore')}}</a>
                          @else
                            <a href="{{url('show/guest/detail',$item->season_slug)}}">{{__('staticwords.readmore')}}</a>
                          @endif
                        </div>
                        <div class="des-btn-block">
                          @if($subscribed==1 && $auth)
                            @if(isset($item->episodes[0]))
                              @if($item->tvseries->age_req =='all age' || $age>=str_replace('+', '',$item->tvseries->age_req))
                                @if($item->episodes[0]->video_link['iframeurl'] !="")

                                  <a href="#" onclick="playoniframe('{{ $item->episodes[0]->video_link['iframeurl'] }}','{{ $item->tvseries->id }}','tv')" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                                   </a>
                                @else
                                  <a href="{{route('watchTvShow',$item->id)}}" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span></a>
                                @endif
                              @else
                                <a onclick="myage({{$age}})" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                                 </a>
                              @endif
                           @endif
                           @if($item->trailer_url != null || $item->trailer_url != '')
                              <a href="{{ route('watchtvTrailer',$item->id)  }}" class="iframe btn btn-default">{{__('staticwords.watchtrailer')}}</a>
                            @endif
                          @else
                             @if($item->trailer_url != null || $item->trailer_url != '')
                              <a href="{{ route('guestwatchtvtrailer',$item->id)  }}" class="iframe btn btn-default">{{__('staticwords.watchtrailer')}}</a>
                            @endif
                          @endif
                          @if($catlog ==0 && $subscribed ==1)
                            @if (isset($wishlist_check->added))
                              <a onclick="addWish({{$item->id}},'{{$item->type}}')" class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{$wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('addtowatchlist')}}</a>
                            @else
                              <a onclick="addWish({{$item->id}},'{{$item->type}}')" class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{__('staticwords.addtowatchlist')}}</a>
                            @endif
                          @elseif($catlog ==1 && $auth)
                            @if (isset($wishlist_check->added))
                              <a onclick="addWish({{$item->id}},'{{$item->type}}')" class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{$wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('addtowatchlist')}}</a>
                            @else
                              <a onclick="addWish({{$item->id}},'{{$item->type}}')" class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{__('staticwords.addtowatchlist')}}</a>
                            @endif
                          @endif
                        </div>
                      </div>
                    </div>
                    @endif
                  @endif
                @endforeach
              @endif
            </div>
          </div>
        </div>
      @endif
    @else
      @php
        $all = collect();
        $all_fil_movies = App\Movie::all();
        $all_fil_tv = App\TvSeries::all();
        if (isset($movie)) {
          $genres = explode(',', $movie->genre_id);
        } elseif (isset($season)) {
          $genres = explode(',', $season->tvseries->genre_id);
        }
        for($i = 0; $i < count($genres); $i++) {
          foreach ($all_fil_movies as $fil_movie) {
            $fil_genre_item = explode(',', trim($fil_movie->genre_id));
            for ($k=0; $k < count($fil_genre_item); $k++) {
              if (trim($fil_genre_item[$k]) == trim($genres[$i])) {
                if (isset($movie)) {
                  if ($fil_movie->id != $movie->id) {
                    $all->push($fil_movie);
                  }
                } else {
                  $all->push($fil_movie);
                }
              }
            }
          }
        }
        if (isset($movie)) {
          $all = $all->except($movie->id);
        }

        for($i = 0; $i < count($genres); $i++) {
          foreach ($all_fil_tv as $fil_tv) {
            $fil_genre_item = explode(',', trim($fil_tv->genre_id));
            for ($k=0; $k < count($fil_genre_item); $k++) {
              if (trim($fil_genre_item[$k]) == trim($genres[$i])) {
                $fil_tv = $fil_tv->seasons;
                if (isset($season)) {
                  $all->push($fil_tv->except($season->id));
                } else {
                  $all->push($fil_tv);
                }
              }
            }
          }
        }
        $all = $all->unique();
        $all = $all->flatten();
      @endphp
      @if (isset($all) && count($all) > 0)
        <div class="genre-main-block">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-3">
                <div class="genre-dtl-block">
                  <h3 class="section-heading">{{__('staticwords.customeralsowatched')}}</h3>
                  <p class="section-dtl">{{__('staticwords.atthebigscreenathome')}}</p>
                </div>
              </div>
              <div class="col-md-9">
                <div class="genre-main-slider owl-carousel">
                  @if(isset($all))
                    @foreach($all as $key => $item)
                      @if($item->type == 'S')
                        <div class="genre-slide">
                          <div class="genre-slide-image home-prime-slider owls-item">
                           @if($auth && $subscribed == 1)
                            <a href="{{url('show/detail/'.$item->season_slug)}}">
                              @if($item->thumbnail != null)
                                <img data-src="{{url('images/tvseries/thumbnails/'.$item->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                              @elseif($item->tvseries->thumbnail != null)
                                <img data-src="{{url('images/tvseries/thumbnails/'.$item->tvseries->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                              @else
                                <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-responsive owl-lazy" alt="genre-image">
                              @endif
                            </a>

                            @else
                            <a href="{{url('show/guest/detail/'.$item->season_slug)}}">
                              @if($item->thumbnail != null)
                                <img data-src="{{url('images/tvseries/thumbnails/'.$item->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                              @elseif($item->tvseries->thumbnail != null)
                                <img data-src="{{url('images/tvseries/thumbnails/'.$item->tvseries->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                              @else
                                <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-responsive owl-lazy" alt="genre-image">
                              @endif
                            </a>
                            @endif
                             @if($item->tvseries->is_custom_label == 1)
                              @if(isset($item->tvseries->label_id))
                                <span class="badge bg-success">{{$item->tvseries->label->name}}</span>
                              @endif
                            @endif
                         
                          </div>
                          <div class="genre-slide-dtl">
                            <h5 class="genre-dtl-heading">@if($auth && $subscribed == 1)<a href="{{url('show/detail/'.$item->season_slug)}}">{{$item->tvseries->title}}</a>
                            @else
                            <a href="{{url('show/guest/detail/'.$item->season_slug)}}">{{$item->tvseries->title}}</a>
                          @endif</h5>
                            <div class="genre-small-info">{{$item->detail != null ? str_limit($item->detail,150,'...'): str_limit($item->tvseries->detail,150,'...')}}</div>
                          </div>
                        </div>
                      @elseif($item->type == 'M')
                        <div class="genre-slide">
                          <div class="genre-slide-image home-prime-slider owls-item">
                           @if($auth && $subscribed == 1)
                            <a href="{{url('movie/detail/'.$item->slug)}}">
                              @if($item->thumbnail != null)
                                <img data-src="{{url('images/movies/thumbnails/'.$item->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                              @endif
                            </a>
                            @else
                             <a href="{{url('movie/guest/detail/'.$item->slug)}}">
                              @if($item->thumbnail != null)
                                <img data-src="{{url('images/movies/thumbnails/'.$item->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                              @endif
                            </a>
                            @endif
                            @if($item->is_custom_label == 1)
                              @if(isset($item->label_id))
                                <span class="badge bg-success">{{$item->label->name}}</span>
                              @endif
                            @else

                              @if(isset($item->is_upcoming) && $item->is_upcoming == 1)
                                <span class="badge bg-success">Upcoming</span>
                              @endif
                            @endif
                            
                          </div>
                          <div class="genre-slide-dtl">
                            <h5 class="genre-dtl-heading">@if($auth && $subscribed == 1)<a href="{{url('movie/detail/'.$item->slug)}}">{{$item->title}}</a>
                            @else
                            <a href="{{url('movie/guest/detail/'.$item->slug)}}">{{$item->title}}</a>
                          @endif</h5>
                          <div class="genre-small-info">{{$item->detail != null ? str_limit($item->detail,150, '...') :''}}</div>
                          </div>
                        </div>
                      @endif
                    @endforeach
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      @endif
    @endif

    <!-- Share Modal -->
      <div class="modal fade" id="sharemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            {{-- <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">{{__('staticwords.shareiton')}}</h4>
            </div> --}}
            
            <div class="text-center modal-body">

              @php
                echo Share::currentPage(null,[],'<div class="row">', '</div>')
                ->facebook()
                ->twitter()
                ->telegram()
                ->whatsapp();
              @endphp
            </div>
           
          </div>
        </div>
      </div>
  </section>


 @endsection

@section('custom-script')
<script type="text/javascript">
  function mouseoverrating () { 
    $.ajax({
        type: "POST",
        url: "{{url('/video/rating')}}",
        data:$("#formrating").serialize(),
        success: function (data) {
          console.log(data);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
      console.log(XMLHttpRequest);
        }
    });
  }

  function mouseoverratingtv () {  
    $.ajax({
        type: "POST",
        url: "{{url('/video/rating/tv')}}",
        data:$("#formrating").serialize(),
        success: function (data) {
          console.log(data);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
      console.log(XMLHttpRequest);
        }
    });
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
  $('#selectseason').on('change',function(){
    var get = $('#selectseason').val();
    @if(Auth::check() && $subscribed == '1')
    window.location.href = '{{ url('show/detail/') }}/'+get;
    @else
     window.location.href = '{{ url('show/guest/detail/') }}/'+get;
    @endif
  });
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
  
<script type="text/javascript">


  $(document).ready(function(){

  $("#rating").on('mouseout',function(event){
    event.preventDefault();
    var val = $(".rating").val();
    $.ajax({
      type: "GET",
      url: "{{url('/video/rating')}}",
      data:$("#formrating").serialize(),
      success: function (data) {
        console.log(data);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
       console.log(XMLHttpRequest);
      }
    });

  });

  $("#rating").on('mouseover',function(event){
    event.preventDefault();
    var val = $(".rating").val();
    $.ajax({
      type: "GET",
      url: "{{url('/video/rating')}}",
      data:$("#formrating").serialize(),
      success: function (data) {
        console.log(data);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
       console.log(XMLHttpRequest);
      }
    });
  });

  $("#rating").on('mouseenter',function(event){
    event.preventDefault();
    var val = $(".rating").val();
    $.ajax({
      type: "GET",
      url: "{{url('/video/rating')}}",
      data:$("#formrating").serialize(),
      success: function (data) {
        console.log(data);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
       console.log(XMLHttpRequest);
      }
    });

  });

  $("#rating").on('mouseleave',function(event){
    event.preventDefault();
    var val = $(".rating").val();
    $.ajax({
      type: "GET",
      url: "{{url('/video/rating')}}",
      data:$("#formrating").serialize(),
      success: function (data) {
        console.log(data);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
       console.log(XMLHttpRequest);
      }
    });

  });

   function mouseoverrating () {
      $.ajax({
        type: "GET",
        url: "{{url('/video/rating')}}",
        data:$("#formrating").serialize(),
        success: function (data) {
          console.log(data);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
         console.log(XMLHttpRequest);
        }
      });
    
    }
    
          
    function mouseoverratingtv () {    
        $.ajax({
            type: "POST",
            url: "{{url('/video/rating/tv')}}",
            data:$("#formratingtv").serialize(),
            success: function (data) {
              console.log(data);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
          console.log(XMLHttpRequest);
            }
        });
    
    }
  });
</script>
<script type="text/javascript">
  $('.download').on('click',function(){
   
   var id    =  $(this).data('id');
   $.ajax({
      type : 'GET',
      url :  '{{ route("updateclick") }}',
      dataType : 'json',
      data : {id : id},
      success : function(data){
          console.log(data);
      }
   });
  });
</script>

<script type="text/javascript">


    var app = new Vue({
      el: '#wishlistelement',
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

    function addWish(id, type) {
      app.addToWishList(id, type);
      setTimeout(function() {
        $('.addwishlistbtn'+id+type).text(function(i, text){
          return text == "{{__('staticwords.addtowatchlist')}}" ? "{{ __('staticwords.removefromwatchlist') }}" : "{{__('staticwords.addtowatchlist')}}";
        });
      }, 100);
    }
  </script>
@endsection
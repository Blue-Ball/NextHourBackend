@extends('layouts.theme')
@section('title',__('staticwords.viewall'))
@section('main-wrapper')
  <!-- main wrapper -->
@php
 $withlogin= $configs->withlogin;
 $catlog= $configs->catlog;
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

  $all_genre = \App\Genre::get();
  $a_lang = \APP\AudioLanguage::get();
  $menus = \APP\Menu::get();
 
@endphp
<section class="main-wrapper main-wrapper-single-movie-prime search-section movie-series-filter-section">
  <div class="container">
    <div class="row">
     
      <div class="col-lg-3 col-sm-3">
         <form action="" method="get" class="filterForm">
          <div class="movie-series-sidebar">

            <div class="movie-series-filter-block language">
              <label for="type" class="filter-header">{{__('staticwords.title')}}</label>
              <select class="form-select select2" aria-label="Default select example " name="title">
               <option value="">{{__('staticwords.SelectTitle')}}</option>
                <option value="ASC" {{(app('request')->input('title') == 'ASC')  ? 'selected' : ''}}>{{__('A to Z')}}</option>
                <option value="DESC" {{(app('request')->input('title') == 'DESC')  ? 'selected' : ''}}>{{__('Z to A')}}</option>
               
              </select>
            </div>
           
          


             <div class="movie-series-filter-block toggle-switch">
              <label class="switch">
                <input type="checkbox" name="feature" @if(app('request')->input('feature')) checked  @else @endif>
                <span class="slider round"></span>
              </label>
              <label class="form-check-label" for="flexSwitchCheckDefault">{{__('staticwords.OnlyFeatured')}}</label>
            </div>


             <div class="movie-series-filter-block genre-filter">
                <label for="type" class="filter-header">{{__('staticwords.SelectedGenres')}}</label>
                <div class="form-check">
                  @foreach($all_genre as $genre)
                  <input class="form-check-input" name="genre[]" id="{{$genre->id}}" type="checkbox" @if(app('request')->input('genre') != NULL) @foreach(app('request')->input('genre') as $request_genre) @if($request_genre == $genre->id)  checked @else @endif @endforeach @endif value="{{$genre->id}}">
                  <label for="{{$genre->id}}">{{$genre->name}}</label><br>
                  @endforeach
                </div>
              </div>

            

            <div class="movie-series-filter-block language">
              <label for="type" class="filter-header">{{__('staticwords.AgeRatings')}}</label>
              <select class="form-select select2" aria-label="Default select example " name="age_rating">
                <option value="">Select Age</option>
                <option value="all" {{(app('request')->input('age_rating') == 'all')  ? 'selected' : ''}}>{{__('All Age')}}</option>
                <option value="13" {{(app('request')->input('age_rating') == '13') ? 'selected' : ''}}>{{__('13+')}}</option>
                <option value="16" {{(app('request')->input('age_rating') == '16') ? 'selected' : ''}}>{{__('16+')}}</option>
                <option value="18" {{(app('request')->input('age_rating') == '18') ? 'selected' : ''}}>{{__('18+')}}</option>

                
              </select>
            </div>
            
            <div class="reset-filter-block">
              <button type="submit" class="btn btn-primary btn-default"><i class="fa fa-sync"></i>{{__('staticwords.ApplyFilters')}}</button> 
            </div>
          </div>
        </form>
        <div class="small-screen-sidebar">
          <div id="mySidebar" class="sidebar">
            <a href="javascript:void(0)" class="closebtn" onclick="closebar()">×</a>
            <form action="" method="get">
              <div class="movie-series-sidebar">
               
                <div class="movie-series-filter-block language">
                  <label for="type" class="filter-header">{{__('staticwords.title')}}</label>
                  <select class="form-select select2" aria-label="Default select example " name="title">
                   <option value="">{{__('staticwords.SelectTitle')}}</option>
                    <option value="ASC" {{(app('request')->input('title') == 'ASC')  ? 'selected' : ''}}>{{__('A to Z')}}</option>
                    <option value="DESC" {{(app('request')->input('title') == 'DESC')  ? 'selected' : ''}}>{{__('Z to A')}}</option>
                   
                  </select>
                </div>
              
                <div class="movie-series-filter-block toggle-switch">
                  <label class="switch">
                    <input type="checkbox" name="tmdb" @if(app('request')->input('tmdb')) checked  @else @endif>
                    <span class="slider round"></span>
                  </label>
                  <label class="form-check-label" for="flexSwitchCheckDefault">{{__('staticwords.OnlyTMDB')}}</label>
                </div>
               
                <div class="movie-series-filter-block toggle-switch">
                  <label class="switch">
                    <input type="checkbox" name="feature" @if(app('request')->input('feature')) checked  @else @endif>
                    <span class="slider round"></span>
                  </label>
                  <label class="form-check-label" for="flexSwitchCheckDefault">{{__('staticwords.OnlyFeatured')}}</label>
                </div>
               
                

                 <div class="movie-series-filter-block genre-filter">
                  <label for="type" class="filter-header">{{__('staticwords.SelectedGenres')}}</label>
                  <div class="form-check">
                    @foreach($all_genre as $genre)
                    <input class="form-check-input" name="genre[]" id="{{$genre->id}}" type="checkbox" @if(app('request')->input('genre') != NULL) @foreach(app('request')->input('genre') as $request_genre) @if($request_genre == $genre->id)  checked @else @endif @endforeach @endif value="{{$genre->id}}">
                    <label for="{{$genre->id}}">{{$genre->name}}</label><br>
                    @endforeach
                  </div>
                </div>

                <div class="movie-series-filter-block language">
                   <label for="type" class="filter-header">{{__('staticwords.AgeRatings')}}</label>
                    <select class="form-select select2" aria-label="Default select example " name="age_rating">
                      <option value="">{{__('staticwords.SelectAge')}}</option>
                      <option value="all" {{(app('request')->input('age_rating') == 'all')  ? 'selected' : ''}}>{{__('All Age')}}</option>
                      <option value="13" {{(app('request')->input('age_rating') == '13') ? 'selected' : ''}}>{{__('13+')}}</option>
                      <option value="16" {{(app('request')->input('age_rating') == '16') ? 'selected' : ''}}>{{__('16+')}}</option>
                      <option value="18" {{(app('request')->input('age_rating') == '18') ? 'selected' : ''}}>{{__('18+')}}</option>
                    </select>
                </div>
                
                 
                
                <div class="reset-filter-block">
                  <button type="submit" class="btn btn-primary btn-default"><i class="fa fa-sync"></i>{{__('staticwords.ApplyFilters')}}</button> 
                </div>
              </div>
            </form>
          </div>

          <div id="main">
            <button class="openbtn" onclick="openbar()">☰</button>  
          </div>
        </div>
      </div>

     
      <div class="col-lg-9 col-sm-9">
        @if (isset($pusheditems) && count($pusheditems) > 0 )
        <div class="movie-series-header-block">
          <div class="row">
            <div class="col-lg-6">
              <h3 class="movie-series-heading">{{__('Browse')}}</h3>
            </div>
            <div class="col-lg-6 text-right">
              <button type="reset" class="btn btn-primary reset-btn" onclick="resetForm();">Reset Filters<i class="flaticon-cancel"></i></button>
            </div>
          </div>
        </div>
        
          @if(isset($pusheditems))
          <div class="row">
            @foreach($pusheditems as $item)
            
              @if($auth && $subscribed==1)
            
                @php
                 if (isset($item['type']) && $item['type'] == 'M') {
                  $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                      ['user_id', '=', $auth->id],
                                                                      ['movie_id', '=', $item['id'],
                                                                     ]])->first();
                   }

                  if (isset($item['type']) && $item['type'] == 'S') {
                     $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                      ['user_id', '=', $auth->id],
                                                                      ['season_id', '=', $item['id']],
                                                                    ])->first();
                  }
                @endphp
              @endif
              
           
          @if(isset($item['type']) && $item['type'] == "M")
          
          <div class="col-xs-6 col-md-4 col-lg-3">
            <div class="movie-series-image protip" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block{{$item['id']}}">
              @if($auth && $subscribed == 1)
                <a href="{{url('movie/detail',$item['slug'])}}">
                  @if($item['thumbnail'] != null || $item['thumbnail'] != '')
                   <img data-src="{{url('images/movies/thumbnails/'.$item['thumbnail'])}}" class="img-fluid lazy" alt="genre-image">
                  @else
                     <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-fluid lazy" alt="genre-image">
                  @endif
                </a>
               
              @else
                <a href="{{url('movie/guest/detail',$item['slug'])}}">
                  @if($item['thumbnail'] != null || $item['thumbnail'] != '')
                   <img data-src="{{url('images/movies/thumbnails/'.$item['thumbnail'])}}" class="img-fluid lazy" alt="genre-image">
                  @else
                     <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-fluid lazy" alt="genre-image">
                  @endif
                </a>
               
              @endif
              @if($item['is_custom_label'] == 1)
                @if(isset($item['label_id']) && $item['label_id'] != NULL)
                  @php
                    $label = App\Label::find($item['label_id']);
                  @endphp
                  <span class="badge bg-success">{{$label->name}}</span>
                @endif
             
              @endif
            </div>
           {{--  <div class="movie-series-heading">
              <h5>{{$item->title}}</h5> --}}
              @if(isset($protip) && $protip == 1)
              <div id="prime-next-item-description-block{{$item['id']}}" class="prime-description-block">
                <div class="prime-description-under-block">
                  <h5 class="description-heading">{{$item['title']}}</h5>
                  <ul class="description-list">
                    <li>{{__('staticwords.rating')}} {{$item['rating']}}</li>
                    <li>{{$item['duration']}} {{__('staticwords.mins')}}</li>
                    <li>{{$item['publish_year']}}</li>
                    <li>{{$item['maturity_rating']}}</li>
                    @if($item['subtitle'] == 1)
                      <li>
                       {{__('staticwords.subtitles')}}
                      </li>
                    @endif
                  </ul>
                  <div class="main-des">
                    <p>{{str_limit($item['detail'],150,'...')}}</p>
                    @if($auth && $subscribed == 1)
                      <a href="{{url('movie/detail',$item['slug'])}}">{{__('staticwords.readmore')}}</a>
                    @else
                       <a href="{{url('movie/guest/detail',$item['slug'])}}">{{__('staticwords.readmore')}}</a>
                    @endif
                  </div>
                  
                  <div class="des-btn-block">
                    @if($subscribed==1 && $auth)
                      @if($item['is_upcoming'] != 1)
                        @if($item['maturity_rating'] =='all age' || $age>=str_replace('+', '', $item['maturity_rating']))
                          @if(isset($item['video_link']['iframeurl']) && $item['video_link']['iframeurl'] != null)
                      
                            <a href="{{route('watchmovieiframe',$item['id'])}}"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                            </a>
                          @else 
                            <a href="{{route('watchmovie',$item['id'])}}" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span></a>
                          @endif
                        @else
                          <a onclick="myage({{$age}})" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                          </a>
                        @endif
                      @endif
                      @if($item['trailer_url'] != null || $item['trailer_url'] != '')
                        <a class="iframe btn btn-default" href="{{ route('watchTrailer',$item['id']) }}">{{__('staticwords.watchtrailer')}}</a>
                      @endif
                    @else
                      @if($item['trailer_url'] != null || $item['trailer_url'] != '')
                        <a class="iframe btn btn-default" href="{{ route('guestwatchtrailer',$item['id']) }}">{{__('staticwords.watchtrailer')}}</a>
                      @endif
                    @endif
                     
                    @if($catlog ==0 && $subscribed ==1)
                      @if (isset($wishlist_check->added))
                        <a onclick="addWish({{$item['id']}},'{{$item['type']}}')" class="addwishlistbtn{{$item['id']}}{{$item['type']}} btn-default">{{$wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')}}</a>
                      @else
                        <a onclick="addWish({{$item['id']}},'{{$item['type']}}')" class="addwishlistbtn{{$item['id']}}{{$item['type']}} btn-default">{{__('staticwords.addtowatchlist')}}</a>
                      @endif
                    @elseif($catlog ==1 && $auth)
                      @if (isset($wishlist_check->added))
                        <a onclick="addWish({{$item['id']}},'{{$item['type']}}')" class="addwishlistbtn{{$item['id']}}{{$item['type']}} btn-default">{{$wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')}}</a>
                      @else
                        <a onclick="addWish({{$item['id']}},'{{$item['type']}}')" class="addwishlistbtn{{$item['id']}}{{$item['type']}} btn-default">{{__('staticwords.addtowatchlist')}}</a>
                      @endif
                    @endif
                  </div>
                 
                </div>
              </div>
              @endif
            </div>
          {{-- </div> --}}
          @elseif(isset($item['type']) && $item['type'] == "T")

            <div class="col-xs-6 col-md-4 col-lg-3">
              <div class="movie-series-image protip" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block{{$item['seasons_first']['id']}}{{ $item['seasons_first']['type'] }}">
                @if($auth && $subscribed == 1)
                  <a href="{{url('show/detail',$item['seasons_first']['season_slug'])}}">
                    @if($item['thumbnail'] != null || $item['thumbnail'] != '')
                     <img data-src="{{url('images/tvseries/thumbnails/'.$item['thumbnail'])}}" class="img-fluid lazy" alt="genre-image">
                    @else
                       <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-fluid lazy" alt="genre-image">
                    @endif
                  </a>
                 
                @else
                  <a href="{{url('show/guest/detail',$item['seasons_first']['season_slug'])}}">
                    @if($item['thumbnail'] != null || $item['thumbnail'] != '')
                     <img data-src="{{url('images/tvseries/thumbnails/'.$item['thumbnail'])}}" class="img-fluid lazy" alt="genre-image">
                    @else
                       <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-fluid lazy" alt="genre-image">
                    @endif
                  </a>
                 
                @endif
                @if($item['is_custom_label'] == 1)
                  @if(isset($item['label_id']))
                    @php
                      $label = App\Label::find($item['label_id']);
                    @endphp
                    <span class="badge bg-success">{{$label->name}}</span>
                  @endif
                @endif

              </div>

               @if(isset($protip) && $protip == 1)
                <div id="prime-next-item-description-block{{$item['seasons_first']['id']}}{{$item['seasons_first']['type']}}" class="prime-description-block">
                    <h5 class="description-heading">{{$item['title']}}</h5>
                    <div class="movie-rating">{{__('staticwords.tmdbrating')}} {{$item['rating']}}</div>
                    <ul class="description-list">
                      <li>{{__('staticwords.season')}}{{$item['seasons_first']['season_no']}}</li>
                      <li>{{$item['seasons_first']['publish_year']}}</li>
                      <li>{{$item['maturity_rating']}}</li>
                      @if($item['seasons_first']['first_episode']['subtitle'] == 1)
                        <li>
                          {{__('staticwords.subtitles')}}
                        </li>
                      @endif
                    </ul>
                    <div class="main-des">
                      @if ($item['detail'] != null || $item['detail'] != '')
                      <p>{{str_limit($item['detail'],150,'...')}}</p>
                        
                      @else
                        <p>{{str_limit($item['seasons_first']['detail'],150,'...')}}</p>
                      @endif
                      @if($auth && $subscribed == 1)
                          <a href="{{url('show/detail',$item['seasons_first']['season_slug'])}}">{{__('staticwords.readmore')}}</a>
                        @else
                           <a href="{{url('show/guest/detail',$item['seasons_first']['season_slug'])}}">{{__('staticwords.readmore')}}</a>
                        @endif
                    </div>
                    
                    <div class="des-btn-block">
                      @if($subscribed==1 && $auth)
                        @if (isset($item['seasons_first']['first_episode']))
                          @if( $item['maturity_rating'] =='all age' ||$age>=str_replace('+', '', $item['maturity_rating']))
                            @if($item['seasons_first']['first_episode']['video_link']['iframeurl'] !="")

                              <a href="#" onclick="playoniframe('{{ $item['seasons_first']['first_episode']['video_link']['iframeurl'] }}','{{ $item['id'] }}','tv')" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                               </a>

                            @else
                              <a href="{{ route('watchTvShow',$item['seasons_first']['id']) }}" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span></a>
                            @endif
                         @else
                            <a onclick="myage({{$age}})" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                            </a>
                          @endif
                        @endif
                         @if($item['seasons_first']['trailer_url'] != null || $item['seasons_first']['trailer_url'] != '')
                          <a href="{{ route('watchtvTrailer',$item['id'])  }}" class="iframe btn btn-default">{{__('staticwords.watchtrailer')}}</a>
                        @endif
                      @else
                         @if($item['seasons_first']['trailer_url'] != null || $item['seasons_first']['trailer_url'] != '')
                          <a href="{{ route('guestwatchtvtrailer',$item['id'])  }}" class="iframe btn btn-default">{{__('staticwords.watchtrailer')}}</a>
                        @endif
                      @endif
                      @if($catlog == 0 && $subscribed ==1)
                        @if (isset($wishlist_check->added))
                          <a onclick="addWish({{$item['seasons_first']['id']}},'{{$item['seasons_first']['type']}}')" class="addwishlistbtn{{$item['seasons_first']['id']}}{{$item['seasons_first']['type']}} btn-default">{{$wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')}}</a>
                        @else
                          <a onclick="addWish({{$item['seasons_first']['id']}},'{{$item['seasons_first']['type']}}')" class="addwishlistbtn{{$item['seasons_first']['id']}}{{$item['seasons_first']['type']}} btn-default">{{__('staticwords.addtowatchlist')}}
                          </a>
                        @endif
                      @elseif($catlog ==1 && $auth)
                        @if (isset($wishlist_check->added))
                          <a onclick="addWish({{$item['seasons_first']['id']}},'{{$item['seasons_first']['type']}}')" class="addwishlistbtn{{$item['seasons_first']['id']}}{{$item['seasons_first']['type']}} btn-default">{{$wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')}}</a>
                        @else
                          <a onclick="addWish({{$item['seasons_first']['id']}},'{{$item['seasons_first']['type']}}')" class="addwishlistbtn{{$item['seasons_first']['id']}}{{$item['seasons_first']['type']}} btn-default">{{__('staticwords.addtowatchlist')}}
                          </a>
                        @endif
                      @endif
                    </div>
                  </div>
                  @endif
          
          </div>


          @endif
          @endforeach

          <div class="col-md-12">
                <div align="center">
                  {{--  {!! $pusheditems->links() !!} --}}
                </div>
             </div>  
          </div>
          @endif
        @else
        <div class="view-all-search">
          <h5 class="text-center" style="top:25%;">{{__('Sorry, that filter combination has no result')}}</h5>
          <p class="text-center">{{__('Please try another filter combination.')}}</p>
        </div>
      @endif
      </div>
      
    </div>
  </div>  
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
    <script>
      function openbar() {
        document.getElementById("mySidebar").style.width = "300px";
      }

      function closebar() {
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
      }
      </script>
    <!-- <script>
      function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
      }

      function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
      }
    </script> -->
    <script>
    $(document).ready(function(){
        $(".reset-btn").click(function(){
           var uri = window.location.toString();

            if (uri.indexOf("?") > 0) {

                var clean_uri = uri.substring(0, uri.indexOf("?"));

                window.history.replaceState({}, document.title, clean_uri);

            }

            location.reload();
        });
    });
</script>

@endsection

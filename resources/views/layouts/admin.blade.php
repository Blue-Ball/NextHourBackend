<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title') - {{__('adminstaticwords.Admin')}} - {{$w_title}}</title>
  <!-- favicon-icon -->
  <link rel="icon" type="image/icon" href="{{url('images/favicon/favicon.png')}}"/>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
  <!-- Google Fonts -->
  <link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet"/>
  <!-- Material Icons -->
  <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
  {{-- datable css --}}
   {{-- datable offline files --}}
   <link rel="stylesheet" type="text/css" href="{{url('css/button.datatable.css')}}">
   <link rel="stylesheet" type="text/css" href="{{url('css/datatable.min.css')}}"/>
   <link href ="{{url('css/datatable_material.css')}}" rel="stylesheet" />
 
  <link href ="{{url('css/dataTables.material.min.css')}}" rel="stylesheet" />
 
   <link href="//cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
  {{-- smooth jquery css --}}
  
  <link rel="stylesheet" href="{{url('css/maincss.css')}}"/>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" type="text/css" />

 
  <!-- Jquery Ui Css -->
  <link rel="stylesheet" href="{{url('css/jquery-ui.min.css')}}"/>
  <link rel="stylesheet" href="{{url('css/jquery-jvectormap.css')}}"/>
  <!-- Admin (main) Style Sheet -->
  <link rel="stylesheet" href="{{url('css/admin.css')}}"/>
  <link rel="stylesheet" href="{{ url('css/bootstrap-tagsinput.css') }}"/>
  <link rel="stylesheet" href="{{ url('css/custom-style.css') }}"/>
  <link rel="stylesheet" href="{{ url('css/star-rating.min.css') }}"/>
   <link rel="stylesheet" href="{{ url('css/bootstrap-colorpicker.min.css') }}"/>

  <!-- select 2 -->
  
  <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />



  <script>
    window.Laravel =  <?php echo json_encode([
      'csrfToken' => csrf_token(),
    ]); ?>
  </script>
  <style media="screen">
    .ht::first-letter{
      text-transform: uppercase;
    }


  </style>

  @yield('stylesheet')
</head>
<body class="hold-transition skin-blue">
  <div class="loading-block">
    <div class="loading z-depth-4"></div>
  </div>
  <div class="wrapper">
    <!-- Main Header -->
    <header class="main-header">
      <!-- Logo -->
      <a href="{{url('/admin')}}" class="logo" title="{{$w_title}}">
        @if(isset($logo))
        <img src="{{url('images/logo/'.$logo)}}" class="img-responsive" alt="{{$w_title}}">
        @endif
      </a>
      @php
      $nav_menus=App\Menu::all();
      @endphp
      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">{{__('adminstaticwords.ToggleNavgation')}}</span>
        </a>
        @if (isset($nav_menus) && count($nav_menus) > 0)
        <a href="{{isset($nav_menus[0]) ? route('home', $nav_menus[0]->slug) : '#'}}" target="_blank" class="visit-site-btn btn" title="{{__('adminstaticwords.VisitSite')}}">{{__('adminstaticwords.VisitSite')}} <i class="material-icons right">keyboard_arrow_right</i></a>
        @else
        <a href="#" data-toggle="tooltip" data-placement="bottom" data-original-title="{{__('adminstaticwords.Pleasecreateatleastonemenutovisitthesite')}}" class="visit-site-btn btn">{{__('adminstaticwords.VisitSite')}} <i class="material-icons right">keyboard_arrow_right</i></a>
        @endif
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown admin-nav">
              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="material-icons">translate</i> {{Session::has('changed_language') ? Session::get('changed_language') : ''}}</button>
              <ul class="dropdown-menu animated flipInX">
                @if (isset($lang) && count($lang) > 0)
                @foreach ($lang as $langitem)
                <li><a href="{{ route('languageSwitch', $langitem->local) }}">{{$langitem->name}} ({{$langitem->local}}) </a></li>
                @endforeach
                @endif
              </ul>
            </li>
            <li class="dropdown admin-nav">
              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="material-icons">account_circle</i></button>
              <ul class="dropdown-menu animated flipInX">
                <li><a href="{{url('admin/profile')}}" title="My Profile">{{__('adminstaticwords.MyProfile')}}</a></li>
                <li>
                  <a href="{{ route('custom.logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();" title="{{__('logout')}}">
                  {{__('adminstaticwords.Logout')}}
                </a>
                <form id="logout-form" action="{{ route('custom.logout') }}" method="GET" style="display: none;">
                  {{ csrf_field() }}
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" style="background-image: url({{url('images/sidebar-7.jpg')}});">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <i class="material-icons">account_circle</i>
        </div>
        <div class="pull-left info">
          <h4 class="user-name">{{ucfirst(Auth::user()->name)}}</h4>
          @if(Auth::user()->is_admin == 1)
            <p>{{__('adminstaticwords.Admin')}}</p>
          @else
            <p>{{__('adminstaticwords.Producer')}}</p>
          @endif
        </div>
      </div>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- Optionally, you can add icons to the links -->
        @if(Auth::user()->is_assistant != 1)
          <li><a class="{{ Nav::isRoute('dashboard') }}" href="{{url('/admin')}}" title="{{__('adminstaticwords.Dashboard')}}" id="dashboard"><i class="material-icons">dashboard</i> <span>{{__('adminstaticwords.Dashboard')}}</span></a></li>
        @endif
        @if(Auth::user()->is_assistant != 1)
          <li><a class="{{ Nav::isResource('users') }}" href="{{url('/admin/users')}}" title="{{__('adminstaticwords.Users')}}" id="users"><i class="material-icons">people</i> <span>{{__('adminstaticwords.Users')}}</span></a></li>
        @endif
        
        @if(Auth::user()->is_assistant != 1)
        <li><a class="{{ Nav::isResource('menu') }}" class="{{ Nav::isResource('menu') }}" href="{{url('/admin/menu')}}" title="{{__('adminstaticwords.Menu')}}" id="menu"><i class="material-icons">menu</i> <span>{{__('adminstaticwords.MenuNavigation')}}</span></a></li>
       
     

        <li class="treeview">
          <a href="#" class="{{ Nav::isResource('packages') }}{{ Nav::isResource('package_feature') }} " title="Producer Settings">
            <i class="material-icons">poll</i> <span>{{__('adminstaticwords.PackageSettings')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a class="{{ Nav::isResource('packages') }}" href="{{url('/admin/packages')}}" title="{{__('Packages')}}" id="package"><i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.Packages')}}</span></a></li>
            <li><a class="{{ Nav::isResource('package_feature') }}" href="{{url('/admin/package_feature')}}" title="{{__('Packages Feature')}}" id="package"><i class="fa fa-circle-o"></i> <span>{{__('Package Feature')}}</span></a></li>
            
          </ul>
        </li>
        @endif

        <li><a class="{{ Nav::isResource('movies') }}" href="{{url('/admin/movies')}}" title="{{__('adminstaticwords.Movies')}}"id="movies"><i class="material-icons">ondemand_video</i> <span>{{__('adminstaticwords.Movies')}}</span></a></li>
        <li><a class="{{ Nav::isResource('tvseries') }}" href="{{url('/admin/tvseries')}}" title="{{__('adminstaticwords.TVSeries')}}" id="tvseries"><i class="material-icons">movie_filter</i> <span>{{__('adminstaticwords.TVSeries')}}</span></a></li>

         <li><a class="{{ Nav::isResource('livetv') }}" href="{{url('/admin/livetv')}}" title="{{__('adminstaticwords.LiveTV')}}" id="livetv"><i class="material-icons">shop_two</i> <span>{{__('adminstaticwords.LiveTV')}}</span></a></li>

         @if(Auth::user()->is_assistant != 1)
         <li><a class="{{ Nav::isResource('liveevent') }}" href="{{url('/admin/liveevent')}}" title="{{__('adminstaticwords.LiveEvent')}}" id="liveevent"><i class="material-icons">event</i> <span>{{__('adminstaticwords.LiveEvent')}}</span></a></li>

        <li><a class="{{ Nav::hasSegment('audio') }}" href="{{url('admin/audio')}}" title="{{__('adminstaticwords.Audio')}}"><i class="material-icons">audiotrack</i> <span>{{__('adminstaticwords.Audio')}}</span></a></li>
        @endif  

        <li class="treeview">
          <a href="#" class="{{ Nav::isResource('genres') }} {{ Nav::isResource('directors') }} {{ Nav::isResource('actors') }} {{ Nav::isResource('audio_language') }} {{ Nav::isResource('label') }} " title="{{__('adminstaticwords.Content')}}">
            <i class="material-icons">filter_list</i> <span>{{__('adminstaticwords.Content')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a class="{{ Nav::isResource('genres') }}" href="{{url('/admin/genres')}}" title="{{__('adminstaticwords.Genres')}}" id="genre"><i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.Genres')}}</span></a></li>
            <li><a class="{{ Nav::isResource('directors') }}" href="{{url('/admin/directors')}}" title="{{__('adminstaticwords.Directors')}}"><i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.Directors')}}</span></a></li>
            <li><a class="{{ Nav::isResource('actors') }}" href="{{url('/admin/actors')}}" title="{{__('adminstaticwords.Actors')}}"><i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.Actors')}}</span></a></li>
             <li><a class="{{ Nav::isResource('audio_language') }}" href="{{url('admin/audio_language')}}" title="{{__('adminstaticwords.AudioLanguages')}}"><i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.AudioLanguages')}}</span></a></li>
            <li><a class="{{ Nav::isResource('label') }}" href="{{url('/admin/label')}}" title="{{__('Label')}}"><i class="fa fa-circle-o"></i> <span>{{__('Label')}}</span></a></li>
          </ul>
        </li>
        
       
        @if(Auth::user()->is_assistant != 1)
        @php
          $config = App\Config::first();
        @endphp
        @if($config->blog == 1)
         <li><a class="{{ Nav::isResource('blog') }}" href="{{route('blog.index')}}" title="{{__('adminstaticwords.Blog')}}"><i class="material-icons">pages</i> <span>{{__('adminstaticwords.Blog')}}</span></a></li>
        @endif
        <li><a class="{{ Nav::isResource('notification') }}" href="{{route('notification.create')}}" title="{{__('adminstaticwords.Notification')}}"><i class="material-icons">notifications_active</i> <span>{{__('adminstaticwords.Notification')}}</span></a></li>

        <li class="treeview">
          <a href="#" class="{{ Nav::isRoute('addedmovies') }} {{ Nav::isRoute('addedTvSeries') }} {{ Nav::isRoute('addedLiveTv') }}" title="{{__('adminstaticwords.ProducerSettings')}}">
            <i class="material-icons">ondemand_video</i> <span>{{__('adminstaticwords.ProducerSettings')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a class="{{ Nav::isRoute('addedmovies') }}" href="{{route('addedmovies')}}" title="{{__('adminstaticwords.AddedMovies')}}"><i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.AddedMovies')}}</span></a></li>
            <li><a class="{{ Nav::isRoute('addedTvSeries') }}" href="{{route('addedTvSeries')}}" title="{{__('adminstaticwords.AddedTVSeries')}}"><i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.AddedTVSeries')}}</span></a></li>
            <li><a class="{{ Nav::isRoute('addedLiveTv') }}" href="{{route('addedLiveTv')}}" title="{{__('adminstaticwords.AddedLiveTv')}}"><i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.AddedLiveTv')}}</span></a></li>
          </ul>
        </li>

        <li><a class="{{ Nav::isResource('coupons') }}" href="{{url('/admin/coupons')}}" title="{{__('adminstaticwords.StripeCoupons')}}"><i class="material-icons">assignment</i> <span>{{__('adminstaticwords.AllCoupons')}}</span></a></li>

        <li><a class="{{ Nav::isRoute('addonmanger.index') }}" href="{{route('addonmanger.index')}}" title="{{__('adminstaticwords.Add-On')}}"><i class="material-icons">extension</i> <span>{{__('adminstaticwords.Add-On')}}</span></a></li>


        <li class="treeview">
          <a href="#" class="{{ Nav::isRoute('admin.comment.index') }} {{ Nav::isRoute('admin.subcomment.index') }} " title="{{__('adminstaticwords.CommentSettings')}}">
            <i class="material-icons">comment</i> <span>{{__('adminstaticwords.CommentSettings')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a class="{{ Nav::isRoute('admin.comment.index') }}" href="{{url('/admin/comments')}}" title="{{__('adminstaticwords.Comments')}}"><i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.Comments')}}</span></a></li>
           <li><a class="{{ Nav::isRoute('admin.subcomment.index') }}" href="{{url('/admin/subcomments')}}" title="{{__('adminstaticwords.Comments')}}"><i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.SubComments')}}</span></a></li>
          
          </ul>
        </li>

        <li class="treeview">
          <a href="#" class="{{ Nav::isResource('home_slider') }} {{ Nav::isResource('landing-page') }} {{ Nav::isResource('auth-page-customize') }} {{ Nav::isRoute('social.ico') }} {{ Nav::isResource('home-block') }} {{ Nav::isResource('custom_page') }} {{ Nav::isResource('faqs') }}" title="{{__('adminstaticwords.SiteCustomization')}}" id="sitecustomization">
            <i class="material-icons">view_quilt</i> <span>{{__('adminstaticwords.SiteCustomization')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
               <li><a class="{{ Nav::isResource('home_slider') }}" href="{{url('/admin/home_slider')}}" title="{{__('adminstaticwords.SliderSettings')}}"><i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.SliderSettings')}}</span></a></li>
            <li><a class="{{ Nav::isResource('landing-page') }}" href="{{url('admin/customize/landing-page')}}" title="{{__('adminstaticwords.LandingPage')}}"><i class="fa fa-circle-o"></i> {{__('adminstaticwords.LandingPage')}}</a></li>
             <li><a class="{{ Nav::isResource('custom_page') }}" href="{{url('/admin/custom_page')}}" title="{{__('adminstaticwords.CustomPages')}}"><i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.CustomPages')}}</span></a></li>

            <li><a class="{{ Nav::isResource('auth-page-customize') }}" href="{{url('admin/customize/auth-page-customize')}}" title="{{__('adminstaticwords.SignInSignUp')}}"><i class="fa fa-circle-o"></i> {{__('adminstaticwords.SignInSignUp')}}</a></li>

            <li><a class="{{ Nav::isRoute('social.ico') }}" href="{{route('social.ico')}}" title="{{__('adminstaticwords.SocialIconSetting')}}"><i class="fa fa-circle-o"></i> {{__('adminstaticwords.SocialIconSetting')}}</a></li>

           
             <li><a class="{{ Nav::isResource('home-block') }}" href="{{url('/admin/home-block')}}" title="{{__('adminstaticwords.PromotionSettings')}}"><i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.PromotionSettings')}}</span></a></li>
             <li><a class="{{ Nav::isResource('faqs') }}" href="{{url('/admin/faqs')}}" title="{{__('adminstaticwords.Faq')}}"><i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.Faq')}}</span></a></li>
          </ul>
        </li>

        

        <li class="treeview">
          <a href="#" class="{{ Nav::isResource('settings') }} {{ Nav::isRoute('term_con') }}{{ Nav::isRoute('manual.payment.gateway') }} {{ Nav::isRoute('pri_pol') }} {{ Nav::isRoute('refund_pol') }}{{ Nav::isRoute('adsense') }}{{ Nav::isRoute('sociallogin') }} {{ Nav::isRoute('copyright') }} {{ Nav::isRoute('term_con') }} {{ Nav::isRoute('pwa.setting.index') }} {{ Nav::isRoute('player.set') }} {{ Nav::isRoute('ads') }}  {{ Nav::isResource('manual-payment') }} {{ Nav::hasSegment('blocker') }} {{ Nav::isResource('languages') }} {{ Nav::isRoute('google.ads') }} {{ Nav::isRoute('admin.color.scheme') }}" title="{{__('adminstaticwords.SiteSettings')}}" id="sitesettings">
            <i class="material-icons">settings</i> <span>{{__('adminstaticwords.SiteSettings')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a class="{{ Nav::isResource('settings') }}" href="{{url('admin/settings')}}" title="{{__('adminstaticwords.Settings')}}"><i class="fa fa-circle-o"></i> {{__('adminstaticwords.Settings')}}</a></li>
           
             <li><a class="{{ Nav::isRoute('sociallogin') }}" href="{{url('/admin/social-login')}}" title="{{__('adminstaticswords.SocialLoginSettings')}}"><i class="fa fa-circle-o"></i><span> {{__('adminstaticwords.SocialLoginSettings')}}</span></a></li>

              <li><a class="{{ Nav::isRoute('chat.index') }}" href="{{route('chat.index')}}" title="{{__('adminstaticwords.ChatSettings')}}"><i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.ChatSettings')}}</span></a>
              </li>

              <li><a class="{{ Nav::isRoute('pwa.setting.index') }}" href="{{route('pwa.setting.index')}}" title="{{__('adminstaticwords.PWASettings')}}"><i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.PWASettings')}}</span></a></li>

              <li><a class="{{ Nav::isRoute('admin.color.scheme') }}" href="{{route('admin.color.scheme')}}" title="{{__('adminstaticwords.ColorSchemes')}}"><i class="fa fa-circle-o"></i> <span>{{__('Color Option')}}</span></a></li>

              <li><a class="{{ Nav::isRoute('manual.payment.gateway') }}" href="{{route('manual.payment.gateway')}}" title="{{__('adminstaticwords.ManualPaymentGateway')}}"><i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.ManualPaymentGateway')}}</span></a></li>

              <li><a class="{{ Nav::isRoute('admin.push.noti.settings') }}" href="{{route('admin.push.noti.settings')}}" title="{{__('adminstaticwords.PushNotification')}}"><i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.PushNotification')}}</span></a></li>

              <li class="treeview">
                <a href="#" class="{{ Nav::isRoute('player.set') }} {{ Nav::isRoute('ads') }} {{ Nav::isRoute('google.ads') }}" title="{{__('adminstaticwords.PlayerSetting')}} " id="player">
                  <i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.PlayerSetting')}}</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a class="{{ Nav::isRoute('player.set') }}" href="{{route('player.set')}}" title="{{__('adminstaticwords.PlayerCustomization')}}"><i class="fa fa-circle-o"></i>{{__('adminstaticwords.PlayerCustomization')}}</a></li>

                  <li><a class="{{ Nav::isRoute('ads') }}" href="{{url('admin/ads')}}" title="{{__('adminstaticwords.Advertise')}}"><i class="fa fa-circle-o"></i>{{__('adminstaticwords.Advertise')}}</a></li>
                   {{-- @php $ads = App\Ads::all(); @endphp --}}
                  <li><a class="{{ Nav::isRoute('google.ads') }}" href="{{route('google.ads')}}" title="{{__('adminstaticwords.GoogleAdvertise')}}"><i class="fa fa-circle-o"></i>{{__('adminstaticwords.GoogleAdvertise')}}</a></li>
                </ul>
              </li>
             <li><a class="{{ Nav::isResource('manual-payment') }}" href="{{url('/admin/manual-payment')}}" title="{{__('adminstaticwords.ManualPaymentTransaction')}}"><i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.ManualPayments')}}</span></a></li>
            
            <li><a class="{{ Nav::isRoute('adsense') }}" href="{{url('/admin/adsensesetting')}}" title="{{__('adminstaticwords.AdsenseSettings')}}"><span><i class="fa fa-circle-o"></i> &nbsp;&nbsp;{{__('adminstaticwords.AdsenseSettings')}}</span></a></li>

            <li><a class="{{ Nav::isRoute('term_con') }}" href="{{url('admin/term&con')}}" title="{{__('adminstaticwords.TermsCondition')}}"><i class="fa fa-circle-o"></i> {{__('adminstaticwords.TermsCondition')}}</a></li>
            <li><a class="{{ Nav::isRoute('pri_pol') }}" href="{{url('admin/pri_pol')}}" title="{{__('adminstaticwords.PrivacyPolicy')}}"><i class="fa fa-circle-o"></i> {{__('adminstaticwords.PrivacyPolicy')}}</a></li>
            <li><a class="{{ Nav::isRoute('refund_pol') }}" href="{{url('admin/refund_pol')}}" title="{{__('adminstaticwords.RefundPolicy')}}"><i class="fa fa-circle-o"></i> {{__('adminstaticwords.RefundPolicy')}}</a></li>
            <li><a class="{{ Nav::isRoute('copyright') }}" href="{{url('admin/copyright')}}" title="{{__('adminstaticwords.Copyright')}}"><i class="fa fa-circle-o"></i> {{__('adminstaticwords.Copyright')}}</a></li>

            <li><a class="{{ Nav::isRoute('customstyle') }}" href="{{url('admin/custom-style-settings')}}" title="{{__('adminstaticwords.CustomStyle')}}"><i class="fa fa-circle-o"></i> {{__('adminstaticwords.CustomStyle')}}</a></li>

            {{-- <li><a class="{{ Nav::hasSegment('blocker') }}" href="{{url('/blocker')}}" title="{{__('adminstaticwords.GeoLocationControl')}}"><i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.GeoLocationControl')}}</span></a></li> --}}
            <li class="treeview">
            <a href="#" class="{{ Nav::isRoute('pricing.get') }} {{ Nav::isResource('languages') }}" id="language">
              <i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.Translations')}}</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a class="{{ Nav::isResource('languages') }}" href="{{url('/admin/languages')}}" title="{{__('adminstaticwords.Languages')}}"><i class="fa fa-circle-o"></i><span>{{__('adminstaticwords.Languages')}}</span></a></li>
            </ul>
          </li>

          </ul>
        </li>

        
        <li class="treeview">
          <a href="#" class="{{ Nav::isRoute('device_history') }} {{ Nav::hasSegment('report') }} {{ Nav::isRoute('revenue.report')}} {{ Nav::isRoute('view.track') }}" title="{{__('adminstaticwords.Reports')}}" id="sitesettings">
            <i class="material-icons">trending_up</i> <span>{{__('adminstaticwords.Reports')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @if(Auth::user()->is_assistant != 1 && App\PaypalSubscription::count()>0)
              <li><a class="{{ Nav::isResource('plan') }}" href="{{url('/admin/plan')}}" title="{{__('adminstaticwords.ActivePlan')}}"><i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.UsersSubscription')}}</span></a>
              </li>
            @endif
            @if(env('STRIPE_SECRET') != "")
              <li><a class="{{ Nav::hasSegment('report') }}" href="{{url('admin/report')}}" title="{{__('adminstaticwords.StripeReports')}}"><i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.StripeReports')}}</span></a></li>
            @endif
            <li><a class="{{ Nav::isRoute('device_history') }}" href="{{ route('device_history') }}" title="{{__('adminstaticwords.DeviceHistory')}}"><i class="fa fa-circle-o"></i>  <span>{{__('adminstaticwords.DeviceHistory')}}</span></a></li>
           
             <li><a class="{{ Nav::isRoute('revenue.report')}}" href="{{url('admin/report_revenue')}}" title="{{__('adminstaticwords.RevenueReport')}}"><i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.RevenueReport')}}</span></a>
            </li>
            <li><a class="{{ Nav::isRoute('view.track') }}" href="{{ route('view.track') }}" title="{{__('adminstaticwords.ViewTracker')}}"><i class="fa fa-circle-o"></i><span>{{__('adminstaticwords.ViewTracker')}}</span></a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#" class="{{ Nav::isResource('appsettings') }} {{ Nav::isRoute('admob') }}{{ Nav::isResource('splashscreen') }} {{ Nav::isResource('appslider') }}" title="{{__('adminstaticwords.MobileAppSettings')}}" id="mobilesettings">
            <i class="material-icons">phonelink_setup</i> <span>{{__('adminstaticwords.AppSettings')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a class="{{ Nav::isResource('appsettings') }}" href="{{url('admin/appsettings')}}" title="{{__('adminstaticwords.Settings')}}"><i class="fa fa-circle-o"></i> {{__('adminstaticwords.Settings')}}</a></li>
           
             <li><a class="{{ Nav::isResource('splashscreen') }}" href="{{url('admin/splashscreen')}}" title="{{__('adminstaticwords.SplashscreenSettings')}}"><span><i class="fa fa-circle-o"></i> &nbsp;&nbsp;{{__('adminstaticwords.SplashscreenSettings')}}</span></a></li>
            
            <li><a class="{{ Nav::isResource('appslider') }}" href="{{url('admin/appslider')}}" title="{{__('adminstaticwords.AppSliderSettings')}}"><span><i class="fa fa-circle-o"></i> &nbsp;&nbsp;{{__('adminstaticwords.AppSliderSettings')}}</span></a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#" class="{{ Nav::isRoute('admin.backup.settings') }} {{ Nav::isRoute('system.status') }} {{ Nav::isRoute('clear_cache') }} {{ Nav::isRoute('get.remove.public') }}" title="{{__('adminstaticwords.HelpAndSupport')}}" id="HelpAndSupport">
            <i class="material-icons">help_outline</i> <span>{{__('adminstaticwords.HelpAndSupport')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a class="{{ Nav::isRoute('admin.backup.settings') }}" href="{{route('admin.backup.settings')}}" title="{{__('adminstaticwords.DatabaseBackup')}}"><i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.DatabaseBackup')}}</span></a></li>
            <li><a class="{{ Nav::isRoute('system.status') }}" href="{{route('system.status')}}" title="{{__('adminstaticwords.SystemStatus')}}"><i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.SystemStatus')}}</span></a></li>
            <li><a class="{{ Nav::isRoute('get.remove.public') }}" href="{{route('get.remove.public')}}" title="{{__('adminstaticwords.RemovePublic')}}"><i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.RemovePublic')}}</span></a></li>
            <li><a class="{{ Nav::isRoute('clear_cache') }}" href="{{route('clear.cache')}}" title="{{__('adminstaticwords.ClearCache')}}"><i class="fa fa-circle-o"></i> <span>{{__('adminstaticwords.ClearCache')}}</span></a></li>
            
          </ul>
        </li>
      
       @endif
   

     </ul>
     <!-- /.sidebar-menu -->
   </section>
   <!-- /.sidebar -->
 </aside>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  @if (Session::has('added'))
  <div id="sessionModal" class="sessionmodal rgba-green-strong z-depth-2">
    <i class="fa fa-check-circle"></i> <p>{{session('added')}}</p>
  </div>
  @elseif (Session::has('updated'))
  <div id="sessionModal" class="sessionmodal rgba-cyan-strong z-depth-2">
    <i class="fa fa-check-circle"></i> <p>{{session('updated')}}</p>
  </div>
  @elseif (Session::has('deleted'))
  <div id="sessionModal" class="sessionmodal rgba-red-strong z-depth-2">
    <i class="fa fa-window-close"></i> <p>{{session('deleted')}}</p>
  </div>
  @endif
  <!-- Content Header (Page header) -->
  <section class="content-header">
  </section>
  <!-- Main content -->
  <section class="content container-fluid">
    @yield('content')

  </section>

  <!-- /.content -->
</div>
<p class="version">{{__('adminstaticwords.Version')}} 4.0&emsp;</p>
<!-- /.content-wrapper -->
<!-- Main Footer -->

</div>
<!-- ./wrapper -->
{{-- smooth jquery js --}}


<!-- Admin Js -->
<script src="{{url('js/jquery.min.js')}}" type="text/javascript"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js" type="text/javascript"></script>
<script src="{{url('js/admin.js')}}" type="text/javascript"></script>
<script src="{{url('js/app.js')}}" type="text/javascript"></script>

<script src="{{url('js/ckeditor.js')}}" type="text/javascript"></script>
<script src="{{url('js/datatables.min.js')}}" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.colVis.js"></script>

<script src="{{url('js/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{url('js/chart.min.js')}}" type="text/javascript"></script>
<script src="{{url('js/utils.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-pageLoadMore/1.0.0/js/dataTables.pageLoadMore.min.js"></script>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="{{url('js/jquery-jvectormap-1.2.2.min.js')}}" type="text/javascript"></script>
<script src="{{url('js/jquery-jvectormap-world-mill-en.js')}}" type="text/javascript"></script>
<script src="{{ url('js/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ url('js/star-rating.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
{{-- yajra scripts --}}

{{-- data table scripts --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

 
<script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="//cdn.datatables.net/1.10.20/js/dataTables.material.min.js"></script>

<script type="text/javascript" src="//cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script>

{{-- end yajra  --}}


<script src="{{ url('js/custom-js.js') }}"></script>
<!------- datepicker ------------------------->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!--- lazy load --->
<script src="{{ url('js/bootstrap-colorpicker.min.js') }}"></script>
 

<script>
  $(function () {
    // DataTables
   $('#movies_table').DataTable({
     
      responsive: true,
      "sDom": "<'row'><'row'<'col-md-4'l><'col-md-4'B><'col-md-4'f>r>t<'row'<'col-sm-12'p>>",
      "language": {
        "paginate": {
          "previous": '<i class="material-icons paginate-btns">keyboard_arrow_left</i>',
          "next": '<i class="material-icons paginate-btns">keyboard_arrow_right</i>'
          }
      },
      buttons: [
        {
          extend: 'print',
          exportOptions: {
              columns: ':visible'
          }
        },
        'csvHtml5',
        'excelHtml5',
      ]
    });

    $('#full_detail_table').DataTable({
      responsive: true,
      "sDom": "<'row'><'row'<'col-md-4'l><'col-md-4'B><'col-md-4'f>r>t<'row'<'col-sm-12'p>>",
      "language": {
      "paginate": {
        "previous": '<i class="material-icons paginate-btns">keyboard_arrow_left</i>',
        "next": '<i class="material-icons paginate-btns">keyboard_arrow_right</i>'
        }
      },
      buttons: [
        {
          extend: 'print',
          exportOptions: {
              columns: ':visible'
          }
        },
        'csvHtml5',
        'excelHtml5',
        'colvis',
      ]
    });
    
    $(".js-select2").select2({
        placeholder: "Pick states",
        theme: "material"
    });

    $(".select2-selection__arrow")
        .addClass("material-icons")
        .html("arrow_drop_down");
  });
</script>
    
</script>
<script>
  $(function () {
    $('[data-toggle="popover"]').popover()
  });
  
  $('.my-colorpicker2').colorpicker()

</script>


@yield('custom-script')
</body>
</html>
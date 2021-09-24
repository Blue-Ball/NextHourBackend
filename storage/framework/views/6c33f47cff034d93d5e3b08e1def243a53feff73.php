<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <title><?php echo $__env->yieldContent('title'); ?> - <?php echo e(__('adminstaticwords.Admin')); ?> - <?php echo e($w_title); ?></title>
  <!-- favicon-icon -->
  <link rel="icon" type="image/icon" href="<?php echo e(url('images/favicon/favicon.png')); ?>"/>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
  <!-- Google Fonts -->
  <link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet"/>
  <!-- Material Icons -->
  <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
  
   
   <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/button.datatable.css')); ?>">
   <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/datatable.min.css')); ?>"/>
   <link href ="<?php echo e(url('css/datatable_material.css')); ?>" rel="stylesheet" />
 
  <link href ="<?php echo e(url('css/dataTables.material.min.css')); ?>" rel="stylesheet" />
 
   <link href="//cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
  
  
  <link rel="stylesheet" href="<?php echo e(url('css/maincss.css')); ?>"/>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" type="text/css" />

 
  <!-- Jquery Ui Css -->
  <link rel="stylesheet" href="<?php echo e(url('css/jquery-ui.min.css')); ?>"/>
  <link rel="stylesheet" href="<?php echo e(url('css/jquery-jvectormap.css')); ?>"/>
  <!-- Admin (main) Style Sheet -->
  <link rel="stylesheet" href="<?php echo e(url('css/admin.css')); ?>"/>
  <link rel="stylesheet" href="<?php echo e(url('css/bootstrap-tagsinput.css')); ?>"/>
  <link rel="stylesheet" href="<?php echo e(url('css/custom-style.css')); ?>"/>
  <link rel="stylesheet" href="<?php echo e(url('css/star-rating.min.css')); ?>"/>
   <link rel="stylesheet" href="<?php echo e(url('css/bootstrap-colorpicker.min.css')); ?>"/>

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

  <?php echo $__env->yieldContent('stylesheet'); ?>
</head>
<body class="hold-transition skin-blue">
  <div class="loading-block">
    <div class="loading z-depth-4"></div>
  </div>
  <div class="wrapper">
    <!-- Main Header -->
    <header class="main-header">
      <!-- Logo -->
      <a href="<?php echo e(url('/admin')); ?>" class="logo" title="<?php echo e($w_title); ?>">
        <?php if(isset($logo)): ?>
        <img src="<?php echo e(url('images/logo/'.$logo)); ?>" class="img-responsive" alt="<?php echo e($w_title); ?>">
        <?php endif; ?>
      </a>
      <?php
      $nav_menus=App\Menu::all();
      ?>
      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only"><?php echo e(__('adminstaticwords.ToggleNavgation')); ?></span>
        </a>
        <?php if(isset($nav_menus) && count($nav_menus) > 0): ?>
        <a href="<?php echo e(isset($nav_menus[0]) ? route('home', $nav_menus[0]->slug) : '#'); ?>" target="_blank" class="visit-site-btn btn" title="<?php echo e(__('adminstaticwords.VisitSite')); ?>"><?php echo e(__('adminstaticwords.VisitSite')); ?> <i class="material-icons right">keyboard_arrow_right</i></a>
        <?php else: ?>
        <a href="#" data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo e(__('adminstaticwords.Pleasecreateatleastonemenutovisitthesite')); ?>" class="visit-site-btn btn"><?php echo e(__('adminstaticwords.VisitSite')); ?> <i class="material-icons right">keyboard_arrow_right</i></a>
        <?php endif; ?>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown admin-nav">
              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="material-icons">translate</i> <?php echo e(Session::has('changed_language') ? Session::get('changed_language') : ''); ?></button>
              <ul class="dropdown-menu animated flipInX">
                <?php if(isset($lang) && count($lang) > 0): ?>
                <?php $__currentLoopData = $lang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $langitem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a href="<?php echo e(route('languageSwitch', $langitem->local)); ?>"><?php echo e($langitem->name); ?> (<?php echo e($langitem->local); ?>) </a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
              </ul>
            </li>
            <li class="dropdown admin-nav">
              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="material-icons">account_circle</i></button>
              <ul class="dropdown-menu animated flipInX">
                <li><a href="<?php echo e(url('admin/profile')); ?>" title="My Profile"><?php echo e(__('adminstaticwords.MyProfile')); ?></a></li>
                <li>
                  <a href="<?php echo e(route('custom.logout')); ?>"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();" title="<?php echo e(__('logout')); ?>">
                  <?php echo e(__('adminstaticwords.Logout')); ?>

                </a>
                <form id="logout-form" action="<?php echo e(route('custom.logout')); ?>" method="GET" style="display: none;">
                  <?php echo e(csrf_field()); ?>

                </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" style="background-image: url(<?php echo e(url('images/sidebar-7.jpg')); ?>);">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <i class="material-icons">account_circle</i>
        </div>
        <div class="pull-left info">
          <h4 class="user-name"><?php echo e(ucfirst(Auth::user()->name)); ?></h4>
          <?php if(Auth::user()->is_admin == 1): ?>
            <p><?php echo e(__('adminstaticwords.Admin')); ?></p>
          <?php else: ?>
            <p><?php echo e(__('adminstaticwords.Producer')); ?></p>
          <?php endif; ?>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- Optionally, you can add icons to the links -->
        <?php if(Auth::user()->is_assistant != 1): ?>
          <li><a class="<?php echo e(Nav::isRoute('dashboard')); ?>" href="<?php echo e(url('/admin')); ?>" title="<?php echo e(__('adminstaticwords.Dashboard')); ?>" id="dashboard"><i class="material-icons">dashboard</i> <span><?php echo e(__('adminstaticwords.Dashboard')); ?></span></a></li>
        <?php endif; ?>
        <?php if(Auth::user()->is_assistant != 1): ?>
          <li><a class="<?php echo e(Nav::isResource('users')); ?>" href="<?php echo e(url('/admin/users')); ?>" title="<?php echo e(__('adminstaticwords.Users')); ?>" id="users"><i class="material-icons">people</i> <span><?php echo e(__('adminstaticwords.Users')); ?></span></a></li>
        <?php endif; ?>
        
        <?php if(Auth::user()->is_assistant != 1): ?>
        <li><a class="<?php echo e(Nav::isResource('menu')); ?>" class="<?php echo e(Nav::isResource('menu')); ?>" href="<?php echo e(url('/admin/menu')); ?>" title="<?php echo e(__('adminstaticwords.Menu')); ?>" id="menu"><i class="material-icons">menu</i> <span><?php echo e(__('adminstaticwords.MenuNavigation')); ?></span></a></li>
       
     

        <li class="treeview">
          <a href="#" class="<?php echo e(Nav::isResource('packages')); ?><?php echo e(Nav::isResource('package_feature')); ?> " title="Producer Settings">
            <i class="material-icons">poll</i> <span><?php echo e(__('adminstaticwords.PackageSettings')); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a class="<?php echo e(Nav::isResource('packages')); ?>" href="<?php echo e(url('/admin/packages')); ?>" title="<?php echo e(__('Packages')); ?>" id="package"><i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.Packages')); ?></span></a></li>
            <li><a class="<?php echo e(Nav::isResource('package_feature')); ?>" href="<?php echo e(url('/admin/package_feature')); ?>" title="<?php echo e(__('Packages Feature')); ?>" id="package"><i class="fa fa-circle-o"></i> <span><?php echo e(__('Package Feature')); ?></span></a></li>
            
          </ul>
        </li>
        <?php endif; ?>

        <li><a class="<?php echo e(Nav::isResource('movies')); ?>" href="<?php echo e(url('/admin/movies')); ?>" title="<?php echo e(__('adminstaticwords.Movies')); ?>"id="movies"><i class="material-icons">ondemand_video</i> <span><?php echo e(__('adminstaticwords.Movies')); ?></span></a></li>
        <li><a class="<?php echo e(Nav::isResource('tvseries')); ?>" href="<?php echo e(url('/admin/tvseries')); ?>" title="<?php echo e(__('adminstaticwords.TVSeries')); ?>" id="tvseries"><i class="material-icons">movie_filter</i> <span><?php echo e(__('adminstaticwords.TVSeries')); ?></span></a></li>

         <li><a class="<?php echo e(Nav::isResource('livetv')); ?>" href="<?php echo e(url('/admin/livetv')); ?>" title="<?php echo e(__('adminstaticwords.LiveTV')); ?>" id="livetv"><i class="material-icons">shop_two</i> <span><?php echo e(__('adminstaticwords.LiveTV')); ?></span></a></li>

         <?php if(Auth::user()->is_assistant != 1): ?>
         <li><a class="<?php echo e(Nav::isResource('liveevent')); ?>" href="<?php echo e(url('/admin/liveevent')); ?>" title="<?php echo e(__('adminstaticwords.LiveEvent')); ?>" id="liveevent"><i class="material-icons">event</i> <span><?php echo e(__('adminstaticwords.LiveEvent')); ?></span></a></li>

        <li><a class="<?php echo e(Nav::hasSegment('audio')); ?>" href="<?php echo e(url('admin/audio')); ?>" title="<?php echo e(__('adminstaticwords.Audio')); ?>"><i class="material-icons">audiotrack</i> <span><?php echo e(__('adminstaticwords.Audio')); ?></span></a></li>
        <?php endif; ?>  

        <li class="treeview">
          <a href="#" class="<?php echo e(Nav::isResource('genres')); ?> <?php echo e(Nav::isResource('directors')); ?> <?php echo e(Nav::isResource('actors')); ?> <?php echo e(Nav::isResource('audio_language')); ?> <?php echo e(Nav::isResource('label')); ?> " title="<?php echo e(__('adminstaticwords.Content')); ?>">
            <i class="material-icons">filter_list</i> <span><?php echo e(__('adminstaticwords.Content')); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a class="<?php echo e(Nav::isResource('genres')); ?>" href="<?php echo e(url('/admin/genres')); ?>" title="<?php echo e(__('adminstaticwords.Genres')); ?>" id="genre"><i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.Genres')); ?></span></a></li>
            <li><a class="<?php echo e(Nav::isResource('directors')); ?>" href="<?php echo e(url('/admin/directors')); ?>" title="<?php echo e(__('adminstaticwords.Directors')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.Directors')); ?></span></a></li>
            <li><a class="<?php echo e(Nav::isResource('actors')); ?>" href="<?php echo e(url('/admin/actors')); ?>" title="<?php echo e(__('adminstaticwords.Actors')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.Actors')); ?></span></a></li>
             <li><a class="<?php echo e(Nav::isResource('audio_language')); ?>" href="<?php echo e(url('admin/audio_language')); ?>" title="<?php echo e(__('adminstaticwords.AudioLanguages')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.AudioLanguages')); ?></span></a></li>
            <li><a class="<?php echo e(Nav::isResource('label')); ?>" href="<?php echo e(url('/admin/label')); ?>" title="<?php echo e(__('Label')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(__('Label')); ?></span></a></li>
          </ul>
        </li>
        
       
        <?php if(Auth::user()->is_assistant != 1): ?>
        <?php
          $config = App\Config::first();
        ?>
        <?php if($config->blog == 1): ?>
         <li><a class="<?php echo e(Nav::isResource('blog')); ?>" href="<?php echo e(route('blog.index')); ?>" title="<?php echo e(__('adminstaticwords.Blog')); ?>"><i class="material-icons">pages</i> <span><?php echo e(__('adminstaticwords.Blog')); ?></span></a></li>
        <?php endif; ?>
        <li><a class="<?php echo e(Nav::isResource('notification')); ?>" href="<?php echo e(route('notification.create')); ?>" title="<?php echo e(__('adminstaticwords.Notification')); ?>"><i class="material-icons">notifications_active</i> <span><?php echo e(__('adminstaticwords.Notification')); ?></span></a></li>

        <li class="treeview">
          <a href="#" class="<?php echo e(Nav::isRoute('addedmovies')); ?> <?php echo e(Nav::isRoute('addedTvSeries')); ?> <?php echo e(Nav::isRoute('addedLiveTv')); ?>" title="<?php echo e(__('adminstaticwords.ProducerSettings')); ?>">
            <i class="material-icons">ondemand_video</i> <span><?php echo e(__('adminstaticwords.ProducerSettings')); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a class="<?php echo e(Nav::isRoute('addedmovies')); ?>" href="<?php echo e(route('addedmovies')); ?>" title="<?php echo e(__('adminstaticwords.AddedMovies')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.AddedMovies')); ?></span></a></li>
            <li><a class="<?php echo e(Nav::isRoute('addedTvSeries')); ?>" href="<?php echo e(route('addedTvSeries')); ?>" title="<?php echo e(__('adminstaticwords.AddedTVSeries')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.AddedTVSeries')); ?></span></a></li>
            <li><a class="<?php echo e(Nav::isRoute('addedLiveTv')); ?>" href="<?php echo e(route('addedLiveTv')); ?>" title="<?php echo e(__('adminstaticwords.AddedLiveTv')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.AddedLiveTv')); ?></span></a></li>
          </ul>
        </li>

        <li><a class="<?php echo e(Nav::isResource('coupons')); ?>" href="<?php echo e(url('/admin/coupons')); ?>" title="<?php echo e(__('adminstaticwords.StripeCoupons')); ?>"><i class="material-icons">assignment</i> <span><?php echo e(__('adminstaticwords.AllCoupons')); ?></span></a></li>

        <li><a class="<?php echo e(Nav::isRoute('addonmanger.index')); ?>" href="<?php echo e(route('addonmanger.index')); ?>" title="<?php echo e(__('adminstaticwords.Add-On')); ?>"><i class="material-icons">extension</i> <span><?php echo e(__('adminstaticwords.Add-On')); ?></span></a></li>


        <li class="treeview">
          <a href="#" class="<?php echo e(Nav::isRoute('admin.comment.index')); ?> <?php echo e(Nav::isRoute('admin.subcomment.index')); ?> " title="<?php echo e(__('adminstaticwords.CommentSettings')); ?>">
            <i class="material-icons">comment</i> <span><?php echo e(__('adminstaticwords.CommentSettings')); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a class="<?php echo e(Nav::isRoute('admin.comment.index')); ?>" href="<?php echo e(url('/admin/comments')); ?>" title="<?php echo e(__('adminstaticwords.Comments')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.Comments')); ?></span></a></li>
           <li><a class="<?php echo e(Nav::isRoute('admin.subcomment.index')); ?>" href="<?php echo e(url('/admin/subcomments')); ?>" title="<?php echo e(__('adminstaticwords.Comments')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.SubComments')); ?></span></a></li>
          
          </ul>
        </li>

        <li class="treeview">
          <a href="#" class="<?php echo e(Nav::isResource('home_slider')); ?> <?php echo e(Nav::isResource('landing-page')); ?> <?php echo e(Nav::isResource('auth-page-customize')); ?> <?php echo e(Nav::isRoute('social.ico')); ?> <?php echo e(Nav::isResource('home-block')); ?> <?php echo e(Nav::isResource('custom_page')); ?> <?php echo e(Nav::isResource('faqs')); ?>" title="<?php echo e(__('adminstaticwords.SiteCustomization')); ?>" id="sitecustomization">
            <i class="material-icons">view_quilt</i> <span><?php echo e(__('adminstaticwords.SiteCustomization')); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
               <li><a class="<?php echo e(Nav::isResource('home_slider')); ?>" href="<?php echo e(url('/admin/home_slider')); ?>" title="<?php echo e(__('adminstaticwords.SliderSettings')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.SliderSettings')); ?></span></a></li>
            <li><a class="<?php echo e(Nav::isResource('landing-page')); ?>" href="<?php echo e(url('admin/customize/landing-page')); ?>" title="<?php echo e(__('adminstaticwords.LandingPage')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(__('adminstaticwords.LandingPage')); ?></a></li>
             <li><a class="<?php echo e(Nav::isResource('custom_page')); ?>" href="<?php echo e(url('/admin/custom_page')); ?>" title="<?php echo e(__('adminstaticwords.CustomPages')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.CustomPages')); ?></span></a></li>

            <li><a class="<?php echo e(Nav::isResource('auth-page-customize')); ?>" href="<?php echo e(url('admin/customize/auth-page-customize')); ?>" title="<?php echo e(__('adminstaticwords.SignInSignUp')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(__('adminstaticwords.SignInSignUp')); ?></a></li>

            <li><a class="<?php echo e(Nav::isRoute('social.ico')); ?>" href="<?php echo e(route('social.ico')); ?>" title="<?php echo e(__('adminstaticwords.SocialIconSetting')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(__('adminstaticwords.SocialIconSetting')); ?></a></li>

           
             <li><a class="<?php echo e(Nav::isResource('home-block')); ?>" href="<?php echo e(url('/admin/home-block')); ?>" title="<?php echo e(__('adminstaticwords.PromotionSettings')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.PromotionSettings')); ?></span></a></li>
             <li><a class="<?php echo e(Nav::isResource('faqs')); ?>" href="<?php echo e(url('/admin/faqs')); ?>" title="<?php echo e(__('adminstaticwords.Faq')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.Faq')); ?></span></a></li>
          </ul>
        </li>

        

        <li class="treeview">
          <a href="#" class="<?php echo e(Nav::isResource('settings')); ?> <?php echo e(Nav::isRoute('term_con')); ?><?php echo e(Nav::isRoute('manual.payment.gateway')); ?> <?php echo e(Nav::isRoute('pri_pol')); ?> <?php echo e(Nav::isRoute('refund_pol')); ?><?php echo e(Nav::isRoute('adsense')); ?><?php echo e(Nav::isRoute('sociallogin')); ?> <?php echo e(Nav::isRoute('copyright')); ?> <?php echo e(Nav::isRoute('term_con')); ?> <?php echo e(Nav::isRoute('pwa.setting.index')); ?> <?php echo e(Nav::isRoute('player.set')); ?> <?php echo e(Nav::isRoute('ads')); ?>  <?php echo e(Nav::isResource('manual-payment')); ?> <?php echo e(Nav::hasSegment('blocker')); ?> <?php echo e(Nav::isResource('languages')); ?> <?php echo e(Nav::isRoute('google.ads')); ?> <?php echo e(Nav::isRoute('admin.color.scheme')); ?>" title="<?php echo e(__('adminstaticwords.SiteSettings')); ?>" id="sitesettings">
            <i class="material-icons">settings</i> <span><?php echo e(__('adminstaticwords.SiteSettings')); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a class="<?php echo e(Nav::isResource('settings')); ?>" href="<?php echo e(url('admin/settings')); ?>" title="<?php echo e(__('adminstaticwords.Settings')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(__('adminstaticwords.Settings')); ?></a></li>
           
             <li><a class="<?php echo e(Nav::isRoute('sociallogin')); ?>" href="<?php echo e(url('/admin/social-login')); ?>" title="<?php echo e(__('adminstaticswords.SocialLoginSettings')); ?>"><i class="fa fa-circle-o"></i><span> <?php echo e(__('adminstaticwords.SocialLoginSettings')); ?></span></a></li>

              <li><a class="<?php echo e(Nav::isRoute('chat.index')); ?>" href="<?php echo e(route('chat.index')); ?>" title="<?php echo e(__('adminstaticwords.ChatSettings')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.ChatSettings')); ?></span></a>
              </li>

              <li><a class="<?php echo e(Nav::isRoute('pwa.setting.index')); ?>" href="<?php echo e(route('pwa.setting.index')); ?>" title="<?php echo e(__('adminstaticwords.PWASettings')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.PWASettings')); ?></span></a></li>

              <li><a class="<?php echo e(Nav::isRoute('admin.color.scheme')); ?>" href="<?php echo e(route('admin.color.scheme')); ?>" title="<?php echo e(__('adminstaticwords.ColorSchemes')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(__('Color Option')); ?></span></a></li>

              <li><a class="<?php echo e(Nav::isRoute('manual.payment.gateway')); ?>" href="<?php echo e(route('manual.payment.gateway')); ?>" title="<?php echo e(__('adminstaticwords.ManualPaymentGateway')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.ManualPaymentGateway')); ?></span></a></li>

              <li><a class="<?php echo e(Nav::isRoute('admin.push.noti.settings')); ?>" href="<?php echo e(route('admin.push.noti.settings')); ?>" title="<?php echo e(__('adminstaticwords.PushNotification')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.PushNotification')); ?></span></a></li>

              <li class="treeview">
                <a href="#" class="<?php echo e(Nav::isRoute('player.set')); ?> <?php echo e(Nav::isRoute('ads')); ?> <?php echo e(Nav::isRoute('google.ads')); ?>" title="<?php echo e(__('adminstaticwords.PlayerSetting')); ?> " id="player">
                  <i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.PlayerSetting')); ?></span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a class="<?php echo e(Nav::isRoute('player.set')); ?>" href="<?php echo e(route('player.set')); ?>" title="<?php echo e(__('adminstaticwords.PlayerCustomization')); ?>"><i class="fa fa-circle-o"></i><?php echo e(__('adminstaticwords.PlayerCustomization')); ?></a></li>

                  <li><a class="<?php echo e(Nav::isRoute('ads')); ?>" href="<?php echo e(url('admin/ads')); ?>" title="<?php echo e(__('adminstaticwords.Advertise')); ?>"><i class="fa fa-circle-o"></i><?php echo e(__('adminstaticwords.Advertise')); ?></a></li>
                   
                  <li><a class="<?php echo e(Nav::isRoute('google.ads')); ?>" href="<?php echo e(route('google.ads')); ?>" title="<?php echo e(__('adminstaticwords.GoogleAdvertise')); ?>"><i class="fa fa-circle-o"></i><?php echo e(__('adminstaticwords.GoogleAdvertise')); ?></a></li>
                </ul>
              </li>
             <li><a class="<?php echo e(Nav::isResource('manual-payment')); ?>" href="<?php echo e(url('/admin/manual-payment')); ?>" title="<?php echo e(__('adminstaticwords.ManualPaymentTransaction')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.ManualPayments')); ?></span></a></li>
            
            <li><a class="<?php echo e(Nav::isRoute('adsense')); ?>" href="<?php echo e(url('/admin/adsensesetting')); ?>" title="<?php echo e(__('adminstaticwords.AdsenseSettings')); ?>"><span><i class="fa fa-circle-o"></i> &nbsp;&nbsp;<?php echo e(__('adminstaticwords.AdsenseSettings')); ?></span></a></li>

            <li><a class="<?php echo e(Nav::isRoute('term_con')); ?>" href="<?php echo e(url('admin/term&con')); ?>" title="<?php echo e(__('adminstaticwords.TermsCondition')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(__('adminstaticwords.TermsCondition')); ?></a></li>
            <li><a class="<?php echo e(Nav::isRoute('pri_pol')); ?>" href="<?php echo e(url('admin/pri_pol')); ?>" title="<?php echo e(__('adminstaticwords.PrivacyPolicy')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(__('adminstaticwords.PrivacyPolicy')); ?></a></li>
            <li><a class="<?php echo e(Nav::isRoute('refund_pol')); ?>" href="<?php echo e(url('admin/refund_pol')); ?>" title="<?php echo e(__('adminstaticwords.RefundPolicy')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(__('adminstaticwords.RefundPolicy')); ?></a></li>
            <li><a class="<?php echo e(Nav::isRoute('copyright')); ?>" href="<?php echo e(url('admin/copyright')); ?>" title="<?php echo e(__('adminstaticwords.Copyright')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(__('adminstaticwords.Copyright')); ?></a></li>

            <li><a class="<?php echo e(Nav::isRoute('customstyle')); ?>" href="<?php echo e(url('admin/custom-style-settings')); ?>" title="<?php echo e(__('adminstaticwords.CustomStyle')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(__('adminstaticwords.CustomStyle')); ?></a></li>

            
            <li class="treeview">
            <a href="#" class="<?php echo e(Nav::isRoute('pricing.get')); ?> <?php echo e(Nav::isResource('languages')); ?>" id="language">
              <i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.Translations')); ?></span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a class="<?php echo e(Nav::isResource('languages')); ?>" href="<?php echo e(url('/admin/languages')); ?>" title="<?php echo e(__('adminstaticwords.Languages')); ?>"><i class="fa fa-circle-o"></i><span><?php echo e(__('adminstaticwords.Languages')); ?></span></a></li>
            </ul>
          </li>

          </ul>
        </li>

        
        <li class="treeview">
          <a href="#" class="<?php echo e(Nav::isRoute('device_history')); ?> <?php echo e(Nav::hasSegment('report')); ?> <?php echo e(Nav::isRoute('revenue.report')); ?> <?php echo e(Nav::isRoute('view.track')); ?>" title="<?php echo e(__('adminstaticwords.Reports')); ?>" id="sitesettings">
            <i class="material-icons">trending_up</i> <span><?php echo e(__('adminstaticwords.Reports')); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if(Auth::user()->is_assistant != 1 && App\PaypalSubscription::count()>0): ?>
              <li><a class="<?php echo e(Nav::isResource('plan')); ?>" href="<?php echo e(url('/admin/plan')); ?>" title="<?php echo e(__('adminstaticwords.ActivePlan')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.UsersSubscription')); ?></span></a>
              </li>
            <?php endif; ?>
            <?php if(env('STRIPE_SECRET') != ""): ?>
              <li><a class="<?php echo e(Nav::hasSegment('report')); ?>" href="<?php echo e(url('admin/report')); ?>" title="<?php echo e(__('adminstaticwords.StripeReports')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.StripeReports')); ?></span></a></li>
            <?php endif; ?>
            <li><a class="<?php echo e(Nav::isRoute('device_history')); ?>" href="<?php echo e(route('device_history')); ?>" title="<?php echo e(__('adminstaticwords.DeviceHistory')); ?>"><i class="fa fa-circle-o"></i>  <span><?php echo e(__('adminstaticwords.DeviceHistory')); ?></span></a></li>
           
             <li><a class="<?php echo e(Nav::isRoute('revenue.report')); ?>" href="<?php echo e(url('admin/report_revenue')); ?>" title="<?php echo e(__('adminstaticwords.RevenueReport')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.RevenueReport')); ?></span></a>
            </li>
            <li><a class="<?php echo e(Nav::isRoute('view.track')); ?>" href="<?php echo e(route('view.track')); ?>" title="<?php echo e(__('adminstaticwords.ViewTracker')); ?>"><i class="fa fa-circle-o"></i><span><?php echo e(__('adminstaticwords.ViewTracker')); ?></span></a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#" class="<?php echo e(Nav::isResource('appsettings')); ?> <?php echo e(Nav::isRoute('admob')); ?><?php echo e(Nav::isResource('splashscreen')); ?> <?php echo e(Nav::isResource('appslider')); ?>" title="<?php echo e(__('adminstaticwords.MobileAppSettings')); ?>" id="mobilesettings">
            <i class="material-icons">phonelink_setup</i> <span><?php echo e(__('adminstaticwords.AppSettings')); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a class="<?php echo e(Nav::isResource('appsettings')); ?>" href="<?php echo e(url('admin/appsettings')); ?>" title="<?php echo e(__('adminstaticwords.Settings')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(__('adminstaticwords.Settings')); ?></a></li>
           
             <li><a class="<?php echo e(Nav::isResource('splashscreen')); ?>" href="<?php echo e(url('admin/splashscreen')); ?>" title="<?php echo e(__('adminstaticwords.SplashscreenSettings')); ?>"><span><i class="fa fa-circle-o"></i> &nbsp;&nbsp;<?php echo e(__('adminstaticwords.SplashscreenSettings')); ?></span></a></li>
            
            <li><a class="<?php echo e(Nav::isResource('appslider')); ?>" href="<?php echo e(url('admin/appslider')); ?>" title="<?php echo e(__('adminstaticwords.AppSliderSettings')); ?>"><span><i class="fa fa-circle-o"></i> &nbsp;&nbsp;<?php echo e(__('adminstaticwords.AppSliderSettings')); ?></span></a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#" class="<?php echo e(Nav::isRoute('admin.backup.settings')); ?> <?php echo e(Nav::isRoute('system.status')); ?> <?php echo e(Nav::isRoute('clear_cache')); ?> <?php echo e(Nav::isRoute('get.remove.public')); ?>" title="<?php echo e(__('adminstaticwords.HelpAndSupport')); ?>" id="HelpAndSupport">
            <i class="material-icons">help_outline</i> <span><?php echo e(__('adminstaticwords.HelpAndSupport')); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a class="<?php echo e(Nav::isRoute('admin.backup.settings')); ?>" href="<?php echo e(route('admin.backup.settings')); ?>" title="<?php echo e(__('adminstaticwords.DatabaseBackup')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.DatabaseBackup')); ?></span></a></li>
            <li><a class="<?php echo e(Nav::isRoute('system.status')); ?>" href="<?php echo e(route('system.status')); ?>" title="<?php echo e(__('adminstaticwords.SystemStatus')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.SystemStatus')); ?></span></a></li>
            <li><a class="<?php echo e(Nav::isRoute('get.remove.public')); ?>" href="<?php echo e(route('get.remove.public')); ?>" title="<?php echo e(__('adminstaticwords.RemovePublic')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.RemovePublic')); ?></span></a></li>
            <li><a class="<?php echo e(Nav::isRoute('clear_cache')); ?>" href="<?php echo e(route('clear.cache')); ?>" title="<?php echo e(__('adminstaticwords.ClearCache')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(__('adminstaticwords.ClearCache')); ?></span></a></li>
            
          </ul>
        </li>
      
       <?php endif; ?>
   

     </ul>
     <!-- /.sidebar-menu -->
   </section>
   <!-- /.sidebar -->
 </aside>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <?php if(Session::has('added')): ?>
  <div id="sessionModal" class="sessionmodal rgba-green-strong z-depth-2">
    <i class="fa fa-check-circle"></i> <p><?php echo e(session('added')); ?></p>
  </div>
  <?php elseif(Session::has('updated')): ?>
  <div id="sessionModal" class="sessionmodal rgba-cyan-strong z-depth-2">
    <i class="fa fa-check-circle"></i> <p><?php echo e(session('updated')); ?></p>
  </div>
  <?php elseif(Session::has('deleted')): ?>
  <div id="sessionModal" class="sessionmodal rgba-red-strong z-depth-2">
    <i class="fa fa-window-close"></i> <p><?php echo e(session('deleted')); ?></p>
  </div>
  <?php endif; ?>
  <!-- Content Header (Page header) -->
  <section class="content-header">
  </section>
  <!-- Main content -->
  <section class="content container-fluid">
    <?php echo $__env->yieldContent('content'); ?>

  </section>

  <!-- /.content -->
</div>
<p class="version"><?php echo e(__('adminstaticwords.Version')); ?> 4.0&emsp;</p>
<!-- /.content-wrapper -->
<!-- Main Footer -->

</div>
<!-- ./wrapper -->



<!-- Admin Js -->
<script src="<?php echo e(url('js/jquery.min.js')); ?>" type="text/javascript"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js" type="text/javascript"></script>
<script src="<?php echo e(url('js/admin.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(url('js/app.js')); ?>" type="text/javascript"></script>

<script src="<?php echo e(url('js/ckeditor.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(url('js/datatables.min.js')); ?>" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.colVis.js"></script>

<script src="<?php echo e(url('js/jquery-ui.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(url('js/chart.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(url('js/utils.js')); ?>" type="text/javascript"></script>
<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-pageLoadMore/1.0.0/js/dataTables.pageLoadMore.min.js"></script>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="<?php echo e(url('js/jquery-jvectormap-1.2.2.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(url('js/jquery-jvectormap-world-mill-en.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(url('js/bootstrap-tagsinput.min.js')); ?>"></script>
<script src="<?php echo e(url('js/star-rating.min.js')); ?>"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>



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




<script src="<?php echo e(url('js/custom-js.js')); ?>"></script>
<!------- datepicker ------------------------->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!--- lazy load --->
<script src="<?php echo e(url('js/bootstrap-colorpicker.min.js')); ?>"></script>
 

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


<?php echo $__env->yieldContent('custom-script'); ?>
</body>
</html><?php /**PATH /var/www/html/resources/views/layouts/admin.blade.php ENDPATH**/ ?>
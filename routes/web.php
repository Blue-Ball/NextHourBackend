<?php

use App\Faq;
use App\Package;
use Illuminate\Support\Facades\Auth;
use App\Movie;
use App\Config;
use App\Season;
use Illuminate\Support\Facades\Validator;

Route::get('/seed',function(){
  try{

   \Artisan::call('db:seed' ,['--class'=>'BlockedTypeTableSeeder']);
   return "Success";
  }catch(Exception $e){
    return $e;
  }
});




Route::get('verifylicense', 'InstallerController@verifylicense')->name('verifylicense');
Route::get('/install/procceed/verifyapp', 'InstallerController@verify')->name('verifyApp');
Route::post('verifycode', 'InitializeController@verify');

Route::get('/install/procceed/EULA', 'InstallerController@eula')->name('eulaterm');

Route::post('/install/procceed/EULA', 'InstallerController@storeeula')->name('store.eula');

/** SERVER CHECK**/
Route::get('/install/procceed/serverCheck', 'InstallerController@serverCheck')->name('servercheck');
Route::post('/install/procceed/serverCheck', 'InstallerController@storeserver')->name('store.server');

/** VERIFY COE ENTER*/
Route::get('/install/procceed/basic-setup', 'InstallerController@getBasicSetup')->name('installApp');
Route::post('store/basic-setup', 'InstallerController@storeBasicSetup')->name('storeBasicSetup');

/**  DATABASE SETUP*/
Route::get('/install/procceed/database-setup', 'InstallerController@getDatabaseSetup')->name('db.setup');
Route::post('stored/step2', 'InstallerController@step2')->name('store.step2');
Route::post('stored/step3', 'InstallerController@storeStep3')->name('store.step3');


Route::get('/existing/installation/', 'UpdateController@exitterm')->name('existterm');
Route::post('/existing/update/', 'UpdateController@updateeula')->name('store.updateeula');

Route::post('/change-domain','ChangeDomainController@changedomain');

Route::middleware(['IsInstalled','isActive' ,'switch_languages', 'ip_block','comming_soon'])->group(function (){

    Route::get('manualpayment/{id}','ManualPaymentController@changemanualpayment')->name('quick.manualpayment.status');

    Route::post('/bttoken','BrainTreeController@accesstoken')->name('bttoken');

    Route::get('genre-sort','GenreController@sort');



    // download video code
    Route::get('/logout','LogoutController@logout')->name('custom.logout');

    Route::view('/offline','offline');
    Route::get('download/save/{file}','PrimeDetailController@filedownload')->name('file.download');

    Route::get('movie/save/{upload_video}','PrimeDetailController@moviedownload')->name('movie.download');
    Route::get('show/save/{upload_video}','PrimeDetailController@seasondownload')->name('season.download');
    Route::get('/user/movie/time/{endtime}/{movie_id}/{user_id}','TimeHistoryController@movie_time');
    Route::get('/user/tv/time/{endtime}/{tv_id}','TimeHistoryController@tv_time');
    Route::get('/user/watchhistory/{movie_id}/{type}','TimeHistoryController@watchhistory');

    Route::get('/user/episode/time/{endtime}/{episode_id}/{user_id}/{tv_id}','TimeHistoryController@episode_time');

    //ajax director
    Route::get('admin/directors/using/ajax', 'DirectorController@ajaxstore')->name('ajax.director');
    Route::get('admin/listofd','DirectorController@listofd')->name('listofd');

    //ajax actor

    Route::get('admin/actors/using/ajax', 'ActorController@ajaxstore')->name('ajax.actor');
    Route::get('admin/listofactor','ActorController@listofactor')->name('listofactor');




    // like and comment routes

    Route::get('comment/index','CommentController@index');
    Route::get('movie/comment/index','MovieCommentController@index');


    Route::post('movie/comment/store/{id}','MovieCommentController@store')->name('movie.comment.store');

    Route::post('movie/comment/reply/{cid}','MovieCommentController@reply')->name('movie.comment.reply');

    Route::delete('movie/comment/delete/{id}','MovieCommentController@deletecomment')->name('movie.comment.delete');

    Route::delete('movie/comment/reply/delete/{cid}','MovieCommentController@deletesubcomment')->name('movie.comment.subdelete');

    Route::get('tvseries/comment/index','TVCommentController@index');


    Route::post('tvseries/comment/store/{id}','TVCommentController@store')->name('tv.comment.store');

    Route::post('tvseries/comment/reply/{cid}','TVCommentController@reply')->name('tv.comment.reply');

    Route::delete('tvseries/comment/delete/{id}','TVCommentController@deletecomment')->name('tv.comment.delete');

    Route::delete('tvseries/comment/reply/delete/{cid}','TVCommentController@deletesubcomment')->name('tv.comment.subdelete');

    Route::get('unlike/unlike','LikeController@unlike')->name('unlike');

    Route::get('like/add','LikeController@add')->name('addtolike');


    Route::post('comment/store/{id}','CommentController@store')->name('comment.store');

    Route::post('comment/reply/{cid}/{bid}','CommentController@reply')->name('comment.reply');

    Route::delete('blog/comment/delete/{id}','CommentController@deletecomment')->name('blog.comment.delete');

    Route::delete('blog/comment/reply/delete/{bid}','CommentController@deletesubcomment')->name('blog.comment.subdelete');


    Route::get('/movietrailer/{user}/{code}/{id}','WatchApiController@watch_trailer');
    Route::get('/tvtrailer/{user}/{code}/{id}','WatchApiController@watchtv_trailer');
    Route::get('/watchseason/{user}/{code}/{id}','WatchApiController@watch_tv');
    Route::get('/watchmovie/{user}/{code}/{id}','WatchApiController@watch_movie');
    Route::get('/watchepisode/{user}/{code}/{id}','WatchApiController@watch_episode');



    Route::get('verifyEmailFirst','Auth\RegisterController@verifyEmailFirst')->name('verifyEmailFirst');

    Route::get('verify/{email}/{verifyToken}', 'Auth\RegisterController@sendEmailDone')->name('sendEmailDone');



    // Test Controller Route to play video

    Route::get('/player','TestController@getVideo');

    // Paytem Routes
    Route::resource('/paytem', 'PaytemController');
    Route::get('/paytm-payment-redirect', 'PaytemController@handlePaytmRequest');
    Route::post('/paytm-callback', 'PaytemController@paytmCallback');


    //freepackagesubscription
    Route::post('free/subscription/{planid}','ManualPaymentController@freePackageSubscription')->name('free.package.subscription');

    // Routes With Only Language Switch Middleware
    Route::group(['middleware' => ['switch_languages']], function (){
      //Catlog view menus for user without logging in
    Route::get('/guest/{menus}', 'HomeController@guestindex')->name('guests');
    Route::get('/guest/watch/{id}','WatchController@watch')->name('guestwatchtrailer');
    Route::get('/guest/watch/tv/{id}','WatchController@watchtvtrailer')->name('guestwatchtvtrailer');
    Route::get('movie/guest/detail/{slug}', 'PrimeDetailController@showMovie');
    Route::get('audio/guest/detail/{id}', 'PrimeDetailController@audioshow');
    Route::get('show/guest/detail/{season_slug}', 'PrimeDetailController@showSeasons');
    Route::get('event/guest/detail/{slug}', 'PrimeDetailController@eventshow');
    Route::get('/guest', 'HomeController@mainPage');
    Route::get('/guest/viewall/{menuid}/{menuname}','HomeController@showall')->name('guestshowall');
    Route::get('/guest/viewall/movies','HomeController@showallsinglemovies')->name('guestshowall2');
    Route::get('/guest/viewall/tvseries','HomeController@showallsingletvseries')->name('guestshowall3');
    Route::get('movies/guest/genre/{id}', 'HomeController@movie_genre');
    Route::get('movies/guest/language/{id}', 'HomeController@movie_language');
    Route::get('tvseries/guest/genre/{id}', 'HomeController@tvseries_genre');
    Route::get('tvseries/guest/language/{id}', 'HomeController@tvseries_language');

    Route::get('show/all/guest/genres/{id}','HomeController@gusetshowallgenre')->name('show.in.guest.genre');
    Route::get('show/all/guest/langs/{id}','HomeController@guestshowallalang')->name('show.in.guest.alang');

    Route::get('home/search', 'HomeController@search')->name('search');
    Route::get('quick/search','HomeController@quicksearch')->name('quick.search');
    
    Route::get('video/detail/director_search/{director}', 'HomeController@director_search');
    Route::get('video/detail/actor_search/{actor}', 'HomeController@actor_search');
    Route::get('video/detail/genre_search/{genre}', 'HomeController@genre_search');

    Route::get('account/blog','BlogController@showBlogList')->name('allblog');
    Route::get('account/blog/{slug}','BlogController@showBlog');

    Route::get('/page/{slug}','CustomPageController@show')->name('custom.page.show');

      if(Auth::user())
      {
        // menu routes
       Route::get('/{menu}', 'HomeController@index')->name('home');
     }else
     {
      // main page route
       Route::get('/', 'HomeController@mainPage');

     }

     // Faq routes

     Route::get('faq', function (){
      $faqs = Faq::all();
      return view('faq', compact('faqs'));
    });
     

    // general pages routes
     Route::view('terms_condition', 'term_condition');
     Route::view('privacy_policy', 'privacy_pol');
     Route::view('refund_policy', 'refund_pol');
     Route::view('seo', 'seo');


      // Auth Routes
     Auth::routes();

    });
    //2FA
    Route::post('/valid-2fa','TwoFactorController@login')->middleware('auth');

    // Language switch middleware 
    Route::get('language-switch/{local}', 'LanguageSwitchController@languageSwitch')->name('languageSwitch');

    // Routes With Web, Auth Middlewares
    Route::group(['middleware' => ['web', 'auth' ,'switch_languages']], function () {
        // User Account routes without subscription
      Route::get('account', 'UserAccountController@index');

      Route::post('/payviarazorpaysuccess/{planid}','PayViaRazorpayController@success')->name('paysuccess');
     
      Route::get('contactus','ContactController@contact')->name('contactus');
      Route::post('send/contactus','ContactController@send')->name('send.contactus');
      Route::get('account/profile', 'UserAccountController@edit_profile');
      Route::post('account/profile', 'UserAccountController@update_profile')->name('user.profile');
      Route::post('account/profile/age','UsersController@update_age')->name('user.age');
      Route::get('account/purchaseplan', 'UserAccountController@purchase_plan');
      Route::get('account/purchase/{id}', 'UserAccountController@get_payment')->name('get_payment');
      Route::post('account/purchase', 'UserAccountController@subscribe');
      Route::get('account/billing_history', 'UserAccountController@history');
      Route::post('emailsubscribe', 'emailSubscribe@subscribe');
      Route::post('paypal_subscription', 'PaypalController@postPaymentWithpaypal')->name('paypal_subscription');
      Route::get('paypal_subscription', 'PaypalController@getPaymentStatus')->name('getPaymentStatus');
      Route::get('paypal_subscription_failed', 'PaypalController@getPaymentFailed')->name('getPaymentFailed');
      // rating routes
      Route::POST('video/rating', 'UserRatingController@store');
      Route::POST('video/rating/tv', 'UserRatingController@tvstore');
      // susbscription routes
      Route::get('payment/braintree', 'BrainTreeController@get_bt');
      Route::post('payment/braintree', 'BrainTreeController@payment');
      Route::get('payment/coinpayment', 'CoinpaymentsController@get_bt');
      Route::post('payment/coinpayment', 'CoinpaymentsController@purchaseItems');
      Route::post('payment/paystack', 'PaystackController@paystackgateway');
      Route::get('paystack/callback', 'PaystackController@paystackcallback'); 
        // Paypal Routes
      Route::get('paypal/cancel-subscription', 'UserAccountController@PaypalCancel')->name('cancelSubPaypal');
      Route::get('paypal/resume-subscription', 'UserAccountController@PaypalResume')->name('resumeSubPaypal');

        # Status Route
      Route::get('payment/status', 'PayuController@status');
      Route::post('payment/payu', 'PayuController@payment');

      //Instamojo Routes
      Route::post('pay/instamojo', 'PayViaInstamojoController@pay')->name('payinstamojo');
      Route::get('instamojo/pay-success', 'PayViaInstamojoController@success');

      //Mollie Payment Routes

      Route::post('payviamollie/subscription','PayViaMollieController@payment')->name('payviamoli_subscription');
      Route::get('paymentmolliedone/status','PayViaMollieController@success')->name('moli.pay.success_subscription');

      // Cash free payment routes
      Route::post('/payviacashfree','PayViaCashFreeController@payment')->name('payviacashfree'); 
      Route::post('/cashfree/success', 'PayViaCashFreeController@success')->name('payviacashfreesuccess');
      Route::post('/cart/payviacashfree','PayViaCashFreeCartController@payment')->name('payviacashfreecart'); 
      Route::post('/cashfree/cart/success', 'PayViaCashFreeCartController@success')->name('payviacashfreesuccesscart');

      // Omise Payment routes
      Route::post('/payviaomise','OmiseController@pay')->name('pay.via.omise');

      //Flutterrave route
      Route::post('/pay', 'FlutterwaveController@initialize')->name('flutterrave.pay');
      Route::get('/rave/callback', 'FlutterwaveController@callback')->name('flutterrave.callback');

    

      Route::get('account/watchlist/shows', 'WishListController@showWishListTvShows');
      Route::get('account/watchlist', 'WishListController@wishlistshow');
      Route::get('account/watchlist/{slug}', 'WishListController@showWishLists')->name('watchlist');

      Route::get('account/watchlist/movies', 'WishListController@showWishListMovies');
      Route::delete('account/watchlist/showdestroy/{id}', 'WishListController@showdestroy');
      Route::delete('account/watchlist/moviedestroy/{id}', 'WishListController@moviedestroy');
      Route::post('addtowishlist', 'WishListController@addWishList')->name('addtowishlist');

      Route::post('/manualpayment/verify/{planid}','ManualPaymentController@store')->name('manualpayment');

      

      Route::post('/coupon/apply','CouponApplyController@get')->name('coupon.apply');

      //2FA
      

      Route::get('/2fa','TwoFactorController@get2fa')->name('2fa.get');
      Route::post('/generate2faSecret','TwoFactorController@generate2faSecret');
      Route::post('/2fa-valid','TwoFactorController@valid2FA');
      Route::post('/disable-2fa','TwoFactorController@disable2FA');



    });

    // Routes With Web, Auth, Administrator Middlewares
    Route::group(['middleware' => ['web', 'auth', 'is_admin', 'switch_languages','TwoFactor']], function () {

      Route::get('/viewstracker',function(){
       $movies =  Movie::orderByUniqueViews()->get();
       $season =  Season::orderByUniqueViews()->get();
       return view('admin.viewtracker',compact('movies','season'));
     })->name('view.track');

      
      
      Route::get('/quick/change/status/{id}','QuickUpdateController@change')->name('quick.movie.status');

      Route::get('/quick/change/status/tvseries/{id}','QuickUpdateController@changetvstatus')->name('quick.tv.status');



      Route::get('/admin/pending/movie','MovieController@addedMovies')->name('addedmovies');

      Route::get('/admin/pending/tvshows','TvSeriesController@addedTvSeries')->name('addedTvSeries');

      Route::get('/admin/pending/livtvs','LiveTvController@addedLiveTv')->name('addedLiveTv');

      Route::resource('admin/blog', 'BlogController');
      
      Route::post('admin/blog/bulk_delete', 'BlogController@bulk_delete');
      
      Route::post('admin/blog/create', 'BlogController@create');
      
      Route::patch('admin/blog/update/{id}', 'BlogController@update');
      
      Route::delete('admin/blog/destroy/{id}', 'BlogController@destroy');

      Route::post('admin/movie/{id}/addsubtitle','SubtitleController@post')->name('add.subtitle');

      Route::post('admin/movie/{id}/delete/subtitle','SubtitleController@delete')->name('del.subtitle');

      Route::get('admin', 'DashboardController@dashboard')->name('dashboard');

      Route::get('admin/profile', function(){
        $auth = Auth::user();
        return view('admin.profile', compact('auth'));
      });

      Route::get('/admin/player-setting','PlayerSettingController@get')->name('player.set');
      Route::post('/admin/player-setting/update','PlayerSettingController@update')->name('player.update');

      Route::resource('admin/menu', 'MenuController');
      Route::post('admin/menu/bulk_delete', 'MenuController@bulk_delete');
      Route::post('admin/menu/reposition', 'MenuController@reposition')->name('menu_reposition');

      Route::resource('admin/users', 'UsersController');
      Route::get('admin/user/status/{id}','UsersController@changestatus');

      Route::get('user/subscription/{id}', 'UsersController@change_subscription_show')->name('change_subscription_show');
      Route::post('user/subscription', 'UsersController@change_subscription')->name('change_subscription');
      Route::post('admin/users/bulk_delete', 'UsersController@bulk_delete');
      Route::resource('admin/movies', 'MovieController');
      Route::get('admin/movie/upload_video/converting', 'MovieController@upload_video');
       Route::get('admin/tvshow/upload_video/converting', 'TvSeriesController@upload_video');
      Route::get('admin/movie/vimeoapi', 'MovieController@vimeoApicall');
      Route::get('admin/movies/link/{id}', 'MovieController@multiplelinks')->name('movies.link');
       Route::post('admin/movies/createlink/{id}', 'MovieController@storelink')->name('movies.storelink');
       Route::patch('admin/movies/editlink/{id}', 'MovieController@editlink')->name('movies.editlink');
       Route::delete('admin/movies/deletelink/{id}', 'MovieController@deletelink')->name('movies.deletelink');
      
      Route::get('admin/movies/tmdb/translations', 'MovieController@tmdb_translations')->name('tmdb_movie_translate');
      Route::post('admin/movies/bulk_delete', 'MovieController@bulk_delete');

      // live tv routes
      Route::resource('admin/livetv', 'LiveTvController');
      Route::get('admin/livetv/upload_video/converting', 'LiveTvController@upload_video');
      Route::get('admin/livetv/vimeoapi', 'LiveTvController@vimeoApicall');
      
      Route::get('admin/livetv/tmdb/translations', 'LiveTvController@tmdb_translations')->name('tmdb_movie_translate');
      Route::post('admin/livetv/bulk_delete', 'LiveTvController@bulk_delete');

       // Live events routes

       Route::resource('admin/liveevent', 'LiveEventController');
       Route::post('admin/liveevent/bulk_delete', 'LiveEventController@bulk_delete');

       Route::resource('admin/audio', 'AudioController');
       Route::post('admin/audio/bulk_delete', 'AudioController@bulk_delete');

      // director controller

      Route::resource('admin/directors', 'DirectorController');
      Route::post('admin/directors/bulk_delete', 'DirectorController@bulk_delete');
      Route::resource('admin/actors', 'ActorController');
      Route::post('admin/actors/bulk_delete', 'ActorController@bulk_delete');

        // Genres Routes
      Route::resource('admin/genres', 'GenreController');
      Route::post('admin/genres/bulk_delete', 'GenreController@bulk_delete');
      Route::get('admin/update-to-english', 'GenreController@updateAll');

      Route::get('admin/front/slider/limit','SlideUpdateController@get')->name('front.slider.limit');

      Route::post('admin/front/slider/limit/{id}','SlideUpdateController@update')->name('front.slider.update');

      Route::resource('admin/packages', 'PackageController');
      Route::delete('/admin/packages/softdelete/{id}', 'PackageController@softDelete');
      Route::post('admin/packages/bulk_delete', 'PackageController@bulk_delete');
      Route::resource('admin/faqs', 'FaqController');
      Route::post('admin/faqs/bulk_delete', 'FaqController@bulk_delete');
      Route::resource('admin/languages', 'LanguageController');
      Route::post('admin/languages/bulk_delete', 'LanguageController@bulk_delete');
      Route::resource('admin/settings', 'ConfigController');
      Route::get('admin/api-settings', 'ConfigController@setApiView');
      Route::post('admin/api-settings', 'ConfigController@changeEnvKeys');


      


      /*Mail Setting Routes*/
      Route::get('/admin/mail-setting','ConfigController@getset')->name('mail.getset');
      Route::post('admin/mail-settings', 'ConfigController@changeMailEnvKeys');
      /* end */

      /*Custom style css ad js routes*/
      Route::get('/admin/custom-style-settings', 'CustomStyleController@addStyle')->name('customstyle');
      Route::post('/admin/custom-style-settings/addcss','CustomStyleController@storeCSS')->name('css.store');
      Route::post('/admin/custom-style-settings/addjs','CustomStyleController@storeJS')->name('js.store');
      /*end*/

      /*custom price text routes*/
      Route::get('/admin/pricing-text-set/{planid}','CustomStyleController@pricingText')->name('pricing.text');
      Route::post('/admin/pricing-text-settings/update','CustomStyleController@pricingTextUpdate')->name('pr.update');
      Route::get('/admin/pricing-text-settings/get/{id}','CustomStyleController@getpricingText')->name('pricing.get');
      /*end*/

      Route::get('/admin/customize/social','SocialIconController@get')->name('social.ico');
      Route::post('/admin/customize/social','SocialIconController@post')->name('socialic');


    // notification route
      Route::resource('/admin/notification', 'NotificationController');
      Route::get('/admin/notification/send', 'NotificationController@sendNotification');
      Route::post('admin/notification/bulk_delete', 'NotificationController@bulk_delete');

       // coupon controllers
      Route::resource('admin/coupons', 'CouponController');
      Route::post('admin/coupons/bulk_delete', 'CouponController@bulk_delete');
      Route::resource('admin/audio_language', 'AudioLanguageController');
      Route::post('admin/audio_language/bulk_delete', 'AudioLanguageController@bulk_delete');
      Route::resource('admin/home_slider', 'HomeSliderController');
      Route::post('admin/home_slider/bulk_delete', 'HomeSliderController@bulk_delete');
      Route::post('admin/home_slider/reposition', 'HomeSliderController@slide_reposition')->name('slide_reposition');
      Route::resource('admin/tvseries', 'TvSeriesController');
      Route::post('admin/tvseries/bulk_delete', 'TvSeriesController@bulk_delete');
      Route::get('admin/tvseries/tmdb/translations', 'TvSeriesController@tmdb_translations')->name('tmdb_tv_translate');
      Route::post('admin/tvseries/seasons', 'TvSeriesController@store_seasons');
      Route::patch('admin/tvseries/seasons/{id}', 'TvSeriesController@update_seasons');
      Route::delete('admin/tvseries/seasons/{id}', 'TvSeriesController@destroy_seasons');
      Route::get('admin/tvseries/seasons/{id}/episodes', 'TvSeriesController@show_episodes')->name('show_episodes');
      Route::get('admin/tvseries/seasons/{id}/episodes/{ep_id}', 
        'TvSeriesController@edit_episodes')->name('edit_episodes');
      Route::post('admin/tvseries/seasons/episodes', 'TvSeriesController@store_episodes');
      Route::delete('admin/tvseries/seasons/episodes/{id}', 'TvSeriesController@destroy_episodes');
      Route::patch('admin/tvseries/seasons/episodes/{id}', 'TvSeriesController@update_episodes');

       Route::get('admin/tvseries/seasons/episodes/link/{id}', 'TvSeriesController@multiplelinks')->name('episode.link');
       Route::post('admin/tvseries/seasons/episodes/createlink/{id}', 'TvSeriesController@storelink')->name('episode.storelink');
       Route::patch('admin/tvseries/seasons/episodes/editlink/{id}', 'TvSeriesController@editlink')->name('episode.editlink');
        Route::delete('admin/tvseries/seasons/episodes/deletelink/{id}', 'TvSeriesController@deletelink')->name('episode.deletelink');

      Route::get('admin/report', 'ReportController@get_report');

      /**************** revenue report ************************/
      Route::get('admin/report_revenue', 'ReportController@get_revenue_report')->name('revenue.report');
      Route::get('admin/report/data', 'ReportController@ajaxonLoad')->name('ajaxdatefilter');

      /*page setting routes*/
      Route::get('/admin/page-settings/','CustomStyleController@getPage')->name('pageset');
      
      Route::put('/admin/page-settings/{id}','CustomStyleController@updatePage')->name('pageset.update');

      /*Social Login setting routes*/
      Route::get('/admin/social-login/','SocialLoginController@index')->name('sociallogin');
      Route::put('/admin/social-login/{id}','SocialLoginController@updatePage')->name('sociallogin.update');
      Route::get('admin/social-login/','SocialLoginController@facebook')->name('set.facebook');
      Route::post('admin/facebook','SocialLoginController@updateFacebookKey')->name('key.facebook');
      Route::post('admin/google','SocialLoginController@updateGoogleKey')->name('key.google');
      Route::post('admin/gitlab','SocialLoginController@updategitlabKey')->name('key.gitlab');
      Route::post('admin/amazon','SocialLoginController@updateamazonKey')->name('key.amazon');



      /*end*/
       // adsense routes
      Route::get('/admin/adsensesetting/','AdsenseController@index')->name('adsense');
      Route::put('/admin/adsensesetting/{id}','AdsenseController@update')->name('adsense.update');



        /////////////////////////
        // Customizable Routes //
        /////////////////////////
      Route::resource('admin/customize/landing-page', 'LandingPageController');
      Route::post('admin/customize/landing-page/bulk_delete', 'LandingPageController@bulk_delete');
      Route::post('admin/customize/landing-page/reposition', 'LandingPageController@reposition')->name('landing_page_reposition');
      Route::get('admin/customize/auth-page-customize', 'AuthCustomizeController@index');
      Route::post('admin/customize/auth-page-customize', 'AuthCustomizeController@store');



      /////////////////////////
        // Customizable pages Routes //
        /////////////////////////
      Route::resource('admin/custom_page', 'CustomPageController');

      Route::resource('admin/home-block', 'HomeBlockController');

      Route::post('admin/home-block/bulk_delete', 'HomeBlockController@bulk_delete');
      
      // Route::post('admin/custom_page/create', 'CustomPageController@create')->name('custom-page.create');
      
      // Route::patch('admin/custom_page/update/{id}', 'CustomPageController@update')->name('custom-page.edit');
      
      Route::delete('admin/custom_page/destroy/{id}', 'CustomPageController@destroy')->name('custom-page.destroy');
      Route::post('admin/custom_page/bulk_delete', 'CustomPageController@bulk_delete');



      //PWA Settings

      Route::get('/pwa-settings', 'PWAController@index')->name('pwa.setting.index');

      Route::post('/pwa/update/setting', 'PWAController@updatesetting')->name('pwa.setting.update');

      Route::post('/pwa/update/icons/setting', 'PWAController@updateicons')->name('pwa.icons.update');

      //manual payment

      Route::resource('admin/manual-payment', 'ManualPaymentController');

      
      
      //chat settings
      Route::get('admin/chat_settings', 'ChatSettingController@index')->name('chat.index');

      Route::post('admin/chat_settings', 'ChatSettingController@update');


      

        // Site Policies Get Method
      Route::get('admin/term&con', function(){
        $config = \App\Config::whereId(1)->first();
        return view('admin.term&con', compact('config'));
      })->name('term_con');
      Route::get('admin/pri_pol', function(){
        $config = \App\Config::whereId(1)->first();
        return view('admin.pri_pol', compact('config'));
      })->name('pri_pol');
      Route::get('admin/refund_pol', function(){
        $config = \App\Config::whereId(1)->first();
        return view('admin.refund_pol', compact('config'));
      })->name('refund_pol');
      Route::get('admin/copyright', function(){
        $config = \App\Config::whereId(1)->first();
        return view('admin.copyright', compact('config'));
      })->name('copyright');

        // Site Policies Patch Method
      Route::patch('admin/term&con', function(\Illuminate\Http\Request $request){
        $config = \App\Config::whereId(1)->first();
        $input = $request->all();
        $input['terms_condition'] = clean($request->terms_condition);
        $config->update($input);
        return back()->with('updated', 'Terms & Condition has been updated');
      })->name('term&con');
      Route::patch('admin/pri_pol', function(\Illuminate\Http\Request $request){
        $config = \App\Config::whereId(1)->first();
        $input = $request->all();
        $input['privacy_pol'] = clean($request->privacy_pol);
        $config->update($input);
        return back()->with('updated', 'Privacy Policy has been updated');
      })->name('pri_pol');
      Route::patch('admin/refund_pol', function(\Illuminate\Http\Request $request){
        $config = \App\Config::whereId(1)->first();
        $input = $request->all();
        $input['refund_pol'] = clean($request->refund_pol);
        $config->update($input);
        return back()->with('updated', 'Refund Policy has been updated');
      })->name('refund_pol');
      Route::patch('admin/copyright', function(\Illuminate\Http\Request $request){
        $config = \App\Config::whereId(1)->first();
        $input = $request->all();
        $input['copyright'] = clean($request->copyright);
        $config->update($input);
        return back()->with('updated', 'Copyright text has been updated');
      })->name('copyright');

        /////////////////////////////////
        // Language Translation Routes //
        /////////////////////////////////
        // Header Translation Routes

     

      Route::get('/get/translation/{lang}','LanguageController@staticword')->name('languages.staticword');
      Route::get('/admin/edit/{lang}/staticTranslations','LanguageController@editStaticTrans')->name('static.trans');

      Route::post('/admin/update/{lang}/staticTranslations/content','LanguageController@updateStaticTrans')->name('static.trans.update');

      Route::post('/admin/update/{lang}/adminstaticTranslations/content','LanguageController@updateAdminStaticTrans')->name('static.admin.trans.update');


      Route::get('admin/header-translations', 'HeaderTranslationController@index')->name('header-translation-index');
      Route::post('admin/header-translations', 'HeaderTranslationController@update');

        // Footer Translation Routes
      Route::get('admin/footer-translations', 'FooterTranslationController@index')->name('footer-translation-index');
      Route::post('admin/footer-translations', 'FooterTranslationController@update');

        // Home Page Translation Routes
      Route::get('admin/home-translations', 'HomeTranslationController@index')->name('home-translation-index');
      Route::post('admin/home-translations', 'HomeTranslationController@update');

        // Popover Detail Translation Routes
      Route::get('admin/popover-detail-translations', 'PopoverTranslationController@index')->name('popover-detail-translation-index');
      Route::post('admin/popover-detail-translations', 'PopoverTranslationController@update');

      Route::get('/admin/device-history', 'DashboardController@device_history')->name('device_history');

      //package feature
      Route::resource('admin/package_feature', 'PackageFeatureController');
      Route::post('admin/package_feature/bulk_delete', 'PackageFeatureController@bulk_delete');


       //mobile app settings route

       Route::resource('admin/appsettings', 'AppConfigController');

       //app slider

      Route::resource('admin/appslider', 'AppSliderController');
      Route::post('admin/appslider/bulk_delete', 'AppSliderController@bulk_delete');
      Route::post('admin/appslider/reposition', 'AppSliderController@slide_reposition')->name('app_slide_reposition');


      //splash screen
      Route::resource('admin/splashscreen', 'SplashScreenController');
      Route::post('admin/splashscreen/bulk_delete', 'SplashScreenController@bulk_delete');
      Route::post('admin/splashscreen/reposition', 'SplashScreenController@reposition')->name('splashscreen_reposition');

      // Database Backup

      Route::get('admin/backups/','BackupController@get')->name('admin.backup.settings');
      Route::post('admin/backup/path', 'BackupController@updatepath')->name('admin.backup.path');
      Route::get('admin/download/{filename}','BackupController@download')->name('admin.backup.download');
      Route::get('admin/backups/process','BackupController@process')->name('admin.backup.process');

      //clear cache
      Route::get('admin/clear-cache', 'BackupController@clearcahe')->name('clear.cache');

      // System Status
      Route::get('admin/system-status','BackupController@system_status')->name('system.status');

      // remove public
      Route::get('admin/remove/public','BackupController@getremove_public')->name('get.remove.public');
      Route::post('admin/remove-public','BackupController@remove_public')->name('remove.public');

      //onesignal notification route
      Route::get('/admin/push-notifications','PushNotificationsController@index')->name('admin.push.noti.settings');
      Route::post('/admin/one-signal/keys','PushNotificationsController@updateKeys')->name('admin.onesignal.keys');
      Route::post('/admin/push-notifications','PushNotificationsController@push')->name('admin.push.notif');

      //menual payment method
      Route::get('admin/manual-payment-settings','ManualPaymentGatewayController@getindex')->name('manual.payment.gateway');
      Route::post('admin/manual-payment-settings','ManualPaymentGatewayController@store')->name('manual.payment.gateway.store');
      Route::post('admin/manual-payment-settings/{id}','ManualPaymentGatewayController@update')->name('manual.payment.gateway.update');
       Route::delete('admin/manual-payment-settings/{id}','ManualPaymentGatewayController@delete')->name('manual.payment.gateway.delete');

      //Addon Manager Route
      Route::get('/admin/addon-manger','AddOnManagerController@index')->name('addonmanger.index');
      Route::post('/admin/toggle/module','AddOnManagerController@toggle');
      Route::post('/admin/addon/install','AddOnManagerController@install')->name('addon.install');
      Route::post('/admin/addon/delete','AddOnManagerController@delete')->name('addon.delete');

      //Label Routes
      Route::resource('/admin/label','LabelController');
      Route::post('admin/label/bulk_delete', 'LabelController@bulk_delete');

      //Comment in admin 

      Route::get('/admin/comments','AdminCommentController@index')->name('admin.comment.index');
      Route::delete('/admin/comments/{id}','AdminCommentController@destroy')->name('comments.destroy');
      Route::get('/quick/change/comment_status/{id}','QuickUpdateController@commentchange')->name('quick.comment.status');
      Route::post('admin/comments/bulk_delete', 'AdminCommentController@bulk_delete');

      //SubComment settings in Admin

      Route::get('/admin/subcomments','AdminCommentController@subcommentindex')->name('admin.subcomment.index');
      Route::delete('/admin/subcomments/{id}','AdminCommentController@subcommentdestroy')->name('subcomments.destroy');
      Route::get('/quick/change/subcomment_status/{id}','QuickUpdateController@subcommentchange')->name('quick.subcomment.status');
      Route::post('admin/subcomments/bulk_delete', 'AdminCommentController@sub_bulk_delete');
      
      //color scheme
      Route::get('admin/color-scheme','ColorSchemeController@index')->name('admin.color.scheme');
      Route::post('admin/color-scheme/store','ColorSchemeController@store');


    });

    Route::group(['middleware' => ['web', 'auth', 'is_subscriber', 'switch_languages','TwoFactor']], function () {

      Route::get('/changescreen/{id}','MultipleScreenController@newupdate');

      Route::get('/manageprofile/mus/{id}','MultipleScreenController@manageprofile')->name('manageprofile');

      Route::post('/manageprofile/mus/{id}','MultipleScreenController@updateprofile')->name('mus.pro.update');

    });

    // Routes With Web, Auth And Subscriber Middlewares
    Route::group(['middleware' => ['web', 'auth', 'is_subscriber', 'login_limit','switch_languages','TwoFactor']], function () {

      Route::get('show/all/genres/{id}','HomeController@showallgenre')->name('show.in.genre');

      Route::get('show/all/alang/{id}','HomeController@showallalang')->name('show.in.alang');

      Route::get('/viewall/filter/','HomeController@filter')->name('filter');

      Route::get('/viewall/{menuid}/{menuname}','HomeController@showall')->name('showall');

      Route::get('/viewall/movies','HomeController@showallsinglemovies')->name('showall2');

      Route::get('/viewall/tvseries','HomeController@showallsingletvseries')->name('showall3');
       // notification
      Route::get('user/notification/read/{id}', 'NotificationController@notificationread')->name('marksingleread');

        // User Main Movies And Shows routes Only With subscription
      Route::get('/{menu}', 'HomeController@index')->name('home');
      Route::get('movie/detail/{slug}', 'PrimeDetailController@showMovie');
      Route::get('show/detail/{season_slug}', 'PrimeDetailController@showSeasons');
      Route::get('event/detail/{slug}', 'PrimeDetailController@eventshow');
      Route::get('audio/detail/{id}', 'PrimeDetailController@audioshow');
      
      
      Route::get('movies/genre/{id}', 'HomeController@movie_genre');
      Route::get('movies/language/{id}', 'HomeController@movie_language');
      Route::get('tvseries/genre/{id}', 'HomeController@tvseries_genre');
      Route::get('tvseries/language/{id}', 'HomeController@tvseries_language');

        // User Accounts routes With subscription
     
      Route::delete('account/history/showdestroy/{id}', 'WatchController@showdestroy');
      Route::delete('account/history/moviedestroy/{id}', 'WatchController@moviedestroy');

      Route::get('cancelsubscription/{plan_id}', 'UserAccountController@cancelSub')->name('cancelSub');
      Route::get('resumesubscription/{plan_id}', 'UserAccountController@resumeSub')->name('resumeSub');

        // Api Routes For movie and Tv series
      Route::get('get_movie/{id}', 'ApiController@get_movie')->name('get_movie');
      Route::get('get_season/{id}', 'ApiController@get_season')->name('get_season');
      Route::get('get-video-data/{id}/{type}', 'ApiController@get_video_data');
      Route::resource('admin/seo', 'SeoController');
      
      Route::resource('admin/plan', 'PlanController');
      Route::post('admin/plan/bulk_delete', 'PlanController@bulk_delete');
      Route::post('admin/plan/change_subscription', 'PlanController@change_subscription');

      Route::get('admin/ads','AdsController@getAds')->name('ads');
      Route::post('admin/ads/insert','AdsController@store')->name('ad.store');

      Route::get('admin/ads/setting','AdsController@getAdsSettings')->name('ad.setting');

      Route::put('admin/ads/timer','AdsController@updateAd')->name('ad.update');

      Route::put('admin/ads/pop','AdsController@updatePopAd')->name('ad.pop.update');

      Route::delete('admin/ads/delete/{id}','AdsController@delete')->name('ad.delete');

      Route::get('admin/ads/create','AdsController@create')->name('ad.create');

      Route::get('admin/ads/edit/{id}','AdsController@showEdit')->name('ad.edit');

      Route::put('admin/ads/edit/{id}','AdsController@updateADSOLO')->name('ad.update.solo');

      Route::put('admin/ads/video/{id}','AdsController@updateVideoAD')->name('ad.update.video');

      Route::post('admin/ads/bulk_delete', 'AdsController@bulk_delete');

      //Google Ads

      Route::get('admin/googleads/','GoogleAdsController@index')->name('google.ads');
      Route::get('admin/googleads/create','GoogleAdsController@create')->name('google.ads.create');
      Route::post('admin/googleads/create','GoogleAdsController@store')->name('google.ads.store');
      Route::get('admin/googleads/edit/{id}','GoogleAdsController@edit')->name('google.ads.edit');
      Route::put('admin/googleads/update/{id}', 'GoogleAdsController@update')->name('google.ads.update');
      Route::delete('admin/googleads/delete/{id}','GoogleAdsController@destroy')->name('google.ads.delete');
      Route::post('admin/googleads/bulk_delete', 'GoogleAdsController@bulk_delete');

      Route::get('/watch/{id}','WatchController@watch')->name('watchTrailer');
      Route::get('/watch/tv/{id}','WatchController@watchtvtrailer')->name('watchtvTrailer');

      Route::get('/watch/tvshow/{id}','WatchController@watchTV')->name('watchTvShow');

      Route::get('/watch/movie/{id}','WatchController@watchMovie')->name('watchmovie');
      
      Route::get('/watch/movie/iframe/{id}','WatchController@watchMovieiframe')->name('watchmovieiframe');

      Route::get('/watch/event/{id}','WatchController@watchEvent')->name('watchevent');

      Route::get('/watch/audiio/{id}','WatchController@watchAudio')->name('watchaudio');

      Route::get('/watch/tvshow/episode/{id}','WatchController@watchEpisode')->name('watch.Episode');

      Route::get('/account/watchhistory','WatchController@watchhistory')->name('watchhistory');

      //Route::get('/account/watchhistory','WatchController@watchistory')->name('watchhistory');
      Route::get('/account/watchhistory/delete','WatchController@watchistorydelete');

      Route::get('/download/clicks/update','PrimeDetailController@updateclick')->name('updateclick');


      Route::get('/protected/content','ProtectedVideoController@video')->name('protectedvideo');
     

    });


    // OAuth Routes
    Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
    Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

    Route::post('/pkg/status/{id}','PackageController@pkgstatus')->name('pkgstatus');

    /*Ad Routes*/

  
});

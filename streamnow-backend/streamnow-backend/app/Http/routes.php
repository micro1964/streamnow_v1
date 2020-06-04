<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::get('/payment/failure' , 'ApplicationController@payment_failure')->name('payment.failure');


Route::get('/clear-cache', function() {

   $exitCode = Artisan::call('config:cache');

   return redirect(route('admin.settings'))->with('flash_success',tr('admin_settings_success'));

})->name('clear-cache');

// Generral configuration routes 

Route::post('project/configurations' , 'ApplicationController@configuration_site');

Route::get('demo_credential_cron' , 'ApplicationController@demo_credential_cron');

Route::get('video_tapes_auto_clear_cron' , 'ApplicationController@video_tapes_auto_clear_cron');


Route::post('save_admin_control', 'ApplicationController@save_admin_control');

Route::get('/generate/index' , 'HomeController@generate_index');

Route::get('/sendpush' , 'HomeController@send_push');

Route::get('/message/save' , 'HomeController@message_save');

Route::get('video_detail/{id}', 'ApplicationController@video_detail');

Route::get('/privacy', 'UserApiController@privacy')->name('user.privacy');

Route::get('/terms_condition', 'UserApiController@terms')->name('user.terms');

//Cron publish video

Route::get('cron/publish/video', 'ApplicationController@cron_vod_publish_video');

// Social Login

Route::get('/test',  'HomeController@test');

Route::get('/social', array('as' => 'SocialLogin' , 'uses' => 'SocialAuthController@redirect'));

Route::get('/callback/{provider}', 'SocialAuthController@callback');

Route::get('/', 'Auth\AdminAuthController@showLoginForm')->name('login');

Route::get('/email/verification' , 'HomeController@email_verify')->name('email.verify');

Route::get('cron_delete_video', 'ApplicationController@cron_delete_video');

Route::get('remainder-for-subscription', 'ApplicationController@send_notification_user_payment');

// Route::get('user_payment_expiry', 'ApplicationController@user_payment_expiry');

Route::get('user_payment_expiry', 'ApplicationController@user_payment_expiry_new');



Route::group(['prefix' => 'admin' , 'as' => 'admin.'], function() {

    Route::get('/control', 'AdminController@control')->name('control');

    Route::get('/login', 'Auth\AdminAuthController@showLoginForm')->name('login');

    Route::post('login', 'Auth\AdminAuthController@login')->name('login.post');

    Route::get('logout', 'Auth\AdminAuthController@logout')->name('logout');

    // Registration Routes...

    Route::get('register', 'Auth\AdminAuthController@showRegistrationForm');

    Route::post('register', 'Auth\AdminAuthController@register');

    // Password Reset Routes...
    Route::get('password/reset/{token?}', 'Auth\AdminPasswordController@showResetForm');

    Route::post('password/email', 'Auth\AdminPasswordController@sendResetLinkEmail');

    Route::post('password/reset', 'Auth\AdminPasswordController@reset');

    Route::get('/', 'AdminController@dashboard')->name('dashboard');

    Route::get('/profile', 'AdminController@profile')->name('profile');

    Route::post('/profile/save', 'AdminController@profile_process')->name('save.profile');

    Route::post('/change/password', 'AdminController@change_password')->name('change.password');

    Route::get('/redeems/{id?}', 'AdminController@user_redeem_requests')->name('users.redeems');

    // Route::post('/redeems/pay', 'AdminController@user_redeem_pay')->name('users.redeem.pay');


    Route::any('/payout/invoice', 'AdminController@users_redeems_payout_invoice')->name('payout.invoice');

    Route::post('/payout/direct', 'AdminController@users_redeems_payout_direct')->name('payout.direct');

    Route::any('/payout/response', 'AdminController@users_redeems_payout_response')->name('payout.response');

    // users

    Route::get('/users', 'AdminController@users')->name('users.index');

    Route::get('/users/create', 'AdminController@user_create')->name('users.create');

    Route::get('/users/edit', 'AdminController@user_edit')->name('users.edit');

    Route::post('/users/create', 'AdminController@user_save')->name('users.save');

    Route::get('/users/delete', 'AdminController@user_delete')->name('users.delete');

    Route::get('/users/view/{id}', 'AdminController@user_view')->name('users.view');

    Route::get('/users/blocklist/{id}', 'AdminController@user_block_list')->name('users.block_list');

    Route::post('/users/payout', 'AdminController@user_payout')->name('users.payout');

    Route::get('/user/verify/{id?}', 'AdminController@user_verify_status')->name('users.verify');


    // Subscriptions

    Route::get('/subscriptions', 'AdminController@subscriptions')->name('subscriptions.index');

    Route::get('/user_subscriptions/{id}', 'AdminController@user_subscriptions')->name('subscriptions.plans');

    Route::get('/subscription/save/{s_id}/u_id/{u_id}', 'AdminController@user_subscription_save')->name('subscription.save');

    Route::get('/subscriptions/create', 'AdminController@subscription_create')->name('subscriptions.create');

    Route::get('/subscriptions/edit/{id}', 'AdminController@subscription_edit')->name('subscriptions.edit');

    Route::post('/subscriptions/create', 'AdminController@subscription_save')->name('subscriptions.save');

    Route::get('/subscriptions/delete/{id}', 'AdminController@subscription_delete')->name('subscriptions.delete');

    Route::get('/subscriptions/view/{id}', 'AdminController@subscription_view')->name('subscriptions.view');

    Route::get('/subscriptions/status/{id}', 'AdminController@subscription_status')->name('subscriptions.status');

    Route::get('/subscriptions/popular/status/{id}', 'AdminController@subscription_popular_status')->name('subscriptions.popular.status');

    Route::get('/subscriptions/users/{id}', 'AdminController@subscription_users')->name('subscriptions.users');

    
    Route::get('settings' , 'AdminController@settings')->name('settings');

    Route::post('save_common_settings' , 'AdminController@save_common_settings')->name('save.common-settings');

    Route::get('payment/settings' , 'AdminController@payment_settings')->name('payment.settings');

    Route::get('theme/settings' , 'AdminController@theme_settings')->name('theme.settings');
    
    Route::post('settings' , 'AdminController@settings_process')->name('save.settings');

    Route::get('settings/email' , 'AdminController@email_settings')->name('email.settings');

    Route::post('settings/email' , 'AdminController@email_settings_process')->name('email.settings.save');

    Route::get('help' , 'AdminController@help')->name('help');

    // Pages

    Route::get('/pages', 'AdminController@pages')->name('pages.index');

    Route::get('/pages/edit/{id}', 'AdminController@page_edit')->name('pages.edit');

    Route::get('/pages/view', 'AdminController@page_view')->name('pages.view');

    Route::get('/pages/create', 'AdminController@page_create')->name('pages.create');

    Route::post('/pages/create', 'AdminController@page_save')->name('pages.save');

    Route::get('/pages/delete/{id}', 'AdminController@page_delete')->name('pages.delete');

    // Videos

    Route::get('/videos', 'AdminController@videos')->name('videos.index');

    Route::get('/videos/list', 'AdminController@videos_list')->name('videos.videos_list');

    Route::get('/videos/view/{id}', 'AdminController@videos_view')->name('videos.view');

    Route::get('/videos/delete/{id}', 'AdminController@live_videos_delete')->name('videos.delete');

    // User Subscriptions

    Route::get('user/payments', 'AdminController@subscription_payments')->name('subscription.payments');
   
    Route::get('video/payments', 'AdminController@video_payments')->name('videos.payments');

    Route::get('revenue/system', 'AdminController@revenue_system')->name('revenue.system');

    Route::get('users/followers/{id}', 'AdminController@followers')->name('users.followers');

    Route::get('users/followings/{id}', 'AdminController@followings')->name('users.followings');

    Route::get('/user/approve', 'AdminController@user_approve')->name('users.approve');

    Route::get('/user/clear-login', 'AdminController@clear_login')->name('users.clear-login');

    // Coupons

    // Get the add coupon forms
    Route::get('/coupons/add','AdminController@coupon_create')->name('add.coupons');

    // Get the edit coupon forms
    Route::get('/coupons/edit/{id}','AdminController@coupon_edit')->name('edit.coupons');

    // Save the coupon details
    Route::post('/coupons/save','AdminController@coupon_save')->name('save.coupon');

    // Get the list of coupon details
    Route::get('/coupons/list','AdminController@coupon_index')->name('coupon.list');

    //Get the particular coupon details
    Route::get('/coupons/view/{id}','AdminController@coupon_view')->name('coupon.view');

    // Delete the coupon details
    Route::get('/coupons/delete/{id}','AdminController@coupon_delete')->name('delete.coupon');

    //Coupon approve and decline status
    Route::get('/coupon/status','AdminController@coupon_status_change')->name('coupon.status');

    //ios control settings

    // Get ios control page
    Route::get('/ios-control','AdminController@ios_control')->name('ios_control');

    //Save the ios control status
    Route::post('/ios-control/save','AdminController@ios_control_save')->name('ios_control.save');


    // Export Section
    Route::get('/users/export/','AdminExportController@users_export')->name('users.export');

    Route::get('/live/videos/export/','AdminExportController@livevideos_export')->name('livevideos.export');

    Route::get('/subscriptions/payments/export/','AdminExportController@subscriptions_export')->name('subscription.export');


    Route::get('/payperview/payments/export/','AdminExportController@payperview_export')->name('payperview.export');


    Route::get('/vod/payments/export/','AdminExportController@vod_payments_export')->name('vod-payments.export');

    Route::get('/vod/videos/export/','AdminExportController@vod_videos_export')->name('vod-videos.export');




    // Automatic subscription
    Route::post('/user/subscription/cancel', 'AdminController@user_subscription_pause')->name('automatic.subscription.cancel');

    Route::get('/user/subscription/enable', 'AdminController@user_subscription_enable')->name('automatic.subscription.enable');


     //Get the video upload page
    Route::get('/vod/videos/upload','AdminController@vod_videos_create')->name('vod-videos.create');

    // Get the edit video page
    Route::get('/vod/video/edit/{id}','AdminController@vod_videos_edit')->name('vod-videos.edit');

    // Save the video details
    Route::post('/vod/video/save','AdminController@vod_videos_save')->name('vod-videos.save');

    // View the video list 
    Route::get('/vod/video/index','AdminController@vod_videos_index')->name('vod-videos.index');

    // View the single video page 
    Route::get('/vod/video/view/{id}','AdminController@vod_videos_view')->name('vod-videos.view');

    // Delete the single video 
    Route::get('/vod/video/delete','AdminController@vod_videos_delete')->name('vod-videos.delete');

    // admin status for particular video
    Route::get('/vod/video/status','AdminController@vod_videos_status_update')->name('vod-videos.status');

    Route::get('/vod/video/publish','AdminController@vod_videos_publish')->name('vod-videos.publish');

    // Add ppv on the particular video
    Route::post('/vod/video/ppv/create','AdminController@vod_videos_ppv_create')->name('vod-videos.ppv.create');

    // Remove PPV amount particular video
    Route::get('/vod/video/ppv/delete','AdminController@vod_videos_ppv_delete')->name('vod-videos.ppv.delete');

    // Get vod video payments list
    Route::get('/vod/payments','AdminController@vod_payments_list')->name('vod-videos.payments.list');


    // Become Creator

    Route::get('/users/become/creator', 'AdminController@become_creator')->name('become.creator');

    // Streamer Gallery

    Route::get('streamer/galleries/upload', 'AdminController@streamer_galleries_upload')->name('streamer_galleries.upload');

    Route::post('streamer/galleries/save', 'AdminController@streamer_galleries_save')->name('streamer_galleries.save');

    Route::get('streamer/galleries/list/{user_id}', 'AdminController@streamer_galleries_list')->name('streamer_galleries.list');

    Route::get('streamer/galleries/delete', 'AdminController@streamer_galleries_delete')->name('streamer_galleries.delete');


        // Subscribers

    Route::get('automatic/subscribers', 'AdminController@automatic_subscribers')->name('automatic.subscribers');

    Route::get('cancelled/subscribers', 'AdminController@cancelled_subscribers')->name('cancelled.subscribers');

    /** @@@@@@@@@@@@@@@ LIVE GROUPS @@@@@@@@@@@@@ */

    Route::get('/groups/index' , 'AdminController@live_groups_index')->name('live_groups.index');

    Route::get('/groups/delete' , 'AdminController@live_groups_delete')->name('live_groups.delete');

    Route::get('/groups/view' , 'AdminController@live_groups_view')->name('live_groups.view');

    // Custom Live Videos

    Route::get('custom/live/videos', 'AdminController@custom_live_videos')->name('custom.live');

    Route::get('custom/live/create', 'AdminController@custom_live_videos_create')->name('custom.live.create');

    Route::get('custom/live/edit', 'AdminController@custom_live_videos_edit')->name('custom.live.edit');

    Route::post('custom/live/save', 'AdminController@custom_live_videos_save')->name('custom.live.save');

    Route::get('custom/live/delete', 'AdminController@custom_live_videos_delete')->name('custom.live.delete');

    Route::get('custom/live/view/{id}', 'AdminController@custom_live_videos_view')->name('custom.live.view');

    Route::get('custom/live/change-status', 'AdminController@custom_live_videos_change_status')->name('custom.live.change_status');


    Route::get('notification_templates', 'TemplateController@notification_template_index')->name('templates.notification_template_index');

    Route::get('notification_template_view', 'TemplateController@notification_template_view')->name('templates.notification_template_view');

    Route::get('notification_template_edit', 'TemplateController@notification_template_edit')->name('templates.notification_template_edit');

    Route::post('save_notification_template', 'TemplateController@save_notification_template')->name('templates.save_notification_template');

    Route::get('notification_template_credential', 'TemplateController@notification_template_credential')->name('templates.notification_template_credential');

    // Languages

    Route::get('/languages/index', 'LanguageController@languages_index')->name('languages.index'); 

    Route::get('/languages/download/', 'LanguageController@languages_download')->name('languages.download'); 

    Route::get('/languages/create', 'LanguageController@languages_create')->name('languages.create');
    
    Route::get('/languages/edit', 'LanguageController@languages_edit')->name('languages.edit');

    Route::get('/languages/status', 'LanguageController@languages_status_change')->name('languages.status');   

    Route::post('/languages/save', 'LanguageController@languages_save')->name('languages.save');

    Route::get('/languages/delete', 'LanguageController@languages_delete')->name('languages.delete');

    Route::get('/languages/set_default', 'LanguageController@languages_set_default')->name('languages.set_default');
});

Route::group(['as' => 'user.' , 'middleware' => 'cors'] ,function() {

    Route::get('delete-video/{id}/{user_id}', 'UserController@delete_video')->name('delete_video');


    // Paypal Payment
    Route::get('paypal/{id}/{user_id}/{coupon_code?}','PaypalController@pay')->name('paypal');


    Route::get('user/payment/status','PaypalController@getPaymentStatus')->name('paypalstatus');


    Route::get('paypal_video/{id}/{user_id}/{coupon_code?}','PaypalController@payPerVideo')->name('paypal');


    Route::get('user/payment_video','PaypalController@getVideoPaymentStatus')->name('paypalstatus');


    Route::get('/vod/paypal/{id}/{user_id}/{coupon_code?}','PaypalController@videoSubscriptionPay')->name('videoPaypal');

    Route::get('/user/vod-status','PaypalController@getVODPaymentStatus')->name('videoPaypalstatus');


    Route::post('video/{mid}', 'UserController@video')->name('live.video');


    Route::post('live_streaming/{mid}', 'UserController@live_streaming')->name('live.streaming');


    Route::post('close_streaming', 'UserController@close_streaming')->name('live.close_streaming');


    Route::post('appSettings/{mid}', 'UserController@appSettings')->name('live.appSettings');
    
    Route::post('get_videos/{type}', 'UserController@get_videos')->name('live.get_videos');
   
    Route::post('check_subscription_plan', 'UserController@check_subscription_plan')->name('check_subscription_plan');

    Route::post('delete_streaming/{id}', 'UserController@delete_streaming')->name('delete_streaming');

    Route::post('userDetails', 'UserController@userDetails')->name('userDetails');

    Route::post('take_snapshot/{rid}', 'UserController@setCaptureImage')->name('setCaptureImage');

    Route::post('getChatMessages/{mid}', 'UserController@getChatMessages')->name('getChatMessages');

    Route::post('allPages', 'UserController@allPages')->name('allPages');

    Route::get('getPage/{id}', 'UserController@getPage')->name('getPage');

    Route::get('/daily/page' , 'UserApiController@daily_view_count')->name('daily.page.count');

    Route::any('searchall' , 'UserController@searchall')->name('search');

    Route::post('zero_plan', 'UserController@zero_plan')->name('zero_plan');

    Route::get('settings' , 'UserController@settings')->name('settings');

    Route::get('check_social', 'UserController@check_social')->name('check_social');

    Route::post('get_live_url', 'UserController@get_live_url')->name('get_live_url');

});



Route::group(['prefix' => 'userApi', 'middleware' => 'cors'], function(){

    Route::post('/register','UserApiController@register');
    
    Route::post('/login','UserApiController@login');

    Route::get('/userDetails','UserApiController@user_details');

    Route::post('/updateProfile', 'UserApiController@update_profile');

    Route::post('/forgotpassword', 'UserApiController@forgot_password');

    Route::post('/changePassword', 'UserApiController@change_password');

    Route::post('/deleteAccount', 'UserApiController@delete_account');

    Route::post('/settings', 'UserApiController@settings');


    // Videos and home

    Route::post('/home' , 'UserApiController@home');

    Route::post('/popular_videos', 'UserApiController@popular_videos');

    Route::post('/subscription_plans', 'UserApiController@subscriptions');
    
    Route::post('/suggestions', 'UserApiController@suggestions');

    Route::post('/add_follower', 'UserApiController@add_follower');

    Route::post('/remove_follower', 'UserApiController@remove_follower');

    Route::post('/save_live_video', 'UserApiController@save_live_video');

    Route::post('/single_video', 'UserApiController@single_video');

    Route::post('/save_chat', 'UserApiController@save_chat');

    Route::post('/block_user', 'UserApiController@block_user');

    Route::post('/unblock_user', 'UserApiController@unblock_user');

    Route::post('/followers_list', 'UserApiController@followers_list');

    Route::post('/followings_list', 'UserApiController@followings_list');

    Route::post('/blockersList', 'UserApiController@blockersList');

    Route::post('/pay_now', 'UserApiController@pay_now');

    Route::post('/video_subscription', 'UserApiController@video_subscription');

    Route::post('/get_viewers', 'UserApiController@get_viewers');

    Route::post('/subscribedPlans', 'UserApiController@subscribedPlans');

    Route::post('/peerProfile', 'UserApiController@peerProfile');

    Route::post('/close_streaming', 'UserApiController@close_streaming');

    Route::get('/checkVideoStreaming/{id?}', 'UserApiController@checkVideoStreaming');

    Route::post('check_user_call', 'UserApiController@check_user_call');

    Route::post('erase_videos', 'UserApiController@erase_videos');

    Route::get('/privacy', 'UserApiController@privacy');

    Route::get('/terms_condition', 'UserApiController@terms');

    Route::post('/live-video/snapshot' , 'UserApiController@live_video_snapshot');

    Route::post('/subscription/invoice', 'UserApiController@subscription_invoice');

    Route::post('/videos/info', 'UserApiController@videos_info');

    Route::post('/videos/paid-info', 'UserApiController@paid_videos');

    Route::post('/video/invoice', 'UserApiController@live_video_invoice');

    Route::post('redeems/list', 'UserApiController@redeems');

    Route::post('redeems/request', 'UserApiController@send_redeem_request');

    Route::post('redeem/request/cancel', 'UserApiController@redeem_request_cancel');

    Route::post('redeem/request/list', 'UserApiController@redeem_request_list');

    Route::post('logout', 'UserApiController@logout');

    Route::post('check/token-valid', 'UserApiController@check_token_valid');

    Route::post('plan_detail', 'UserApiController@plan_detail');

    Route::post('video_details', 'UserApiController@video_details');

    Route::post('streaming/status', 'UserApiController@streaming_status');

   // Stripe Payment

    Route::post('/stripe_payment', 'UserApiController@stripe_payment');

    Route::post('card_details', 'UserApiController@card_details');

    Route::post('payment_card_add', 'UserApiController@cards_add');

    Route::post('default_card', 'UserApiController@default_card');

    Route::post('delete_card', 'UserApiController@delete_card');

    Route::post('stripe/live/ppv', 'UserApiController@stripe_live_ppv');

    Route::post('admin', 'UserApiController@admin');

    // Automatic subscription with cancel

    Route::post('/cancel/subscription', 'UserApiController@autorenewal_cancel');

    Route::post('/autorenewal/enable', 'UserApiController@autorenewal_enable');


     // VOD

    Route::post('/vod/videos/save', 'UserApiController@vod_videos_save');

    Route::post('/vod/videos/delete', 'UserApiController@vod_videos_delete'); 

    Route::post('/vod/videos/list', 'UserApiController@vod_videos_list'); 

    Route::post('/vod/videos/status', 'UserApiController@vod_videos_status');

    Route::post('/vod/videos/view', 'UserApiController@vod_videos_view');

    Route::post('/vod/videos/set/ppv', 'UserApiController@vod_videos_set_ppv');

    Route::post('/vod/videos/remove/ppv', 'UserApiController@vod_videos_remove_ppv');

    Route::post('/vod/videos/ppv/history', 'UserApiController@ppv_history');

    Route::post('/vod/videos/pay/now', 'UserApiController@vod_videos_payment');

    Route::post('/ppv/revenue', 'UserApiController@ppv_revenue');

    Route::post('/vod/videos/search', 'UserApiController@vod_videos_search');

    Route::post('vod/videos/oncomplete/ppv', 'UserApiController@vod_videos_oncomplete_ppv');

    Route::post('vod/videos/stripe_ppv', 'UserApiController@vod_videos_stripe_ppv');

    Route::post('vod/videos/publish', 'UserApiController@vod_videos_publish');

    Route::post('vod/invoice', 'UserApiController@vod_invoice');

    // Streamer Gallery

    Route::post('streamer/galleries/save', 'UserApiController@streamer_galleries_save');

    Route::post('streamer/galleries/list', 'UserApiController@streamer_galleries_list');

    Route::post('streamer/galleries/delete', 'UserApiController@streamer_galleries_delete');

    // Coupons

    Route::post('/apply/coupon/subscription', 'UserApiController@apply_coupon_subscription');

    Route::post('apply/coupon/live-videos', 'UserApiController@apply_coupon_live_videos');

    Route::post('apply/coupon/vod-videos', 'UserApiController@apply_coupon_vod_videos');

    // Pages 

    Route::post('/pages/list', 'UserApiController@pages_list');

    Route::post('/pages/view', 'UserApiController@pages_view');

    Route::get('check/social', 'UserApiController@check_social');

    Route::get('/daily/page' , 'UserApiController@daily_view_count');

    Route::post('/become/operator', 'UserApiController@become_creator');


    // site_settings
    Route::get('site/settings', 'UserApiController@site_settings');

    Route::post('user/view', 'UserApiController@user_view');


    // Groups 

    Route::post('groups/index' , 'UserApiController@live_groups_index');

    Route::post('groups/view' , 'UserApiController@live_groups_view');

    Route::post('groups/save' , 'UserApiController@live_groups_save');

    Route::post('groups/delete' , 'UserApiController@live_groups_delete');

    Route::post('groups/members' , 'UserApiController@live_groups_members');

    Route::post('groups/members/add' , 'UserApiController@live_groups_members_add');

    Route::post('groups/members/remove' , 'UserApiController@live_groups_members_remove');


    // Live tv video

    Route::post('/single/live/video' , 'UserApiController@custom_live_videos_view');

    Route::post('/custom/live/videos' , 'UserApiController@custom_live_videos');

    Route::post('/custom/video/save', 'UserApiController@custom_live_videos_save');

    Route::post('/custom/video/delete', 'UserApiController@custom_live_videos_delete');

    Route::post('/custom/video/status', 'UserApiController@custom_live_videos_change_status');

    Route::post('/custom/videos/search', 'UserApiController@custom_live_videos_search');

    // search

    Route::post('/search', 'UserApiController@search');

    Route::post('/search/user', 'UserApiController@searchDetails')->name('search.users');

    Route::post('/search/live/videos', 'UserApiController@searchDetails')->name('search.live_videos');

    Route::post('/search/livetv', 'UserApiController@searchDetails')->name('search.live_tv');

    Route::post('/searchUser','UserApiController@searchUser'); // Dont use

    // Bell Notificatioons

    Route::post('/user/notifications', 'UserApiController@user_notifications');
    
    Route::post('/status/notifications', 'UserApiController@change_notifications_status');

    Route::post('/get/notification/count', 'UserApiController@notification_count');

});
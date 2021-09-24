<?php

use Illuminate\Support\Facades\Route;
/* --------------------- Common/User Routes START -------------------------------- */


Route::get('/', 'IndexController@index');

//Auth::routes(['verify' => true]);
Auth::routes();

Route::get('/googlelatlong', 'HomeController@googlelatlong')->name('googlelatlong');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/test', 'HomeController@test');
Route::get('/privacy-policy','HomeController@privacy_policy');
Route::get('/terms-conditions','HomeController@terms_conditions');
Route::get('/mobile-verify','Auth\RegisterController@mobile_otp_verify');
Route::get('/mobile_verify/{mobile}','Auth\RegisterController@mobile_verify');
Route::post('/mobile_verify/{mobile}','Auth\RegisterController@mobile_verify');

Route::get('/property_listing_request','HomeController@property_listing_request');
Route::post('/property_listing_request','HomeController@property_listing_request');
Route::get('/submitmobile_otp_verify/{mobile}','Auth\RegisterController@submitmobile_otp_verify');
Route::get('/propertylist','HomeController@propertylist');
Route::post('/propertylist','HomeController@propertylist');
Route::get('/propertylist/{city}','HomeController@propertylist');
Route::get('/propertylist_detail/{id}','HomeController@propertylist_detail');
Route::get('/about','HomeController@about');
Route::get('/contact/{pcode}','HomeController@contact');
Route::get('/contact','HomeController@contact');
Route::post('/contact_mail_send','HomeController@contact_mail_send');
Route::post('/request_for_call','ScheduleController@request_for_call');
Route::get('/getCity/{id}','HomeController@getCityInfo');
Route::get('/getSector/{id}','HomeController@getSectorInfo');


Route::middleware('auth:web')->group(function () {
Route::get('/my_account','HomeController@myaccount');
Route::get('/my_account/{fav}','HomeController@myaccount');
Route::post('/my_account','HomeController@myaccount');
Route::get('/cancel_visit','ScheduleController@cancel_visit')->name('schedule.cancel_visit');
Route::post('/change_mobile_otp_verify','HomeController@change_mobile_otp_verify');
Route::get('/change_mb_otp_verify/{mobile}','HomeController@change_mb_otp_verify');
Route::get('/mobile_verify_change/{mobile}','HomeController@mobile_verify_change');
Route::post('/mobile_verify_change/{mobile}','HomeController@mobile_verify_change');

});
Route::get('/cancel_visit/{id}','ScheduleController@cancel_visit')->name('schedule.cancel_visit');
Route::get('/notification','HomeController@notification');
Route::get('/payment','HomeController@payment');
Route::get('/subscription','HomeController@subscription');
Route::get('/schedule-visit','HomeController@schedule_visit');
Route::post('/request_for_schedule','ScheduleController@request_for_schedule');

Route::post('/add_favorite','UserController@add_favorite');
Route::get('/delete_fav/{id}','UserController@delete_fav');

//Socail Login
Route::get('login/facebook/redirect', 'Auth\SocialAuthFacebookController@redirect')->name('redirect');
Route::get('/facebook/callback', 'Auth\SocialAuthFacebookController@callback')->name('callback');
Route::get('login/google/redirect', 'Auth\SocialAuthGoogleController@redirect');
Route::get('/google/callback', 'Auth\SocialAuthGoogleController@callback');
//Auth::routes([ 'verify' => true ]);

//Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

/* --------------------- Common/User Routes END -------------------------------- */

/* ----------------------- Admin Routes START -------------------------------- */



Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function () {

    /**
     * Admin Auth Route(s)
     */
    Route::namespace('Auth')->group(function () {

        //Login Routes
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login');
        Route::post('/logout', 'LoginController@logout')->name('logout');

        //Forgot Password Routes
        Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');

        //Reset Password Routes
        Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');

        // Email Verification Route(s)
        Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
        Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify');
        Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');
    });

    Route::middleware('auth:admin')->group(function () {

        Route::get('/dashboard', 'HomeController@index')->name('home');
        Route::get('/add_property', 'PropertyController@add_property')->name('property.add_property');

        Route::post('/submit_property', 'PropertyController@submit_property')->name('property.submit_property');

        Route::post('/owner_details', 'PropertyController@saveOwnerDetails')->name('property.owner_details');

        Route::post('/property_manager_details', 'PropertyController@savePropertyManagerDetails')->name('property.property_manager_details');
		Route::post('/property_neighbour_details', 'PropertyController@savePropertyNeighbourhoods')->name('property.property_neighbour_details');
		
		Route::post('/property_digital_signature', 'PropertyController@savePropertyDigitalSignatureDetails')->name('property.property_digital_signature');
 
        Route::post('/property_owner_details', 'PropertyController@savePropertyOwnerDetails')->name('property.property_owner_details');

        Route::post('/property_general_details', 'PropertyController@savePropertyGeneralDetails')->name('property.property_general_details');

        Route::post('/property_address_details', 'PropertyController@savePropertyAddressDetails')->name('property.property_address_details');

        Route::post('/property_additional_details', 'PropertyController@savePropertyAdditionalDetails')->name('property.property_additional_details');

        Route::post('/property_image', 'PropertyController@savePropertyImages')->name('property.property_image');
		Route::post('/change_property_admin_status', 'PropertyController@change_property_admin_status')->name('property.change_property_admin_status');

		Route::get('/property_lead_delete/{id}/delete', 'PropertyController@delete_request')->name('property.delete_request');
		Route::get('/property_add_request/', 'PropertyController@property_add_request')->name('property.property_add_request');
		Route::get('/property_request_detail/{id}', 'PropertyController@property_request_detail')->name('property.property_request_detail');
		Route::get('/property_lead_request/', 'PropertyController@property_lead_request')->name('property.property_lead_request');
		Route::get('/property_lead_request_detail/{id}', 'PropertyController@property_lead_request_detail')->name('property.property_lead_request_detail');
		Route::get('/inventory_management/', 'PropertyController@inventory_management')->name('property.inventory_management');
		Route::get('/view_invent_request/{id}', 'PropertyController@view_invent_request')->name('property.view_invent_request');
		Route::post('/change_inventory_status', 'PropertyController@change_inventory_status')->name('property.change_inventory_status');
		Route::post('/change_inventory_admin_status', 'PropertyController@change_inventory_admin_status')->name('property.change_inventory_admin_status');
		


        Route::get('/property_list', 'PropertyController@property_list')->name('property.property_list');
		Route::get('/property_list?type=area_manager&id={id}', 'PropertyController@property_list')->name('property.property_list');
		Route::get('/property_list?type=owner&id={id}', 'PropertyController@property_list')->name('property.property_list');

        Route::get('/property_list_data', 'PropertyController@property_list_data')->name('property.property_list_data');
		Route::get('/bulk_upload_property', 'PropertyController@bulk_upload_property')->name('bulk_upload_property');
		Route::post('/bulk_upload_property', 'PropertyController@bulk_upload_property')->name('bulk_upload_property');
		Route::post('/image_delete_property', 'PropertyController@image_delete_property')->name('property.image_delete_property');
        Route::get('/property_status/{id}/{statusid}', 'PropertyController@propertyStatus')->name('property.property_status');

        Route::get('/property_detail/{id}', 'PropertyController@property_detail')->name('property.property_detail');
		Route::get('/property_detail/{id}/delete','PropertyController@delete');
		Route::get('/property_detail/{id}/edit','PropertyController@edit');

        Route::post('dropzone/upload', 'PropertyController@upload')->name('property.upload');

        Route::get('dropzone/fetch', 'PropertyController@fetch')->name('property.fetch');

        Route::get('dropzone/delete', 'PropertyController@delete')->name('property.delete');

        Route::get('/getAreaManagerInfo/{id}','PropertyController@getAreaManagerInfo');
        Route::get('/getCity/{id}','PropertyController@getCityInfo');
        Route::get('/getSector/{id}','PropertyController@getSectorInfo');
		
		
        Route::get('/property_schedule_list','ScheduleController@index');
		Route::get('/property_schedule_list/{id}','ScheduleController@index');
		Route::get('/schedule/{id}/edit','ScheduleController@edit');
		Route::post('/schedule/{id}/edit','ScheduleController@edit');
		Route::get('/schedule/{id}/delete','ScheduleController@delete');
		
		//Site setting
		Route::post('/site_setting/{id}','SiteSettingController@store');
		Route::get('/site_setting','SiteSettingController@create');
		
		//propery owner
		Route::post('/add_propery_owner','OwnerController@store');
		Route::get('/add_propery_owner','OwnerController@create');
		Route::get('/property_owner_list','OwnerController@index');
		Route::get('/property_owner/{id}/delete','OwnerController@delete');
		Route::get('/owner_detail/{id}/','OwnerController@owner_detail');
		Route::post('/property_owner/{id}/edit','OwnerController@update');
		Route::get('/property_owner/{id}/edit','OwnerController@fetch');
		
		
		//Manager
		Route::post('/add_area_manager','AreaManagerController@store');
		Route::get('/add_area_manager','AreaManagerController@create');
		Route::get('/area_manager_list','AreaManagerController@index');
		//Route::get('/area_manager/{id}/delete','AreaManagerController@delete');		
		Route::post('/area_manager/{id}/edit','AreaManagerController@update');
		Route::get('/area_manager/{id}/edit','AreaManagerController@fetch');
		Route::get('/area_manager_detail/{id}/','AreaManagerController@area_manager_detail');
		Route::post('/area_manager/{id}/delete','AreaManagerController@delete');
		Route::get('/area_manager/{id}/delete','AreaManagerController@delete');
		
		//Sectors
		Route::get('/city_list','SectorController@city_list');
		Route::post('/sector/{id}/add','SectorController@store');
		Route::get('/sector/{id}/add','SectorController@create');
		Route::get('/sector_list/{id}','SectorController@index');
		Route::get('/sector/{id}/delete','SectorController@delete');		
		Route::post('/sector/{id}/edit','SectorController@update');
		Route::get('/sector/{city_id}/{id}/edit','SectorController@fetch');		
		
		//User
		Route::get('/user_list','UserController@index');
		Route::get('/user/{id}/delete','UserController@delete');		
		Route::post('/user/{id}/edit','UserController@update');
		Route::get('/user/{id}/edit','UserController@fetch');
		Route::get('/user_detail/{id}/','UserController@user_detail');
		
		Route::get('/owner_payment_detail_approval', 'UserController@owner_payment_detail_approval')->name('property.owner_payment_detail_approval');
		Route::get('/owner_bank_details/{id}/edit', 'UserController@savePropertyOwnerBankDetails')->name('property.owner_payment_detail_approval');
		Route::post('/owner_bank_details/{id}/edit', 'UserController@savePropertyOwnerBankDetails')->name('property.owner_payment_detail_approval');
		Route::get('/owner_bank_details/{id}/','UserController@owner_bank_details');
		Route::get('/owner_bank_details/{id}/delete','UserController@delete_bank_details');
    });




    //Put all of your admin routes here...

});

/* ----------------------- Admin Routes END -------------------------------- */

Route::prefix('/property_owner')->name('property_owner.')->namespace('Property_owner')->group(function () {
    Route::namespace('Auth')->group(function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login');
        Route::post('/logout', 'LoginController@logout')->name('logout');
    });
    Route::middleware('auth:property_owner')->group(function () {
        Route::get('/dashboard', 'HomeController@index')->name('home');
        Route::get('/property_list', 'PropertyController@property_list')->name('property.property_list');
        Route::get('/property_list_data', 'PropertyController@property_list_data')->name('property.property_list_data');
        Route::get('/change_password', 'OwnerController@change_password')->name('change_password');
        Route::post('/submit_change_password', 'OwnerController@submit_change_password')->name('submit_change_password');

        Route::get('/payment_detail', 'PropertyController@payment_detail')->name('property.payment_detail');
        Route::post('/payment_detail', 'PropertyController@savePropertyOwnerBankDetails')->name('property.payment_detail');
        Route::get('/property_detail/{id}', 'PropertyController@property_detail')->name('property.property_detail');
        Route::get('/edit_inventory/{id}', 'PropertyController@edit_inventory')->name('property.edit_inventory');
        Route::post('/edit_inventory/{id}', 'PropertyController@edit_inventory')->name('property.edit_inventory');
		Route::post('/inventory_management/', 'PropertyController@inventory_management')->name('property.inventory_management');

    });
});

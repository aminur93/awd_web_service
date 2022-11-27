<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers\auth','prefix' => 'auth/auth/v1'], function ($router) {
    /*Web portal login and forget and reset password start*/
    Route::post('login', 'AuthController@login');
    Route::post('forget_password', 'ForgetPasswordController@forgetPassword');
    Route::post('change_password', 'ChangePasswordController@saveResetPassword');
    Route::post('admin_change_password', 'ChangePasswordController@adminChangePassword');
    Route::post('admin_profile_update', 'ChangePasswordController@adminProfileUpdate');
    Route::post('edit_user/{id}', 'AuthController@edituser');
     /*Web portal login and forget and reset password start*/
});

Route::group(['namespace' => 'App\Http\Controllers\auth','prefix' => 'auth/auth/v1'], function ($router) {
    /*mobile portal login and forget and reset password start*/
    Route::post('mobile_register', 'MobileAuthController@mobileRegister');
    Route::post('mobile_login', 'MobileAuthController@mobileLogin');

    Route::post('mobile_forget_password', 'MobileForgetPasswordController@mobileForgetPassword');
    Route::post('mobile_otp_check', 'MobileForgetPasswordController@otpCheck');
    Route::post('mobile_change_password', 'MobileChangePasswordController@saveResetPassword');
     /*mobile portal login and forget and reset password start*/
});

Route::group(['middleware' => 'api','namespace' => 'App\Http\Controllers\auth','prefix' => 'auth/auth/v1'], function ($router) {
    /*web portal route start*/
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    /*web portal route start*/

    /*mobile auth route start*/
    Route::post('mobile_logout', 'MobileAuthController@mobileLogout');
    Route::post('mobile_refresh', 'MobileAuthController@mobileRefresh');
    Route::post('mobile_me', 'MobileAuthController@mobileMe');
    /*mobile auth route end*/

    /*mobile user profile route start*/
    Route::get('mobile_profile', 'MobileProfileController@profile');
    Route::post('mobile_profile_update', 'MobileProfileController@update');
    /*mobile user profile route end*/

    /*web and mobile auth token check*/
    Route::post('isValidToken', 'AuthController@isValidToken');
    /*web and mobile auth token check*/

});

Route::group(['middleware' => ['api'], 'namespace' => 'App\Http\Controllers\api','prefix' => 'auth/access/v1'], function ($router) {

    /*users route start*/
    Route::get('user','UserController@index');
    Route::get('user/getData','UserController@getData');
    Route::post('user/store','UserController@store');
    Route::get('user/edit/{id}','UserController@edit');
    Route::put('user/update/{id}','UserController@update');
    Route::delete('user/destroy/{id}','UserController@destroy');
    /*users route start*/

    /*Roles route start*/
    Route::get('role', 'RoleController@index');
    Route::get('role/getData', 'RoleController@getData');
    Route::post('role/store', 'RoleController@store');
    Route::get('role/edit/{id}', 'RoleController@edit');
    Route::put('role/update/{id}', 'RoleController@update');
    Route::delete('role/destroy/{id}', 'RoleController@destroy');
    /*Roles route end*/

    /*permission route start*/
    Route::get('permission', 'PermissionController@index');
    Route::get('permission/getData', 'PermissionController@getData');
    Route::post('permission/store', 'PermissionController@store');
    Route::get('permission/edit/{id}', 'PermissionController@edit');
    Route::put('permission/update/{id}', 'PermissionController@update');
    Route::delete('permission/destroy/{id}', 'PermissionController@destroy');
    /*permission route end*/

});



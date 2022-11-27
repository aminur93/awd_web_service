<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'email/v1', 'namespace' => 'App\Http\Controllers'], function($router){

    Route::post('welcome_email', 'EmailController@welcomeEmail');
    Route::post('forget_password_email', 'EmailController@forgetPassword');
    Route::post('otp_code_email', 'EmailController@otpCode');
    Route::post('push_notification', 'EmailController@pushNotification');
});
<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
 

 Route::group(['prefix' => 'v1','namespace' => 'Api'], function () {
     Route::get('governorates' , 'MainController@governorates');
// api/v1/governorates
     Route::get('cities' , 'MainController@cities');
// api/v1/cities
     Route::post('register' , 'AuthController@register');
// api/v1/register
     Route::post('login' , 'AuthController@login');
//
     Route::post('forgotPassword' , 'MainController@forgotPassword');     
//
    // Route::post('verifyPinCode' , 'MainController@verifyPinCode');  
//
     Route::post('resetPassword' , 'MainController@resetPassword');

     Route::post('settings/{id}' , 'MainController@settings'); 

          
     Route::group(['middleware' => 'auth:api'] , function(){
     
     Route::post('registerToken' , 'AuthController@registerToken');

     Route::post('removeToken' , 'AuthController@removeToken');
     
     Route::get('articles' , 'MainController@articles');
     
     // contact us service route
     Route::get('contactus' , 'MainController@contactus');

     Route::get('reports' , 'MainController@reports');
     // show and edit profile 
     Route::get('profile' , 'MainController@profile');
     //notifications list
     Route::get('notifications' , 'MainController@notifications');
     //
     Route::get('favoriteArticle' , 'MainController@favoriteArticle');
     //
     Route::get('unfavoriteArticle' , 'MainController@unfavoriteArticle');
     //
     Route::get('favorited' , 'MainController@favorited');
     //
     Route::get('donationOrders' , 'MainController@donationOrders');
     //
     Route::post('submitDonationOrder' , 'MainController@submitDonationOrder');
     //
     Route::post('notificationSettings' , 'MainController@notificationSettings');
     //
     Route::get('notificationSettingsRead' , 'MainController@notificationSettingsRead');
     //
     Route::get('bloodType' , 'MainController@bloodType');

      });
});


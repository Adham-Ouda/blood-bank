<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('governorate', 'GovernorateController');

Route::resource('city', 'CityController');

Route::resource('article', 'ArticleController');

Route::resource('category', 'CategoryController');

Route::resource('contactus', 'ContactUsController');

Route::resource('report', 'ReportController');

Route::resource('client', 'ClientController');

Route::resource('settings', 'SettingsController');

Route::resource('donationOrder', 'DonationOrderController');


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

Route::get('email-verification/error', 'Auth\RegisterController@getVerificationError')->name('email-verification.error');
Route::get('email-verification/check/{token}', 'Auth\RegisterController@getVerification')->name('email-verification.check');

Route::get('users/settings', 'Auth\UserSettingsController@edit')->name('user.edit');
Route::put('users/settings', 'Auth\UserSettingsController@update')->name('user.update');

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin\\'
], function (){
    Route::get('login', 'Auth\LoginController@ShowLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::group(['middleware' => ['isVerified','can:admin']], function(){
        Route::post('logout', 'Auth\LoginController@logout')->name('logout');
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::resource('users', 'UsersController');
        Route::resource('categories', 'CategoryController');
        Route::resource('series', 'SerieController');
        Route::resource('videos', 'VideoController');
    });
});

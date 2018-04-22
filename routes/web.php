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

    Route::group(['middleware' => ['isVerified', 'can:admin']], function (){
        Route::name('logout')->post('logout', 'Auth\LoginController@logout');
        Route::get('dashboard', function (){
            return view('admin.dashboard');
        });
        Route::name('user_settings.edit')->get('users/settings', 'Auth\UserSettingsController@edit');
        Route::name('user_settings.update')->put('users/settings', 'Auth\UserSettingsController@update');
        Route::resource('users', 'UsersController');
        Route::resource('categories', 'CategoryController');
        Route::name('series.thumb_asset')
            ->get('series/{series}/thumb_asset', 'SerieController@thumbAsset');
        Route::name('series.thumb_small_asset')
            ->get('series/{series}/thumb_small_asset', 'SerieController@thumbSmallAsset');
        Route::resource('series', 'SerieController');
        Route::group(['prefix' => 'videos', 'as' => 'videos.'], function (){
            Route::name('relations.create')->get('{video}/relations', 'VideoRelationsController@create');
            Route::name('relations.store')->post('{video}/relations', 'VideoRelationsController@store');
            Route::name('uploads.create')->get('{video}/uploads', 'VideoUploadsController@create');
            Route::name('uploads.store')->post('{video}/uploads', 'VideoUploadsController@store');
        });
        Route::resource('videos', 'VideosController');
        Route::resource('plans', 'PlansController');
        Route::resource('web_profiles', 'PayPalWebProfilesController');
    });
});

<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'PageController@index']);

    Route::get('/editorial', function () {
        return view('pages.editorial');
    });
    Route::get('/career', function () {
        return view('pages.career');
    });
    Route::get('/faq', function () {
        return view('pages.faq');
    });
    Route::get('/privacy', function () {
        return view('pages.privacy');
    });
    Route::get('/disclaimer', function () {
        return view('pages.disclaimer');
    });
    Route::get('/terms', function () {
        return view('pages.terms');
    });
    Route::get('/contact', function () {
        return view('pages.contact');
    });

    Route::resource('feedback', 'FeedbackController', [
        'only' => [
            'store'
        ]
    ]);
});

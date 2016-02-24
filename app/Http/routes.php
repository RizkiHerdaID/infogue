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
    Route::get('/search', ['as' => 'search', 'uses' => 'PageController@search']);
    Route::get('/search/people', ['as' => 'search.people', 'uses' => 'PageController@searchPeople']);
    Route::get('/search/article', ['as' => 'search.article', 'uses' => 'PageController@searchArticle']);
    Route::resource('feedback', 'FeedbackController', ['only' => ['store']]);

    Route::group(['as' => 'article.'], function () {
        Route::get('/{slug}', ['as' => 'show', 'uses' => 'ArticleController@show']);
        Route::get('/category/{category}', ['as' => 'category', 'uses' => 'CategoryController@index']);
        Route::get('/category/{category}/{subcategory}', ['as' => 'subcategory', 'uses' => 'SubcategoryController@index']);
        Route::get('/featured/latest', ['as' => 'latest', 'uses' => 'ArticleController@latest']);
        Route::get('/featured/headline', ['as' => 'headline', 'uses' => 'ArticleController@headline']);
        Route::get('/featured/trending', ['as' => 'trending', 'uses' => 'ArticleController@trending']);
        Route::get('/featured/random', ['as' => 'trending', 'uses' => 'ArticleController@random']);
        Route::get('/archive', ['as' => 'archive', 'uses' => 'ArticleController@archive']);
        Route::post('/rate/{slug}', ['as' => 'rate', 'uses' => 'ArticleController@rate']);
        Route::post('/hit/{slug}', ['as' => 'hit', 'uses' => 'ArticleController@hit']);
    });

    Route::group(['as' => 'contributor.', 'prefix' => 'contributor/{username}'], function () {
        Route::get('/', ['as' => 'stream', 'uses' => 'ContributorController@stream']);
        Route::get('/detail', ['as' => 'detail', 'uses' => 'ContributorController@detail']);
        Route::get('/article', ['as' => 'article', 'uses' => 'ContributorController@article']);
        Route::get('/follower', ['as' => 'follower', 'uses' => 'ContributorController@follower']);
        Route::get('/following', ['as' => 'following', 'uses' => 'ContributorController@following']);
    });

    Route::group(['as' => 'account.', 'prefix' => 'account', 'middleware' => ['auth']], function () {
        Route::get('/', ['as' => 'stream', 'uses' => 'ArticleController@stream']);

        Route::group(['as' => 'message.', 'prefix' => 'message'], function () {
            Route::get('/', ['as' => 'list', 'uses' => 'MessageController@index']);
            Route::post('/{username}', ['as' => 'send', 'uses' => 'MessageController@send']);
            Route::delete('/{username}', ['as' => 'delete', 'uses' => 'MessageController@destroy']);
            Route::get('/conversation/{username}', ['as' => 'conversation', 'uses' => 'MessageController@conversation']);
        });

        Route::get('/article', ['as' => 'article', 'uses' => 'ArticleController@index']);
        Route::get('/follower', ['as' => 'follower', 'uses' => 'FollowerController@follower']);
        Route::get('/following', ['as' => 'following', 'uses' => 'FollowerController@following']);

        Route::post('/follow/{username}', ['as' => 'follow', 'uses' => 'FollowerController@follow']);
        Route::post('/unfollow/{username}', ['as' => 'unfollow', 'uses' => 'FollowerController@unfollow']);

        Route::get('/setting', ['as' => 'setting', 'uses' => 'ContributorController@setting']);
        Route::match(['put', 'patch'], '/setting', ['as' => 'update', 'uses' => 'ContributorController@update']);

        Route::get('/logout', ['as' => 'logout', 'uses' => 'ContributorController@logout']);
    });

    Route::group(['namespace' => 'Api', 'as' => 'api.', 'prefix' => 'api'], function () {
        Route::resource('article', 'ArticleController');
        Route::get('/category/{category}', ['as' => 'category', 'uses' => 'CategoryController@index']);
        Route::get('/category/{category}/{subcategory}', ['as' => 'subcategory', 'uses' => 'SubcategoryController@index']);
        Route::post('/register', ['as' => 'register', 'uses' => 'ContributorController@register']);
        Route::post('/login', ['as' => 'login', 'uses' => 'ContributorController@login']);
        Route::get('/logout', ['as' => 'logout', 'uses' => 'ContributorController@logout']);
        Route::get('/setting', ['as' => 'setting', 'uses' => 'ContributorController@setting']);
        Route::match(['put', 'get'], '/setting', ['as' => 'setting', 'uses' => 'ContributorController@update']);
        Route::post('/follow/{username}', ['as' => 'follow', 'uses' => 'FollowerController@follow']);
        Route::post('/unfollow/{username}', ['as' => 'unfollow', 'uses' => 'FollowerController@unfollow']);

        Route::group(['as' => 'contributor.', 'prefix' => 'contributor/{username}'], function () {
            Route::get('/', ['as' => 'stream', 'uses' => 'ContributorController@stream']);
            Route::get('/article', ['as' => 'stream', 'uses' => 'ContributorController@article']);
            Route::get('/follower', ['as' => 'stream', 'uses' => 'ContributorController@follower']);
            Route::get('/following', ['as' => 'stream', 'uses' => 'ContributorController@following']);
        });
    });

    Route::group(['namespace' => 'Admin', 'as' => 'admin.', 'prefix' => 'admin'], function() {
        Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'AdministratorController@index']);
        Route::get('/setting', ['as' => 'setting', 'uses' => 'AdministratorController@setting']);
        Route::match(['put', 'patch'], 'setting', ['as' => 'setting', 'uses' => 'AdministratorController@setting']);
        Route::get('/contributor', ['as' => 'contributor', 'uses' => 'ContributorController@index']);

        Route::resource('article', 'ArticleController');
        Route::resource('category', 'CategoryController', ['except' => [
            'show', 'create', 'edit'
        ]]);
        Route::resource('subcategory', 'SubController', ['only' => [
            'store', 'update', 'destroy'
        ]]);
        Route::get('/feedback', ['as' => 'feedback', 'uses' => 'FeedbackController@index']);
        Route::post('/feedback/reply', ['as' => 'feedback.reply', 'uses' => 'FeedbackController@reply']);
        Route::post('/feedback/important', ['as' => 'feedback.important', 'uses' => 'FeedbackController@important']);
        Route::post('/feedback/archive', ['as' => 'feedback.archive', 'uses' => 'FeedbackController@archive']);
        Route::delete('/feedback/{id}', ['as' => 'feedback.destroy', 'uses' => 'FeedbackController@destroy']);
        Route::get('/about', ['as' => 'about', 'uses' => 'AdministratorController@about']);
        Route::get('/logout', ['as' => 'about', 'uses' => 'AdministratorController@logout']);
    });

});

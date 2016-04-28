<?php

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

    // Group of login administrator feature...
    Route::group(['namespace' => 'Admin'], function () {
        // Authentication routes...
        Route::get('admin', ['as' => 'admin.login.form', 'uses' => 'AuthController@showLoginForm']);
        Route::post('admin/login', ['as' => 'admin.login.attempt', 'uses' => 'AuthController@login']);
        Route::get('admin/logout', ['as' => 'admin.login.destroy', 'uses' => 'AuthController@logout']);

        // Reset routes...
        Route::get('admin/password/forgot', ['as' => 'admin.forgot.form', 'uses' => 'PasswordController@showLinkRequestForm']);
        Route::post('admin/password/email', ['as' => 'admin.forgot.email', 'uses' => 'PasswordController@sendResetLinkEmail']);
        Route::get('admin/password/reset/{token?}', ['as' => 'admin.reset.form', 'uses' => 'PasswordController@showResetForm']);
        Route::post('admin/password/reset', ['as' => 'admin.reset.attempt', 'uses' => 'PasswordController@reset']);
    });

    // Group of administrator feature...
    Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth:admin']], function () {
        // Basic admin routes...
        Route::get('dashboard', ['as' => 'admin.dashboard', 'uses' => 'AdministratorController@index']);
        Route::get('setting', ['as' => 'admin.setting', 'uses' => 'AdministratorController@setting']);
        Route::match(['put', 'patch'], 'setting', ['as' => 'admin.setting.update', 'uses' => 'AdministratorController@update']);
        Route::get('about', ['as' => 'admin.about', 'uses' => 'AdministratorController@about']);

        // Admin module routes...
        Route::resource('contributor', 'ContributorController', ['except' => ['show', 'create', 'store']]);
        Route::get('article/tags', ['as' => 'admin.article.tags', 'uses' => 'ArticleController@tags']);
        Route::get('article/subcategory/{id}', ['as' => 'admin.article.subcategory', 'uses' => 'CategoryController@subcategories']);
        Route::match(['put', 'patch'], '/article/mark/{type}/{label}/{id}', ['as' => 'admin.article.mark', 'uses' => 'ArticleController@mark']);
        Route::resource('article', 'ArticleController');
        Route::resource('category', 'CategoryController', ['except' => ['show', 'create', 'edit']]);
        Route::resource('subcategory', 'SubcategoryController', ['only' => ['store', 'update', 'destroy']]);
        Route::resource('feedback', 'FeedbackController', ['only' => ['index', 'destroy']]);
        Route::post('feedback/reply', ['as' => 'admin.feedback.reply', 'uses' => 'FeedbackController@reply']);
        Route::match(['put', 'patch'], 'feedback/mark/{label}/{id}', ['as' => 'admin.feedback.mark', 'uses' => 'FeedbackController@mark']);
    });

    // Group of frontend routes...
    Route::group(['middleware' => ['maintenance']], function () {
        // Group of static page...
        Route::get('editorial', ['as' => 'page.editorial', 'uses' => function () {
            return view('pages.editorial');
        }]);

        Route::get('career', ['as' => 'page.career', 'uses' => function () {
            return view('pages.career');
        }]);

        Route::get('faq', ['as' => 'page.faq', 'uses' => function () {
            return view('pages.faq');
        }]);

        Route::get('privacy', ['as' => 'page.privacy', 'uses' => function () {
            return view('pages.privacy');
        }]);

        Route::get('disclaimer', ['as' => 'page.disclaimer', 'uses' => function () {
            return view('pages.disclaimer');
        }]);

        Route::get('terms', ['as' => 'page.terms', 'uses' => function () {
            return view('pages.terms');
        }]);

        // Index routes...
        Route::get('/', ['as' => 'index', 'uses' => 'PageController@index']);

        // Searching routes...
        Route::get('/search', ['as' => 'search', 'uses' => 'PageController@search']);
        Route::get('/search/people', ['as' => 'search.people', 'uses' => 'PageController@searchPeople']);
        Route::get('/search/article', ['as' => 'search.article', 'uses' => 'PageController@searchArticle']);

        // Authentication routes...
        Route::get('auth/login', ['as' => 'login.form', 'uses' => 'Auth\AuthController@showLoginForm']);
        Route::post('auth/login', ['as' => 'login.attempt', 'uses' => 'Auth\AuthController@login']);
        Route::get('account/logout', ['as' => 'login.destroy', 'uses' => 'Auth\AuthController@logout']);

        // Reset routes...
        Route::get('password/forgot', ['as' => 'login.forgot', 'uses' => 'Auth\PasswordController@showLinkRequestForm']);
        Route::post('password/email', ['as' => 'login.reset.email', 'uses' => 'Auth\PasswordController@sendResetLinkEmail']);
        Route::get('password/reset/{token?}', ['as' => 'login.reset.form', 'uses' => 'Auth\PasswordController@showResetForm']);
        Route::post('password/reset', ['as' => 'login.reset.attempt', 'uses' => 'Auth\PasswordController@reset']);

        // Registration routes...
        Route::get('auth/register', ['as' => 'register.form', 'uses' => 'Auth\AuthController@showRegistrationForm']);
        Route::post('auth/register', ['as' => 'register.attempt', 'uses' => 'Auth\AuthController@register']);
        Route::get('auth/confirm/{token}', ['as' => 'register.confirm', 'uses' => 'Auth\AuthController@confirm']);
        Route::get('auth/resend/{token}', ['as' => 'register.resend', 'uses' => 'Auth\AuthController@resend']);
        Route::get('auth/activate/{token}', ['as' => 'register.activate', 'uses' => 'Auth\AuthController@activate']);

        // OAuth routes...
        Route::get('auth/facebook', 'Auth\AuthController@redirectToFacebookProvider');
        Route::get('auth/facebook/callback', 'Auth\AuthController@handleFacebookProviderCallback');
        Route::get('auth/twitter', 'Auth\AuthController@redirectToTwitterProvider');
        Route::get('auth/twitter/callback', 'Auth\AuthController@handleTwitterProviderCallback');

        // Contact / feedback routes...
        Route::resource('feedback', 'FeedbackController', ['only' => ['store']]);
        Route::get('contact', ['as' => 'page.contact', 'uses' => function () {
            return view('pages.contact');
        }]);

        // Subscription routes...
        Route::get('subscribe/broadcast/{period?}', ['as' => 'subscribe.broadcast', 'uses' => 'SubscriberController@broadcast']);
        Route::post('subscribe', ['as' => 'subscribe.register', 'uses' => 'SubscriberController@store']);
        Route::get('subscribe/{email}', ['as' => 'subscribe.complete', 'uses' => 'SubscriberController@subscribed']);
        Route::get('unsubscribe/{email}', ['as' => 'subscribe.stop', 'uses' => 'SubscriberController@unsubscribe']);

        // Group of contributor view profile routes...
        Route::group(['as' => 'contributor.', 'prefix' => 'contributor/{username}'], function () {
            Route::get('/', ['as' => 'stream', 'uses' => 'ContributorController@show']);
            Route::get('detail', ['as' => 'detail', 'uses' => 'ContributorController@detail']);
            Route::get('article', ['as' => 'article', 'uses' => 'ContributorController@article']);
            Route::get('follower', ['as' => 'follower', 'uses' => 'ContributorController@follower']);
            Route::get('following', ['as' => 'following', 'uses' => 'ContributorController@following']);
        });

        // Group of logged in account profile routes...
        Route::group(['prefix' => 'account', 'middleware' => ['auth']], function () {
            Route::get('/', ['as' => 'account.stream', 'uses' => 'ArticleController@stream']);

            Route::group(['as' => 'account.message.', 'prefix' => 'message'], function () {
                Route::get('/', ['as' => 'list', 'uses' => 'MessageController@index']);
                Route::post('/', ['as' => 'send', 'uses' => 'MessageController@send']);
                Route::delete('/{id}', ['as' => 'delete', 'uses' => 'MessageController@destroy']);
                Route::get('/conversation/{username}', ['as' => 'conversation', 'uses' => 'MessageController@conversation']);
            });

            Route::resource('article', 'ArticleController', ['except' => ['show']]);
            Route::match(['put', 'patch'], 'article/draft/{id}', ['as' => 'account.article.draft', 'uses' => 'ArticleController@draft']);
            Route::get('article/subcategory/{id}', ['as' => 'account.article.subcategory', 'uses' => 'CategoryController@subcategories']);
            Route::get('article/tags', ['as' => 'account.article.tags', 'uses' => 'TagController@tags']);
            Route::get('follower', ['as' => 'account.follower', 'uses' => 'FollowerController@follower']);
            Route::get('following', ['as' => 'account.following', 'uses' => 'FollowerController@following']);

            Route::post('follow', ['as' => 'account.follow', 'uses' => 'FollowerController@follow']);
            Route::delete('unfollow/{id}', ['as' => 'account.unfollow', 'uses' => 'FollowerController@unfollow']);

            Route::get('setting', ['as' => 'account.setting', 'uses' => 'ContributorController@setting']);
            Route::match(['put', 'patch'], 'setting', ['as' => 'account.update', 'uses' => 'ContributorController@update']);
        });

        // Group of article routes...
        Route::group(['as' => 'article.'], function () {
            Route::get('category/{category}', ['as' => 'category', 'uses' => 'CategoryController@category']);
            Route::get('category/{category}/{subcategory}', ['as' => 'subcategory', 'uses' => 'CategoryController@subcategory']);
            Route::get('tag/{tag}', ['as' => 'tag', 'uses' => 'TagController@tag']);
            Route::get('archive', ['as' => 'archive', 'uses' => 'ArticleController@archive']);
            Route::get('archive/latest', ['as' => 'latest', 'uses' => 'ArticleController@latest']);
            Route::get('archive/headline', ['as' => 'headline', 'uses' => 'ArticleController@headline']);
            Route::get('archive/trending', ['as' => 'trending', 'uses' => 'ArticleController@trending']);
            Route::get('archive/random', ['as' => 'random', 'uses' => 'ArticleController@random']);
            Route::post('article/rate', ['as' => 'rate', 'uses' => 'ArticleController@rate']);
            Route::post('article/hit', ['as' => 'hit', 'uses' => 'ArticleController@hit']);
            Route::get('{slug}', ['as' => 'show', 'uses' => 'ArticleController@show']);
        });
    });

    // Group of API for external devices...
    Route::group(['namespace' => 'Api', 'prefix' => 'api'], function () {
        Route::get('version', ['as' => 'api.version', 'uses' => 'ApiController@index']);

        Route::post('article/hit', ['as' => 'api.article.hit', 'uses' => 'ArticleController@hit']);
        Route::post('article/rate', ['as' => 'api.article.rate', 'uses' => 'ArticleController@rate']);
        Route::get('article/{slug}/comment', ['as' => 'api.article.comment', 'uses' => 'ArticleController@comment']);
        Route::resource('article', 'ArticleController', ['except' => [
            'create', 'edit'
        ]]);
        Route::post('comment', ['as' => 'api.comment.store', 'uses' => 'CommentController@store']);
        Route::get('tags', ['as' => 'api.tags.index', 'uses' => 'TagController@tags']);
        Route::get('tag/{tag}', ['as' => 'api.tags.article', 'uses' => 'TagController@tag']);
        
        Route::get('search', ['as' => 'api.search.article', 'uses' => 'SearchController@search']);
        Route::get('search/contributor', ['as' => 'api.search.contributor', 'uses' => 'SearchController@searchContributor']);
        Route::get('search/article', ['as' => 'api.search.article', 'uses' => 'SearchController@searchArticle']);
        
        Route::get('featured/latest', ['as' => 'api.latest', 'uses' => 'CategoryController@latest']);
		Route::get('featured/popular', ['as' => 'api.popular', 'uses' => 'CategoryController@popular']);
		Route::get('featured/trending', ['as' => 'api.trending', 'uses' => 'CategoryController@trending']);
		Route::get('featured/headline', ['as' => 'api.headline', 'uses' => 'CategoryController@headline']);
		Route::get('featured/random', ['as' => 'api.random', 'uses' => 'CategoryController@random']);
		
        Route::get('category', ['as' => 'api.menu', 'uses' => 'CategoryController@index']);
        Route::get('category/{category}', ['as' => 'api.category', 'uses' => 'CategoryController@category']);
        Route::get('category/{category}/{subcategory}', ['as' => 'api.subcategory', 'uses' => 'CategoryController@subcategory']);

        Route::post('account/register', ['as' => 'api.account.register', 'uses' => 'AccountController@register']);
        Route::post('account/login', ['as' => 'api.account.login', 'uses' => 'AccountController@login']);
        Route::match(['put', 'patch'], 'account', ['as' => 'api.account.update', 'uses' => 'AccountController@update']);

        Route::post('follow', ['as' => 'api.follow', 'uses' => 'FollowerController@follow']);
        Route::delete('unfollow', ['as' => 'api.unfollow', 'uses' => 'FollowerController@unfollow']);

        Route::group(['as' => 'api.contributor.', 'prefix' => 'contributor/{username}'], function () {
            Route::get('/', ['as' => 'show', 'uses' => 'ContributorController@show']);
            Route::get('/stream', ['as' => 'stream', 'uses' => 'ContributorController@stream']);
            Route::get('/article', ['as' => 'article', 'uses' => 'ContributorController@article']);
            Route::get('/followers', ['as' => 'follower', 'uses' => 'ContributorController@follower']);
            Route::get('/following', ['as' => 'following', 'uses' => 'ContributorController@following']);
        });
    });

});
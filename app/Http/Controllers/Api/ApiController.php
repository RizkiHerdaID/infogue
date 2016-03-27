<?php

namespace Infogue\Http\Controllers\Api;

use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;

class ApiController extends Controller
{
    public function index()
    {
        return [
            'api' => 'Infogue.id open RESTful API',
            'version' => '0.1',
            'last_build' => 'April 2016',
            'credit' => 'Angga Ari Wijaya',
            'contact' => 'anggadarkprince@gmail.com',
            'modules' => [
                'category' => [
                    'menu' => [
                        'method' => 'GET/HEAD',
                        'url' => url('api') . '/category',
                        'params' => []
                    ],
                    'category_article' => [
                        'method' => 'GET/HEAD',
                        'url' => url('api') . '/category/{:category}?{page=:value}',
                        'params' => [
                            'category' => 'Category\'s slug',
                            'value' => 'Page of article category',
                        ]
                    ],
                    'subcategory_article' => [
                        'method' => 'GET/HEAD',
                        'url' => url('api') . '/category/{:category}/{:subcategory}?{page=:value}',
                        'params' => [
                            'category' => 'Category\'s slug',
                            'subcategory' => 'Category\'s slug',
                            'value' => 'Page of article subcategory',
                        ]
                    ],
                ],
                'article' => [
                    'archive' => [
                        'method' => 'GET/HEAD',
                        'url' => url('api') . '/article?{page=:value}',
                        'params' => [
                            'value' => 'Page of stream',
                        ]
                    ],
                    'retrieve' => [
                        'method' => 'GET/HEAD',
                        'url' => url('api') . '/article/{:slug}',
                        'params' => [
                            'slug' => 'Article\'s slug'
                        ]
                    ],
                    'create' => [
                        'method' => 'POST',
                        'url' => url('api') . '/article',
                        'params' => [],
                        'inputs' => [
                            'title' => 'string:70',
                            'type' => 'enum:standard|gallery|video',
                            'slug' => 'alphadash|100',
                            'subcategory_id' => 'integer',
                            'content' => 'text',
                            'excerpt' => 'string:300',
                            'status' => 'enum:published|draft',
                        ],
                        'payload' => [
                            'featured' => 'mimes:images/*'
                        ],
                    ],
                    'update' => [
                        'method' => 'PATCH/PUT',
                        'url' => url('api') . '/article/{:slug}',
                        'params' => [],
                        'inputs' => [
                            'title' => 'string:70',
                            'type' => 'enum:standard|gallery|video',
                            'slug' => 'alphadash|100',
                            'subcategory_id' => 'integer',
                            'content' => 'text',
                            'excerpt' => 'string:300',
                            'status' => 'enum:published|draft',
                        ],
                        'payload' => [
                            'featured' => 'mimes:images/*'
                        ]
                    ],
                    'delete' => [
                        'method' => 'DELETE',
                        'url' => url('api') . '/article/{:slug}',
                        'params' => [
                            'slug' => 'Article\'s slug'
                        ]
                    ],
                    'hit' => [
                        'method' => 'POST',
                        'url' => url('api') . '/article/hit',
                        'params' => []
                    ],
                    'rate' => [
                        'method' => 'POST',
                        'url' => url('api') . '/article/rate',
                        'params' => [],
                        'inputs' => [
                            'article_id' => 'integer',
                            'rate' => 'integer|max:5|min:1'
                        ]
                    ],
                ],
                'contributor' => [
                    'retrieve' => [
                        'method' => 'GET/HEAD',
                        'url' => url('api') . '/contributor/{:username}',
                        'params' => [
                            'username' => 'Article\'s slug'
                        ]
                    ],
                    'stream' => [
                        'method' => 'GET/HEAD',
                        'url' => url('api') . '/contributor/{:username}/stream?{page=:value}',
                        'params' => [
                            'username' => 'Contributor\'s username',
                            'value' => 'Page of stream',
                        ]
                    ],
                    'article' => [
                        'method' => 'GET/HEAD',
                        'url' => url('api') . '/contributor/{:username}/article?{page=:value}',
                        'params' => [
                            'username' => 'Contributor\'s username',
                            'value' => 'Page of article',
                        ]
                    ],
                    'follower' => [
                        'method' => 'GET/HEAD',
                        'url' => url('api') . '/contributor/{:username}/follower?{page=:value}',
                        'params' => [
                            'username' => 'Contributor\'s username',
                            'value' => 'Page of followers',
                        ]
                    ],
                    'following' => [
                        'method' => 'GET/HEAD',
                        'url' => url('api') . '/contributor/{:username}/following?{page=:value}',
                        'params' => [
                            'username' => 'Contributor\'s username',
                            'value' => 'Page of following',
                        ]
                    ],
                    'register' => [
                        'method' => 'POST',
                        'url' => url('api') . '/contributor/register',
                        'params' => [],
                        'inputs' => [
                            'name' => 'string|max:50',
                            'email' => 'string|email|max:50',
                            'username' => 'string|alphadash|max:30',
                            'password' => 'string|min:8|max:20',
                            'status' => 'enum:pending|pending',
                        ],
                    ],
                    'auth' => [
                        'method' => 'POST',
                        'url' => url('api') . '/contributor/login',
                        'params' => [],
                        'inputs' => [
                            'email' => 'string|email|max:50',
                            'password' => 'string|min:8|max:20',
                        ],
                    ],
                    'update' => [
                        'method' => 'PATCH/PUT',
                        'url' => url('api') . '/contributor/{:username}',
                        'params' => [],
                        'inputs' => [
                            'name' => 'string|max:50',
                            'email' => 'string|email|max:50',
                            'username' => 'string|alphadash|max:30',
                            'gender' => 'enum:male|female',
                            'location' => 'string|max:50',
                            'about' => 'string|max:160',
                            'contact' => 'string|max:50',
                            'facebook' => 'url|max:160',
                            'twitter' => 'url|max:160',
                            'google+' => 'url|max:160',
                            'instagram' => 'url|max:160',
                            'password' => 'string|min:8|max:20',
                            'new_password' => 'string|min:8|max:20',
                            'new_password_confirmation' => 'string|min:8|max:20',
                        ],
                        'payload' => [
                            'avatar' => 'mimes:images/*',
                            'cover' => 'mimes:images/*',
                        ],
                    ],
                ],
                'follower' => [
                    'follow' => [
                        'method' => 'POST',
                        'url' => url('api') . '/follow',
                        'params' => [],
                        'inputs' => [
                            'contributor_id' => 'integer',
                            'following' => 'integer',
                        ]
                    ],
                    'unfollow' => [
                        'method' => 'DELETE',
                        'url' => url('api') . '/unfollow',
                        'params' => [],
                        'inputs' => [
                            'contributor_id' => 'integer',
                            'following' => 'integer',
                        ]
                    ],
                ]
            ]
        ];
    }
}

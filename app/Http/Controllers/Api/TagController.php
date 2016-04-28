<?php

namespace Infogue\Http\Controllers\Api;

use Carbon\Carbon;
use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;
use Infogue\Tag;

class TagController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Tag Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling article showing grouped by
    | tag, the tags are given by slug from category title and the article list
    | is result of guessing reverse form of slug.
    |
    */

    /**
     * Retrieve available tags request via AJAX for typeahead.
     *
     * @return json
     */
    public function tags()
    {
        $tags = Tag::pluck('tag');

        return response()->json([
            'request_id' => uniqid(),
            'status' => 'success',
            'timestamp' => Carbon::now(),
            'tags' => $tags
        ]);
    }

    /**
     * Retrieve article by tag label.
     *
     * @param $tag
     * @return json
     */
	public function tag($tag)
	{
		$article_tag = str_replace('-', ' ', $tag);
		
		$tag = new Tag();

        $articles = $tag->tagArticle($article_tag);
		
		return [
            'request_id' => uniqid(),
            'status' => 'success',
            'timestamp' => Carbon::now(),
            'articles' => $articles
        ];
	}
}

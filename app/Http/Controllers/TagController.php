<?php

namespace Infogue\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
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
     * Instance variable of Tag.
     *
     * @var Tag
     */
    private $tag;

    /**
     * Create a new tag controller instance.
     *
     * @param Tag $tag
     */
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    /**
     * Display a listing of the article by tags are given.
     *
     * @param Request $request
     * @param $tag
     * @return \Illuminate\Http\Response
     */
    public function tag(Request $request, $tag)
    {
        /*
         * --------------------------------------------------------------------------
         * Populating article by tag
         * --------------------------------------------------------------------------
         * Reverse tag by slug form into plain name and select article by that
         * name, also construct breadcrumb stack, because we implement lazy
         * pagination via ajax so return json when 'page' variable exist.
         */

        $article_tag = str_replace('-', ' ', $tag);

        $tag = new Tag();

        $article = $tag->tagArticle($article_tag);

        $breadcrumb = [
            'Archive' => route('article.archive'),
            'Tag' => '#',
            $article_tag => '#'
        ];

        $next_ref = '#';

        $prev_ref = '#';

        if (Input::get('page', false) && $request->ajax()) {
            return $article;
        } else {
            return view('article.category', compact('breadcrumb', 'next_ref', 'prev_ref'));
        }
    }

    /**
     * Retrieve available tags request via AJAX for typeahead.
     *
     * @param Request $request
     * @return json
     */
    public function tags(Request $request)
    {
        if($request->ajax()){
            $tags = Tag::pluck('tag');

            return $tags;
        } else {
            abort(403, 'Resources are restricted.');
        }
    }
}

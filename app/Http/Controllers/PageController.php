<?php

namespace Infogue\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Infogue\Article;
use Infogue\Category;
use Infogue\Contributor;
use Infogue\Http\Requests;

class PageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Page Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling main page and search
    | functionality.
    |
    */

    /**
     * Display a listing of the index resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
         * --------------------------------------------------------------------------
         * Retrieve featured posts from Article model
         * --------------------------------------------------------------------------
         * Headline : indicate article with headline state
         * Trending : indicate article with trending state
         * Popular  : the top of post sort by most viewed on last 3 months
         * Ranked   : the top of post sort by most stared
         * Latest   : last published article
         */
        $article = new Article();

        $featured = $article->headline();

        $trending = $article->trending();

        $popular = $article->mostPopular();

        $ranked = $article->mostRanked();

        $latest = $article->latest();

        /*
         * --------------------------------------------------------------------------
         * Retrieve featured category
         * --------------------------------------------------------------------------
         * Selecting the most viewed articles on top 4 categories
         */
        $category = new Category();

        $summary = $category->featured();

        return view('pages.index', compact('featured', 'popular', 'ranked', 'trending', 'latest', 'summary'));
    }

    /**
     * Show the result for articles and contributors.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $article = new Article();
        $contributor = new Contributor();

        $filter = Input::get('filter');

        /*
         * --------------------------------------------------------------------------
         * Querying result set
         * --------------------------------------------------------------------------
         * Select data by filter option, by default result search will return people
         * and article, contributor filter will select data each 8 rows, article
         * filter select data each 10 rows
         */

        if($filter == 'contributor'){
            $contributor_result = $contributor->search(Input::get('query'), 8);

            $total_result = $contributor_result->total();

            return view('pages.search', compact('contributor_result', 'total_result'));
        }
        else if($filter == 'article'){
            $article_result = $article->search(Input::get('query'), 10);

            $total_result = $article_result->total();

            return view('pages.search', compact('article_result', 'total_result'));
        }
        else{
            $article_result = $article->search(Input::get('query'), 10);

            $contributor_result = $contributor->search(Input::get('query'), 4);

            $total_result = $article_result->total() + $contributor_result->total();

            return view('pages.search', compact('contributor_result', 'article_result', 'total_result'));
        }
    }

    /**
     * Show the search result for finding contributors.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchPeople()
    {
        $contributor = new Contributor();

        $contributor_result = $contributor->search(Input::get('query'), 20);

        $total_result = $contributor_result->total();

        return view('pages.search', compact('contributor_result', 'total_result'));
    }

    /**
     * Show the result for finding articles.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchArticle()
    {
        $article = new Article();

        $article_result = $article->search(Input::get('query'));

        $total_result = $article_result->total();

        return view('pages.search', compact('article_result', 'total_result'));
    }
}

<?php

namespace Infogue\Http\Controllers;

use Infogue\Article;
use Infogue\Category;
use Infogue\Http\Requests;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article = new Article();
        $featured = $article->headline();
        $popular = $article->most_popular();
        $ranked = $article->most_ranked();
        $trending = $article->trending();
        $latest = $article->latest();

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
        //
    }

    /**
     * Show the search result for finding contributors.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchPeople()
    {
        //
    }

    /**
     * Show the result for finding articles.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchArticle()
    {
        //
    }

}

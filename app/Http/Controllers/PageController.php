<?php

namespace Infogue\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Infogue\Article;
use Infogue\Category;
use Infogue\Contributor;
use Infogue\Http\Requests;
use Symfony\Component\HttpFoundation\Request;

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
        $popular = $article->mostPopular();
        $ranked = $article->mostRanked();
        $trending = $article->trending();
        $latest = $article->latest();

        $category = new Category();
        $summary = $category->featured();

        //dd($summary[0][1]->rating);

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

<?php

namespace Infogue\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Infogue\Article;
use Infogue\Contributor;
use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;

class SearchController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Search Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling query operation, find related
    | contributor or article by keywords.
    |
    */

    /**
     * Show the result for articles and contributors.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $requests)
    {
        $article = new Article();
        $contributor = new Contributor();
		$id_contributor = $requests->get('contributor_id');

        $articles = $article->search(Input::get('query'), 10);
        $contributors = $contributor->search(Input::get('query'), 4, true, $id_contributor);

        return response()->json([
            'request_id' => uniqid(),
            'status' => 'success',
            'timestamp' => Carbon::now(),
            'contributors' => $contributors,
            'articles' => $articles,
        ]);
    }

    /**
     * Show the search result for finding contributors.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchContributor(Request $requests)
    {
        $contributor = new Contributor();
		$id_contributor = $requests->get('contributor_id');

        $contributors = $contributor->search(Input::get('query'), 12, true, $id_contributor);

        return response()->json([
            'request_id' => uniqid(),
            'status' => 'success',
            'timestamp' => Carbon::now(),
            'contributors' => $contributors,
        ]);
    }

    /**
     * Show the result for finding articles.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchArticle()
    {
        $article = new Article();

        $articles = $article->search(Input::get('query'), 12);

        return response()->json([
            'request_id' => uniqid(),
            'status' => 'success',
            'timestamp' => Carbon::now(),
            'articles' => $articles,
        ]);
    }
}

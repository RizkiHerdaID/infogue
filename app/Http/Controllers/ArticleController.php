<?php

namespace Infogue\Http\Controllers;

use Illuminate\Http\Request;
use Infogue\Article;
use Infogue\Http\Requests;

class ArticleController extends Controller
{
    private $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Display a listing of the article.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the article.
     *
     * @return \Illuminate\Http\Response
     */
    public function stream()
    {
        //
    }

    /**
     * Display a listing of the article.
     *
     * @return \Illuminate\Http\Response
     */
    public function latest()
    {
        //
    }

    /**
     * Display a listing of the article.
     *
     * @return \Illuminate\Http\Response
     */
    public function headline()
    {
        //
    }

    /**
     * Display a listing of the article.
     *
     * @return \Illuminate\Http\Response
     */
    public function trending()
    {
        //
    }

    /**
     * Display a listing of the article.
     *
     * @return \Illuminate\Http\Response
     */
    public function random()
    {
        //
    }

    /**
     * Display a listing of the article.
     *
     * @return \Illuminate\Http\Response
     */
    public function archive()
    {
        //
    }

    /**
     * Show the form for creating a new article.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created article in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Store user rating for the article.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function rate(Request $request, $id)
    {
        //
    }

    /**
     * Count +1 every user access the article at least for 30 seconds.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function hit(Request $request)
    {
        //
    }

    /**
     * Display the specified article.
     *
     * @param  int $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
    }

    /**
     * Show the form for editing the specified article.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified article in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified article from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

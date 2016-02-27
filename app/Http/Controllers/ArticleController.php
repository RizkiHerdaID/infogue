<?php

namespace Infogue\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
use Infogue\Article;
use Infogue\Contributor;
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
        $latest = $this->article->latest(false);

        $breadcrumb = [
            'Archive' => route('article.archive'),
            'Latest' => route('article.latest'),
        ];

        $next_ref = route('article.headline');

        $prev_ref = '#';

        if(Input::get('page', false)){
            return $latest;
        }
        else{
            return view('article.category', compact('breadcrumb', 'next_ref', 'prev_ref'));
        }
    }

    /**
     * Display a listing of the article.
     *
     * @return \Illuminate\Http\Response
     */
    public function headline()
    {
        $headline = $this->article->headline(false);

        $breadcrumb = [
            'Archive' => route('article.archive'),
            'Headline' => route('article.headline'),
        ];

        $next_ref = route('article.trending');

        $prev_ref = route('article.latest');

        if(Input::get('page', false)){
            return $headline;
        }
        else{
            return view('article.category', compact('breadcrumb', 'next_ref', 'prev_ref'));
        }
    }

    /**
     * Display a listing of the article.
     *
     * @return \Illuminate\Http\Response
     */
    public function trending()
    {
        $trending = $this->article->trending(false);

        $breadcrumb = [
            'Archive' => route('article.archive'),
            'Trending' => route('article.trending'),
        ];

        $next_ref = route('article.random');

        $prev_ref = route('article.headline');

        if(Input::get('page', false)){
            return $trending;
        }
        else{
            return view('article.category', compact('breadcrumb', 'next_ref', 'prev_ref'));
        }
    }

    /**
     * Display a listing of the article.
     *
     * @return \Illuminate\Http\Response
     */
    public function random()
    {
        $trending = $this->article->random();

        $breadcrumb = [
            'Archive' => route('article.archive'),
            'Random' => route('article.random'),
        ];

        $next_ref = '#';

        $prev_ref = route('article.trending');

        if(Input::get('page', false)){
            return $trending;
        }
        else{
            return view('article.category', compact('breadcrumb', 'next_ref', 'prev_ref'));
        }
    }

    /**
     * Display a listing of the article.
     *
     * @param $tag
     * @return \Illuminate\Http\Response
     */
    public function tag($tag)
    {
        $article_tag = str_replace('-', ' ', $tag);

        $article = $this->article->tag($article_tag);

        $breadcrumb = [
            'Archive' => route('article.archive'),
            'Tag' => '#',
            $article_tag => '#'
        ];

        $next_ref = '#';

        $prev_ref = '#';

        if(Input::get('page', false)){
            return $article;
        }
        else{
            return view('article.category', compact('breadcrumb', 'next_ref', 'prev_ref'));
        }
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
        $article = $this->article->whereSlug($slug)->firstOrFail();

        $category = $article->subcategory->category->category;

        $subcategory = $article->subcategory->subcategory;

        $breadcrumb = [
            'Archive' => route('article.archive'),
            $category => route('article.category', [str_slug($category)]),
            $subcategory => route('article.subcategory', [str_slug($category), str_slug($subcategory)]),
        ];

        $previous_article = $this->article->navigateArticle($article->id, 'prev');

        $next_article = $this->article->navigateArticle($article->id, 'next');

        $prev_ref = ($previous_article != null) ? route('article.show', [$previous_article->slug]) : '#';

        $next_ref = ($next_article != null) ? route('article.show', [$next_article->slug]) : '#';

        $tags = $article->tags()->get();

        $related = $this->article->related($article->id);

        $popular = $this->article->most_popular(5);

        $contributor = new Contributor();

        $author = $contributor->profile($article->contributor->username);

        return view('article.article', compact('breadcrumb','prev_ref', 'next_ref', 'article', 'author', 'tags', 'related', 'popular'));
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

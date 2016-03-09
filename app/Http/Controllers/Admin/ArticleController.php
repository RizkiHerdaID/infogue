<?php

namespace Infogue\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Infogue\Article;
use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;

class ArticleController extends Controller
{
    private $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Display a listing of the articles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filter_data = Input::has('data') ? Input::get('data') : 'all';
        $filter_status = Input::has('status') ? Input::get('status') : 'all';
        $filter_by = Input::has('by') ? Input::get('by') : 'date';
        $filter_sort = Input::has('sort') ? Input::get('sort') : 'desc';
        $query = Input::has('query') ? Input::get('query') : null;

        $article = new Article();

        $articles = $article->retrieveArticle($filter_data, $filter_status, $filter_by, $filter_sort, $query);

        return view('admin.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a article.
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
     * Display the specified article.
     *
     * @param  int $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $article = $this->article->whereSlug($slug)->firstOrFail();

        $tags = $article->tags()->get();

        return view('admin.article.article', compact('article', 'author', 'tags'));
    }

    /**
     * Show the form for editing the article.
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
     * Update the specified article status and state in storage.
     *
     * @param $type
     * @param $label
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function mark($type, $label, $id)
    {
        $article = Article::findOrFail($id);

        if($type == 'status'){
            $article->status = $label;
        }
        else if($type == 'state'){
            $article->state = $label;
        }
        else{
            abort(404);
        }

        $result = $article->save();

        if($result){
            return redirect()
                ->route('admin.article.index')
                ->with('status', ($label=='reject' || $label=='general') ? 'warning' : 'success')
                ->with('message', 'The <strong>'.$article->title.'</strong> set '.$type.' as <strong>'.$label.'</strong>');
        }
        else {
            return redirect()
                ->back()->withErrors()
                ->with('status', 'danger')
                ->with('message', 'The <strong>'.$article->title.'</strong> fail mark '.$type.' as <strong>'.$label.'</strong>');
        }
    }

    /**
     * Remove the specified article from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if(!empty(trim($request->input('selected')))){
            $article_ids = explode(',', $request->input('selected'));
            $delete = Article::whereIn('id', $article_ids)->delete();

            $title = count($article_ids).' Articles';
        }
        else{
            $article = Article::findOrFail($id);

            $title = $article->title;

            $delete = $article->delete();
        }

        $status = $delete ? 'warning' : 'danger';

        $message = $delete ? 'The <strong>'.$title.'</strong> was deleted' : 'Something is getting wrong';

        return redirect()->route('admin.article.index')
            ->with('status', $status)
            ->with('message', $message);
    }
}

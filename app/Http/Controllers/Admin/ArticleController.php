<?php

namespace Infogue\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Infogue\Article;
use Infogue\Category;
use Infogue\Contributor;
use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;
use Infogue\Http\Requests\CreateArticleRequest;
use Infogue\Subcategory;
use Infogue\Tag;
use Infogue\Uploader;

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
        $categories = Category::pluck('category', 'id');

        $subcategories = null;

        if(Input::old('category', '') != ''){
            $subcategories = Category::findOrFail(Input::old('category'))->subcategories;
        }

        return view('admin.article.create', compact('categories', 'subcategories'));
    }

    public function subcategory($id)
    {
        $category = Category::findOrFail($id);

        return $category->subcategories;
    }

    public function tags()
    {
        $tags = Tag::pluck('tag');

        return $tags;
    }

    /**
     * Store a newly created article in storage.
     *
     * @param Request|CreateArticleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateArticleRequest $request)
    {
        $tags_id = [];

        // get all tags which already exist with tags are given
        $tag = Tag::whereIn('tag', explode(',', $request->get('tags')));

        // merge tags which exist into tags_id
        $tags_id = array_merge($tags_id, $tag->pluck('id')->toArray());

        // retrieve tags label which already exist to compare with given array
        $available_tags = $tag->pluck('tag')->toArray();

        // new tags need to insert into tags table
        $new_tags = array_diff(explode(',', $request->get('tags')), $available_tags);

        foreach ($new_tags as $tag_label):
            $newTag = new Tag();
            $newTag->tag = $tag_label;
            $newTag->save();
            array_push($tags_id, $newTag->id);
        endforeach;

        $article = new Article();
        $article->contributor_id = Auth::guard('admin')->user()->id;
        $article->subcategory_id = $request->input('subcategory');
        $article->title = $request->input('title');
        $article->slug = $request->input('slug');
        $article->type = $request->input('type');
        $article->content = $request->input('content');
        $article->excerpt = $request->input('excerpt');
        $article->status = $request->input('status');

        $image = new Uploader();
        if ($image->upload($request, 'featured', base_path('public/images/featured/'), rand(0, 1000) . uniqid())) {
            $article->featured = $request->input('featured');
        }

        $article->save();

        Article::find($article->id)->tags()->attach($tags_id);

        return redirect()
            ->route('admin.article.index')
            ->with('status', 'success')
            ->with('message', 'The <strong>' . $article->title . '</strong> was created');
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
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $article = Article::whereSlug($slug)->firstOrFail();

        $categories = Category::pluck('category', 'id');

        $subcategories = null;

        if(Input::old('category', '') != ''){
            $subcategories = Category::findOrFail(Input::old('category'))->subcategories;
        }
        else{
            $subcategories = Subcategory::whereCategoryId($article->subcategory->category->id)->get();
        }

        return view('admin.article.edit', compact('article', 'categories', 'subcategories'));
    }

    /**
     * Update the specified article in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $slug
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Foundation\Validation\ValidationException
     */
    public function update(Request $request, $slug)
    {
        $article = Article::whereSlug($slug)->firstOrFail();

        $rules = [
            'title' => 'required|max:70',
            'slug' => 'required|alpha_dash|max:100|unique:articles,slug,'.$article->id,
            'type' => 'required|in:standard,gallery,video',
            'category' => 'required',
            'subcategory' => 'required',
            'featured' => 'mimes:jpg,jpeg,gif,png',
            'tags' => 'required',
            'content' => 'required',
            'excerpt' => 'max:300',
            'status' => 'required|in:pending,draft,published,reject',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $request->session()->flash('status', 'danger');
            $request->session()->flash('message', 'Your inputs data are invalid, please check again');

            $this->throwValidationException(
                $request, $validator
            );
        }

        // get all tags which already exist with tags are given
        $tag = Tag::whereIn('tag', explode(',', $request->get('tags')));

        // merge tags which exist into tags_id
        $tags_id =$tag->pluck('id')->toArray();

        // retrieve tags label which already exist to compare with given array
        $available_tags = $tag->pluck('tag')->toArray();

        // new tags need to insert into tags table
        $new_tags = array_diff(explode(',', $request->get('tags')), $available_tags);

        $article->tags()->sync($tags_id);

        foreach ($new_tags as $tag_label):
            $newTag = new Tag();
            $newTag->tag = $tag_label;
            $newTag->save();

            if (!$article->tags->contains($newTag->id)) {
                $article->tags()->save($newTag);
            }
        endforeach;

        $article->subcategory_id = $request->input('subcategory');
        $article->title = $request->input('title');
        $article->slug = $request->input('slug');
        $article->type = $request->input('type');
        $article->content_update = $request->input('content');
        $article->excerpt = $request->input('excerpt');
        $article->status = $request->input('status');

        $image = new Uploader();
        if ($image->upload($request, 'featured', base_path('public/images/featured/'), rand(0, 1000) . uniqid())) {
            $article->featured = $request->input('featured');
        }

        $article->save();

        return redirect()
            ->route('admin.article.index')
            ->with('status', 'success')
            ->with('message', 'The <strong>' . $article->title . '</strong> was updated');
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
            if($type == 'status' && $label == 'published'){
                $this->sendEmailNotification($article);
            }
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
     * Send email notification to followers that contributor create new article.
     *
     * @param $article
     */
    public function sendEmailNotification($article)
    {
        $contributor = $article->contributor;

        $followers = $contributor->followers;

        foreach ($followers as $follower):
            $follower = $follower->contributor;
            if ($follower->email_feed) {
                $data = [
                    'receiverName' => $follower->name,
                    'receiverUsername' => $follower->username,
                    'contributorName' => $contributor->name,
                    'contributorLocation' => $contributor->location,
                    'contributorUsername' => $contributor->username,
                    'contributorAvatar' => $contributor->avatar,
                    'contributorArticle' => $contributor->articles()->count(),
                    'contributorFollower' => $contributor->followers()->count(),
                    'contributorFollowing' => $contributor->following()->count(),
                    'article' => $article,
                ];

                Mail::send('emails.stream', $data, function ($message) use ($follower, $contributor) {

                    $message->from(env('MAIL_ADDRESS', 'no-reply@infogue.id'), env('MAIL_NAME', 'Infogue.id'));

                    $message->replyTo('no-reply@infogue.id', env('MAIL_NAME', 'Infogue.id'));

                    $message->to($follower->email)->subject($contributor->name . ' create new article');

                });
            }
        endforeach;
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

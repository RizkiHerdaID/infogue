<?php

namespace Infogue\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Infogue\Activity;
use Infogue\Article;
use Infogue\Category;
use Infogue\Contributor;
use Infogue\Http\Requests;
use Infogue\Http\Requests\CreateArticleRequest;
use Infogue\Image;
use Infogue\Rating;
use Infogue\Subcategory;
use Infogue\Tag;

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
        $filter_data = Input::has('data') ? Input::get('data') : 'all-data';
        $filter_by = Input::has('by') ? Input::get('by') : 'date';
        $filter_sort = Input::has('sort') ? Input::get('sort') : 'desc';

        $articles = $this->article->archive($filter_data, $filter_by, $filter_sort, Auth::user()->id);

        return view('contributor.article', compact('articles'));
    }

    /**
     * Display a listing of the article.
     *
     * @return \Illuminate\Http\Response
     */
    public function stream()
    {
        $contributor = new Contributor();

        $stream = $contributor->stream(Auth::user()->username);

        if (Input::get('page', false)) {
            return $stream;
        } else {
            return view('contributor.stream', compact('stream'));
        }
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
        $filter_data = Input::has('data') ? Input::get('data') : 'all-data';
        $filter_by = Input::has('by') ? Input::get('by') : 'date';
        $filter_sort = Input::has('sort') ? Input::get('sort') : 'desc';

        $archive = $this->article->archive($filter_data, $filter_by, $filter_sort);

        return view('article.archive', compact('archive'));
    }

    /**
     * Show the form for creating a new article.
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

        return view('contributor.article_create', compact('categories', 'subcategories'));
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
     * @param CreateArticleRequest $request
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
        $article->contributor_id = Auth::user()->id;
        $article->subcategory_id = $request->input('subcategory');
        $article->title = $request->input('title');
        $article->slug = $request->input('slug');
        $article->type = $request->input('type');
        $article->content = $request->input('content');
        $article->excerpt = $request->input('excerpt');
        $article->status = $request->input('status');

        $image = new Image();
        if ($image->uploadImage($request, 'featured', base_path('public/images/featured/'), rand(0, 1000) . uniqid())) {
            $article->featured = $request->input('featured');
        }

        $article->save();

        Article::find($article->id)->tags()->attach($tags_id);

        $this->sendEmailNotification(Auth::user()->id, $article);

        return redirect()
            ->route('account.article.index')
            ->with('status', 'success')
            ->with('message', 'The <strong>' . $article->title . '</strong> was created');
    }

    public function sendEmailNotification($contributor_id, $article)
    {
        $contributor = Contributor::findOrFail($contributor_id);

        $followers = $contributor->followers;

        foreach($followers as $follower):
            $follower = $follower->contributor;
            if($follower->email_feed){
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

                    $message->from('no-reply@infogue.id', 'Infogue.id');

                    $message->replyTo('no-reply@infogue.id', 'Infogue.id');

                    $message->to($follower->email)->subject($contributor->name.' create new article');

                });
            }
        endforeach;
    }

    /**
     * Store user rating for the article.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function rate(Request $request)
    {
        $article = Article::findOrFail($request->input('article_id'));

        $ip = $_SERVER['REMOTE_ADDR'];

        $is_rated = $article->ratings()->whereIp($ip)->count();

        if($is_rated){
            $rating = Rating::whereArticleId($request->input('article_id'))->whereIp($ip)->firstOrFail();
            $rating->rate = $request->input('rate');
            $rating->save();
        }
        else{
            $rating = new Rating();
            $rating->article_id = $request->input('article_id');
            $rating->ip = $ip;
            $rating->rate = $request->input('rate');
            $rating->save();
        }

        $activity = new Activity();
        $activity->contributor_id = $article->contributor_id;
        $activity->activity = $activity->giveRatingActivity($article->title, $article->slug, $request->input('rate'));
        $activity->save();

        return ($article->rating()->count() == null) ? 0 : $article->rating->total_rating;
    }

    /**
     * Count +1 every user access the article at least for 30 seconds.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function hit(Request $request)
    {
        $article = Article::findOrFail($request->id);

        $article->view = $article->view + 1;

        $article->save();

        return $article->view;

    }

    /**
     * Display the specified article.
     *
     * @param  int $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $article = $this->article->published()->whereSlug($slug)->firstOrFail();

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

        $popular = $this->article->mostPopular(5);

        $contributor = new Contributor();

        $author = $contributor->profile($article->contributor->username);

        return view('article.article', compact('breadcrumb','prev_ref', 'next_ref', 'article', 'author', 'tags', 'related', 'popular'));
    }

    /**
     * Show the form for editing the specified article.
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

        return view('contributor.article_edit', compact('article', 'categories', 'subcategories'));
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

        $tags_id = [];

        // get all tags which already exist with tags are given
        $tag = Tag::whereIn('tag', explode(',', $request->get('tags')));

        // merge tags which exist into tags_id
        $tags_id = array_merge($tags_id, $tag->pluck('id')->toArray());

        // retrieve tags label which already exist to compare with given array
        $available_tags = $tag->pluck('tag')->toArray();

        // new tags need to insert into tags table
        $new_tags = array_diff(explode(',', $request->get('tags')), $available_tags);

        //$tags_id_new = [];

        $article->tags()->sync($tag->pluck('id')->toArray());

        foreach ($new_tags as $tag_label):
            $newTag = new Tag();
            $newTag->tag = $tag_label;
            $newTag->save();
            //array_push($tags_id_new, $newTag->id);
            if (!$article->tags->contains($newTag->id)) {
                $article->tags()->save($newTag);
            }
        endforeach;

        //$article->tags()->attach($tags_id_new);

        $article->subcategory_id = $request->input('subcategory');
        $article->title = $request->input('title');
        $article->slug = $request->input('slug');
        $article->type = $request->input('type');
        $article->content_update = $request->input('content');
        $article->excerpt = $request->input('excerpt');
        $article->status = $request->input('status');

        $image = new Image();
        if ($image->uploadImage($request, 'featured', base_path('public/images/featured/'), rand(0, 1000) . uniqid())) {
            $article->featured = $request->input('featured');
        }

        $article->save();

        return redirect()
            ->route('account.article.index')
            ->with('status', 'success')
            ->with('message', 'The <strong>' . $article->title . '</strong> was updated');
    }

    /**
     * Update the specified article in storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function draft($id)
    {
        $article = Article::whereId($id)->whereContributorId(Auth::user()->id)->firstOrFail();

        $article->status = 'draft';

        $article->save();

        return redirect()->route('account.article.index')
            ->with('status', 'warning')
            ->with('message', 'The <strong>'.$article->title.'</strong> set to draft');
    }

    /**
     * Remove the specified article from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        $article->delete();

        $activity = new Activity();
        $activity->contributor_id = Auth::user()->id;
        $activity->activity = $activity->deleteArticleActivity(Auth::user()->username, $article->title, $article->slug);
        $activity->save();

        return redirect()->route('account.article.index')
            ->with('status', 'danger')
            ->with('message', 'The <strong>'.$article->title.'</strong> was deleted');;
    }
}

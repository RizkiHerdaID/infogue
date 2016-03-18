<?php

namespace Infogue\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Infogue\Article;
use Infogue\Category;
use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;
use Infogue\Http\Requests\CreateArticleRequest;
use Infogue\Subcategory;
use Infogue\Tag;
use Infogue\Uploader;

class ArticleController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Article Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling showing article page including
    | management, confirm, set article to headline or trending.
    |
    */

    /**
     * Instance variable of Article.
     *
     * @var Article
     */
    private $article;

    /**
     * Create a new article controller instance.
     *
     * @param Article $article
     */
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
        /*
         * --------------------------------------------------------------------------
         * Filtering article
         * --------------------------------------------------------------------------
         * Populate optional filter on url break down in data, sorting by and sorting
         * method, retrieve the article.
         */

        $filter_data = Input::has('data') ? Input::get('data') : 'all';
        $filter_status = Input::has('status') ? Input::get('status') : 'all';
        $filter_by = Input::has('by') ? Input::get('by') : 'date';
        $filter_sort = Input::has('sort') ? Input::get('sort') : 'desc';
        $query = Input::has('query') ? Input::get('query') : null;

        $articles = $this->article->retrieveArticle($filter_data, $filter_status, $filter_by, $filter_sort, $query);

        return view('admin.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a article.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*
         * --------------------------------------------------------------------------
         * Show create form
         * --------------------------------------------------------------------------
         * Populate category into list for build drop down, and try catch old
         * subcategory input because it depends on category which accessed via ajax.
         */

        $categories = Category::pluck('category', 'id');

        $subcategories = null;

        if (Input::old('category', '') != '') {
            $subcategories = Category::findOrFail(Input::old('category'))->subcategories;
        }

        return view('admin.article.create', compact('categories', 'subcategories'));
    }

    /**
     * Retrieve available tags request via AJAX for typeahead.
     *
     * @return json
     */
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
        $result = DB::transaction(function () use ($request) {
            try {
                /*
                 * --------------------------------------------------------------------------
                 * Populate tags
                 * --------------------------------------------------------------------------
                 * tags [many-to] -- article_tags -- [many] articles
                 *
                 * Sync tags and article, extract tags from request, break down between new
                 * tags and tags that available in database, collect available tags first
                 * then insert new tags and merge new inserted tag id with available tags id
                 * finally store them all into article_tags table.
                 */

                // get all tags which ALREADY EXIST by tags are given eg:
                // request tags         = [angga, ari, entertainment, happy, trend, 2016]
                // all database tags    = [1 => news, 2 => happy, 3 => angga, 4 => love, 5 => 2016]
                // tags where in        = [3 => angga, 2 => happy, 5 => 2016]
                $tag = Tag::whereIn('tag', explode(',', $request->get('tags')));

                // collect tags which existed into tags_id and leave for a while
                // $tags_id [3, 2, 5]
                $tags_id = $tag->pluck('id')->toArray();

                // retrieve tags label (name) which already exist to compare with given array
                // tags label [angga, happy, 2016]
                $available_tags = $tag->pluck('tag')->toArray();

                // new tags need to insert into tags table
                // $new_tags = [ari, entertainment, trend]
                $new_tags = array_diff(explode(',', $request->get('tags')), $available_tags);

                // loop through new tags and retrieve last inserted id to merge with tags_id that need to insert later
                // new tags will have id [6 => ari, 7 => entertainment, 8 => trend]
                // $tags_id will be [3, 2, 5, 6, 7, 8]
                foreach ($new_tags as $tag_label):
                    $newTag = new Tag();
                    $newTag->tag = $tag_label;
                    $newTag->save();
                    array_push($tags_id, $newTag->id);
                endforeach;

                /*
                 * --------------------------------------------------------------------------
                 * Populate article data
                 * --------------------------------------------------------------------------
                 * Retrieve all data from request and populate into article object model
                 * then store it into database, check if featured is available then attempt
                 * to upload to asset directory.
                 */

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
                if ($image->upload($request, 'featured', base_path('public/images/featured/'), 'featured_' . uniqid())) {
                    $article->featured = $request->input('featured');
                }

                $article->save();

                /*
                 * --------------------------------------------------------------------------
                 * Sync and Attach
                 * --------------------------------------------------------------------------
                 * We have all tag ids that need to insert on article_tags [3, 2, 5, 6, 7, 8]
                 * use attach method we insert them through article model related by article
                 * id so everything should be working perfectly.
                 */

                Article::find($article->id)->tags()->attach($tags_id);

                return $article;
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withErrors(['error' => Lang::get('alert.error.transaction')])
                    ->withInput();
            }
        });

        if ($result instanceof RedirectResponse) {
            return $result;
        }

        return redirect(route('admin.article.index'))->with([
            'status' => 'success',
            'message' => Lang::get('alert.article.create', ['title' => $result->title])
        ]);
    }

    /**
     * Display the specified article.
     *
     * @param  int $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        /*
         * --------------------------------------------------------------------------
         * Populate single article view
         * --------------------------------------------------------------------------
         * Find published article by slug so administrator could review to determine
         * it's deserve to approve or not.
         */

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
        /*
         * --------------------------------------------------------------------------
         * Show edit form
         * --------------------------------------------------------------------------
         * Populate category into list for build drop down, and try catch old
         * subcategory input because it depends on category, by default subcategory
         * should be exist on edit because all article should have it.
         */

        $article = Article::whereSlug($slug)->firstOrFail();

        $categories = Category::pluck('category', 'id');

        $subcategories = null;

        if (Input::old('category', '') != '') {
            $subcategories = Category::findOrFail(Input::old('category'))->subcategories;
        } else {
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

        /*
         * --------------------------------------------------------------------------
         * Validate data
         * --------------------------------------------------------------------------
         * Build validation rules, slug must be unique except its own, featured
         * not required to change or re-upload.
         */

        $rules = [
            'title' => 'required|max:70',
            'slug' => 'required|alpha_dash|max:100|unique:articles,slug,' . $article->id,
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
            $this->throwValidationException(
                $request, $validator
            );
        }

        $result = DB::transaction(function () use ($request, $article) {
            try {
                /*
                 * --------------------------------------------------------------------------
                 * Populate tags
                 * --------------------------------------------------------------------------
                 * tags [many-to] -- article_tags -- [many] articles
                 *
                 * This process should be similar with create article, little bit difference
                 * at old tags synchronization, some tags maybe removed from article and new
                 * tags need to insert again.
                 */

                // get all tags which ALREADY EXIST by tags are given
                $tag = Tag::whereIn('tag', explode(',', $request->get('tags')));

                // collect tags which existed into tags_id and leave for a while
                $tags_id = $tag->pluck('id')->toArray();

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
                $article->content = $request->input('content');
                $article->excerpt = $request->input('excerpt');
                $article->status = $request->input('status');

                $image = new Uploader();
                if ($image->upload($request, 'featured', base_path('public/images/featured/'), 'featured_' . uniqid())) {
                    $article->featured = $request->input('featured');
                }

                $article->save();

                return $article;

            } catch (\Exception $e) {
                return redirect()->back()
                    ->withErrors(['error' => Lang::get('alert.error.transaction')])
                    ->withInput();
            }
        });

        if ($result instanceof RedirectResponse) {
            return $result;
        }

        return redirect(route('admin.article.index'))->with([
            'status' => 'success',
            'message' => Lang::get('alert.article.update', ['title' => $result->title])
        ]);
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

        if ($type == 'status') {
            $article->status = $label;

            if ($label == 'published' && !empty(trim($article->content_update))) {
                $article->content = $article->content_update;
                $article->content_update = '';
            }
        } else if ($type == 'state') {
            $article->state = $label;
        } else {
            abort(404);
        }

        $result = $article->save();

        if ($result) {
            if ($type == 'status' && $label == 'published') {
                $this->sendEmailNotification($article);
            }
            return redirect(route('admin.article.index'))->with([
                'status' => ($label == 'reject' || $label == 'general') ? 'warning' : 'success',
                'message' => Lang::get('alert.article.mark', [
                    'title' => $article->title,
                    'type' => $type,
                    'label' => $label,
                ])
            ]);
        } else {
            return redirect()->back()->withErrors(['error' => Lang::get('alert.error.database')]);
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
        /*
         * --------------------------------------------------------------------------
         * Delete article
         * --------------------------------------------------------------------------
         * Check if selected variable is not empty so user intends to select multiple
         * rows at once, and prepare the feedback message according the type of
         * deletion action.
         */

        if (!empty(trim($request->input('selected')))) {
            $article_ids = explode(',', $request->input('selected'));

            $delete = Article::whereIn('id', $article_ids)->delete();

            $message = Lang::get('alert.article.delete_all', ['count' => $delete]);
        } else {
            $article = Article::findOrFail($id);

            $message = Lang::get('alert.article.delete', ['title' => $article->title]);

            $delete = $article->delete();
        }

        if ($delete) {
            return redirect(route('admin.article.index'))->with([
                'status' => 'warning',
                'message' => $message,
            ]);
        } else {
            return redirect()->back()->withErrors(['error' => Lang::get('alert.error.database')]);
        }
    }
}
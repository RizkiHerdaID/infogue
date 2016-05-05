<?php

namespace Infogue\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Infogue\Activity;
use Infogue\Article;
use Infogue\Contributor;
use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;
use Infogue\Rating;
use Infogue\Setting;
use Infogue\Tag;
use Infogue\Uploader;
use Infogue\User;

class ArticleController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Article Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling showing article page
    | including archive, latest, headline, featured, random, single article,
    | tags, hit, rate, and article management.
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
        $this->middleware('auth:api', ['only' => ['store', 'update', 'destroy']]);

        $this->article = $article;
    }

    /**
     * Display a listing of the article.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = $this->article->archive('all-data', 'date', 'desc', $request->input('contributor_id'));

        return $articles;
    }

    /**
     * Store a newly created article in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'featured' => 'mimes:jpg,jpeg,gif,png|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'request_id' => uniqid(),
                'status' => 'denied',
                'message' => "Featured must image and less than 1MB",
                'timestamp' => Carbon::now(),
            ], 400);
        }

        $exist = Article::whereSlug($request->input('slug'))->count();

        if ($exist) {
            return response()->json([
                'request_id' => uniqid(),
                'status' => 'denied',
                'message' => 'Unique slug has taken',
                'timestamp' => Carbon::now(),
            ], 400);
        }

        $articleController = $this;

        $result = DB::transaction(function () use ($request, $articleController) {
            try {
                /*
                 * --------------------------------------------------------------------------
                 * Populate tags
                 * --------------------------------------------------------------------------
                 * Sync tags and article, extract tags from request, break down between new
                 * tags and tags that available in database, collect available tags first
                 * then insert new tags and merge new inserted tag id with available tags id
                 * finally store them all into article_tags table.
                 */

                $availableTags = Tag::whereIn('tag', explode(',', $request->get('tags')));

                $availableTagsId = $availableTags->pluck('id')->toArray();

                $availableTagsName = $availableTags->pluck('tag')->toArray();

                $newTags = array_diff(explode(',', $request->get('tags')), $availableTagsName);

                foreach ($newTags as $tagLabel):
                    $newTag = new Tag();
                    $newTag->tag = $tagLabel;
                    $newTag->save();
                    array_push($availableTagsId, $newTag->id);
                endforeach;

                /*
                 * --------------------------------------------------------------------------
                 * Populate article data
                 * --------------------------------------------------------------------------
                 * Retrieve all data from request and populate into article object model
                 * then store it into database, check if featured is available then attempt
                 * to upload to asset directory.
                 */

                $autoApprove = Setting::whereKey('Auto Approve')->first();
                $status = $request->input('status');
                if ($autoApprove->value) {
                    if ($status == 'pending') {
                        $status = 'published';
                    }
                }

                $contributor = Contributor::findOrFail($request->input('contributor_id'));

                $article = new Article();
                $article->contributor_id = $contributor->id;
                $article->subcategory_id = $request->input('subcategory_id');
                $article->title = $request->input('title');
                $article->slug = $request->input('slug');
                $article->content = $request->input('content');
                $article->excerpt = $request->input('excerpt');
                $article->status = $status;

                $image = new Uploader();
                if ($image->upload($request, 'featured', base_path('public/images/featured/'), 'featured_' . uniqid())) {
                    $article->featured = $request->input('featured');
                }

                $article->save();

                Article::find($article->id)->tags()->attach($availableTagsId);

                Activity::create([
                    'contributor_id' => $contributor->id,
                    'activity' => Activity::createArticleActivity($contributor->username, $article->title, $article->slug)
                ]);

                if ($autoApprove->value) {
                    $articleController->sendFollowerEmailNotification($article);
                } else {
                    $articleController->sendAdminArticleNotification($contributor, $article);
                }

                return response()->json([
                    'request_id' => uniqid(),
                    'status' => 'success',
                    'message' => 'Article was created',
                    'auto_approve' => $autoApprove->value,
                    'timestamp' => Carbon::now(),
                ]);

            } catch (\Exception $e) {
                return response()->json([
                    'request_id' => uniqid(),
                    'status' => 'failure',
                    'message' => Lang::get('alert.error.transaction'),
                    'timestamp' => Carbon::now(),
                ], 500);
            }
        });

        return $result;
    }

    /**
     * Send notification email for admin or support.
     *
     * @param $contributor
     * @param $article
     * @param bool|false $doUpdate
     */
    public function sendAdminArticleNotification($contributor, $article, $doUpdate = false)
    {
        $notification = Setting::whereKey('Email Article')->first();

        if ($notification->value) {
            $admins = User::all(['name', 'email']);

            foreach ($admins as $admin) {
                if ($admin->email != 'anggadarkprince@gmail.com' && $admin->email != 'sketchprojectstudio@gmail.com') {
                    Mail::send('emails.admin.article', ['admin' => $admin, 'contributor' => $contributor, 'article' => $article], function ($message) use ($admin, $contributor, $doUpdate) {
                        $message->from(env('MAIL_ADDRESS', 'noreply@infogue.id'), env('MAIL_NAME', 'Infogue.id'));
                        $subject = $contributor->name . ' create new article [PENDING]';

                        if ($doUpdate) {
                            $subject = $contributor->name . ' updated the article [PENDING UPDATE]';
                        }

                        $message->to($admin->email)->subject($subject);
                    });
                }
            }
        }
    }

    /**
     * Send email notification to followers that contributor create new article.
     *
     * @param $article
     */
    public function sendFollowerEmailNotification($article)
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
                    $message->from(env('MAIL_ADDRESS', 'noreply@infogue.id'), env('MAIL_NAME', 'Infogue.id'));
                    $message->to($follower->email)->subject($contributor->name . ' create new article');
                });
            }
        endforeach;
    }

    /**
     * Add hit counter on certain article.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function hit(Request $request)
    {
        $article = Article::findOrFail($request->input('article_id'));

        $article->increment('view');

        return response()->json([
            'request_id' => uniqid(),
            'status' => 'success',
            'message' => $article->view,
            'timestamp' => Carbon::now(),
        ]);
    }

    /**
     * Rate a article between 1 to 5.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function rate(Request $request)
    {
        $article_id = $request->input('article_id');
        $rate = $request->input('rate');
        $ipAddress = $request->ip();

        $article = Article::findOrFail($article_id);

        $isRated = $article->ratings()->whereIp($ipAddress)->count();

        if ($isRated) {
            $rating = Rating::whereArticleId($article_id)->whereIp($ipAddress)->firstOrFail();
            $rating->rate = $rate;
        } else {
            $rating = new Rating();
            $rating->article_id = $request->input('article_id');
            $rating->ip = $ipAddress;
            $rating->rate = $request->input('rate');
        }

        $result = $rating->save();

        return response()->json([
            'request_id' => uniqid(),
            'status' => $result ? 'success' : 'failure',
            'message' => $result ? round($article->ratings()->avg('rate')) : Lang::get('database.generic'),
            'timestamp' => Carbon::now(),
        ], $result ? 200 : 500);
    }

    /**
     * Display the specified article.
     *
     * @param Request $requests
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function show(Request $requests, $slug)
    {
        $article = $this->article
            ->whereSlug($slug)
            ->with('subcategory', 'subcategory.category', 'tags')
            ->firstOrFail();

        $contributor = new Contributor();
        $contributor_id = $requests->get('contributor_id');
        $username = $article->contributor->username;
        $author = $contributor->profile($username, false, $contributor_id, true);

        $rating = round($article->ratings()->avg('rate'));

        $article = $article->toArray();

        $article['contributor'] = $author;
        $article['rating'] = $rating;

        return response()->json([
            'request_id' => uniqid(),
            'status' => 'success',
            'timestamp' => Carbon::now(),
            'article' => $article,
        ]);
    }

    /**
     * Retrieve article comments by passing slug.
     *
     * @param $slug
     * @return mixed
     */
    public function comment($slug)
    {
        $article = $this->article->whereSlug($slug)->firstOrFail();
        $comments = $article->comments()->paginate(10);

        return response()->json([
            'request_id' => uniqid(),
            'status' => 'success',
            'timestamp' => Carbon::now(),
            'comments' => $comments,
        ]);
    }

    /**
     * Update the specified article in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param param int $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $validator = Validator::make($request->all(), [
            'featured' => 'mimes:jpg,jpeg,gif,png|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'request_id' => uniqid(),
                'status' => 'denied',
                'message' => "Featured must image and less than 1MB",
                'timestamp' => Carbon::now(),
            ], 400);
        }

        $articleController = $this;

        $article = Article::whereSlug($slug)->firstOrFail();

        $exist = Article::whereSlug($request->input('slug'))->where('id', '!=', $article->id)->count();

        if ($exist) {
            return response()->json([
                'request_id' => uniqid(),
                'status' => 'denied',
                'message' => 'Unique slug has taken',
                'timestamp' => Carbon::now(),
            ], 400);
        }

        $result = DB::transaction(function () use ($request, $article, $articleController) {
            try {
                /*
                 * --------------------------------------------------------------------------
                 * Populate tags
                 * --------------------------------------------------------------------------
                 * Sync last tags and new article, extract tags from request, break down 
                 * between new tags and tags that available in database, merge new inserted 
                 * tag id with available tags id and remove the old which is removed.
                 */

                $tag = Tag::whereIn('tag', explode(',', $request->get('tags')));

                $tags_id = $tag->pluck('id')->toArray();

                $available_tags = $tag->pluck('tag')->toArray();

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

                /*
                 * --------------------------------------------------------------------------
                 * Update the article
                 * --------------------------------------------------------------------------
                 * Finally populate article data like create process and check if featured
                 * need to change and upload the image then update the changes.
                 */

                $autoApprove = Setting::whereKey('Auto Approve')->first();
                $content = $article->content;
                $content_update = $request->input('content');
                $status = $request->input('status');

                if ($autoApprove->value) {
                    $content = $request->input('content');
                    $content_update = '';
                    if ($status == 'pending') {
                        $status = 'published';
                    }
                }

                $article->subcategory_id = $request->input('subcategory_id');
                $article->title = $request->input('title');
                $article->slug = $request->input('slug');
                $article->type = $request->input('type');
                $article->content = $content;
                $article->content_update = $content_update;
                $article->excerpt = $request->input('excerpt');
                $article->status = $status;

                $image = new Uploader();
                if ($image->upload($request, 'featured', base_path('public/images/featured/'), 'featured_' . uniqid())) {
                    $article->featured = $request->input('featured');
                }

                $article->save();

                $contributor = Contributor::findOrFail($request->input('contributor_id'));

                Activity::create([
                    'contributor_id' => $contributor->id,
                    'activity' => Activity::updateArticleActivity($contributor->username, $article->title, $article->slug)
                ]);

                if (!$autoApprove->value) {
                    $articleController->sendAdminArticleNotification($contributor, $article, true);
                }

                return response()->json([
                    'request_id' => uniqid(),
                    'status' => 'success',
                    'message' => 'Article was updated',
                    'auto_approve' => $autoApprove->value,
                    'timestamp' => Carbon::now(),
                ]);

            } catch (\Exception $e) {
                return response()->json([
                    'request_id' => uniqid(),
                    'status' => 'failure',
                    'message' => Lang::get('alert.error.transaction'),
                    'timestamp' => Carbon::now(),
                ], 500);
            }
        });

        return $result;
    }

    /**
     * Remove the specified article from storage.
     *
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $article = Article::whereSlug($slug)->firstOrFail();

        if ($article->delete()) {
            return response()->json([
                'request_id' => uniqid(),
                'status' => 'success',
                'message' => 'Article was deleted',
                'timestamp' => Carbon::now(),
            ]);
        }

        return response()->json([
            'request_id' => uniqid(),
            'status' => 'failure',
            'message' => Lang::get('alert.error.generic'),
            'timestamp' => Carbon::now(),
        ], 500);
    }
}

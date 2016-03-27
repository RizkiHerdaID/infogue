<?php

namespace Infogue\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Infogue\Article;
use Infogue\Contributor;
use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;
use Infogue\Rating;
use Infogue\Uploader;

class ArticleController extends Controller
{
    private $article;

    public function __construct(Article $article)
    {
        //$this->middleware('auth:api', ['except' => 'show']);

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
        $tags_list = explode(',', $request->get('tags'));

        // get all tags which already exist with tags are given
        $tag = Tag::whereIn('tag', $tags_list);

        // merge tags which exist into tags_id
        $tags_id = $tag->pluck('id')->toArray();

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
        $article->contributor_id = $request->input('contributor_id');
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

        $save = $article->save();

        Article::find($article->id)->tags()->attach($tags_id);

        $this->sendEmailNotification($request->input('contributor_id'), $article);

        return $save;
    }

    public function sendEmailNotification($contributor_id, $article)
    {
        $contributor = Contributor::findOrFail($contributor_id);

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
                    $message->from('no-reply@infogue.id', 'Infogue.id');

                    $message->replyTo('no-reply@infogue.id', 'Infogue.id');

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
        $article = Article::findOrFail($request->input('id'));

        $article->increment('view');

        return [
            'request_id' => uniqid(),
            'status' => 'success',
            'timestamp' => Carbon::now(),
        ];
    }

    /**
     * Rate a article between 1 to 5.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function rate(Request $request)
    {
        $article = Article::findOrFail($request->input('article_id'));

        $ipAddress = $request->ip();

        $isRated = $article->ratings()->whereIp($ipAddress)->count();

        if ($isRated) {
            $rating = Rating::whereArticleId($request->input('article_id'))->whereIp($ipAddress)->firstOrFail();
            $rating->rate = $request->input('rate');
        } else {
            $rating = new Rating();
            $rating->article_id = $request->input('article_id');
            $rating->ip = $ipAddress;
            $rating->rate = $request->input('rate');
        }

        return [
            'request_id' => uniqid(),
            'status' => $rating->save() ? 'success' : 'failure',
            'timestamp' => Carbon::now(),
        ];
    }

    /**
     * Display the specified article.
     *
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $article = $this->article
            ->whereSlug($slug)
            ->with('subcategory', 'subcategory.category', 'tags', 'contributor')
            ->firstOrFail();

        $article->rating = round($article->ratings()->avg('rate'));

        return [
            'request_id' => uniqid(),
            'status' => 'success',
            'timestamp' => Carbon::now(),
            'article' => $article
        ];
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
        $article = Article::whereSlug($slug)->firstOrFail();

        $tags_list = explode(',', $request->get('tags'));

        // get all tags which already exist with tags are given
        $tag = Tag::whereIn('tag', $tags_list);

        // merge tags which exist into tags_id
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
        $article->content_update = $request->input('content');
        $article->excerpt = $request->input('excerpt');
        $article->status = $request->input('status');

        $image = new Uploader();
        if ($image->upload($request, 'featured', base_path('public/images/featured/'), rand(0, 1000) . uniqid())) {
            $article->featured = $request->input('featured');
        }

        return $article->save();
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

        return $article->delete();
    }
}

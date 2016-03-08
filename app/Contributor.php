<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Contributor extends Authenticatable
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $hidden = ['password', 'deleted_at', 'remember_token'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('latest', function(Builder $builder) {
            $builder->orderBy('contributors.created_at', 'desc');
        });
    }

    public function scopeActivated($query)
    {
        return $query->where('contributors.status', 'activated');
    }

    public function activities()
    {
        return $this->hasMany('Infogue\Activity');
    }

    public function messages()
    {
        return $this->hasMany('Infogue\Message', 'from');
    }

    public function articles()
    {
        return $this->hasMany('Infogue\Article');
    }

    public function retrieveContributor($by, $sort, $query = null){
        $contributor = $this->select(DB::raw('contributors.*, IFNULL(follower_total, 0) AS follower_total, IFNULL(article_total, 0) AS article_total'))
            ->leftJoin(DB::raw("(SELECT followers.id, following, COUNT(*) AS follower_total FROM followers GROUP BY following) followers"), 'contributors.id', '=', 'followers.following')
            ->leftJoin(DB::raw("(SELECT articles.id, contributor_id, COUNT(*) AS article_total FROM articles GROUP BY contributor_id) articles"), 'contributors.id', '=', 'articles.contributor_id')
            ->groupBy('contributors.id');

        if($query != null && $query != ''){
            $contributor->where('username', 'like', "%{$query}%")
                ->orWhere('name', 'like', "%{$query}%")
                ->orWhere('email', 'like', "%{$query}%")
                ->orWhere('location', 'like', "%{$query}%");
        }

        if($by == 'date'){
            $contributor->orderBy('created_at', $sort);
        }
        else if($by == 'name'){
            $contributor->orderBy('name', $sort);
        }
        else if($by == 'popularity'){
            $contributor->orderBy('follower_total', $sort);
        }
        else if($by == 'article'){
            $contributor->orderBy('article_total', $sort);
        }

        return $contributor->paginate(10);
    }

    public function contributorArticle($username)
    {
        $contributor = $this->whereUsername($username)->first();

        $contributor_article = $contributor->articles()->select('articles.id')->pluck('articles.id')->toArray();

        $article = new Article();

        $articles = $article->preArticleQuery()
            ->whereIn('articles.id', $contributor_article)
            ->where('articles.status', 'published')
            ->paginate(10);

        return $article->preArticleModifier($articles);
    }

    public function followers()
    {
        return $this->hasMany('Infogue\Follower', 'following');
    }

    public function contributorFollower($username)
    {
        $contributor = $this->whereUsername($username)->first();

        $follower = $contributor->followers()->pluck('contributor_id')->toArray();

        $contributors = $this->relatedFollowers()
            ->whereIn('contributors.id', $follower)
            ->paginate(10);

        return $this->preContributorModifier($contributors);
    }

    public function following()
    {
        return $this->hasMany('Infogue\Follower');
    }

    public function contributorFollowing($username)
    {
        $contributor = $this->whereUsername($username)->first();

        $following = $contributor->following()->pluck('following')->toArray();

        $contributors = $this->relatedFollowers()
            ->whereIn('contributors.id', $following)
            ->paginate(10);

        return $this->preContributorModifier($contributors);
    }

    public function profile($username, $activated = false)
    {
        if($activated){
            $profile = $this->relatedFollowers()->activated()->whereUsername($username)->firstOrFail();
        }
        else{
            $profile = $this->relatedFollowers()->whereUsername($username)->firstOrFail();
        }

        return $this->preContributorModifier([$profile])[0];
    }

    public function relatedFollowers()
    {
        $id = 0;

        if (Auth::check()) {
            $id = Auth::id();
        }

        return $this->select(DB::raw('contributors.*, CASE WHEN following IS NULL THEN 0 ELSE 1 END AS is_following'))
            ->leftJoin(DB::raw("(SELECT following FROM followers WHERE contributor_id = {$id}) followings"), 'contributors.id', '=', 'followings.following');
    }

    public function stream($username)
    {
        $contributor = $this->whereUsername($username)->first();

        $follow = $contributor->following()->select('following')->pluck('following')->toArray();

        $article = new Article();

        $articles = $article->preArticleQuery()->published()
            ->whereIn('contributor_id', $follow)
            ->paginate(10);

        return $article->preArticleModifier($articles);
    }

    public function preContributorModifier($contributors)
    {
        foreach ($contributors as $contributor):

            $contributor->location = (empty($contributor->location)) ? 'No Location' : $contributor->location;
            $contributor->about = (empty($contributor->about)) ? 'No Description' : $contributor->about;
            $contributor->contributor_ref = route('contributor.stream', [$contributor->username]);
            $contributor->avatar_ref = asset("images/contributors/{$contributor->avatar}");
            $contributor->following_status = ($contributor->is_following) ? 'btn-unfollow active' : 'btn-follow';
            $contributor->following_text = ($contributor->is_following) ? 'UNFOLLOW' : 'FOLLOW';

        endforeach;

        return $contributors;
    }

    public function search($query, $take = 10)
    {
        $result = $this->relatedFollowers()->activated()
            ->where('username', 'like', "%{$query}%")
            ->orWhere('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->orWhere('location', 'like', "%{$query}%")
            ->paginate($take);

        return $this->preContributorModifier($result);
    }
}

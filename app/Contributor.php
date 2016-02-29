<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Contributor extends Authenticatable
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $hidden = ['password', 'deleted_at'];

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

    public function contributor_following($username)
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

        $articles = $article->preArticleQuery()
            ->whereIn('articles.id', $follow)
            ->paginate(10);

        return $article->preArticleModifier($articles);
    }

    public function preContributorModifier($contributors)
    {
        foreach ($contributors as $contributor):

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
            ->paginate($take);

        return $this->preContributorModifier($result);
    }
}

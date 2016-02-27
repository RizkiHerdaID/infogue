<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Contributor extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $hidden = ['password', 'deleted_at'];

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

    public function profile($username)
    {
        $profile = $this->relatedFollowers()->whereUsername($username)->firstOrFail();

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
}

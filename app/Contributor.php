<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Contributor extends Authenticatable
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'deleted_at', 'remember_token'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('latest', function (Builder $builder) {
            $builder->orderBy('contributors.created_at', 'desc');
        });
    }

    /**
     * Additional query scope, select activated contributor only.
     *
     * @param $query
     * @return mixed
     */
    public function scopeActivated($query)
    {
        return $query->where('contributors.status', 'activated');
    }

    /**
     * One-to-many relationship, retrieve activities by contributor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activities()
    {
        return $this->hasMany('Infogue\Activity');
    }

    /**
     * One-to-many relationship, retrieve comments by contributor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('Infogue\Comment');
    }

    /**
     * One-to-many relationship, retrieve messages by contributor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany('Infogue\Message', 'from');
    }

    /**
     * One-to-many relationship, retrieve articles by contributor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany('Infogue\Article');
    }

    /**
     * One-to-many relationship, retrieve followers by contributor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function followers()
    {
        return $this->hasMany('Infogue\Follower', 'following');
    }

    /**
     * One-to-many relationship, retrieve following by contributor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function following()
    {
        return $this->hasMany('Infogue\Follower');
    }

    /**
     * Retrieve top of similarity name or username with query and take 10 data.
     *
     * @param $query keyword of name or username
     * @return Collection
     */
    public function suggestion($query)
    {
        $suggestion = $this->activated()
            ->select("id", "username", "name", "avatar")
            ->where('username', 'like', "%{$query}%")
            ->orWhere('name', 'like', "%{$query}%")
            ->take(10)
            ->get();
        return $suggestion;
    }

    /**
     * Retrieve all contributor with filter, use in admin page.
     *
     * @param $by
     * @param $sort
     * @param null $query
     * @return mixed
     */
    public function retrieveContributor($by, $sort, $query = null)
    {
        $contributor = $this->select(DB::raw('contributors.*, IFNULL(follower_total, 0) AS follower_total, IFNULL(article_total, 0) AS article_total'))
            ->leftJoin(DB::raw("(SELECT followers.id, following, COUNT(*) AS follower_total FROM followers GROUP BY following) followers"), 'contributors.id', '=', 'followers.following')
            ->leftJoin(DB::raw("(SELECT articles.id, contributor_id, COUNT(*) AS article_total FROM articles GROUP BY contributor_id) articles"), 'contributors.id', '=', 'articles.contributor_id')
            ->groupBy('contributors.id');

        /*
         * --------------------------------------------------------------------------
         * Searching
         * --------------------------------------------------------------------------
         * Check if query passed as param and is not empty, try guess similarity by
         * name, email, location.
         */

        if ($query != null && $query != '') {
            $contributor->where('username', 'like', "%{$query}%")
                ->orWhere('name', 'like', "%{$query}%")
                ->orWhere('email', 'like', "%{$query}%")
                ->orWhere('location', 'like', "%{$query}%");
        }

        /*
         * --------------------------------------------------------------------------
         * Sorting the data
         * --------------------------------------------------------------------------
         * Just simply data order, sort by date, name, popularity in ascending,
         * descending or shuffle list.
         */

        if ($by == 'date') {
            $contributor->orderBy('created_at', $sort);
        } else if ($by == 'name') {
            $contributor->orderBy('name', $sort);
        } else if ($by == 'popularity') {
            $contributor->orderBy('follower_total', $sort);
        } else if ($by == 'article') {
            $contributor->orderBy('article_total', $sort);
        }

        return $contributor->paginate(10);
    }

    /**
     * Retrieve article by contributor.
     *
     * @param $username
     * @return mixed
     */
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

    /**
     * Retrieve follower by contributor and check if the are users have followed.
     *
     * @param $username
     * @param null $contributor_id
     * @return mixed
     */
    public function contributorFollower($username, $contributor_id = null, $includeStatistic = false)
    {
        $contributor = $this->whereUsername($username)->first();

        $follower = $contributor->followers()->pluck('contributor_id')->toArray();

        $contributors = $this->relatedFollowers($contributor_id)
            ->whereIn('contributors.id', $follower)
            ->paginate(10);

        return $this->preContributorModifier($contributors, $includeStatistic);
    }

    /**
     * Retrieve following by contributor and check if the are users have followed.
     *
     * @param $username
     * @param null $contributor_id
     * @return mixed
     */
    public function contributorFollowing($username, $contributor_id = null, $includeStatistic = false)
    {
        $contributor = $this->whereUsername($username)->first();

        $following = $contributor->following()->pluck('following')->toArray();

        $contributors = $this->relatedFollowers($contributor_id)
            ->whereIn('contributors.id', $following)
            ->paginate(10);

        return $this->preContributorModifier($contributors, $includeStatistic);
    }

    /**
     * Retrieve contributor profile.
     *
     * @param $username
     * @param bool|false $activated
     * @param null $contributor_id
     * @param bool $includeStatistic
     * @return mixed
     */
    public function profile($username, $activated = false, $contributor_id = null, $includeStatistic = false)
    {
        if ($activated) {
            $profile = $this->relatedFollowers($contributor_id)
                ->activated()->whereUsername($username)->firstOrFail();
        } else {
            $profile = $this->relatedFollowers($contributor_id)
                ->whereUsername($username)->firstOrFail();
        }

        return $this->preContributorModifier([$profile], $includeStatistic)[0];
    }

    /**
     * Check if authenticate user has follow another contributor in list of selection.
     *
     * @param null $id_contributor
     * @return mixed
     */
    public function relatedFollowers($id_contributor = null)
    {
        $id = 0;

        if (Auth::check()) {
            $id = Auth::id();
        }

        if ($id_contributor != null) {
            $id = $id_contributor;
        }

        return $this->select(DB::raw('contributors.*, CASE WHEN following IS NULL THEN 0 ELSE 1 END AS is_following'))
            ->leftJoin(DB::raw("(SELECT following FROM followers WHERE contributor_id = {$id}) followings"), 'contributors.id', '=', 'followings.following');
    }

    /**
     * Retrieve stream by contributor.
     *
     * @param $username
     * @return mixed
     */
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

    /**
     * Modifying contributor data for javascript template.
     *
     * @param $contributors
     * @param bool $includeStatistic
     * @return mixed
     */
    public function preContributorModifier($contributors, $includeStatistic = false)
    {
        foreach ($contributors as $contributor):

            $contributor->location = (empty($contributor->location)) ? 'No Location' : $contributor->location;
            $contributor->about = (empty($contributor->about)) ? 'No Description' : $contributor->about;
            $contributor->contributor_ref = route('contributor.stream', [$contributor->username]);
            $contributor->avatar_ref = asset("images/contributors/{$contributor->avatar}");
            $contributor->cover_ref = asset("images/covers/{$contributor->cover}");
            $contributor->following_status = ($contributor->is_following) ? 'btn-unfollow active' : 'btn-follow';
            $contributor->following_text = ($contributor->is_following) ? 'UNFOLLOW' : 'FOLLOW';

            if ($includeStatistic) {
                $contributor->article_total = $contributor->articles()->where('status', 'published')->count();
                $contributor->followers_total = $contributor->followers()->count();
                $contributor->following_total = $contributor->following()->count();
            }

        endforeach;

        return $contributors;
    }

    /**
     * Search contributor by query, use in public page.
     *
     * @param $query
     * @param int $take
     * @param bool $includeStatistic
     * @param null $id_contributor
     * @return mixed
     */
    public function search($query, $take = 10, $includeStatistic = false, $id_contributor = null)
    {
        $result = $this->relatedFollowers($id_contributor)->activated()
            ->where('username', 'like', "%{$query}%")
            ->orWhere('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->orWhere('location', 'like', "%{$query}%")
            ->paginate($take);

        return $this->preContributorModifier($result, $includeStatistic);
    }
}

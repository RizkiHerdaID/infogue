<?php

namespace Infogue;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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
    protected $hidden = ['deleted_at'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('latest', function (Builder $builder) {
            $builder->orderBy('articles.updated_at', 'desc');
        });
    }

    /**
     * Additional query scope, select published article only.
     *
     * @param $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where('articles.status', 'published');
    }

    /**
     * Many-to-one relationship, article author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contributor()
    {
        return $this->belongsTo('Infogue\Contributor');
    }

    /**
     * Many-to-one relationship, article subcategory.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subcategory()
    {
        return $this->belongsTo('Infogue\Subcategory');
    }

    /**
     * One-to-many relationship article comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('Infogue\Comment')
            ->selectRaw('comments.id, article_id, contributor_id, username, name, email, comment, CONCAT(\''.asset("images/contributors").'\', \'/\', avatar) AS avatar, comments.created_at')
            ->join('contributors', 'contributor_id', '=', 'contributors.id');
    }

    /**
     * Retrieve accumulation of article rating.
     *
     * @return mixed
     */
    public function rating()
    {
        return $this->hasOne('Infogue\Rating')
            ->selectRaw('IFNULL(ROUND(AVG(ratings.rate)), 0) AS total_rating')
            ->groupBy('article_id');
    }

    /**
     * One-to-many relationship article rating.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings()
    {
        return $this->hasMany('Infogue\Rating');
    }

    /**
     * Many-to-many relationship, article tags.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('Infogue\Tag', 'article_tags')->withTimestamps();
    }

    /**
     * Find out if an article related to another.
     *
     * @param $id
     * @return mixed
     */
    public function related($id)
    {
        /*
         * --------------------------------------------------------------------------
         * Populate related article by tags
         * --------------------------------------------------------------------------
         * Retrieve article tags by article id, the idea of related article is
         * comparing article tags with another so this part is try to collect array
         * of article tags id and take top 5 with similar tags.
         */

        $tags = $this->published()
            ->join('article_tags', 'articles.id', '=', 'article_id')
            ->join('tags', 'tags.id', '=', 'tag_id')
            ->where('articles.id', $id)
            ->pluck('tags.id')->toArray();

        $related = $this->published()
            ->select('articles.id', 'title', 'slug', 'content', 'view', 'featured', 'articles.created_at')
            ->join('article_tags', 'articles.id', '=', 'article_id')
            ->join('tags', 'tags.id', '=', 'tag_id')
            ->groupBy('articles.id')
            ->whereIn('tags.id', $tags)
            ->where('articles.id', '!=', $id)
            ->take(5)
            ->get();

        return $related;
    }

    /**
     * Find out most popular article in last 3 months with most viewed.
     *
     * @param int $take
     * @return mixed
     */
    public function mostPopular($take = 10)
    {
        $popular = $this->preArticleQuery()->published()
            ->where('articles.updated_at', '>', Carbon::now()->addMonth(-3))
            ->orderBy('view', 'desc')
            ->take($take)
            ->get();

        return $this->preArticleModifier($popular);
    }

    /**
     * Find out most ranked article in passed a year.
     *
     * @return mixed
     */
    public function mostRanked()
    {
        $ranking = $this->published()
            ->select(DB::raw('articles.id, slug, title, CAST(SUM(ratings.rate) AS UNSIGNED) AS total_rating'))
            ->where('articles.created_at', '>', Carbon::now()->addYear(-1))
            ->leftJoin('ratings', 'articles.id', '=', 'ratings.article_id')
            ->groupBy('articles.id')
            ->orderBy('total_rating', 'desc')
            ->take(10)
            ->get();

        return $ranking;
    }

    /**
     * Select article where state is headline.
     *
     * @param bool|true $is_featured
     * @return mixed
     */
    public function headline($is_featured = true)
    {
        if ($is_featured) {
            $headline = $this->published()->where('state', 'headline')->take(4)->get();
        } else {
            $articles = $this->preArticleQuery()->published()->where('state', 'headline')->paginate(9);

            $headline = $this->preArticleModifier($articles);
        }

        return $headline;
    }

    /**
     * Select article where state is trending.
     *
     * @param bool|true $is_featured
     * @return mixed
     */
    public function trending($is_featured = true)
    {
        if ($is_featured) {
            $trending = $this->published()->where('state', 'trending')->take(4)->get();
        } else {
            $articles = $this->preArticleQuery()->published()->where('state', 'trending')->paginate(9);

            $trending = $this->preArticleModifier($articles);
        }

        return $trending;
    }

    /**
     * Retrieve published latest article.
     *
     * @param bool|true $is_featured
     * @return mixed
     */
    public function latest($is_featured = true)
    {
        if ($is_featured) {
            $trending = $this->select('id')
                ->published()
                ->where('state', 'trending')
                ->take(4)
                ->pluck('id')->toArray();

            $latest = $this->published()->whereNotIn('id', $trending)->take(4)->get();
        } else {
            $articles = $this->preArticleQuery()->published()->paginate(9);

            $latest = $this->preArticleModifier($articles);
        }

        return $latest;
    }

    /**
     * Retrieve random article, it can be infinity.
     *
     * @return mixed
     */
    public function random()
    {
        $articles = $this->preArticleQuery()->orderByRaw("RAND()")->published()->paginate(9);

        $random = $this->preArticleModifier($articles);

        return $random;
    }

    /**
     * Retrieve all published article as archive or by contributor.
     *
     * @param $data
     * @param $by
     * @param $sort
     * @param null $contributor
     * @return mixed
     */
    public function archive($data, $by, $sort, $contributor = null)
    {
        $archive = $this->preArticleQuery();

        /*
         * --------------------------------------------------------------------------
         * Type archive
         * --------------------------------------------------------------------------
         * Select archive by contributor or select all article archive, contributor
         * archive use in show article on contributor profile.
         */

        if ($contributor == null) {
            $archive->published();
        } else {
            $archive->where('contributor_id', $contributor);
        }

        /*
         * --------------------------------------------------------------------------
         * Data filtering
         * --------------------------------------------------------------------------
         * Filter data by state, category, article, otherwise do not add criteria
         * or condition.
         */

        if ($data == 'trending') {
            $archive->where('state', 'trending');
        } else if ($data == 'popular') {
            $archive->where('articles.created_at', '>', Carbon::now()->addMonth(-3))->orderBy('view', 'desc');
        } else if ($data == 'headline') {
            $archive->where('state', 'headline');
        } else if ($data != 'all-data') {
            $archive->where('category', 'like', "%{$data}%");
        }

        /*
         * --------------------------------------------------------------------------
         * Sorting the data
         * --------------------------------------------------------------------------
         * Just simply data order, sort by date, title, star, view in ascending,
         * descending or shuffle list.
         */

        if ($sort == 'random') {
            $archive->orderByRaw("RAND()");
        } else {
            $sort_by = $by;

            if ($by == 'date') {
                $sort_by = 'created_at';
            } else if ($by == 'star') {
                $sort_by = 'total_rating';
            }

            $archive->orderBy($sort_by, $sort);
        }

        return $this->preArticleModifier($archive->paginate(12));
    }

    /**
     * Retrieve all article without published scope use in admin page.
     *
     * @param $data
     * @param $status
     * @param $by
     * @param $sort
     * @param null $query
     * @return mixed
     */
    public function retrieveArticle($data, $status, $by, $sort, $query = null)
    {
        $articles = $this->preArticleQuery();

        /*
         * --------------------------------------------------------------------------
         * Searching
         * --------------------------------------------------------------------------
         * Check if query passed as param and is not empty, try guess similarity by
         * title, name of author, category name, subcategory name, or even the
         * content itself.
         */

        if ($query != null && $query != '') {
            $articles
                ->where('title', 'like', "%{$query}%")
                ->orWhere('name', 'like', "%{$query}%")
                ->orWhere('category', 'like', "%{$query}%")
                ->orWhere('subcategory', 'like', "%{$query}%")
                ->orWhere('content', 'like', "%{$query}%");
        }

        /*
         * --------------------------------------------------------------------------
         * Status filter
         * --------------------------------------------------------------------------
         * Except all status filter find article by certain status.
         */

        if ($status != 'all') {
            $articles->where('articles.status', $status);
        }

        /*
         * --------------------------------------------------------------------------
         * Kind of data
         * --------------------------------------------------------------------------
         * Data filter like in archive filter, select data by state, category,
         * article, otherwise do not add criteria or condition.
         */

        if ($data == 'trending') {
            $articles->where('state', 'trending');
        } else if ($data == 'popular') {
            $articles->where('articles.created_at', '>', Carbon::now()->addMonth(-3))->orderBy('view', 'desc');
        } else if ($data == 'headline') {
            $articles->where('state', 'headline');
        } else if ($data != 'all') {
            $articles->where('category', 'like', "%{$data}%");
        }

        /*
         * --------------------------------------------------------------------------
         * Sorting the data
         * --------------------------------------------------------------------------
         * Just simply data order, sort by date, title, author, star, view in
         * ascending, descending or shuffle list.
         */

        if ($by == 'date') {
            $articles->orderBy('articles.updated_at', $sort);
        } else if ($by == 'title') {
            $articles->orderBy('title', $sort);
        } else if ($by == 'view') {
            $articles->orderBy('view', $sort);
        } else if ($by == 'author') {
            $articles->orderBy('name', $sort);
        } else if ($by == 'popularity') {
            $articles->orderBy('total_rating', $sort);
        }

        return $this->preArticleModifier($articles->paginate(10));
    }

    /**
     * Search article by query, use in public page.
     *
     * @param $query
     * @param int $take
     * @return mixed
     */
    public function search($query, $take = 10)
    {
        $result = $this->preArticleQuery()->published()
            ->where('title', 'like', "%{$query}%")
            ->orWhere('category', 'like', "%{$query}%")
            ->orWhere('subcategory', 'like', "%{$query}%")
            ->orWhere('content', 'like', "%{$query}%")
            ->groupBy('articles.id')
            ->paginate($take);

        return $this->preArticleModifier($result);
    }

    /**
     * Build basic of article select query.
     *
     * @return mixed
     */
    public function preArticleQuery()
    {
        return $this->select(
            DB::raw('
                    articles.id,
                    slug,
                    title,
                    content,
                    content_update,
                    featured,
                    view,
                    articles.status AS status,
                    state,
                    contributor_id,
                    name,
                    username,
                    avatar,
                    CAST(IFNULL(ROUND(AVG(ratings.rate)), 0) AS UNSIGNED) AS total_rating,
                    subcategory_id,
                    subcategory,
                    category_id,
                    category,
                    articles.created_at,
                    articles.updated_at'
            )
        )
            ->join('subcategories', 'subcategories.id', '=', 'subcategory_id')
            ->join('categories', 'categories.id', '=', 'category_id')
            ->join('contributors', 'contributors.id', '=', 'contributor_id')
            ->leftJoin('ratings', 'articles.id', '=', 'article_id')
            ->groupBy('articles.id');
    }

    /**
     * Article modifier needed for javascript template.
     *
     * @param $articles
     * @return mixed
     */
    public function preArticleModifier($articles)
    {
		include "simple_html_dom.php";
		
        foreach ($articles as $article):

            $content = strip_tags($article->content);
            $content_update = strip_tags($article->content_update);

            $article->featured_ref = asset('images/featured/' . $article->featured);
            $article->article_ref = route('article.show', [$article->slug]);
            $article->contributor_ref = route('contributor.stream', [$article->username]);
            $article->avatar_ref = asset('images/contributors/' . $article->avatar);
            $article->category_ref = route('article.category', [str_slug($article->category)]);
            $article->subcategory_ref = route('article.subcategory', [str_slug($article->category), str_slug($article->username)]);
            $article->published_at = Carbon::parse($article->created_at)->format('d F Y');
            $article->content = ucfirst(strtolower(str_limit(preg_replace('/\s\s+/', ' ', trim(preg_replace("/&#?[a-z0-9]+;/i", " ", $content))), 160)));
			$article->content_update = ucfirst(strtolower(str_limit(preg_replace('/\s\s+/', ' ', trim(preg_replace("/&#?[a-z0-9]+;/i", " ", $content_update))), 160)));
            
        endforeach;

        return $articles;
    }

    /**
     * Find out if there is next or previous article from current article id.
     *
     * @param $id
     * @param $direction
     * @param int $total
     * @return mixed
     */
    public function navigateArticle($id, $direction, $total = 1)
    {
        if ($direction == 'prev') {
            $article = $this->published()->where('id', '<', $id)->orderBy('id', 'desc')->take($total);
        } else {
            $article = $this->published()->where('id', '>', $id)->orderBy('id', 'asc')->take($total);
        }

        if ($total > 1) {
            $article = $article->get();
        } else {
            $article = $article->first();
        }

        return $article;
    }

    public function broadcastArticle($article)
    {
        $article->featured_ref = asset('images/featured/' . $article->featured);

        $headers = array(
            'Authorization: key=' . env('GCM_KEY'),
            'Content-Type: application/json'
        );

        $data = [
            "to" => "/topics/article",
            "notification" => [
                "body" => $article->title,
                "title" => "Infogue Update",
				"icon" => "ic_whatshot"
            ],
			"data" => [
                "message" => "New article "+$article->title,
                "id" => $article->id,
                "title" => $article->title,
                "slug" => $article->slug,
                "featured_ref" => $article->featured_ref,
            ]
        ];

        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, env('GCM_URL'));

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarily
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            // die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

        return $result;
    }
}
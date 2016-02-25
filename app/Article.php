<?php

namespace Infogue;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('latest', function(Builder $builder) {
            $builder->orderBy('articles.created_at', 'desc');
        });
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function contributor()
    {
        return $this->belongsTo('Infogue\Contributor', 'author');
    }

    public function subcategory()
    {
        return $this->belongsTo('Infogue\Subcategory', 'label');
    }

    public function rating()
    {
        return $this->hasOne('Infogue\Rating')
            ->selectRaw('ROUND(AVG(ratings.rate)) AS total_rating')
            ->groupBy('article_id');
    }

    public function tags()
    {
        return $this->belongsToMany('Infogue\Tag', 'article_tags')->withTimestamps();
    }

    public function related($id)
    {
        $tags = $this->published()
            ->select(DB::raw("group_concat(tags.id separator ',') as tag_list"))
            ->join('article_tags', 'articles.id', '=', 'article_id')
            ->join('tags', 'tags.id', '=', 'tag_id')
            ->where('articles.id', $id)
            ->first()['tag_list'];

        $related = $this->published()
            ->select('articles.id', 'title', 'slug', 'content', 'view', 'articles.created_at')
            ->join('article_tags', 'articles.id', '=', 'article_id')
            ->join('tags', 'tags.id', '=', 'tag_id')
            ->whereIn('tags.id', explode(',', $tags))
            ->where('articles.id', '!=', $id)
            ->take(10)
            ->get();

        return $related;
    }

    public function most_popular()
    {
        $popular = $this->published()
            ->select('id', 'slug', 'title', 'view')
            ->where('created_at', '>', Carbon::now()->addMonth(-3))
            ->orderBy('view', 'desc')
            ->take(10)
            ->get();

        return $popular;
    }

    public function most_ranked()
    {
        $ranking = $this->published()
            ->select(DB::raw('articles.id, slug, title, sum(ratings.rate) as total_rating'))
            ->where('articles.created_at', '>', Carbon::now()->addYear(-1))
            ->leftJoin('ratings', 'articles.id', '=', 'ratings.article_id')
            ->groupBy('articles.id')
            ->orderBy('total_rating', 'desc')
            ->take(10)
            ->get();

        return $ranking;
    }

    public function headline($is_featured = true)
    {
        if($is_featured){
            $headline = $this->published()->where('state', 'headline')->take(4)->get();
        }
        else{
            $headline = $this->published()->where('state', 'headline')->paginate(10);
        }

        return $headline;
    }

    public function trending($is_featured = true)
    {
        if($is_featured){
            $trending = $this->published()->where('state', 'trending')->take(4)->get();
        }
        else{
            $trending = $this->published()->where('state', 'trending')->paginate(10);
        }

        return $trending;
    }

    public function latest($is_featured = true)
    {
        if($is_featured){
            $trending = $this->select('id')
                ->published()
                ->where('state', 'trending')
                ->take(3)
                ->pluck('id')->toArray();

            $latest = $this->published()->whereNotIn('id', $trending)->take(4)->get();
        }
        else{
            $latest = $this->published()->paginate(10);
        }

        return $latest;
    }

    public function archive()
    {
        $archive = $this->published()->paginate(10);

        return $archive;
    }

    public function search($query)
    {
        $result = $this->select(
            DB::raw('
                articles.id,
                slug,
                title,
                SUBSTR(content, 400),
                featured,
                author,
                label,
                category,
                subcategory
                articles.created_at')
            )
            ->join('subcategory', 'subcategories.id', '=', 'label')
            ->join('category', 'categories.id', '=', 'category_id')
            ->where('title', 'like', "%{$query}%")
            ->orWhere('category', 'like', "%{$query}%")
            ->orWhere('subcategory', 'like', "%{$query}%")
            ->orWhere('content', 'like', "%{$query}%")
            ->groupBy('articles.id')
            ->paginate(10);

        return $result;
    }
}

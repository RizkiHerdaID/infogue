<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = array('pivot');

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tag'];

    /**
     * Many-to-many relationship, find out a tag is used in articles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany('Infogue\Article', 'article_tags')->withTimestamps();
    }

    /**
     * Retrieve articles by tag.
     *
     * @param $tag
     * @return mixed
     */
    public function tagArticle($tag)
    {
        $article = new Article();

        $articles = $article->preArticleQuery()
            ->join('article_tags', 'articles.id', '=', 'article_tags.article_id')
            ->join('tags', 'tags.id', '=', 'tag_id')
            ->where('tags.tag', 'like', $tag)
            ->where('articles.status', 'published')
            ->orderBy('articles.created_at', 'desc')
            ->paginate(12);

        return $article->preArticleModifier($articles);
    }
}

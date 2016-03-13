<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['tag'];

    public function articles()
    {
        $this->belongsToMany('Infogue\Article', 'article_tags')->withTimestamps();
    }

    public function tagArticle($tag)
    {
        $article = new Article();

        $articles = $article->preArticleQuery()
            ->join('article_tags', 'articles.id', '=', 'article_tags.article_id')
            ->join('tags', 'tags.id', '=', 'tag_id')
            ->where('tags.tag', 'like', $tag)
            ->where('articles.status', 'published')
            ->orderBy('articles.created_at', 'desc')
            ->paginate(9);

        return $article->preArticleModifier($articles);
    }
}

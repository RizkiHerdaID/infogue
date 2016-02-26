<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = ['subcategory', 'description'];

    private $article;

    public function subcategory_article($id)
    {
        $this->article = new Article();

        $articles = $this->article->preArticleQuery()
            ->where('articles.status', 'published')
            ->where('subcategory_id', $id)
            ->orderBy('articles.created_at', 'desc')
            ->paginate(9);

        return $this->article->preArticleModifier($articles);
    }

    public function articles()
    {
        return $this->hasMany('Infogue\Article');
    }

    public function category()
    {
        return $this->belongsTo('Infogue\Category');
    }
}

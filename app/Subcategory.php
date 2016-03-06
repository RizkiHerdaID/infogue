<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = ['subcategory', 'description'];

    protected $hidden = ['created_at', 'updated_at'];

    private $article;

    public function subcategoryArticle($id)
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

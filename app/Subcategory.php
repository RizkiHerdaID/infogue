<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['category_id', 'subcategory', 'label', 'description'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Retrieve articles by subcategory.
     *
     * @param $id
     * @return mixed
     */
    public function subcategoryArticle($id)
    {
        $article = new Article();

        $articles = $article->preArticleQuery()
            ->where('articles.status', 'published')
            ->where('subcategory_id', $id)
            ->orderBy('articles.updated_at', 'desc')
            ->paginate(12);

        return $article->preArticleModifier($articles);
    }

    /**
     * On-to-many relationship, retrieve articles by subcategory.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function articles()
    {
        return $this->hasMany('Infogue\Article');
    }

    /**
     * Many-to-one relationship, find out this subcategory belongs to which category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('Infogue\Category');
    }
}
<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['contributor_id', 'activity'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('latest', function (Builder $builder) {
            $builder->orderBy('activities.created_at', 'desc');
        });
    }

    /**
     * Many-to-one relationship, owner of activity record.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contributor()
    {
        return $this->belongsTo('Infogue\Contributor');
    }

    /**
     * Registration activity builder.
     *
     * @param $username
     * @param $provider
     * @return string
     */
    public static function registerActivity($username, $provider)
    {
        $template = "<a href='" . route('contributor.stream', $username) . "'>" . $username . "</a> is joining Infogue via " . $provider;
        return $template;
    }

    /**
     * Reset password activity builder.
     *
     * @param $username
     * @return string
     */
    public static function resetPasswordActivity($username)
    {
        $template = "<a href='" . route('contributor.stream', $username) . "'>" . $username . "</a> recently resetting the password";
        return $template;
    }

    /**
     * Create article activity builder.
     *
     * @param $username
     * @param $title
     * @param $slug
     * @return string
     */
    public static function createArticleActivity($username, $title, $slug)
    {
        $template = "<a href='" . route('contributor.stream', $username) . "'>" . $username . "</a> published new article <a href='" . route('article.show', $slug) . "'>" . $title . "</a>";
        return $template;
    }

    /**
     * Update article activity builder.
     *
     * @param $username
     * @param $title
     * @param $slug
     * @return string
     */
    public static function updateArticleActivity($username, $title, $slug)
    {
        $template = "<a href='" . route('contributor.stream', $username) . "'>" . $username . "</a> updated the article <a href='" . route('article.show', $slug) . "'>" . $title . "</a>";
        return $template;
    }

    /**
     * Delete article activity builder.
     *
     * @param $username
     * @param $title
     * @param $slug
     * @return string
     */
    public static function deleteArticleActivity($username, $title, $slug)
    {
        $template = "<a href='" . route('contributor.stream', $username) . "'>" . $username . "</a> updated the article <a href='" . route('article.show', $slug) . "'>" . $title . "</a>";
        return $template;
    }

    /**
     * Following activity builder.
     *
     * @param $username
     * @param $follow
     * @return string
     */
    public static function followActivity($username, $follow)
    {
        $template = "<a href='" . route('contributor.stream', $username) . "'>" . $username . "</a> now is following <a href='" . route('contributor.stream', $follow) . "'>" . $follow . "</a>";
        return $template;
    }

    /**
     * Sending message activity builder.
     *
     * @param $sender
     * @param $receiver
     * @return string
     */
    public static function sendingMessageActivity($sender, $receiver)
    {
        $template = "<a href='" . route('contributor.stream', $sender) . "'>" . $sender . "</a> sending a message to <a href='" . route('contributor.stream', $receiver) . "'>" . $receiver . "</a>";
        return $template;
    }

    /**
     * Rate article activity builder.
     *
     * @param $title
     * @param $slug
     * @param $rating
     * @return string
     */
    public static function giveRatingActivity($title, $slug, $rating)
    {
        $template = "Someone give " . $rating . " star for <a href='" . route('article.show', $slug) . "'>" . $title . "</a>";
        return $template;
    }
}
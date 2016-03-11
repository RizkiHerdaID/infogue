<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['contributor_id', 'activity'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('latest', function (Builder $builder) {
            $builder->orderBy('activities.created_at', 'desc');
        });
    }

    public function contributor()
    {
        return $this->belongsTo('Infogue\Contributor');
    }

    public static function registerActivity($username, $provider)
    {
        $template = "<a href='" . route('contributor.stream', $username) . "'>" . $username . "</a> is joining Infogue via " . $provider;
        return $template;
    }

    public static function resetPasswordActivity($username)
    {
        $template = "<a href='" . route('contributor.stream', $username) . "'>" . $username . "</a> recently resetting the password";
        return $template;
    }

    public static function createArticleActivity($username, $title, $slug)
    {
        $template = "<a href='" . route('contributor.stream', $username) . "'>" . $username . "</a> published new article <a href='" . route('article.show', $slug) . "'>" . $title . "</a>";
        return $template;
    }

    public static function updateArticleActivity($username, $title, $slug)
    {
        $template = "<a href='" . route('contributor.stream', $username) . "'>" . $username . "</a> updated the article <a href='" . route('article.show', $slug) . "'>" . $title . "</a>";
        return $template;
    }

    public static function deleteArticleActivity($username, $title, $slug)
    {
        $template = "<a href='" . route('contributor.stream', $username) . "'>" . $username . "</a> updated the article <a href='" . route('article.show', $slug) . "'>" . $title . "</a>";
        return $template;
    }

    public static function followActivity($username, $follow)
    {
        $template = "<a href='" . route('contributor.stream', $username) . "'>" . $username . "</a> now is following <a href='" . route('contributor.stream', $follow) . "'>" . $follow . "</a>";
        return $template;
    }

    public static function sendingMessageActivity($sender, $receiver)
    {
        $template = "<a href='" . route('contributor.stream', $sender) . "'>" . $sender . "</a> sending a message to <a href='" . route('contributor.stream', $receiver) . "'>" . $receiver . "</a>";
        return $template;
    }

    public static function giveRatingActivity($title, $slug, $rating)
    {
        $template = "Someone give " . $rating . " star for <a href='" . route('article.show', $slug) . "'>" . $title . "</a>";
        return $template;
    }
}

<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['contributor_id', 'activity'];

    public function contributor()
    {
        return $this->belongsTo('Infogue\Contributor');
    }

    public function registerActivity($username, $provider){
        $template = "<a href='".route('contributor.stream', $username)."'>".$username."</a> is joining Infogue via ".$provider;
        return $template;
    }

    public function resetPasswordActivity($username){
        $template = "<a href='".route('contributor.stream', $username)."'>".$username."</a> recently resetting the password";
        return $template;
    }

    public function createArticleActivity($username, $title, $slug){
        $template = "<a href='".route('contributor.stream', $username)."'>".$username."</a> published new article <a href='".route('article.show', $slug)."'>".$title."</a>";
        return $template;
    }

    public function updateArticleActivity($username, $title, $slug){
        $template = "<a href='".route('contributor.stream', $username)."'>".$username."</a> updated the article <a href='".route('article.show', $slug)."'>".$title."</a>";
        return $template;
    }

    public function deleteArticleActivity($username, $title, $slug){
        $template = "<a href='".route('contributor.stream', $username)."'>".$username."</a> updated the article <a href='".route('article.show', $slug)."'>".$title."</a>";
        return $template;
    }

    public function followActivity($username, $follow){
        $template = "<a href='".route('contributor.stream', $username)."'>".$username."</a> now is following <a href='".route('contributor.stream', $follow)."'>".$follow."</a>";
        return $template;
    }

    public function sendingMessageActivity($sender, $receiver){
        $template = "<a href='".route('contributor.stream', $sender)."'>".$sender."</a> sending a message to <a href='".route('contributor.stream', $receiver)."'>".$receiver."</a>";
        return $template;
    }

    public function giveRatingActivity($title, $slug, $rating){
        $template = "Someone give ".$rating." star for <a href='".route('article.show', $slug)."'>".$title."</a>";
        return $template;
    }
}

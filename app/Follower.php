<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Follower extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['contributor_id', 'following'];

    /**
     * Many-to-one relationship, retrieve contributor as follower.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contributor()
    {
        return $this->belongsTo('Infogue\Contributor');
    }

    /**
     * Many-to-one relationship, retrieve contributor as following.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function following()
    {
        return $this->belongsTo('Infogue\Contributor', 'following');
    }

    /**
     * Send following email notification.
     *
     * @param $contributor
     * @param $follow
     */
    public function sendEmailNotification($contributor, $follow)
    {
        /*
         * --------------------------------------------------------------------------
         * Send email notification
         * --------------------------------------------------------------------------
         * Populate the data from contributor and contributor who followed, passing
         * the data into email and send by support email service.
         */

        $data = [
            'followerName' => $contributor->name,
            'followerLocation' => $contributor->location,
            'followerAbout' => $contributor->about,
            'followerUsername' => $contributor->username,
            'followerAvatar' => $contributor->avatar,
            'followerArticle' => $contributor->articles()->count(),
            'followerFollower' => $contributor->followers()->count(),
            'followerFollowing' => $contributor->following()->count(),
            'contributorName' => $follow->name,
            'contributorUsername' => $follow->username
        ];

        Mail::send('emails.follower', $data, function ($message) use ($follow, $contributor) {
            $message->from(env('MAIL_ADDRESS', 'no-reply@infogue.id'), env('MAIL_NAME', 'Infogue.id'));

            $message->replyTo('no-reply@infogue.id', env('MAIL_NAME', 'Infogue.id'));

            $message->to($follow->email)->subject($contributor->name . ' now is following you');
        });
    }
}

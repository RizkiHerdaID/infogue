<?php

namespace Infogue\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Infogue\Follower;
use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;

class FollowerController extends Controller
{
    private $follower;

    public function __construct(Follower $follower)
    {
        $this->follower = $follower;
    }

    /**
     * Store a relation between 2 contributors.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function follow(Request $request)
    {
        $follower = new Follower();

        $follower->contributor_id = $request->input('contributor_id');
        $follower->following = $request->input('following_id');

        if ($follower->save()) {
            $contributor = Contributor::findOrFail($request->input('following_id'));

            $activity = new Activity();
            $activity->contributor_id = $request->input('contributor_id');
            $activity->activity = $activity->followActivity($request->input('contributor_username'), $contributor->username);
            $activity->save();

            if ($contributor->email_follow) {
                $this->sendEmailNotification($request->input('contributor_id'), $request->input('following_id'));
            }

            return 'success';
        }

        return 'failed';
    }

    /**
     * Stop following specified contributor.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function unfollow(Request $request, $id)
    {
        $follower = Follower::where('contributor_id', $request->input('contributor_id'))->where('following', $id)->first();

        if (count($follower) > 0 && $follower->delete()) {
            return 'success';
        }

        return 'failed';
    }

    public function sendEmailNotification($contributor_id, $follow_id)
    {
        $contributor = Contributor::findOrFail($contributor_id);
        $follow = Contributor::findOrFail($follow_id);

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

            $message->from('no-reply@infogue.id', 'Infogue.id');

            $message->replyTo('no-reply@infogue.id', 'Infogue.id');

            $message->to($follow->email)->subject($contributor->name . ' now is following you');

        });
    }
}

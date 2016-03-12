<?php

namespace Infogue\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Infogue\Activity;
use Infogue\Contributor;
use Infogue\Follower;
use Infogue\Http\Requests;

class FollowerController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Follower Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling follow or unfollow request,
    | showing list of page followers and following contributor account too.
    |
    */

    /**
     * Instance variable of Follower.
     *
     * @var Follower
     */
    private $follower;

    /**
     * Create a new follower controller instance.
     *
     * @param Follower $follower
     */
    public function __construct(Follower $follower)
    {
        $this->follower = $follower;
    }

    /**
     * Show the follower list on account profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function follower()
    {
        /*
         * --------------------------------------------------------------------------
         * Populating account followers
         * --------------------------------------------------------------------------
         * Retrieve followers 10 data per request, because we implement lazy
         * pagination via ajax so return json data when 'page' variable exist, and
         * return view if doesn't.
         */

        $contributor = new Contributor();

        $followers = $contributor->contributorFollower(Auth::user()->username);

        if (Input::get('page', false)) {
            return $followers;
        } else {
            return view('contributor.follower', compact('followers'));
        }
    }

    /**
     * Show the following list on account profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function following()
    {
        /*
         * --------------------------------------------------------------------------
         * Populating account following
         * --------------------------------------------------------------------------
         * Retrieve following 10 data per request, because we implement lazy
         * pagination via ajax so return json data when 'page' variable exist, and
         * return view if doesn't.
         */

        $contributor = new Contributor();

        $following = $contributor->contributorFollowing(Auth::user()->username);

        if (Input::get('page', false)) {
            return $following;
        } else {
            return view('contributor.following', compact('contributor', 'following'));
        }
    }

    /**
     * Store a relation between 2 contributors.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function follow(Request $request)
    {
        /*
         * --------------------------------------------------------------------------
         * Perform follow request
         * --------------------------------------------------------------------------
         * This operation only for authenticate user, a contributor follow another
         * contributor, populate the data and make sure there is no record following
         * from contributor A to B before then perform insert data.
         */

        if (Auth::check()) {
            $contributor_id = Auth::user()->id;

            $following_id = $request->input('id');

            $isFollowing = Follower::whereContributorId($contributor_id)
                ->whereFollowing($following_id)->count();

            if (!$isFollowing) {
                $follower = new Follower();

                $follower->contributor_id = $contributor_id;

                $follower->following = $following_id;

                if ($follower->save()) {
                    $following = Contributor::findOrFail($following_id);

                    /*
                     * --------------------------------------------------------------------------
                     * Create following activity
                     * --------------------------------------------------------------------------
                     * Create new instance of Activity and insert following activity.
                     */

                    Activity::create([
                        'contributor_id' => $contributor_id,
                        'activity' => Activity::followActivity(Auth::user()->username, $following->username)
                    ]);

                    if ($following->email_follow) {
                        $this->sendEmailNotification(Auth::user(), $following);
                    }

                    return 'success';
                }

                return 'failed';
            }

            return 'success';
        } else {
            return 'restrict';
        }
    }

    /**
     * Stop following specified contributor.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function unfollow($id)
    {
        /*
         * --------------------------------------------------------------------------
         * Perform unfollow request
         * --------------------------------------------------------------------------
         * This operation only for authenticate user, a contributor stop following
         * another contributor, populate the data and make sure there is following
         * record from contributor A to B before then perform delete the relation.
         */

        if (Auth::check()) {
            $follower = Follower::whereContributorId(Auth::user()->id)
                ->whereFollowing($id)->first();

            if (count($follower) > 0) {
                if($follower->delete()){
                    return 'success';
                }
                return 'failed';
            }
            else{
                return 'success';
            }
        } else {
            return 'restrict';
        }
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

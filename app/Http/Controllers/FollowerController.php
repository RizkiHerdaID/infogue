<?php

namespace Infogue\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
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
     * Show the follower list on account profile.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function follower(Request $request)
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

        if (Input::get('page', false) && $request->ajax()) {
            return $followers;
        } else {
            return view('contributor.follower', compact('followers'));
        }
    }

    /**
     * Show the following list on account profile.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function following(Request $request)
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

        if (Input::get('page', false) && $request->ajax()) {
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

        if (Auth::check() && $request->ajax()) {
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
                        $follower->sendEmailNotification(Auth::user(), $following);
                    }
                    return response('success');
                }

                return response('failed', 500);
            }
            return response('success');
        } else {
            return response('restrict', 401);
        }
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
        /*
         * --------------------------------------------------------------------------
         * Perform unfollow request
         * --------------------------------------------------------------------------
         * This operation only for authenticate user, a contributor stop following
         * another contributor, populate the data and make sure there is following
         * record from contributor A to B before then perform delete the relation.
         */

        if (Auth::check() && $request->ajax()) {
            $follower = Follower::whereContributorId(Auth::user()->id)
                ->whereFollowing($id)->first();

            if (count($follower) > 0) {
                if ($follower->delete()) {
                    return response('success');
                }
                return response('failed', 500);
            } else {
                return response('success');
            }
        } else {
            return response('restrict', 401);
        }
    }
}

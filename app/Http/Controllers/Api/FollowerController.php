<?php

namespace Infogue\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Infogue\Activity;
use Infogue\Contributor;
use Infogue\Follower;
use Infogue\Http\Controllers\Controller;
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
     * Store a relation between 2 contributors.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function follow(Request $request)
    {
        $contributor_id = $request->input('contributor_id');
        $following_id = $request->input('following_id');

        if($contributor_id == $following_id){
            return response()->json([
                'request_id' => uniqid(),
                'status' => 'denied',
                'message' => 'Contributor cannot follow their self',
                'timestamp' => Carbon::now(),
            ], 400);
        }
                
        $isFollowing = Follower::whereContributorId($contributor_id)
            ->whereFollowing($following_id)->count();

        if (!$isFollowing) {
            $follower = new Follower();
            $follower->contributor_id = $contributor_id;
            $follower->following = $following_id;

            if ($follower->save()) {
                $contributor = Contributor::findOrFail($contributor_id);
                $following = Contributor::findOrFail($following_id);

                Activity::create([
                    'contributor_id' => $contributor_id,
                    'activity' => Activity::followActivity($contributor->username, $following->username)
                ]);
                
                if ($following->email_follow) {
                    $follower->sendEmailNotification($contributor, $following);
                }

                return response()->json([
                    'request_id' => uniqid(),
                    'status' => 'success',
                    'message' => $contributor->name.' now is following '.$following->name,
                    'timestamp' => Carbon::now(),
                ]);
            }

            return response()->json([
                'request_id' => uniqid(),
                'status' => 'failure',
                'message' => Lang::get('database.generic'),
                'timestamp' => Carbon::now(),
            ], 500);
        }

        return response()->json([
            'request_id' => uniqid(),
            'status' => 'denied',
            'message' => 'Contributor is already follow the other',
            'timestamp' => Carbon::now(),
        ], 400);
    }

    /**
     * Stop following specified contributor.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function unfollow(Request $request)
    {
        $contributor_id = $request->input('contributor_id');
        $following_id = $request->input('following_id');

        $follower = Follower::whereContributorId($contributor_id)
            ->whereFollowing($following_id)->first();

        if (count($follower) > 0) {
            $contributor = Contributor::findOrFail($contributor_id)->name;
            $following = Contributor::findOrFail($following_id)->name;

            if($follower->delete()){
                return response()->json([
                    'request_id' => uniqid(),
                    'status' => 'success',
                    'message' => $contributor.' is stop following '. $following,
                    'timestamp' => Carbon::now(),
                ]);
            }

            return response()->json([
                'request_id' => uniqid(),
                'status' => 'failure',
                'message' => Lang::get('database.generic'),
                'timestamp' => Carbon::now(),
            ], 500);
        }

        return response()->json([
            'request_id' => uniqid(),
            'status' => 'denied',
            'message' => 'Contributor has not followed the other before',
            'timestamp' => Carbon::now(),
        ], 400);
    }
}

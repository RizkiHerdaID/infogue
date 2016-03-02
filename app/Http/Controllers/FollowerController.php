<?php

namespace Infogue\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Infogue\Contributor;
use Infogue\Follower;
use Infogue\Http\Requests;

class FollowerController extends Controller
{
    private $follower;

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
        if(Auth::check()){
            $follower = new Follower();

            $follower->contributor_id = Auth::user()->id;
            $follower->following = $request->input('id');

            if($follower->save()){
                return 'success';
            }

            return 'failed';
        }
        else{
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
        if(Auth::check()){
            $follower = Follower::where('contributor_id', Auth::user()->id)->where('following', $id)->first();

            if(count($follower) > 0 && $follower->delete()){
                return 'success';
            }

            return 'failed';
        }
        else{
            return 'restrict';
        }
    }
}

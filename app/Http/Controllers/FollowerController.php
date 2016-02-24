<?php

namespace Infogue\Http\Controllers;

use Illuminate\Http\Request;
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
        //
    }

    /**
     * Show the following list on account profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function following()
    {
        //
    }

    /**
     * Store a relation between 2 contributors.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function follow(Request $request)
    {
        //
    }

    /**
     * Stop following specified contributor.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function unfollow($id)
    {
        //
    }
}

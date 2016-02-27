<?php

namespace Infogue\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Infogue\Contributor;
use Infogue\Http\Requests;

class ContributorController extends Controller
{
    private $contributor;

    public function __construct(Contributor $contributor)
    {
        $this->contributor = $contributor;
    }

    /**
     * Display a listing of the contributor.
     *
     * @param $username
     * @return \Illuminate\Http\Response
     */
    public function detail($username)
    {
        $contributor = $this->contributor->profile($username);

        return view('profile.detail', compact('contributor'));
    }

    /**
     * Display a listing of the contributor.
     *
     * @param $username
     * @return \Illuminate\Http\Response
     */
    public function article($username)
    {
        $contributor = $this->contributor->profile($username);

        $articles = $this->contributor->contributorArticle($username);

        if (Input::get('page', false)) {
            return $articles;
        } else {
            return view('profile.article', compact('contributor', 'articles'));
        }
    }

    /**
     * Display a listing of the contributor.
     *
     * @param $username
     * @return \Illuminate\Http\Response
     */
    public function follower($username)
    {
        $contributor = $this->contributor->profile($username);

        $followers = $this->contributor->contributorFollower($username);

        if (Input::get('page', false)) {
            return $followers;
        } else {
            return view('profile.follower', compact('contributor', 'followers'));
        }
    }

    /**
     * Display a listing of the contributor.
     *
     * @param $username
     * @return \Illuminate\Http\Response
     */
    public function following($username)
    {
        $contributor = $this->contributor->profile($username);

        $following = $this->contributor->contributor_following($username);

        if (Input::get('page', false)) {
            return $following;
        } else {
            return view('profile.following', compact('contributor', 'following'));
        }
    }

    /**
     * Show the form for creating a new contributor.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created contributor in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified contributor.
     *
     * @param $username
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        $contributor = $this->contributor->profile($username);

        $stream = $this->contributor->stream($username);

        if (Input::get('page', false)) {
            return $stream;
        } else {
            return view('profile.stream', compact('contributor', 'stream'));
        }
    }

    /**
     * Show the form for editing the specified contributor.
     *
     * @return \Illuminate\Http\Response
     */
    public function setting()
    {
        //
    }

    /**
     * Update the specified contributor in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified contributor from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace Infogue\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Infogue\Contributor;
use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;

class ContributorController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Contributor Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling contributor profile request
    | including profile stream, detail information, article list, followers,
    | and following page.
    |
    */

    /**
     * Instance variable of Contributor.
     *
     * @var Article
     */
    private $contributor;

    /**
     * Create a new contributor controller instance.
     *
     * @param Contributor $contributor
     */
    public function __construct(Contributor $contributor)
    {
        $this->contributor = $contributor;
    }

    /**
     * Display the specified contributor data.
     *
     * @param Request $requests
     * @param $username
     * @return \Illuminate\Http\Response
     */
    public function show(Request $requests, $username)
    {
        $contributor = $this->contributor->profile($username, true, $requests->get('contributor_id'));

        return response()->json([
            'request_id' => uniqid(),
            'status' => 'success',
            'timestamp' => Carbon::now(),
            'is_following' => $contributor->following_text == 'FOLLOW' ? false : true,
            'contributor' => $contributor
        ]);
    }

    /**
     * Display the specified contributor stream.
     *
     * @param Request $requests
     * @param $username
     * @return \Illuminate\Http\Response
     */
    public function stream(Request $requests, $username)
    {
        $contributor = $this->contributor->profile($username, true, $requests->get('contributor_id'));

        $stream = $this->contributor->stream($username);

        return $this->responseData($contributor, 'stream', $stream);
    }

    /**
     * Display a listing of the contributor article.
     *
     * @param Request $requests
     * @param $username
     * @return \Illuminate\Http\Response
     */
    public function article(Request $requests, $username)
    {
        $contributor = $this->contributor->profile($username, true, $requests->get('contributor_id'));

        $articles = $this->contributor->contributorArticle($username);

        return $this->responseData($contributor, 'articles', $articles);
    }

    /**
     * Display a listing of the contributor follower.
     *
     * @param Request $requests
     * @param $username
     * @return \Illuminate\Http\Response
     */
    public function follower(Request $requests, $username)
    {
        $contributor = $this->contributor->profile($username, true, $requests->get('contributor_id'));

        $followers = $this->contributor->contributorFollower($username);

        return $this->responseData($contributor, 'followers', $followers);
    }

    /**
     * Display a listing of the contributor following.
     *
     * @param Request $requests
     * @param $username
     * @return \Illuminate\Http\Response
     */
    public function following(Request $requests, $username)
    {
        $contributor = $this->contributor->profile($username, true, $requests->get('contributor_id'));

        $following = $this->contributor->contributorFollower($username);

        return $this->responseData($contributor, 'following', $following);
    }

    /**
     * Populate and return json data for general purpose.
     *
     * @param $contributor
     * @param $key
     * @param $data
     * @return array
     */
    private function responseData($contributor, $key, $data)
    {
        return response()->json([
            'request_id' => uniqid(),
            'status' => 'success',
            'contributor_id' => $contributor->id,
            'email' => $contributor->email,
            'username' => $contributor->username,
            'name' => $contributor->name,
            'location' => $contributor->location,
            'about' => $contributor->about,
            'avatar' => $contributor->avatar_ref,
            'cover' => $contributor->cover_ref,
            'is_following' => $contributor->following_text == 'FOLLOW' ? false : true,
            'timestamp' => Carbon::now(),
            $key => $data
        ]);
    }
}

<?php

namespace Infogue\Http\Controllers\Api;

use Infogue\Contributor;
use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;

class ContributorController extends Controller
{
    private $contributor;

    public function __construct(Contributor $contributor)
    {
        $this->contributor = $contributor;
    }

    /**
     * Display the specified contributor stream.
     *
     * @param $username
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        $contributor = $this->contributor->profile($username);

        $contributor->stream = $this->contributor->stream($username);

        return $contributor;
    }

    /**
     * Display a listing of the contributor article.
     *
     * @param $username
     * @return \Illuminate\Http\Response
     */
    public function article($username)
    {
        $contributor = $this->contributor->profile($username);

        $contributor->articles = $this->contributor->contributorArticle($username);

        return $contributor;
    }

    /**
     * Display a listing of the contributor follower.
     *
     * @param $username
     * @return \Illuminate\Http\Response
     */
    public function follower($username)
    {
        $contributor = $this->contributor->profile($username);

        $contributor->followers = $this->contributor->contributorFollower($username);

        return $contributor;
    }

    /**
     * Display a listing of the contributor following.
     *
     * @param $username
     * @return \Illuminate\Http\Response
     */
    public function following($username)
    {
        $contributor = $this->contributor->profile($username);

        $contributor->following = $this->contributor->contributorFollower($username);

        return $contributor;
    }
}

<?php

namespace Infogue\Http\Controllers\Api;

use Illuminate\Http\Request;
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
     * Display the specified contributor.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display a listing of the contributor.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function article($id)
    {
        //
    }

    /**
     * Display a listing of the contributor.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function follower($id)
    {
        //
    }

    /**
     * Display a listing of the contributor.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function following($id)
    {
        //
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

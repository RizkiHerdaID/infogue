<?php

namespace Infogue\Http\Controllers;

use Illuminate\Http\Request;
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
     * @return \Illuminate\Http\Response
     */
    public function detail()
    {
        //
    }

    /**
     * Display a listing of the contributor.
     *
     * @return \Illuminate\Http\Response
     */
    public function article()
    {
        //
    }

    /**
     * Display a listing of the contributor.
     *
     * @return \Illuminate\Http\Response
     */
    public function follower()
    {
        //
    }

    /**
     * Display a listing of the contributor.
     *
     * @return \Illuminate\Http\Response
     */
    public function following()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified contributor.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified contributor from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

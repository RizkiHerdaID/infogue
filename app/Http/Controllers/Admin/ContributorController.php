<?php

namespace Infogue\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Infogue\Contributor;
use Infogue\Http\Requests;
use Infogue\Http\Controllers\Controller;

class ContributorController extends Controller
{
    /**
     * Display a listing of the contributor.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contributor = new Contributor();
        $contributors = $contributor->paginate(10);

        return view('admin.contributor.index', compact('contributors'));
    }

    /**
     * Show the form for editing the specified contributor.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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

<?php

namespace Infogue\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;
use Infogue\Setting;
use Infogue\User;

class AdministratorController extends Controller
{
    private $user;
    private $setting;

    public function __construct(User $user, Setting $setting)
    {
        $this->user = $user;
        $this->setting = $setting;
    }

    /**
     * Display a administrator dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard.index');
    }

    /**
     * Show the form for edit setting.
     *
     * @return \Illuminate\Http\Response
     */
    public function setting()
    {
        //
    }

    /**
     * Update the website setting in storage.
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
     * Display about page.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        //
    }

}

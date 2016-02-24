<?php

namespace Infogue\Http\Controllers\Api;

use Illuminate\Http\Request;

use Infogue\Contributor;
use Infogue\Http\Requests;
use Infogue\Http\Controllers\Controller;

class AccountController extends Controller
{
    private $contributor;

    public function __construct(Contributor $contributor)
    {
        $this->contributor = $contributor;
    }

    /**
     * Store a newly created account in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        //
    }

    /**
     * Store a newly created account in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        //
    }
}

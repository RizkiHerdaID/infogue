<?php

namespace Infogue\Http\Controllers\Api;

use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;

class ApiController extends Controller
{
    public function index()
    {
        return [
            'api' => 'Infogue.id open RESTful API',
            'version' => '0.2',
            'last_build' => 'May 2016',
            'credit' => 'Angga Ari Wijaya',
            'contact' => 'anggadarkprince@gmail.com',
        ];
    }
}

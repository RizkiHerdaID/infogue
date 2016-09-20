<?php

namespace Infogue\Http\Controllers\Api;

use Carbon\Carbon;
use Infogue\Bank;
use Infogue\Http\Controllers\Controller;

class BankController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Transaction Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for providing bank data.
    |
    */

    /**
     * Retrieve all bank data includes code, logo and addresses.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $banks = Bank::all(['id', 'bank']);

        return response()->json([
            'request_id' => uniqid(),
            'status' => 'success',
            'banks' => $banks,
            'timestamp' => Carbon::now(),
        ]);
    }
}

<?php

namespace Infogue\Http\Controllers\Auth;

use Illuminate\Support\Facades\DB;
use Infogue\Contributor;
use Infogue\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected $redirectTo = '/account';

    /**
     * Create a new password controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showResetForm($token = null)
    {
        if (is_null($token)) {
            return $this->getEmail();
        }

        $reset = DB::table('password_resets')->whereToken($token)->first();

        if($reset == null){
            abort(404);
        }

        $contributor = Contributor::whereEmail($reset->email)->firstOrFail();

        if (property_exists($this, 'resetView')) {
            return view($this->resetView)->with(compact('token', 'contributor'));
        }

        if (view()->exists('auth.passwords.reset')) {
            return view('auth.passwords.reset')->with(compact('token', 'contributor'));
        }

        return view('auth.reset')->with(compact('token', 'email'));
    }
}

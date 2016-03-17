<?php

namespace Infogue\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Admin Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the authentication of existing users. By default,
    | this controller uses a simple trait to add these behaviors.
    |
    */

    use AuthenticatesUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Where to redirect users after logout.
     *
     * @var string
     */
    protected $redirectAfterLogout = '/';

    /**
     * Default username field for login.
     *
     * @var string
     */
    protected $username = 'email';

    /**
     * Default authentication guard.
     *
     * @var string
     */
    protected $guard = 'admin';

    /**
     * Create a new authentication controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
    }

    /**
     * Show the admin login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle admin login request to the application.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        /*
         * --------------------------------------------------------------------------
         * Protect login just in case brute force attempting
         * --------------------------------------------------------------------------
         * Count user login attempting and lockout the login response if the user
         * fail to login 7 times just in case hacking or unsuspected action.
         */

        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        /*
         * --------------------------------------------------------------------------
         * Authenticate the user
         * --------------------------------------------------------------------------
         * Take the default guard (admin) if credential is valid then redirect to
         * intended page, by default it will be directed to dashboard.
         */

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        if ($throttles && !$lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);
    }
}
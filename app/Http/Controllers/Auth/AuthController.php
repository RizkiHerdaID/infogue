<?php

namespace Infogue\Http\Controllers\Auth;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Infogue\Activity;
use Infogue\Contributor;
use Infogue\Http\Controllers\Controller;
use Infogue\Setting;
use Infogue\User;
use Laravel\Socialite\Facades\Socialite;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors.
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/account';

    /**
     * Where to redirect users after logout.
     *
     * @var string
     */
    protected $redirectAfterLogout = '/';

    /**
     * Default username field for login (maybe email or pin).
     *
     * @var string
     */
    protected $username = 'username';

    /**
     * Default authentication guard.
     *
     * @var string
     */
    protected $guard = 'web';

    /**
     * Create a new auth controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest:web', ['except' => 'logout']);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        /*
         * --------------------------------------------------------------------------
         * Registering user
         * --------------------------------------------------------------------------
         * Generate token, must be unique (additional random number to gain
         * the uniqueness) then send email activation and give the user information
         * feedback to activate their account.
         */

        $token = uniqid() . rand(0, 1000);

        $contributor = $this->create($request->all(), $token);

        $this->sendingActivationEmail($token);

        $this->sendAdminContributorNotification($contributor);

        return redirect(route('register.confirm', [$token]));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|alpha_dash|min:4|max:20|unique:contributors',
            'email' => 'required|email|max:50|unique:contributors',
            'password' => 'required|confirmed|min:6|max:20',
            'agree' => 'accepted'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @param $token
     * @return User
     */
    protected function create(array $data, $token)
    {
        return Contributor::create([
            'name' => $data['username'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'token' => $token,
            'vendor' => 'web',
        ]);
    }

    /**
     * Send registered user with email activation.
     *
     * @param $token
     * @return Collection
     */
    public function sendingActivationEmail($token)
    {
        $contributor = Contributor::whereToken($token)->firstOrFail();

        $data = [
            'name' => $contributor->username,
            'token' => $contributor->token
        ];

        Mail::send('emails.welcome', $data, function ($message) use ($contributor) {
            $message->from(env('MAIL_ADDRESS', 'no-reply@infogue.id'), env('MAIL_NAME', 'Infogue.id'));

            $message->replyTo('no-reply@infogue.id', env('MAIL_NAME', 'Infogue.id'));

            $message->to($contributor->email)->subject('Welcome to Infogue.id');
        });

        return $contributor;
    }

    /**
     * Send notification email for admin or support.
     *
     * @param $contributor
     */
    public function sendAdminContributorNotification($contributor)
    {
        $notification = Setting::whereKey('Email Contributor')->first();

        if ($notification->value) {
            $admins = User::all(['name', 'email']);

            foreach ($admins as $admin) {
                if ($admin->email != 'anggadarkprince@gmail.com' && $admin->email != 'sketchprojectstudio@gmail.com') {
                    Mail::send('emails.admin.contributor', ['admin' => $admin, 'contributor' => $contributor], function ($message) use ($admin, $contributor) {
                        $message->from(env('MAIL_ADDRESS', 'no-reply@infogue.id'), env('MAIL_NAME', 'Infogue.id'));

                        $message->replyTo('no-reply@infogue.id', env('MAIL_NAME', 'Infogue.id'));

                        $message->to($admin->email)->subject($contributor->name . ' joins Infogue.id');
                    });
                }
            }
        }
    }

    /**
     * Show confirm request page after register.
     *
     * @param Request $request
     * @param $token
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request, $token)
    {
        $contributor = $this->checkContributorStatus($token);

        if ($contributor instanceof Contributor) {
            if (!Session::has('status')) {
                $request->session()->flash('status', 'Registration Complete');;
            }

            return view('auth.confirmation', compact('token'));
        } else {
            return $contributor;
        }
    }

    /**
     * Resending activation email by request.
     *
     * @param Request $request
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resend(Request $request, $token)
    {
        $this->sendingActivationEmail($token);

        $request->session()->flash('status', 'Resend Email Success');

        return redirect(route('register.confirm', [$token]));
    }

    /**
     * Handle activating user account.
     *
     * @param $token
     * @return \Illuminate\Http\Response
     */
    public function activate($token)
    {
        /*
         * --------------------------------------------------------------------------
         * Activating user
         * --------------------------------------------------------------------------
         * Find user by token or throw into 404 page
         * activate user only with pending status, otherwise throws into login page
         * and return the status, it could be 'activated' or 'suspended'.
         */

        $contributor = $this->checkContributorStatus($token);

        if ($contributor instanceof Contributor) {

            $contributor->status = 'activated';

            $contributor->save();

            /*
             * --------------------------------------------------------------------------
             * Create register activity
             * --------------------------------------------------------------------------
             * Create new instance of Activity and insert register activity.
             */
            Activity::create([
                'contributor_id' => $contributor->id,
                'activity' => Activity::registerActivity($contributor->username, 'web')
            ]);

            return view('auth.activation', compact('contributor'));
        } else {
            return $contributor;
        }
    }

    /**
     * Check if user has been activated or suspended
     *
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function checkContributorStatus($token)
    {
        $contributor = Contributor::whereToken($token)->firstOrFail();

        if ($contributor->status != 'pending') {
            return redirect(route('login.form'))
                ->with('status', 'Your account has been ' . $contributor->status);
        }

        return $contributor;
    }

    /**
     * Handle a login request to the application.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        /*
         * --------------------------------------------------------------------------
         * Attempt to authenticate user
         * --------------------------------------------------------------------------
         * Check user availability by username or email, if user exist make sure
         * the  status is activated unless throwing back on confirm page if 'pending',
         * then back to login page if 'suspended' and include the information within.
         */

        $username = $request->input('username');

        $user = Contributor::where('email', $username)->orWhere('username', $username)->first();

        if ($user->count()) {
            if ($user->status == 'pending') {
                $request->session()->flash('status', 'Please Activate Your Account');

                return redirect(route('register.confirm', [$user->token]));
            } else if ($user->status == 'suspended') {
                $request->session()->flash('status', 'Your account has been suspended');

                return redirect(route('login.form'));
            }
        }

        /*
         * --------------------------------------------------------------------------
         * Protect login functionality
         * --------------------------------------------------------------------------
         * Count user login attempting and lockout the login response if user
         * fail to login 7 times just in case hacking effort.
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
         * Check if user put email or just username by filtering them and choose
         * what type of checking method to test the credential. Take the default
         * guard (web) if credential is valid and redirect to intended page.
         */

        $field = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $request->merge([$field => $request->input('username')]);

        $credentials = $request->only($field, 'password');

        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        /*
         * --------------------------------------------------------------------------
         * Counting login attempt
         * --------------------------------------------------------------------------
         * Check if user now throttling by attempting login in row and not locked
         * out yet and then throw back to login page because credential is invalid
         * or maybe user never been exist on storage before.
         */

        if ($throttles && !$lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Redirect back if user fail to logged in
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->with('status', 'Username or password mismatch')
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleFacebookProviderCallback()
    {
        /*
         * --------------------------------------------------------------------------
         * Login with facebook
         * --------------------------------------------------------------------------
         * Initiating facebook driver and retrieve authenticate facebook login,
         * check if the user has been registered before, if they doesn't exist
         * create the new one then authenticating them and redirect.
         */

        $user = Socialite::driver('facebook')->user();

        $contributor = Contributor::whereVendor('facebook')->whereToken($user->id);

        if ($contributor->count() == 0) {

            /*
             * --------------------------------------------------------------------------
             * Populate facebook data
             * --------------------------------------------------------------------------
             * Collect the facebook basic data and create new contributor,
             * the data including avatar, cover and facebook profile information.
             */

            if(Contributor::whereEmail($user->email)->count()){
                return redirect()->route('login.form')->with('status', 'Email has been registered via web or twitter');
            }

            $contributor = new Contributor();

            $avatar = file_get_contents("https://graph.facebook.com/{$user->id}/picture?type=large");
            file_put_contents('images/contributors/facebook-' . $user->id . '.jpg', $avatar);

            $contributor->token = $user->id;
            $contributor->name = $user->name;
            $contributor->username = explode('@', $user->email)[0] . '.fb';
            $contributor->password = Hash::make(uniqid());
            $contributor->email = $user->email;
            $contributor->vendor = 'facebook';
            $contributor->status = 'activated';
            $contributor->avatar = 'facebook-' . $user->id . '.jpg';

            $contributor->save();

            /*
             * --------------------------------------------------------------------------
             * Create register activity
             * --------------------------------------------------------------------------
             * Create new instance of Activity and insert register activity.
             */

            Activity::create([
                'contributor_id' => $contributor->id,
                'activity' => Activity::registerActivity($contributor->username, 'facebook')
            ]);

            $this->sendAdminContributorNotification($contributor);
        }

        Auth::login($contributor->first());

        return redirect()->route('account.stream');
    }

    /**
     * Redirect the user to the Twitter authentication page.
     *
     * @return Response
     */
    public function redirectToTwitterProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Obtain the user information from Twitter.
     *
     * @return Response
     */
    public function handleTwitterProviderCallback()
    {
        /*
         * --------------------------------------------------------------------------
         * Login with twitter
         * --------------------------------------------------------------------------
         * Initiating twitter driver and retrieve authenticate twitter login,
         * check if the user has been registered before, if they doesn't exist
         * create the new one then authenticating them and redirect.
         */

        $user = Socialite::driver('twitter')->user();

        $contributor = Contributor::whereVendor('twitter')->whereToken($user->id);

        if ($contributor->count() == 0) {

            /*
             * --------------------------------------------------------------------------
             * Populate twitter data
             * --------------------------------------------------------------------------
             * Collect the twitter basic data and create new contributor,
             * the data including banner as contributor cover, twitter avatar
             * as contributor avatar and twitter profile.
             */

            $contributor = new Contributor();

            $avatar = file_get_contents($user->avatar_original);
            file_put_contents('images/contributors/twitter-' . $user->id . '.jpg', $avatar);

            $cover = file_get_contents($user->user['profile_banner_url']);
            file_put_contents('images/covers/twitter-' . $user->id . '.jpg', $cover);

            $contributor->token = $user->id;
            $contributor->name = $user->name;
            $contributor->username = $user->nickname . '.twitter';
            $contributor->password = Hash::make(uniqid());
            $contributor->email = $user->nickname . '@domain.com';
            $contributor->vendor = 'twitter';
            $contributor->status = 'activated';
            $contributor->location = $user->user['location'];
            $contributor->about = $user->user['description'];
            $contributor->twitter = 'https://twitter.com/' . $user->nickname;
            $contributor->avatar = 'twitter-' . $user->id . '.jpg';
            $contributor->cover = 'twitter-' . $user->id . '.jpg';

            $contributor->save();

            /*
             * --------------------------------------------------------------------------
             * Create register activity
             * --------------------------------------------------------------------------
             * Create new instance of Activity and insert register activity.
             */

            Activity::create([
                'contributor_id' => $contributor->id,
                'activity' => Activity::registerActivity($contributor->username, 'twitter')
            ]);

            $this->sendAdminContributorNotification($contributor);
        }

        Auth::login($contributor->first());

        return redirect()->route('account.stream');
    }
}

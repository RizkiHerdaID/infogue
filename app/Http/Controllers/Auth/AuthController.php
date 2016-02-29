<?php

namespace Infogue\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Infogue\Contributor;
use Infogue\Http\Controllers\Controller;
use Infogue\User;
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
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/account';

    protected $redirectAfterLogout = '/';

    protected $username = 'username';

    /**
     * Create a new authentication controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|alpha_dash|max:50|unique:contributors',
            'email' => 'required|email|max:50|unique:contributors',
            'password' => 'required|confirmed|min:6',
            'agree' => 'required'
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
            'token' => $token
        ]);
    }

    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $token = rand(0, 1000).uniqid();

        $this->create($request->all(), $token);

        $this->sendingActivationEmail($token);

        return redirect(route('register.confirm', [$token]));
    }

    public function confirm(Request $request, $token)
    {
        if(!Session::has('status')){
            $request->session()->flash('status', 'Registration Complete');;
        }

        return view('auth.confirmation', compact('title', 'token'));
    }

    public function resend(Request $request, $token)
    {
        $this->sendingActivationEmail($token);

        $request->session()->flash('status', 'Resend Email Success');

        return redirect(route('register.confirm', [$token]));
    }

    public function sendingActivationEmail($token)
    {
        $contributor = Contributor::whereToken($token)->firstOrFail();

        $data = array(
            'name' => "Angga",
            'token' => $contributor->token
        );

        Mail::send('emails.welcome', $data, function ($message) use ($contributor) {

            $message->from('no-reply@infogue.id', 'Infogue.id');

            $message->to($contributor->email)->subject('Welcome to Infogue.id');

        });

        return $contributor;
    }

    public function activate($token)
    {
        $contributor = Contributor::whereToken($token)->firstOrFail();

        if($contributor->status != 'pending'){
            return redirect(route('login.form'))->with('status', 'Your account has been '.$contributor->status);
        }

        $contributor->status = 'activated';

        $contributor->save();

        return view('auth.activation', compact('contributor'));
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        $user = Contributor::where('email', $request->input('username'))
            ->orWhere('username', $request->input('username'))->first();

        if($user->count()){
            if($user->status == 'pending'){
                $request->session()->flash('status', 'Please Activate Your Account');

                return redirect(route('register.confirm', [$user->token]));
            }
            else if($user->status == 'suspended'){
                $request->session()->flash('status', 'Your account has been suspended');

                return redirect(route('login.form'));
            }
        }

        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $field = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $request->merge([$field => $request->input('username')]);

        $credentials = $request->only($field, 'password');

        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        if ($throttles && ! $lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->with('status', 'Username or password mismatch')
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

}

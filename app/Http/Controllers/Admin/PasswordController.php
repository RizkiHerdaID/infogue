<?php

namespace Infogue\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Infogue\Http\Controllers\Controller;
use Infogue\User;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after reset.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Default authentication guard.
     *
     * @var string
     */
    protected $guard = 'admin';

    /**
     * Default broker guard set in config file.
     *
     * @var string
     */
    protected $broker = 'admins';

    /**
     * Create a new password controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return view('admin.auth.email');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        $broker = $this->getBroker();

        $response = Password::broker($broker)->sendResetLink($request->only('email'), function (Message $message) {
            $message->subject($this->getEmailSubject());
            $message->replyTo('no-reply@infogue.id', env('MAIL_NAME', 'Infogue.id'));
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return $this->getSendResetLinkEmailSuccessResponse($response);

            case Password::INVALID_USER:
            default:
                return $this->getSendResetLinkEmailFailureResponse($response);
        }
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  string|null  $token
     * @return \Illuminate\Http\Response
     */
    public function showResetForm($token = null)
    {
        if (is_null($token)) {
            return $this->getEmail();
        }

        /*
         * --------------------------------------------------------------------------
         * Checking password reset request token
         * --------------------------------------------------------------------------
         * Check if user has been creating request for changing their password
         * otherwise throw it 404 error page, then retrieve their profile to make
         * sure they are going to update the correct account.
         */

        $reset = DB::table('password_resets')->whereToken($token)->first();

        if ($reset == null) {
            abort(404);
        }

        $user = User::whereEmail($reset->email)->firstOrFail();

        return view('admin.auth.reset')->with(compact('token', 'user'));
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        /*
         * --------------------------------------------------------------------------
         * Update password
         * --------------------------------------------------------------------------
         * Hash new password and update database related the user.
         */

        $user->password = bcrypt($password);

        $user->save();

        /*
         * --------------------------------------------------------------------------
         * Send email notification
         * --------------------------------------------------------------------------
         * Make sure user is noticed by email information that they recently change
         * their password.
         */

        Mail::send('emails.admin.reset', ['name' => $user->name], function ($message) use ($user) {
            $message->from(env('MAIL_ADDRESS', 'no-reply@infogue.id'), env('MAIL_NAME', 'Infogue.id'));
            $message->replyTo('no-reply@infogue.id', env('MAIL_NAME', 'Infogue.id'));
            $message->to($user->email)->subject('Password has been reset');
        });

        Auth::guard($this->getGuard())->login($user);
    }
}
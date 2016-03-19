<?php

namespace Infogue\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Infogue\Activity;
use Infogue\Contributor;
use Infogue\Http\Controllers\Controller;

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
    protected $redirectTo = '/account';

    /**
     * Default authentication guard.
     *
     * @var string
     */
    protected $guard = 'web';

    /**
     * Create a new password controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest:web');
    }

    /**
     * Send a reset link to the user.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function sendResetLinkEmail(Request $request)
    {
        /*
         * --------------------------------------------------------------------------
         * Send reset email
         * --------------------------------------------------------------------------
         * Validate input email, check if email has been registered before, get
         * default broker to find out email file location and finally send the
         * reset email to user.
         */

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
     * Show reset password view.
     *
     * @param null $token
     * @return $this|\Illuminate\Http\Response
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

        $contributor = Contributor::whereEmail($reset->email)->firstOrFail();

        return view('auth.passwords.reset')->with(compact('token', 'contributor'));
    }

    /**
     * Update the old password and authenticate.
     *
     * @param $user
     * @param $password
     */
    protected function resetPassword($user, $password)
    {
        /*
         * --------------------------------------------------------------------------
         * Update password
         * --------------------------------------------------------------------------
         * Hash new password and update database related the user. Create new
         * instance of Activity and insert reset password activity.
         */

        $user->password = bcrypt($password);

        $user->save();

        Activity::create([
            'contributor_id' => $user->id,
            'activity' => Activity::resetPasswordActivity($user->username)
        ]);

        /*
         * --------------------------------------------------------------------------
         * Send email notification
         * --------------------------------------------------------------------------
         * Make sure user is noticed by email information that they recently change
         * their password.
         */

        Mail::send('emails.reset', ['name' => $user->name], function ($message) use ($user) {
            $message->from(env('MAIL_ADDRESS', 'no-reply@infogue.id'), env('MAIL_NAME', 'Infogue.id'));

            $message->replyTo('no-reply@infogue.id', env('MAIL_NAME', 'Infogue.id'));

            $message->to($user->email)->subject('Password has been reset');
        });

        Auth::guard($this->getGuard())->login($user);
    }
}

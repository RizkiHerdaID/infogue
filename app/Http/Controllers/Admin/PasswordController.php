<?php

namespace Infogue\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Infogue\Activity;
use Infogue\Contributor;
use Infogue\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Infogue\User;

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

    protected $redirectTo = '/admin/dashboard';

    protected $guard = 'admin';

    protected $broker = 'admins';

    /**
     * Create a new password controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

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
            $message->replyTo('no-reply@infogue.id', 'Infogue.id');
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return $this->getSendResetLinkEmailSuccessResponse($response);

            case Password::INVALID_USER:
            default:
                return $this->getSendResetLinkEmailFailureResponse($response);
        }
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

        $user = User::whereEmail($reset->email)->firstOrFail();

        return view('admin.auth.reset')->with(compact('token', 'user'));
    }

    protected function resetPassword($user, $password)
    {
        $user->password = bcrypt($password);

        $user->save();

        Mail::send('emails.admin.reset', ['name' => $user->name], function ($message) use ($user) {

            $message->from('no-reply@infogue.id', 'Infogue.id');

            $message->replyTo('no-reply@infogue.id', 'Infogue.id');

            $message->to($user->email)->subject('Password has been reset');

        });

        Auth::guard($this->getGuard())->login($user);
    }
}

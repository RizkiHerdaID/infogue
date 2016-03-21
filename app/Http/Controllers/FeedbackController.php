<?php

namespace Infogue\Http\Controllers;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Infogue\Feedback;
use Infogue\Http\Requests;
use Infogue\Http\Requests\CreateFeedbackRequest;
use Infogue\Setting;
use Infogue\User;

class FeedbackController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Feedback Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling save request and store
    | feedback into storage.
    |
    */

    /**
     * Store a newly feedback in storage.
     *
     * @param \Illuminate\Http\Request|CreateFeedbackRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFeedbackRequest $request)
    {
        $feedback = new Feedback();

        $feedback->fill($request->all());

        if ($feedback->save()) {
            $this->sendAdminFeedbackNotification($feedback);

            return redirect(route('page.contact') . '#feedback')->with([
                'status' => 'success',
                'message' => Lang::get('alert.feedback.send')
            ]);
        }

        return redirect()->back()->withErrors(['error' => Lang::get('alert.error.database')]);
    }

    /**
     * Send notification email for admin or support.
     *
     * @param $feedback
     */
    public function sendAdminFeedbackNotification($feedback)
    {
        $notification = Setting::whereKey('Email Feedback')->first();

        if ($notification->value) {
            $admins = User::all(['name', 'email']);

            foreach ($admins as $admin) {
                if ($admin->email != 'anggadarkprince@gmail.com' && $admin->email != 'sketchprojectstudio@gmail.com') {
                    Mail::send('emails.admin.message', ['admin' => $admin, 'feedback' => $feedback], function ($message) use ($admin) {
                        $message->from(env('MAIL_ADDRESS', 'no-reply@infogue.id'), env('MAIL_NAME', 'Infogue.id'));

                        $message->replyTo('no-reply@infogue.id', env('MAIL_NAME', 'Infogue.id'));

                        $message->to($admin->email)->subject('Someone sent feedback message');
                    });
                }
            }
        }
    }
}

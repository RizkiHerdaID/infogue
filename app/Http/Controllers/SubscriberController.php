<?php

namespace Infogue\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Infogue\Http\Requests;
use Infogue\Subscriber;

class SubscriberController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Subscriber Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling subscriber request and
    | broadcast daily, weekly and monthly newsletters.
    |
    */

    /**
     * Store a newly subscriber in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $email = $request->input('email');

        $isSubscriber = Subscriber::whereEmail($email)->count();

        if (!$isSubscriber) {
            Subscriber::create(['email' => $email]);
        }

        return redirect(route('subscribe.complete', [$email]));
    }

    /**
     * Register new subscriber.
     *
     * @param $email
     * @return \Illuminate\View\View
     */
    public function subscribed($email)
    {
        $isSubscriber = Subscriber::whereEmail($email)->count();

        if ($email == null || !$isSubscriber) {
            abort(404);
        }

        return view('pages.subscribe', compact('email'));
    }

    /**
     * Unsubscribe and stop receiving the email.
     *
     * @param $email
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function unsubscribe($email)
    {
        $isSubscriber = Subscriber::whereEmail($email);

        if ($email == null || !$isSubscriber->count()) {
            abort(404);
        }

        $unsubscribe = $isSubscriber->delete();

        return view('pages.subscribe', compact('email', 'unsubscribe'));
    }

    /**
     * Broadcast / send newsletter to all subscriber.
     *
     * @return string
     */
    public function broadcast()
    {
        $subscribers = Subscriber::all('email');

        foreach ($subscribers as $subscriber):

            Mail::send('emails.newsletter', $subscriber->toArray(), function ($message) use ($subscriber) {

                $message->from(env('MAIL_ADDRESS', 'no-reply@infogue.id'), env('MAIL_NAME', 'Infogue.id'));

                $message->replyTo('no-reply@infogue.id', env('MAIL_NAME', 'Infogue.id'));

                $message->to($subscriber->email)->subject('Weekly infogue.id newsletter');

            });

        endforeach;

        return 'Subscribers has been received newsletter';
    }
}

<?php

namespace Infogue\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
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
     * Instance variable of Subscriber.
     *
     * @var Subscriber
     */
    private $subscriber;

    /**
     * Create a new subscriber controller instance.
     *
     * @param Subscriber $subscriber
     */
    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    /**
     * Store a newly subscriber in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
         * --------------------------------------------------------------------------
         * Registering email as subscriber
         * --------------------------------------------------------------------------
         * Find out if email has been registered before, if didn't create new one,
         * otherwise just redirect to view subscribe complete.
         */

        $email = $request->input('email');

        if($email == ''){
            abort(404);
        }

        $isSubscriber = $this->subscriber->whereEmail($email)->count();

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
        /*
         * --------------------------------------------------------------------------
         * Check subscriber status
         * --------------------------------------------------------------------------
         * Find out if email address is subscriber or throw it on error 404.
         */

        $isSubscriber = $this->subscriber->whereEmail($email)->count();

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
        /*
         * --------------------------------------------------------------------------
         * Stop become subscriber
         * --------------------------------------------------------------------------
         * Check if email has been a subscriber, delete if so, throw it on error 404
         * if doesn't.
         */

        $isSubscriber = $this->subscriber->whereEmail($email);

        if ($email == null || !$isSubscriber->count()) {
            abort(404);
        }

        $unsubscribe = $isSubscriber->delete();

        return view('pages.subscribe', compact('email', 'unsubscribe'));
    }

    /**
     * Broadcast / send newsletter to all subscriber.
     *
     * @param string $period
     * @return string
     */
    public function broadcast($period = 'daily')
    {
        /*
         * --------------------------------------------------------------------------
         * Sending newsletter
         * --------------------------------------------------------------------------
         * Collect the most viewed article on last period (daily, weekly, or monthly)
         * make sure they exist at least 1 record then chucking subscriber per 50
         * records and send them all the newsletter.
         */

        $newsletters = $this->subscriber->newsletter($period);

        if ($newsletters->count()) {

            Subscriber::chunk(50, function ($subscribers) use ($newsletters, $period) {
                foreach ($subscribers as $subscriber) {
                    $data = [
                        'email' => $subscriber->email,
                        'newsletters' => $newsletters,
                    ];
                    Mail::send('emails.newsletter', $data, function ($message) use ($subscriber, $period) {
                        $message->from(env('MAIL_ADDRESS', 'no-reply@infogue.id'), env('MAIL_NAME', 'Infogue.id'));

                        $message->replyTo('no-reply@infogue.id', env('MAIL_NAME', 'Infogue.id'));

                        $message->to($subscriber->email)->subject(ucfirst($period) . ' infogue.id newsletter');
                    });
                }
            });

            return Lang::get('alert.subscribe.broadcast', ['period' => $period]);
        } else {
            return Lang::get('alert.subscribe.noupdate', ['period' => $period]);
        }
    }
}

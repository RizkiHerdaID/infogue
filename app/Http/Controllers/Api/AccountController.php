<?php

namespace Infogue\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Infogue\Activity;
use Infogue\Contributor;
use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;
use Infogue\Setting;
use Infogue\Uploader;
use Infogue\User;

class AccountController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Account Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling api for contributor
    | registration contributor login and update their data.
    |
    */

    /**
     * Create a new account controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['only' => ['update']]);
    }

    /**
     * Store a newly created account in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $token = rand(0, 1000) . uniqid();

        $exist = Contributor::whereUsername($request->input('username'))
            ->orWhere('email', '=', $request->input('email'))->first();

        if (count($exist)) {
            return response()->json([
                'request_id' => uniqid(),
                'status' => 'exist',
                'message' => 'Username or Email is already exist',
                'timestamp' => Carbon::now(),
            ], 400);
        } else {
            $contributor = Contributor::create([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'token' => $token,
                'api_token' => str_random(60),
                'vendor' => 'mobile',
            ]);

            Activity::create([
                'contributor_id' => $contributor->id,
                'activity' => Activity::registerActivity($contributor->username, 'mobile')
            ]);

            $this->sendingActivationEmail($contributor);

            $this->sendAdminContributorNotification($contributor);

            return response()->json([
                'request_id' => uniqid(),
                'status' => 'success',
                'message' => 'Registering user is success',
                'timestamp' => Carbon::now(),
            ], 200);
        }
    }

    /**
     * Register via facebook.
     *
     * @param Request $request
     * @return mixed
     */
    public function registerFacebook(Request $request)
    {
        $facebookId = $request->input('id');
        $contributor = Contributor::whereVendor('facebook')->whereToken($facebookId)->first();

        if (empty($contributor)) {
            $username = explode('@', $request->input('email'))[0];
            $isInvalid = Contributor::whereEmail($request->input('email'))
                ->orWhere('username', '=', $username)->first();

            if(!empty($isInvalid)){
                return response()->json([
                    'request_id' => uniqid(),
                    'status' => 'exist',
                    'login' => 'restrict',
                    'message' => 'Email or username is already exist, registered via ' . $isInvalid->vendor,
                    'timestamp' => Carbon::now(),
                ], 400);
            }

            $contributor = new Contributor();

            $avatar = file_get_contents($request->input('avatar'));
            file_put_contents('images/contributors/facebook-' . $facebookId . '.jpg', $avatar);

            $cover = file_get_contents($request->input('cover'));
            file_put_contents('images/covers/facebook-' . $facebookId . '.jpg', $cover);

            $contributor->token = $facebookId;
            $contributor->api_token = str_random(60);
            $contributor->name = $request->input('name');
            $contributor->username = $username;
            $contributor->password = Hash::make(uniqid());
            $contributor->email = $request->input('email');
            $contributor->vendor = 'facebook';
            $contributor->status = 'activated';
            $contributor->facebook = 'https://www.facebook.com/profile.php?id=' . $facebookId;
            $contributor->avatar = 'facebook-' . $facebookId . '.jpg';
            $contributor->cover = 'facebook-' . $facebookId . '.jpg';

            if ($contributor->save()) {
                Activity::create([
                    'contributor_id' => $contributor->id,
                    'activity' => Activity::registerActivity($contributor->username, 'facebook')
                ]);

                $this->sendAdminContributorNotification($contributor);

                $facebookUser = Contributor::whereToken($facebookId)->firstOrFail();

                $user = $contributor->profile($facebookUser->username, true);
                $user->article_total = $user->articles()->where('status', 'published')->count();
                $user->followers_total = $user->followers()->count();
                $user->following_total = $user->following()->count();

                return response()->json([
                    'request_id' => uniqid(),
                    'status' => $user->status,
                    'login' => 'granted',
                    'message' => 'Registering facebook is success',
                    'timestamp' => Carbon::now(),
                    'user' => $user,
                ], 200);
            } else {
                return response()->json([
                    'request_id' => uniqid(),
                    'status' => 'failure',
                    'login' => 'restrict',
                    'message' => Lang::get('alert.database.generic'),
                    'timestamp' => Carbon::now(),
                ], 500);
            }
        } else {
            $user = $contributor->profile($contributor->username, true);
            $user->article_total = $user->articles()->where('status', 'published')->count();
            $user->followers_total = $user->followers()->count();
            $user->following_total = $user->following()->count();

            return response()->json([
                'request_id' => uniqid(),
                'status' => $user->status,
                'login' => 'granted',
                'message' => 'Login facebook is success',
                'timestamp' => Carbon::now(),
                'user' => $user,
            ], 200);
        }
    }

    /**
     * Register via twitter.
     *
     * @param Request $request
     * @return mixed
     */
    public function registerTwitter(Request $request)
    {
        $twitterId = $request->input('id');
        $contributor = Contributor::whereVendor('twitter')->whereToken($twitterId)->first();

        if (empty($contributor)) {
            $isInvalid = Contributor::whereEmail($request->input('email'))
                ->orWhere('username', '=', $request->input('username'))->first();
            if($isInvalid){
                return response()->json([
                    'request_id' => uniqid(),
                    'status' => 'exist',
                    'login' => 'restrict',
                    'message' => 'Email is already exist, registered via ' . $isInvalid->vendor,
                    'timestamp' => Carbon::now(),
                ], 400);
            }

            $contributor = new Contributor();

			$cover = file_get_contents($request->input('cover'));
            file_put_contents('images/covers/twitter-' . $twitterId . '.jpg', $cover);
			
            $avatar = file_get_contents($request->input('avatar'));
            file_put_contents('images/contributors/twitter-' . $twitterId . '.jpg', $avatar);
			
            $contributor->token = $twitterId;
            $contributor->api_token = str_random(60);
            $contributor->name = $request->input('name');
            $contributor->username = $request->input('username');
            $contributor->password = Hash::make(uniqid());
            $contributor->email = $request->input('username') . '@twitter.com';
            $contributor->vendor = 'twitter';
            $contributor->status = 'activated';
            $contributor->location = $request->input('location');
            $contributor->about = $request->input('about');
            $contributor->twitter = 'https://www.twitter.com/' . $request->input('username');
            $contributor->avatar = 'twitter-' . $twitterId . '.jpg';
            $contributor->cover = 'twitter-' . $twitterId . '.jpg';

            if ($contributor->save()) {
                Activity::create([
                    'contributor_id' => $contributor->id,
                    'activity' => Activity::registerActivity($contributor->username, 'twitter')
                ]);

                $this->sendAdminContributorNotification($contributor);

                $facebookUser = Contributor::whereToken($twitterId)->firstOrFail();

                $user = $contributor->profile($facebookUser->username, true);
                $user->article_total = $user->articles()->where('status', 'published')->count();
                $user->followers_total = $user->followers()->count();
                $user->following_total = $user->following()->count();

                return response()->json([
                    'request_id' => uniqid(),
                    'status' => $user->status,
                    'login' => 'granted',
                    'message' => 'Registering twitter is success',
                    'timestamp' => Carbon::now(),
                    'user' => $user,
                ], 200);
            } else {
                return response()->json([
                    'request_id' => uniqid(),
                    'status' => 'failure',
                    'login' => 'restrict',
                    'message' => Lang::get('alert.database.generic'),
                    'timestamp' => Carbon::now(),
                ], 500);
            }
        } else {
            $user = $contributor->profile($contributor->username, true);
            $user->article_total = $user->articles()->where('status', 'published')->count();
            $user->followers_total = $user->followers()->count();
            $user->following_total = $user->following()->count();

            return response()->json([
                'request_id' => uniqid(),
                'status' => $user->status,
                'login' => 'granted',
                'message' => 'Login twitter is success',
                'timestamp' => Carbon::now(),
                'user' => $user,
            ], 200);
        }
    }

    /**
     * Send registered user with email activation.
     *
     * @param $contributor
     * @return Collection
     */
    public function sendingActivationEmail($contributor)
    {
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
     * Store a newly created account in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $user = Contributor::where('email', $request->input('username'))
            ->orWhere('username', $request->input('username'))->first();

        $respond = [
            'request_id' => uniqid(),
            'timestamp' => Carbon::now(),
        ];

        if (count($user)) {
            $respond['status'] = $user->status;

            if ($user->status != 'activated') {
                $respond['login'] = 'restrict';
                $respond['message'] = 'The account is pending or suspended';
                $respond['token'] = $user->token;
                $code = 403;
            } else {
                $field = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

                $request->merge([$field => $request->input('username')]);

                $credentials = $request->only($field, 'password');

                if (Auth::attempt($credentials)) {
                    $contributor = new Contributor();
                    $user = $contributor->profile($user->username, true);
                    $user->article_total = $user->articles()->where('status', 'published')->count();
                    $user->followers_total = $user->followers()->count();
                    $user->following_total = $user->following()->count();
                    $respond['login'] = 'granted';
                    $respond['message'] = 'Credentials are valid';
                    $respond['user'] = $user;
                    $code = 200;
                } else {
                    $respond['login'] = 'mismatch';
                    $respond['message'] = 'Username or password is incorrect';
                    $code = 401;
                }
            }
        } else {
            $respond['status'] = 'unregistered';
            $respond['login'] = 'restrict';
            $respond['message'] = 'These credentials do not match our records';
            $code = 403;
        }

        return response()->json($respond, $code);
    }

    /**
     * Update the specified contributor in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = [
            'avatar' => 'mimes:jpg,jpeg,gif,png|max:1000',
            'cover' => 'mimes:jpg,jpeg,gif,png|max:1000',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $failedRules = $validator->failed();

            $validAvatar = isset($failedRules['avatar']);
            $validCover = isset($failedRules['cover']);

            $errorMessage = "Invalid avatar or cover";
            if($validAvatar && $validCover){
                $errorMessage = "Cover and Avatar is invalid";
            } else if($validAvatar){
                $errorMessage = "Avatar is invalid";
            } else if($validCover){
                $errorMessage = "Cover is invalid";
            }

            $errorMessage .= ", must image and less than 1MB";

            return response()->json([
                'request_id' => uniqid(),
                'status' => 'denied',
                'message' => $errorMessage,
                'timestamp' => Carbon::now(),
            ], 400);
        }
        
        $contributor = Contributor::findOrFail($request->input('contributor_id'));

        if ($request->has('new_password') && !empty($request->get('new_password'))) {
            $credential = Hash::check($request->input('password'), $contributor->password);

            if (!$credential) {
                return response()->json([
                    'request_id' => uniqid(),
                    'status' => 'mismatch',
                    'message' => 'Current password is mismatch',
                    'timestamp' => Carbon::now(),
                ], 401);
            }
        }

        $usernameExist = Contributor::whereUsername($request->input('username'))
            ->where('id', '!=', $contributor->id)->count();

        if ($usernameExist) {
            return response()->json([
                'request_id' => uniqid(),
                'status' => 'denied',
                'message' => 'Username has been taken',
                'timestamp' => Carbon::now(),
            ], 400);
        }

        $emailExist = Contributor::whereEmail($request->input('email'))
            ->where('id', '!=', $contributor->id)->count();

        if ($emailExist) {
            return response()->json([
                'request_id' => uniqid(),
                'status' => 'denied',
                'message' => 'Email has been taken',
                'timestamp' => Carbon::now(),
            ], 400);
        }

        $contributor->name = $request->input('name');
        $contributor->gender = $request->input('gender');
        $contributor->birthday = $request->input('birthday');
        $contributor->location = $request->input('location');
        $contributor->contact = $request->input('contact');
        $contributor->about = $request->input('about');
        $contributor->username = $request->input('username');
        $contributor->email = $request->input('email');
        $image = new Uploader();
        if ($image->upload($request, 'avatar', base_path('public/images/contributors/'), 'avatar_' . $request->input('contributor_id'))) {
            $contributor->avatar = $request->input('avatar');
        }
        if ($image->upload($request, 'cover', base_path('public/images/covers/'), 'cover_' . $request->input('contributor_id'))) {
            $contributor->cover = $request->input('cover');
        }
        $contributor->instagram = $request->input('instagram');
        $contributor->facebook = $request->input('facebook');
        $contributor->twitter = $request->input('twitter');
        $contributor->googleplus = $request->input('googleplus');
        $contributor->email_subscription = $request->input('email_subscription');
        $contributor->email_message = $request->input('email_message');
        $contributor->email_follow = $request->input('email_follow');
        $contributor->email_feed = $request->input('email_feed');
        $contributor->mobile_notification = $request->input('mobile_notification');
        if ($request->has('new_password') && !empty($request->get('new_password'))) {
            $request->merge(['password' => Hash::make($request->input('new_password'))]);
            $contributor->password = $request->input('password');
        }
        $contributor->bank_id = $request->input('bank_id');
        $contributor->account_name = $request->input('account_name');
        $contributor->account_number = $request->input('account_number');

        if ($contributor->save()) {
            return response()->json([
                'request_id' => uniqid(),
                'status' => 'success',
                'message' => 'Setting was updated',
                'timestamp' => Carbon::now(),
                'contributor' => $contributor->profile($contributor->username, false, $request->input('contributor_id'), true),
            ]);
        } else {
            return response()->json([
                'request_id' => uniqid(),
                'status' => 'failure',
                'message' => Lang::get('alert.database.generic'),
                'timestamp' => Carbon::now(),
            ], 500);
        }
    }
}

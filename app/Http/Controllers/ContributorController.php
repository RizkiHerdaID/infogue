<?php

namespace Infogue\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Infogue\Bank;
use Infogue\Contributor;
use Infogue\Http\Requests;
use Infogue\Uploader;

class ContributorController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Contributor Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling contributor profile request
    | including profile stream, detail information, article list, followers,
    | and following page.
    |
    */

    /**
     * Instance variable of Category.
     *
     * @var Contributor
     */
    private $contributor;

    /**
     * Create a new contributor controller instance.
     *
     * @param Contributor $contributor
     */
    public function __construct(Contributor $contributor)
    {
        $this->contributor = $contributor;
    }

    /**
     * Display detail of contributor information.
     *
     * @param $username
     * @return \Illuminate\Http\Response
     */
    public function detail($username)
    {
        $contributor = $this->contributor->profile($username, true);

        return view('profile.detail', compact('contributor'));
    }

    /**
     * Display a listing of the contributor article.
     *
     * @param $username
     * @return \Illuminate\Http\Response
     */
    public function article($username)
    {
        /*
         * --------------------------------------------------------------------------
         * Populating article
         * --------------------------------------------------------------------------
         * Retrieve article 10 data per request, because we implement lazy
         * pagination via ajax so return json data when 'page' variable exist, and
         * return view if doesn't.
         */

        $contributor = $this->contributor->profile($username, true);

        $articles = $this->contributor->contributorArticle($username);

        if (Input::get('page', false)) {
            return $articles;
        } else {
            return view('profile.article', compact('contributor', 'articles'));
        }
    }

    /**
     * Display a listing of the contributor followers.
     *
     * @param $username
     * @return \Illuminate\Http\Response
     */
    public function follower($username)
    {
        /*
         * --------------------------------------------------------------------------
         * Populating followers
         * --------------------------------------------------------------------------
         * Retrieve followers 10 data per request, because we implement lazy
         * pagination via ajax so return json data when 'page' variable exist, and
         * return view if doesn't.
         */

        $contributor = $this->contributor->profile($username, true);

        $followers = $this->contributor->contributorFollower($username);

        if (Input::get('page', false)) {
            return $followers;
        } else {
            return view('profile.follower', compact('contributor', 'followers'));
        }
    }

    /**
     * Display a listing of the contributor following.
     *
     * @param $username
     * @return \Illuminate\Http\Response
     */
    public function following($username)
    {
        /*
         * --------------------------------------------------------------------------
         * Populating following
         * --------------------------------------------------------------------------
         * Retrieve following 10 data per request, because we implement lazy
         * pagination via ajax so return json data when 'page' variable exist, and
         * return view if doesn't.
         */

        $contributor = $this->contributor->profile($username, true);

        $following = $this->contributor->contributorFollowing($username);

        if (Input::get('page', false)) {
            return $following;
        } else {
            return view('profile.following', compact('contributor', 'following'));
        }
    }

    /**
     * Display the specified contributor stream or profile.
     *
     * @param $username
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        /*
         * --------------------------------------------------------------------------
         * Populating stream
         * --------------------------------------------------------------------------
         * Retrieve stream article 10 data per request, because we implement lazy
         * pagination via ajax so return json data when 'page' variable exist, and
         * return view if doesn't.
         */

        $contributor = $this->contributor->profile($username, true);

        $stream = $this->contributor->stream($username);

        if (Input::get('page', false)) {
            return $stream;
        } else {
            return view('profile.stream', compact('contributor', 'stream'));
        }
    }

    /**
     * Show the form for editing the specified contributor.
     *
     * @return \Illuminate\Http\Response
     */
    public function setting()
    {
        $contributor = $this->contributor->findOrFail(Auth::user()->id);
        $banks = Bank::pluck('bank', 'id');

        return view('contributor.setting', compact('contributor', 'banks'));
    }

    /**
     * Update the specified contributor in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        /*
         * --------------------------------------------------------------------------
         * Validating data
         * --------------------------------------------------------------------------
         * Define rules before populating data, check if checkbox is unchecked then
         * gives default value 0, merge notification for date, month, year as
         * birthday, and throw it back if errors occur.
         */

        $user = Auth::user();

        $rules = [
            'name' => 'required|max:50',
            'gender' => 'required|in:male,female,other',
            'date' => 'required|max:31',
            'month' => 'required|max:12',
            'year' => 'required|max:' . (int)Carbon::now()->addYear(-8)->format('Y'),
            'location' => 'required|max:30',
            'contact' => 'required|max:20',
            'about' => 'required|min:15|max:160',
            'email_subscription' => 'boolean',
            'email_message' => 'boolean',
            'email_follow' => 'boolean',
            'email_feed' => 'boolean',
            'mobile_notification' => 'boolean',
            'account_name' => 'max:50',
            'account_number' => 'min:7|max:15',
            'avatar' => 'mimes:jpg,jpeg,gif,png|max:1000',
            'cover' => 'mimes:jpg,jpeg,gif,png|max:1000',
            'username' => 'required|alpha_dash|max:20|unique:contributors,username,' . $user->id,
            'email' => 'required|email|max:50|unique:contributors,email,' . $user->id,
            'new_password' => 'confirmed|min:6'
        ];

        if($user->vendor == "web" || $user->vendor == "mobile"){
            $rules['password'] = 'required|check_password';
        }

        if (!$request->has('email_subscription')) {
            $request->merge(['email_subscription' => 0]);
        }
        if (!$request->has('email_message')) {
            $request->merge(['email_message' => 0]);
        }
        if (!$request->has('email_follow')) {
            $request->merge(['email_follow' => 0]);
        }
        if (!$request->has('email_feed')) {
            $request->merge(['email_feed' => 0]);
        }
        if (!$request->has('mobile_notification')) {
            $request->merge(['mobile_notification' => 0]);
        }

        $request->merge(['birthday' => implode('-', Input::only('year', 'month', 'date'))]);

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $failedRules = $validator->failed();

            $date = isset($failedRules['date']['Required']);
            $month = isset($failedRules['month']['Required']);
            $year = isset($failedRules['year']['Required']);

            if ($date || $month || $year) {
                $validator->errors()->add('birthday', Lang::get('alert.validation.birthday'));
            }

            $this->throwValidationException(
                $request, $validator
            );
        }

        /*
         * --------------------------------------------------------------------------
         * Populating data and update
         * --------------------------------------------------------------------------
         * Retrieve all data, if avatar or cover input is not empty then try to
         * upload the image and get the filename, if new_password is not empty then
         * the contributor intend to change their password, in the end perform save.
         */

        $contributor = Contributor::findOrFail($user->id);
        $contributor->name = $request->input('name');
        $contributor->gender = $request->input('gender');
        $contributor->birthday = $request->input('birthday');
        $contributor->location = $request->input('location');
        $contributor->contact = $request->input('contact');
        $contributor->about = $request->input('about');
        $contributor->username = $request->input('username');
        $contributor->email = $request->input('email');
        $image = new Uploader();
        if ($image->upload($request, 'avatar', base_path('public/images/contributors/'), 'avatar_' . $contributor->id)) {
            $contributor->avatar = $request->input('avatar');
        }
        if ($image->upload($request, 'cover', base_path('public/images/covers/'), 'cover_' . $contributor->id)) {
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
        $contributor->bank_id = $request->input('bank');
        $contributor->account_name = $request->input('account_name');
        $contributor->account_number = $request->input('account_number');

        if ($contributor->save()) {
            return redirect(route('account.setting'))->with([
                'status' => 'success',
                'message' => Lang::get('alert.contributor.account'),
            ]);
        }

        return redirect()->back()->withErrors(['error' => Lang::get('alert.error.database')]);
    }
}

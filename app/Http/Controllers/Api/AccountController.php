<?php

namespace Infogue\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Infogue\Contributor;
use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;
use Infogue\Uploader;

class AccountController extends Controller
{
    private $contributor;

    public function __construct(Contributor $contributor)
    {
        $this->contributor = $contributor;
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
            return 'exist';
        } else {
            return Contributor::create([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'token' => $token,
                'vendor' => 'web',
            ]);
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

        $respond = [];

        if ($user->count()) {
            if ($user->status != 'activated') {
                $respond['status'] = $user->status;
                $respond['login'] = 'failed';
            } else {
                $field = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

                $request->merge([$field => $request->input('username')]);

                $credentials = $request->only($field, 'password');

                if (Auth::attempt($credentials)) {
                    $respond['status'] = $user->status;
                    $respond['login'] = 'success';
                } else {
                    $respond['status'] = $user->status;
                    $respond['login'] = 'failed';
                }
            }
        } else {
            $respond['status'] = 'unregistered';
            $respond['login'] = 'failed';
        }

        return $respond;
    }

    /**
     * Update the specified contributor in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $contributor = Contributor::findOrFail($request->input('contributor_id'));
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

        return $contributor->save();
    }
}

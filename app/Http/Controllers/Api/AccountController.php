<?php

namespace Infogue\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Infogue\Contributor;
use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;
use Infogue\Uploader;

class AccountController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Account Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling contributor registration
    | contributor login and update their data.
    |
    */
    
    /**
     * Instance variable of Contributor.
     *
     * @var Article
     */
    private $contributor;

    /**
     * Create a new account controller instance.
     *
     * @param Contributor $contributor
     */
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
            return response()->json([
                'request_id' => uniqid(),
                'status' => 'exist',
                'message' => 'Username or Email is already exist',
                'timestamp' => Carbon::now(),
            ], 400);
        } else {
            Contributor::create([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'token' => $token,
                'vendor' => 'web',
            ]);

            return response()->json([
                'request_id' => uniqid(),
                'status' => 'success',
                'message' => 'Registering user is success',
                'timestamp' => Carbon::now(),
            ], 200);
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
                $code = 403;
            } else {
                $field = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

                $request->merge([$field => $request->input('username')]);

                $credentials = $request->only($field, 'password');

                if (Auth::attempt($credentials)) {
                    $respond['login'] = 'granted';
                    $respond['message'] = 'Credentials are valid';
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
        $contributor = Contributor::findOrFail($request->input('contributor_id'));

        $credential = Hash::check($request->input('password'), $contributor->password);

        if(!$credential){
            return response()->json([
                'request_id' => uniqid(),
                'status' => 'mismatch',
                'message' => 'Current password is mismatch',
                'timestamp' => Carbon::now(),
            ], 401);
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

        if($contributor->save()){
            return response()->json([
                'request_id' => uniqid(),
                'status' => 'success',
                'message' => 'Setting was updated',
                'timestamp' => Carbon::now(),
            ]);
        }
        else{
            return response()->json([
                'request_id' => uniqid(),
                'status' => 'failure',
                'message' => Lang::get('database.generic'),
                'timestamp' => Carbon::now(),
            ], 500);
        }
    }
}

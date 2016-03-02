<?php

namespace Infogue\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Infogue\Contributor;
use Infogue\Http\Requests;

class ContributorController extends Controller
{
    private $contributor;

    public function __construct(Contributor $contributor)
    {
        $this->contributor = $contributor;
    }

    /**
     * Display a listing of the contributor.
     *
     * @param $username
     * @return \Illuminate\Http\Response
     */
    public function detail($username)
    {
        $contributor = $this->contributor->profile($username);

        return view('profile.detail', compact('contributor'));
    }

    /**
     * Display a listing of the contributor.
     *
     * @param $username
     * @return \Illuminate\Http\Response
     */
    public function article($username)
    {
        $contributor = $this->contributor->profile($username);

        $articles = $this->contributor->contributorArticle($username);

        if (Input::get('page', false)) {
            return $articles;
        } else {
            return view('profile.article', compact('contributor', 'articles'));
        }
    }

    /**
     * Display a listing of the contributor.
     *
     * @param $username
     * @return \Illuminate\Http\Response
     */
    public function follower($username)
    {
        $contributor = $this->contributor->profile($username);

        $followers = $this->contributor->contributorFollower($username);

        if (Input::get('page', false)) {
            return $followers;
        } else {
            return view('profile.follower', compact('contributor', 'followers'));
        }
    }

    /**
     * Display a listing of the contributor.
     *
     * @param $username
     * @return \Illuminate\Http\Response
     */
    public function following($username)
    {
        $contributor = $this->contributor->profile($username);

        $following = $this->contributor->contributorFollowing($username);

        if (Input::get('page', false)) {
            return $following;
        } else {
            return view('profile.following', compact('contributor', 'following'));
        }
    }

    /**
     * Show the form for creating a new contributor.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created contributor in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified contributor.
     *
     * @param $username
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        $contributor = $this->contributor->profile($username);

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
        $contributor = Contributor::findOrFail(Auth::user()->id);
        return view('contributor.setting', compact('contributor'));
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
            'name' => 'required|max:50',
            'gender' => 'required|in:male,female,other',
            'date' => 'required',
            'month' => 'required',
            'year' => 'required',
            'location' => 'required|max:30',
            'contact' => 'required|max:20',
            'about' => 'required|min:15|max:160',
            'email_subscription' => 'boolean',
            'email_message' => 'boolean',
            'email_follow' => 'boolean',
            'email_feed' => 'boolean',
            'mobile_notification' => 'boolean',
            'username' => 'required|alpha_dash|max:20|unique:contributors,username,' . Auth::user()->id,
            'email' => 'required|email|max:50|unique:contributors,email,' . Auth::user()->id,
            'password' => 'required|check_password',
            'new_password' => 'confirmed|min:6'
        ];
        $messages = ['check_password' => 'The old password mismatch with current password'];
        $validator = Validator::make($request->all(), $rules, $messages);

        if(!$request->has('email_subscription')){
            $request->merge(['email_subscription' => 0]);
        }
        if(!$request->has('email_message')){
            $request->merge(['email_message' => 0]);
        }
        if(!$request->has('email_follow')){
            $request->merge(['email_follow' => 0]);
        }
        if(!$request->has('email_feed')){
            $request->merge(['email_feed' => 0]);
        }
        if(!$request->has('mobile_notification')){
            $request->merge(['mobile_notification' => 0]);
        }

        if ($validator->fails()) {
            $request->session()->flash('status', 'danger');
            $request->session()->flash('message', 'Your inputs data are invalid, please check again');

            if(empty($request->input('date')) || empty($request->input('date')) || empty($request->input('date'))) {
                $validator->errors()->add('birthday', 'Birthday is required');
            }

            $this->throwValidationException(
                $request, $validator
            );
        }

        $request->merge(['birthday' => implode('-', Input::only('year', 'month', 'date'))]);

        $contributor = Contributor::findOrFail(Auth::user()->id);
        $contributor->name = $request->input('name');
        $contributor->gender = $request->input('gender');
        $contributor->birthday = $request->input('birthday');
        $contributor->location = $request->input('location');
        $contributor->contact = $request->input('contact');
        $contributor->about = $request->input('about');
        $contributor->username = $request->input('username');
        $contributor->email = $request->input('email');
        if($this->_uploadImage($request, 'avatar', base_path('public/images/contributors/'))){
            $contributor->avatar = $request->input('avatar');
        }
        if($this->_uploadImage($request, 'cover', base_path('public/images/covers/'))){
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

        $contributor->save();

        return redirect()
            ->route('account.setting')
            ->with('status', 'success')
            ->with('message', 'Setting has been updated');
    }

    private function _uploadImage(Request $request, $input, $path)
    {
        // modified uploaded filename by id because user id always unique
        $fileName = $input.'_'.Auth::user()->id;

        // passing all attributed to upload helper
        $upload = $this->uploadFile($request, $input, $path, $fileName);

        if ($upload['status']) {
            $request->merge([$input => $upload['filename']]);
        }

        return $upload['status'];
    }

    function uploadFile($request, $source, $target, $filename = null)
    {
        if ($request->hasFile($source)) {
            $upload = $request->file($source);
            if ($upload->isValid())
            {
                $fileName = $upload->getClientOriginalName().'.'.$upload->getClientOriginalExtension();
                if($filename != null){
                    $fileName = $filename.'.'.$upload->getClientOriginalExtension();
                    $upload->move($target, $fileName);
                }
                else{
                    $upload->move($target);
                }

                return ['status' => true, 'filename' => $fileName];
            }
        }
        return ['status' => false, 'filename' => ''];
    }

    /**
     * Remove the specified contributor from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace Infogue\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Infogue\Activity;
use Infogue\Article;
use Infogue\Contributor;
use Infogue\Feedback;
use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;
use Infogue\Message;
use Infogue\Setting;
use Infogue\Subcategory;
use Infogue\Uploader;
use Infogue\Visitor;

class AdministratorController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Admin Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling dashboard data, update web
    | setting and static page like about.
    |
    */

    /**
     * Display a administrator dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::with('contributor')->paginate(8);

        $statistics = [
            'ARTICLES'      => Article::count(),
            'MEMBERS'       => Contributor::count(),
            'CATEGORIES'    => Subcategory::count(),
            'MESSAGES'      => Message::count(),
            'FEEDBACK'      => Feedback::count(),
            'VISITORS'      => (int) Visitor::sum('unique')
        ];

        $visitors = Visitor::take(10)->get();

        return view('admin.dashboard.index', compact('activities', 'statistics', 'visitors'));
    }

    /**
     * Show the form for edit setting.
     *
     * @return \Illuminate\Http\Response
     */
    public function setting()
    {
        return view('admin.setting.index');
    }

    /**
     * Update the website setting in storage.
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
         * gives default value 0, regex rule for checking coordinate, and merge
         * error message for notification.
         */

        $rules = [
            'website'       => 'required|max:50',
            'keywords'      => 'required|max:300',
            'status'        => 'required|in:online,maintenance',
            'address'       => 'required|max:100',
            'contact'       => 'required|max:50',
            'email'         => 'required|email|max:30',
            'description'   => 'required|max:160',
            'owner'         => 'required|max:30',
            'latitude'      => 'required|regex:/^[+-]?\d+\.\d+$/',
            'longitude'     => 'required|regex:/^[+-]?\d+\.\d+$/',
            'facebook'      => 'required|url',
            'twitter'       => 'required|url',
            'googleplus'    => 'required|url',
            'favicon'       => 'mimes:jpg,jpeg,gif,png,ico|max:500',
            'background'    => 'mimes:jpg,jpeg,gif,png|max:1000',
            'article'       => 'boolean',
            'feedback'      => 'boolean',
            'member'        => 'boolean',
            'approve'       => 'boolean',
            'admin_email'   => 'required|email|max:30',
            'name'          => 'required|max:50',
            'avatar'        => 'mimes:jpg,jpeg,gif,png|max:1000',
            'password'      => 'required|check_password:admin',
            'new_password'  => 'confirmed|min:6'
        ];

        if (!$request->has('article')) {
            $request->merge(['article' => 0]);
        }
        if (!$request->has('feedback')) {
            $request->merge(['feedback' => 0]);
        }
        if (!$request->has('member')) {
            $request->merge(['member' => 0]);
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $failedRules = $validator->failed();

            if (isset($failedRules['latitude']['Required']) || isset($failedRules['longitude']['Required'])) {
                $validator->errors()->add('location', 'Location is required');
            }
            if (isset($failedRules['latitude']['Regex']) || isset($failedRules['longitude']['Regex'])) {
                $validator->errors()->add('location', 'Invalid GPS coordinate');
            }

            if (isset($failedRules['article']['Boolean']) || isset($failedRules['feedback']['Boolean']) || isset($failedRules['member']['Boolean'])) {
                $validator->errors()->add('notification', 'Notification should be has yes or no value');
            }

            $this->throwValidationException(
                $request, $validator
            );
        }

        DB::transaction(function () use ($request) {
            try {
                Setting::where('key', 'Website Name')->update(['value' => $request->input('website')]);
                Setting::where('key', 'Keywords')->update(['value' => $request->input('keywords')]);
                Setting::where('key', 'Status')->update(['value' => $request->input('status')]);
                Setting::where('key', 'Address')->update(['value' => $request->input('address')]);
                Setting::where('key', 'Contact')->update(['value' => $request->input('contact')]);
                Setting::where('key', 'Email')->update(['value' => $request->input('email')]);
                Setting::where('key', 'Description')->update(['value' => $request->input('description')]);
                Setting::where('key', 'Owner')->update(['value' => $request->input('owner')]);
                Setting::where('key', 'Latitude')->update(['value' => $request->input('latitude')]);
                Setting::where('key', 'Longitude')->update(['value' => $request->input('longitude')]);
                Setting::where('key', 'Facebook')->update(['value' => $request->input('facebook')]);
                Setting::where('key', 'Twitter')->update(['value' => $request->input('twitter')]);
                Setting::where('key', 'Google Plus')->update(['value' => $request->input('googleplus')]);
                Setting::where('key', 'Email Article')->update(['value' => $request->input('article')]);
                Setting::where('key', 'Email Feedback')->update(['value' => $request->input('feedback')]);
                Setting::where('key', 'Email Contributor')->update(['value' => $request->input('member')]);
                Setting::where('key', 'Auto Approve')->update(['value' => $request->input('approve')]);

                $image = new Uploader();
                if ($image->upload($request, 'favicon', base_path('public/'), 'favicon')) {
                    Setting::where('key', 'Favicon')->update(['value' => $request->input('favicon')]);
                }

                if ($image->upload($request, 'background', base_path('public/images/misc/'), 'background')) {
                    Setting::where('key', 'Background')->update(['value' => $request->input('background')]);
                }

                $user = Auth::guard('admin')->user();
                $user->name = $request->input('name');
                if ($request->has('new_password') && !empty($request->get('new_password'))) {
                    $request->merge(['password' => Hash::make($request->input('new_password'))]);
                    $user->password = $request->input('password');
                }
                if ($image->upload($request, 'avatar', base_path('public/images/contributors/'), 'admin_' . Auth::guard('admin')->user()->id)) {
                    $user->avatar = $request->input('avatar');
                }
                $user->save();
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withErrors($e->getErrors())
                    ->withInput();
            }
        });

        return redirect(route('admin.setting'))->with([
            'status' => 'success',
            'message' => 'Setting has been updated',
        ]);
    }

    /**
     * Display about page.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        return view('admin.about.index');
    }
}
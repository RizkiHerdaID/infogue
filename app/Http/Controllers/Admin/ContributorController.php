<?php

namespace Infogue\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Infogue\Contributor;
use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;
use Infogue\Uploader;

class ContributorController extends Controller
{
    /*
     |--------------------------------------------------------------------------
     | Contributor Controller
     |--------------------------------------------------------------------------
     |
     | This controller is responsible for handling contributor management,
     | including suspending, editing, deleting data.
     |
     */

    /**
     * Display a listing of the contributor.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contributor = new Contributor();

        /*
         * --------------------------------------------------------------------------
         * Filtering contributor
         * --------------------------------------------------------------------------
         * Populate optional filter on url break down into data, sorting by, sorting
         * method, and search query, then retrieve the contributor.
         */

        $filter_by = Input::has('by') ? Input::get('by') : 'date';
        $filter_sort = Input::has('sort') ? Input::get('sort') : 'desc';
        $query = Input::has('query') ? Input::get('query') : null;

        $contributors = $contributor->retrieveContributor($filter_by, $filter_sort, $query);

        return view('admin.contributor.index', compact('contributors'));
    }

    /**
     * Show the form for editing the specified contributor.
     *
     * @param $username
     * @return \Illuminate\Http\Response
     */
    public function edit($username)
    {
        $contributor = Contributor::whereUsername($username)->firstOrFail();

        return view('admin.contributor.edit', compact('contributor'));
    }

    /**
     * Update the specified contributor in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name'                  => 'required|max:50',
            'gender'                => 'required|in:male,female,other',
            'date'                  => 'required|max:31',
            'month'                 => 'required|max:12',
            'year'                  => 'required|max:'.(int) Carbon::now()->addYear(-8)->format('Y'),
            'location'              => 'required|max:30',
            'contact'               => 'required|max:20',
            'about'                 => 'required|min:15|max:160',
            'email_subscription'    => 'boolean',
            'email_message'         => 'boolean',
            'email_follow'          => 'boolean',
            'email_feed'            => 'boolean',
            'mobile_notification'   => 'boolean',
            'avatar'                => 'mimes:jpg,jpeg,gif,png|max:1000',
            'cover'                 => 'mimes:jpg,jpeg,gif,png|max:1000',
            'username'              => 'required|alpha_dash|max:20|unique:contributors,username,' . $id,
            'email'                 => 'required|email|max:50|unique:contributors,email,' . $id,
            'new_password'          => 'confirmed|min:6'
        ];

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

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $failedRules = $validator->failed();

            $date = isset($failedRules['date']['Required']);
            $month = isset($failedRules['month']['Required']);
            $year = isset($failedRules['year']['Required']);

            if($date || $month || $year) {
                $validator->errors()->add('birthday', 'Birthday is required');
            }

            $this->throwValidationException(
                $request, $validator
            );
        }

        $request->merge(['birthday' => implode('-', Input::only('year', 'month', 'date'))]);

        /*
         * --------------------------------------------------------------------------
         * Populate contributor data
         * --------------------------------------------------------------------------
         * Retrieve all data from request and populate into contributor object model
         * then store it into database, check if avatar and cover is available then
         * attempt to upload to asset directory.
         */

        $contributor                        = Contributor::findOrFail($id);
        $contributor->name                  = $request->input('name');
        $contributor->gender                = $request->input('gender');
        $contributor->birthday              = $request->input('birthday');
        $contributor->location              = $request->input('location');
        $contributor->contact               = $request->input('contact');
        $contributor->about                 = $request->input('about');
        $contributor->username              = $request->input('username');
        $contributor->email                 = $request->input('email');
        $contributor->instagram             = $request->input('instagram');
        $contributor->facebook              = $request->input('facebook');
        $contributor->twitter               = $request->input('twitter');
        $contributor->googleplus            = $request->input('googleplus');
        $contributor->email_subscription    = $request->input('email_subscription');
        $contributor->email_message         = $request->input('email_message');
        $contributor->email_follow          = $request->input('email_follow');
        $contributor->email_feed            = $request->input('email_feed');
        $contributor->mobile_notification   = $request->input('mobile_notification');

        $image = new Uploader();
        if($image->upload($request, 'avatar', base_path('public/images/contributors/'), 'avatar_'.$id)){
            $contributor->avatar = $request->input('avatar');
        }
        if($image->upload($request, 'cover', base_path('public/images/covers/'), 'cover_'.$id)){
            $contributor->cover = $request->input('cover');
        }
        if ($request->has('new_password') && !empty($request->get('new_password'))) {
            $contributor->password = Hash::make($request->input('new_password'));
        }

        if($contributor->save()){
            return redirect(route('admin.contributor.index'))
                ->with('status', 'success')
                ->with('message', '<strong>'.$contributor->name.'</strong> data has been updated');
        }
        else{
            return redirect()->back()->withErrors(['error' => 'Something is getting wrong']);
        }
    }

    /**
     * Remove the specified contributor from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        /*
         * --------------------------------------------------------------------------
         * Delete contributor
         * --------------------------------------------------------------------------
         * Check if selected variable is not empty so user intends to select multiple
         * rows at once, and prepare the feedback message according the type of
         * deletion action.
         */

        if(!empty(trim($request->input('selected')))){
            $contributor_ids = explode(',', $request->input('selected'));

            $delete = Contributor::whereIn('id', $contributor_ids)->delete();

            $name = count($contributor_ids).' Contributors';
        }
        else{
            $contributor = Contributor::findOrFail($id);

            $name = $contributor->name;

            $delete = $contributor->delete();
        }

        $status = $delete ? 'warning' : 'danger';

        $message = $delete ? 'The <strong>'.$name.'</strong> was deleted' : 'Something is getting wrong';

        return redirect(route('admin.contributor.index'))->with([
            'status' => $status,
            'message' => $message,
        ]);
    }
}
<?php

namespace Infogue\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Infogue\Contributor;
use Infogue\Http\Requests;
use Infogue\Http\Controllers\Controller;
use Infogue\Uploader;

class ContributorController extends Controller
{
    /**
     * Display a listing of the contributor.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contributor = new Contributor();

        $filter_by = Input::has('by') ? Input::get('by') : 'date';
        $filter_sort = Input::has('sort') ? Input::get('sort') : 'desc';

        $contributors = $contributor->retrieveContributor($filter_by, $filter_sort);

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
            'name' => 'required|max:50',
            'gender' => 'required|in:male,female,other',
            'date' => 'required|max:31',
            'month' => 'required|max:12',
            'year' => 'required|max:'.(int) Carbon::now()->addYear(-8)->format('Y'),
            'location' => 'required|max:30',
            'contact' => 'required|max:20',
            'about' => 'required|min:15|max:160',
            'email_subscription' => 'boolean',
            'email_message' => 'boolean',
            'email_follow' => 'boolean',
            'email_feed' => 'boolean',
            'mobile_notification' => 'boolean',
            'avatar' => 'mimes:jpg,jpeg,gif,png|max:1000',
            'cover' => 'mimes:jpg,jpeg,gif,png|max:1000',
            'username' => 'required|alpha_dash|max:20|unique:contributors,username,' . $id,
            'email' => 'required|email|max:50|unique:contributors,email,' . $id,
            'new_password' => 'confirmed|min:6'
        ];

        $validator = Validator::make($request->all(), $rules);

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
            $failedRules = $validator->failed();

            if(isset($failedRules['date']['Required']) || isset($failedRules['month']['Required']) || isset($failedRules['year']['Required'])) {
                $validator->errors()->add('birthday', 'Birthday is required');
            }

            $this->throwValidationException(
                $request, $validator
            );
        }

        $request->merge(['birthday' => implode('-', Input::only('year', 'month', 'date'))]);

        $contributor = Contributor::findOrFail($id);
        $contributor->name = $request->input('name');
        $contributor->gender = $request->input('gender');
        $contributor->birthday = $request->input('birthday');
        $contributor->location = $request->input('location');
        $contributor->contact = $request->input('contact');
        $contributor->about = $request->input('about');
        $contributor->username = $request->input('username');
        $contributor->email = $request->input('email');
        $image = new Uploader();
        if($image->upload($request, 'avatar', base_path('public/images/contributors/'), 'avatar_'.$id)){
            $contributor->avatar = $request->input('avatar');
        }
        if($image->upload($request, 'cover', base_path('public/images/covers/'), 'cover_'.$id)){
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
            $contributor->password = Hash::make($request->input('new_password'));
        }

        $result = $contributor->save();

        if($result){
            return redirect()
                ->route('admin.contributor.index')
                ->with('status', 'success')
                ->with('message', '<strong>'.$contributor->name.'</strong> data has been updated');
        }
        else{
            return redirect()
                ->back()->withErrors()
                ->with('status', 'danger')
                ->with('message', '<strong>'.$contributor->name.'</strong> data fail to update');
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

        return redirect()->route('admin.contributor.index')
            ->with('status', $status)
            ->with('message', $message);
    }
}

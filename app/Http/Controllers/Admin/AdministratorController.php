<?php

namespace Infogue\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Infogue\Activity;
use Infogue\Article;
use Infogue\Contributor;
use Infogue\Feedback;
use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;
use Infogue\Message;
use Infogue\Setting;
use Infogue\Subcategory;
use Infogue\User;
use Infogue\Visitor;

class AdministratorController extends Controller
{
    private $user;
    private $setting;

    public function __construct(User $user, Setting $setting)
    {
        $this->user = $user;
        $this->setting = $setting;
    }

    /**
     * Display a administrator dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::with('contributor')->paginate(8);

        $statistics = [
            'ARTICLES' => Article::count(),
            'MEMBERS' => Contributor::count(),
            'CATEGORIES' => Subcategory::count(),
            'MESSAGES' => Message::count(),
            'FEEDBACK' => Feedback::count(),
            'VISITORS' => (int) Visitor::sum('unique')
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Display about page.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        //
    }

}

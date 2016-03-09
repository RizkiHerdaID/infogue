<?php

namespace Infogue\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Infogue\Feedback;
use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the feedback.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filter_data = Input::has('data') ? Input::get('data') : 'all';
        $filter_by = Input::has('by') ? Input::get('by') : 'date';
        $filter_sort = Input::has('sort') ? Input::get('sort') : 'desc';
        $query = Input::has('query') ? Input::get('query') : null;

        $feedback = new Feedback();

        $feedbacks = $feedback->retrieveFeedback($filter_data, $filter_by, $filter_sort, $query);

        return view('admin.feedback.index', compact('feedbacks'));
    }

    /**
     * Store a newly created feedback in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function reply(Request $request)
    {
        //
    }

    /**
     * Store a newly created feedback in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function important(Request $request)
    {
        //
    }

    /**
     * Store a newly created feedback in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function archive(Request $request)
    {
        //
    }

    /**
     * Remove the specified feedback from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feedback = $this->feedback->find($id);

        $feedback->delete();

        return redirect()->route('admin.feedback.index')
            ->with('status', Lang::get('alert.feedback_deleted'));
    }
}

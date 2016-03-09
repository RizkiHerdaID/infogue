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
     * @param $label
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function mark($label, $id)
    {
        $feedback = Feedback::findOrFail($id);

        $feedback->label = $label;

        $result = $feedback->save();

        if($result){
            return redirect()
                ->route('admin.feedback.index')
                ->with('status', $label=='important'? 'warning' : 'success')
                ->with('message', 'Feedback from <strong>'.$feedback->name.'</strong> marked as <strong>'.$label.'</strong>');
        }
        else {
            return redirect()
                ->back()->withErrors()
                ->with('status', 'danger')
                ->with('message', 'Feedback from <strong>'.$feedback->name.'</strong> fail mark as <strong>'.$label.'</strong>');
        }
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

<?php

namespace Infogue\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Infogue\Feedback;
use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;

class FeedbackController extends Controller
{
    /*
     |--------------------------------------------------------------------------
     | Feedback Controller
     |--------------------------------------------------------------------------
     |
     | This controller is responsible for handling feedback management including
     | read feedback, marking as important, achieving them and reply the
     | message to their email.
     |
     */

    /**
     * Display a listing of the feedback.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
         * --------------------------------------------------------------------------
         * Filtering feedback
         * --------------------------------------------------------------------------
         * Populate optional filter on url break down in data, sorting by, sorting
         * method, and search query, then retrieve the feedback.
         */

        $filter_data    = Input::has('data') ? Input::get('data') : 'all';
        $filter_by      = Input::has('by') ? Input::get('by') : 'date';
        $filter_sort    = Input::has('sort') ? Input::get('sort') : 'desc';
        $query          = Input::has('query') ? Input::get('query') : null;

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
        $id         = $request->input('id');
        $name       = $request->input('name');
        $email      = $request->input('email');
        $message    = $request->input('message');
        $reply      = $request->input('reply');

        $feedback = new Feedback();

        $result = $feedback->reply($id, $name, $email, $message, $reply);

        if ($result) {
            return redirect(route('admin.feedback.index'))->with([
                'status' => 'success',
                'message' => 'Reply of feedback <strong>#' . $id . '</strong> has been sent to <strong>' . $email . '</strong>'
            ]);
        } else {
            return redirect()->back()->withErrors();
        }
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

        if ($result) {
            return redirect()
                ->route('admin.feedback.index')->with([
                    'status' => $label == 'important' ? 'warning' : 'success',
                    'message' => 'Feedback from <strong>' . $feedback->name . '</strong> marked as <strong>' . $label . '</strong>',
                ]);
        } else {
            return redirect()->back()->withErrors();
        }
    }

    /**
     * Remove the specified feedback from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        /*
         * --------------------------------------------------------------------------
         * Delete feedback
         * --------------------------------------------------------------------------
         * Check if selected variable is not empty so user intends to select multiple
         * rows at once, and prepare the feedback message according the type of
         * deletion action.
         */

        if (!empty(trim($request->input('selected')))) {
            $feedback_ids = explode(',', $request->input('selected'));

            $delete = Feedback::whereIn('id', $feedback_ids)->delete();

            $name = count($feedback_ids) . ' Feedbacks';
        } else {
            $feedback = Feedback::findOrFail($id);

            $name = $feedback->name;

            $delete = $feedback->delete();
        }

        $status = $delete ? 'warning' : 'danger';

        $message = $delete ? '<strong>' . $name . '\'s</strong> feedback was deleted' : 'Something is getting wrong';

        return redirect(route('admin.feedback.index'))->with([
            'status' => $status,
            'message' => $message,
        ]);
    }
}

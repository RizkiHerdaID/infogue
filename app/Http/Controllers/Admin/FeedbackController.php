<?php

namespace Infogue\Http\Controllers\Admin;

use Illuminate\Http\Request;
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
        $feedback = $this->feedback->paginate(10);

        return view('admin.feedback.data', compact('feedback'));
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

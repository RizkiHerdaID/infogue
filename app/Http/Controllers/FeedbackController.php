<?php

namespace Infogue\Http\Controllers;

use Illuminate\Support\Facades\Lang;
use Infogue\Feedback;
use Infogue\Http\Requests;
use Infogue\Http\Requests\CreateFeedbackRequest;

class FeedbackController extends Controller
{
    private $feedback;

    public function __construct(Feedback $feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedback = $this->feedback->paginate(10);

        return view('admin.feedback.data', compact('feedback'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request|CreateFeedbackRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFeedbackRequest $request)
    {
        $this->feedback->create($request->all());

        return redirect('contact')->with('status', Lang::get('alert.feedback_sent'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feedback = $this->feedback->find($id);

        $feedback->delete();

        return redirect()->route('admin::feedback.index')
            ->with('status', Lang::get('alert.feedback_deleted'));
    }
}

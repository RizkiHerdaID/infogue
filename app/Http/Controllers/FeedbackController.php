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
     * Store a newly created feedback in storage.
     *
     * @param \Illuminate\Http\Request|CreateFeedbackRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFeedbackRequest $request)
    {
        $this->feedback->create($request->all());

        return redirect('contact')->with('status', Lang::get('alert.feedback_sent'));
    }

}

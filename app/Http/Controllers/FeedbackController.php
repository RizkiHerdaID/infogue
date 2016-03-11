<?php

namespace Infogue\Http\Controllers;

use Illuminate\Support\Facades\Lang;
use Infogue\Feedback;
use Infogue\Http\Requests;
use Infogue\Http\Requests\CreateFeedbackRequest;

class FeedbackController extends Controller
{
    /**
     * The instance variable of the Feedback class.
     *
     * @var Feedback
     */
    private $feedback;

    /**
     * Create a new Feedback model instance.
     *
     * @param Feedback $feedback
     */
    public function __construct(Feedback $feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * Store a newly feedback in storage.
     *
     * @param \Illuminate\Http\Request|CreateFeedbackRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFeedbackRequest $request)
    {
        $this->feedback->fill($request->all());

        if($this->feedback->save()){
            return redirect()->route('page.contact')
                ->with('status','success')
                ->with('message', Lang::get('alert.feedback_sent'));;
        }

        return redirect()->back()->withErrors();
    }

}

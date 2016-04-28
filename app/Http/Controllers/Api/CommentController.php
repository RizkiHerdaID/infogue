<?php

namespace Infogue\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Infogue\Comment;
use Infogue\Http\Requests;
use Infogue\Http\Controllers\Controller;

class CommentController extends Controller
{
	/*
    |--------------------------------------------------------------------------
    | Comment Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling showing comment page
    | including submit and provide comment data.
    |
    */

    /**
     * Create a new comment controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['only' => ['comment.store']]);
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();

        return response()->json([
            'request_id' => uniqid(),
            'status' => 'success',
            'timestamp' => Carbon::now(),
            'comments' => $comments,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article_id = $request->input('article_id');
        $contributor_id = $request->input('contributor_id');
        $message = $request->input('comment');

        $comment = new Comment();
        $comment->article_id = $article_id;
        $comment->contributor_id = $contributor_id;
        $comment->comment = $message;

        $result = $comment->save();

        return response()->json([
            'request_id' => uniqid(),
            'status' => $result ? 'success' : 'failure',
            'timestamp' => Carbon::now(),
        ], $result ? 200 : 500);
    }
}

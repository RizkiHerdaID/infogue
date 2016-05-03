<?php

namespace Infogue\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Infogue\Article;
use Infogue\Comment;
use Infogue\Http\Requests;

class CommentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Comment Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling save request and store
    | comment into storage.
    |
    */

    /**
     * Store a newly comment in storage.
     *
     * @param \Illuminate\Http\Request
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $slug)
    {
        $rules = [
            'comment' => 'required|max:2000',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $article = Article::whereSlug($slug)->firstOrFail();

        $comment = new Comment();
        $comment->contributor_id = Auth::user()->id;
        $comment->article_id = $article->id;
        $comment->comment = $request->input('comment');

        if ($comment->save()) {
            return redirect(route('article.show', [$slug]) . '#form-comment')->with([
                'status' => 'success',
                'message' => Lang::get('alert.comment.send')
            ]);
        }

        return redirect()->back()->withErrors(['error' => Lang::get('alert.error.database')]);
    }
}

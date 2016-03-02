<?php

namespace Infogue\Http\Controllers;

use Illuminate\Http\Request;
use Infogue\Conversation;
use Infogue\Http\Requests;
use Infogue\Message;

class MessageController extends Controller
{
    private $message;
    private $conversation;

    public function __construct(Message $message, Conversation $conversation)
    {
        $this->message = $message;
        $this->conversation = $conversation;
    }

    /**
     * Display a listing of the message.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contributor.message');
    }

    /**
     * Show the form for creating a new message.
     *
     * @param $username
     * @return \Illuminate\Http\Response
     */
    public function conversation($username)
    {
        //
    }

    /**
     * Send new message to another contributor in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        //
    }

    /**
     * Remove the specified message from database.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

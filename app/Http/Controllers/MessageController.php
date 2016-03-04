<?php

namespace Infogue\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
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
        $message = new Message();

        $messages = $message->retrieveMessages(Auth::user()->id);

        if (Input::get('page', false)) {
            return $messages;
        } else {
            return view('contributor.message', compact('messages'));
        }
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
        $sender = Auth::user()->id;
        $receiver = (int) $request->input('contributor_id');

        $lastMessage = Conversation::whereSender($sender)->whereReceiver($receiver)->orWhere('sender', $receiver)->whereReceiver($sender)->first();

        if(count($lastMessage) == 0){
            $message = new Message();
            $message->save();
            $messageId = $message->id;
        }
        else{
            $messageId = $lastMessage->message_id;
        }

        $conversation = new Conversation();
        $conversation->message_id = $messageId;
        $conversation->sender = $sender;
        $conversation->receiver = $receiver;
        $conversation->message = $request->input('message');
        $conversation->save();

        return redirect()->back()
            ->with('status', 'success')
            ->with('message', 'The message was sent');
    }

    /**
     * Remove the specified message from database.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $message = Conversation::whereMessageId($id);

        if(count($message->get()) == 0){
            abort(404);
        }
        else{
            if($request->input('sender') == Auth::user()->id){
                $message->update(['is_available_sender' => 0]);
            }
            else{
                $message->update(['is_available_receiver' => 0]);
            }
        }

        return redirect()->route('account.message.list')
            ->with('status', 'danger')
            ->with('message', 'Conversation with <strong>' . $request->input('contributor') . '</strong> was deleted');
    }
}

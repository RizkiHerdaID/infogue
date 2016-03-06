<?php

namespace Infogue\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Infogue\Activity;
use Infogue\Attachment;
use Infogue\Contributor;
use Infogue\Conversation;
use Infogue\Http\Requests;
use Infogue\Uploader;
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
        $contributor = Contributor::whereUsername($username)->firstOrFail();

        $conversation = new Conversation();
        $conversations = $conversation->retrieveConversation($contributor->id, Input::get('last', null));

        if (Input::get('page', false) || Input::has('last')) {
            return $conversations;
        } else {
            return view('contributor.conversation', compact('contributor', 'conversations'));
        }
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

        $contributor = Contributor::findOrFail($receiver);
        if($contributor->email_message){
            $this->sendEmailNotification($sender, $receiver, $request->input('message'));
        }

        if($request->has('async')){
            $image = new Uploader();
            if ($image->upload($request, 'attachment', base_path('public/file/'), rand(0, 1000) . uniqid())) {
                $attachment = new Attachment();
                $attachment->conversation_id = $conversation->id;
                $attachment->file = $request->input('attachment');
                $attachment->save();
            }
        }
        else{
            return redirect()->back()
                ->with('status', 'success')
                ->with('message', 'The message was sent');
        }
    }

    public function sendEmailNotification($sender, $receiver, $message)
    {
        $contributorSender = Contributor::findOrFail($sender);
        $contributorReceiver = Contributor::findOrFail($receiver);

        $activity = new Activity();
        $activity->contributor_id = Auth::user()->id;
        $activity->activity = $activity->sendingMessageActivity($contributorSender->username, $contributorReceiver->username);
        $activity->save();

        $data = [
            'receiverName' => $contributorReceiver->name,
            'receiverUsername' => $contributorReceiver->username,
            'receiverMessage' => $message,
            'senderName' => $contributorSender->name,
            'senderLocation' => $contributorSender->location,
            'senderUsername' => $contributorSender->username,
            'senderAvatar' => $contributorSender->avatar,
            'senderArticle' => $contributorSender->articles()->count(),
            'senderFollower' => $contributorSender->followers()->count(),
            'senderFollowing' => $contributorSender->following()->count(),
        ];

        Mail::send('emails.message', $data, function ($message) use ($contributorReceiver, $contributorSender) {

            $message->from('no-reply@infogue.id', 'Infogue.id');

            $message->replyTo('no-reply@infogue.id', 'Infogue.id');

            $message->to($contributorReceiver->email)->subject($contributorSender->name.' sent you a message');

        });
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

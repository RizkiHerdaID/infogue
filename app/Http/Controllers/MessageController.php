<?php

namespace Infogue\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Infogue\Activity;
use Infogue\Attachment;
use Infogue\Contributor;
use Infogue\Conversation;
use Infogue\Http\Requests;
use Infogue\Message;
use Infogue\Uploader;

class MessageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Message Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling send private message between
    | contributors, this message including send text or attachment.
    |
    */

    /**
     * Instance variable of Message.
     *
     * @var Message
     */
    private $message;

    /**
     * Instance variable of Conversation.
     *
     * @var Conversation
     */
    private $conversation;

    /**
     * Create a new message controller instance.
     *
     * @param Message $message
     * @param Conversation $conversation
     */
    public function __construct(Message $message, Conversation $conversation)
    {
        $this->message = $message;

        $this->conversation = $conversation;
    }

    /**
     * Display a listing of the account message.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*
         * --------------------------------------------------------------------------
         * Populating account messages
         * --------------------------------------------------------------------------
         * Retrieve messages 10 data per request, because we implement lazy
         * pagination via ajax so return json data when 'page' variable exist, and
         * return view if doesn't.
         */

        $messages = $this->message->retrieveMessages(Auth::user()->id);

        if (Input::get('page', false) && $request->ajax()) {
            return $messages;
        } else {
            return view('contributor.message', compact('messages'));
        }
    }

    /**
     * Show the list of conversation between contributor.
     *
     * @param Request $request
     * @param $username
     * @return \Illuminate\Http\Response
     */
    public function conversation(Request $request, $username)
    {
        /*
         * --------------------------------------------------------------------------
         * Retrieve conversation
         * --------------------------------------------------------------------------
         * Retrieve conversation 15 data per request, because we implement lazy
         * pagination via ajax so return json data when 'page' variable exist, and
         * return view if doesn't.
         */

        $contributor = Contributor::whereUsername($username)->firstOrFail();

        $conversations = $this->conversation->retrieveConversation($contributor->id, Input::get('last', null));

        if ((Input::get('page', false) || Input::has('last')) && $request->ajax()) {
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
        /*
         * --------------------------------------------------------------------------
         * Create message
         * --------------------------------------------------------------------------
         * Each conversation will handle by one message record as identity, first
         * check if contributor sender or receiver ever make conversation, if they
         * did not then create new one of message.
         */

        $sender = Auth::user()->id;

        $receiver = (int)$request->input('contributor_id');

        $lastMessage = $this->conversation
            ->whereSender($sender)
            ->whereReceiver($receiver)
            ->orWhere('sender', $receiver)
            ->whereReceiver($sender)
            ->first();

        if (count($lastMessage) == 0) {
            $message = new Message();
            $message->save();
            $messageId = $message->id;
        } else {
            $messageId = $lastMessage->message_id;
        }

        /*
         * --------------------------------------------------------------------------
         * Create conversation
         * --------------------------------------------------------------------------
         * Populate message id from last conversation or last inserted new message
         * then create the first conversation or continue with last message, check
         * if there is request of attachment, if so then upload it.
         */

        $conversation = new Conversation([
            'message_id' => $messageId,
            'sender' => $sender,
            'receiver' => $receiver,
            'message' => $request->input('message'),
        ]);
        //$conversation->message_id = $messageId;
        //$conversation->sender = $sender;
        //$conversation->receiver = $receiver;
        //$conversation->message = $request->input('message');

        if ($conversation->save()) {
            $contributor = Contributor::findOrFail($receiver);
            if ($contributor->email_message) {
                $this->sendEmailNotification(Auth::user(), $contributor, $request->input('message'));
            }

            if ($request->has('async') && $request->ajax()) {
                $image = new Uploader();
                if ($image->upload($request, 'attachment', base_path('public/file/'), 'attachment_' . uniqid())) {
                    $attachment = new Attachment();
                    $attachment->conversation_id = $conversation->id;
                    $attachment->file = $request->input('attachment');
                    if (!$attachment->save()) {
                        return false;
                    }
                }
                return 'sent';
            }

            return redirect()->back()->with([
                'status' => 'success',
                'message' => Lang::get('alert.message.send', ['receiver' => $contributor->name])
            ]);
        }

        if ($request->has('async') && $request->ajax()) {
            return false;
        }

        return redirect()->back()->with([
            'status' => 'danger',
            'message' => Lang::get('alert.error.database')
        ]);
    }

    /**
     * Send message email notification.
     *
     * @param $sender
     * @param $receiver
     * @param $message
     */
    public function sendEmailNotification($sender, $receiver, $message)
    {
        /*
         * --------------------------------------------------------------------------
         * Create sending message activity
         * --------------------------------------------------------------------------
         * Create new instance of Activity and insert following activity.
         */
        Activity::create([
            'contributor_id' => $sender->id,
            'activity' => Activity::sendingMessageActivity($sender->username, $receiver->username)
        ]);

        $data = [
            'receiverName' => $receiver->name,
            'receiverUsername' => $receiver->username,
            'receiverMessage' => $message,
            'senderName' => $sender->name,
            'senderLocation' => $sender->location,
            'senderUsername' => $sender->username,
            'senderAvatar' => $sender->avatar,
            'senderArticle' => $sender->articles()->count(),
            'senderFollower' => $sender->followers()->count(),
            'senderFollowing' => $sender->following()->count(),
        ];

        Mail::send('emails.message', $data, function ($message) use ($sender, $receiver) {
            $message->from(env('MAIL_ADDRESS', 'no-reply@infogue.id'), env('MAIL_NAME', 'Infogue.id'));

            $message->replyTo('no-reply@infogue.id', env('MAIL_NAME', 'Infogue.id'));

            $message->to($receiver->email)->subject($sender->name . ' sent you a message');
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

        if (count($message->get()) == 0) {
            abort(404);
        }

        $result = DB::transaction(function () use ($request, $message, $id) {
            try{
                if ($request->input('sender') == Auth::user()->id) {
                    $message->update(['is_available_sender' => 0]);
                } else {
                    $message->update(['is_available_receiver' => 0]);
                }

                Conversation::whereIsAvailableSender(0)->whereIsAvailableReceiver(0)->delete();

                $message = Message::find($id);

                $conversations = $message->conversations()->count();

                if(!$conversations){
                    $message->delete();
                }

                return redirect(route('account.message.list'))->with([
                    'status' => 'danger',
                    'message' => Lang::get('alert.message.delete', ['receiver' => $request->input('contributor')])
                ]);

            } catch (\Exception $e) {
                return redirect()->back()
                    ->withErrors(['error' => Lang::get('alert.error.transaction')])
                    ->withInput();
            }
        });

        return $result;
    }
}

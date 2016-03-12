<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Conversation extends Model
{
    protected $fillable = ['message_id', 'sender', 'receiver', 'message', 'is_available_sender', 'is_available_receiver'];

    public function receiver()
    {
        $this->belongsTo('Infogue\Contributor', 'receiver');
    }

    public function sender()
    {
        $this->belongsTo('Infogue\Contributor', 'sender');
    }

    public function attachment()
    {
        $this->hasOne('Infogue\Attachment');
    }

    public function retrieveConversation($id, $last = null){
        $contributor_id = $id;
        $user_id = Auth::user()->id;

        $message = $this->whereSender($user_id)->whereReceiver($contributor_id)
            ->orWhere('sender', '=', $contributor_id)->whereReceiver($user_id)->firstOrFail();

        $conversations = $this->select(DB::raw('conversations.id AS id, name, username, avatar, message_id, sender, receiver, message, file AS attachment, conversations.created_at'))
            ->leftJoin('attachments', 'conversations.id', '=', 'attachments.conversation_id')
            ->join('contributors', 'contributors.id', '=', 'sender')
            ->whereMessageId($message->message_id)
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc');

        if($last != null || $last != 0){
            $conversations = $conversations->where('conversations.id', '>', $last)->get();
            return ["data"=>$this->preConversationModifier($conversations)];
        }

        return $this->preConversationModifier($conversations->paginate(15));
    }

    public function preConversationModifier($conversations)
    {
        foreach ($conversations as $conversation):

            $conversation->contributor_ref = route('contributor.stream', [$conversation->username]);
            $conversation->avatar_ref = asset("images/contributors/{$conversation->avatar}");
            $conversation->attachment_ref = asset("file/{$conversation->attachment}");
            $conversation->owner = ($conversation->sender == Auth::user()->id) ? 'me' : 'they';
            $conversation->has_attachment = ($conversation->attachment == null) ? 'hidden' : '';
            $conversation->message = nl2br($conversation->message);
        endforeach;

        return $conversations;
    }
}

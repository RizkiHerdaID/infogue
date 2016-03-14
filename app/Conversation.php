<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Conversation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['message_id', 'sender', 'receiver', 'message', 'is_available_sender', 'is_available_receiver'];

    /**
     * Many-to-one relationship, find out the conversation belong to receiver.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receiver()
    {
        return $this->belongsTo('Infogue\Contributor', 'receiver');
    }

    /**
     * Many-to-one relationship, find out the conversation belong to sender.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo('Infogue\Contributor', 'sender');
    }

    /**
     * One-to-one relationship, get attachment in conversation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function attachment()
    {
        return $this->hasOne('Infogue\Attachment');
    }

    /**
     * Retrieve conversation in chat box.
     *
     * @param $id
     * @param null $last
     * @return array
     */
    public function retrieveConversation($id, $last = null)
    {
        $contributor_id = $id;
        $user_id = Auth::user()->id;

        /*
         * --------------------------------------------------------------------------
         * Conversation message
         * --------------------------------------------------------------------------
         * Each conversation between contributor it's represented by a message
         * record, find out and get the id then.
         */

        $message = $this->whereSender($user_id)->whereReceiver($contributor_id)
            ->orWhere('sender', '=', $contributor_id)->whereReceiver($user_id)->firstOrFail();

        /*
         * --------------------------------------------------------------------------
         * Populate the conversation
         * --------------------------------------------------------------------------
         * Select conversation by message id, and find out each conversation record
         * has attachment and join with contributor to get the information who
         * sender and who receiver.
         */

        $conversations = $this->select(DB::raw('conversations.id AS id, name, username, avatar, message_id, sender, receiver, message, file AS attachment, conversations.created_at'))
            ->leftJoin('attachments', 'conversations.id', '=', 'attachments.conversation_id')
            ->join('contributors', 'contributors.id', '=', 'sender')
            ->whereMessageId($message->message_id)
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc');

        /*
         * --------------------------------------------------------------------------
         * Newly conversation checking
         * --------------------------------------------------------------------------
         * This condition checking if $last variable is passed as param then we
         * intent to check if new message has arrived and return it.
         */

        if ($last != null || $last != 0) {
            $conversations = $conversations->where('conversations.id', '>', $last)->get();
            return ["data" => $this->preConversationModifier($conversations)];
        }

        /*
         * --------------------------------------------------------------------------
         * Retrieve per 15 conversation
         * --------------------------------------------------------------------------
         * If not then return conversation every 15 data and modify the data before
         * it returned.
         */

        return $this->preConversationModifier($conversations->paginate(15));
    }

    /**
     * Modifying conversation data for javascript template.
     *
     * @param $conversations
     * @return mixed
     */
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

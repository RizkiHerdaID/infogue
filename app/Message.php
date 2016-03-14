<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Message extends Model
{
    /**
     * One-to-many relationship, retrieve conversations by message.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function conversations()
    {
        return $this->hasMany('Infogue\Conversation');
    }

    /**
     * Retrieve all messages by contributor.
     *
     * @param $contributor_id
     * @return mixed
     */
    public function retrieveMessages($contributor_id)
    {
        $id = 0;

        if (Auth::check()) {
            $id = Auth::id();
        }

        /*
         * --------------------------------------------------------------------------
         * Retrieve message list
         * --------------------------------------------------------------------------
         * Select conversation by contributor and find who is the first sender,
         * just select data with marker column which has value 1, if sender is
         * this contributor then is_available_sender must be 1, otherwise
         * is_available_receiver must be 1, this marker as guard that the data
         * is available for the contributor because if the value of marker depends
         * on they are the first sender or not then the message or conversation has
         * been deleted before, and in other situation another user who chat with
         * must keep see the message, because we just update the marker 0 or 1,
         * 0 mean deleted, 1 mean available.
         */

        $conversation = Conversation::select(DB::raw('conversations.*, message_sender, IF(sender = ' . $contributor_id . ', receiver, sender) AS interact_with'))
            ->join(DB::raw('
            (SELECT message_id, sender AS message_sender
            FROM  conversations
            WHERE (sender = ' . $contributor_id . ' OR receiver = ' . $contributor_id . ')
            GROUP BY message_id) senders'), 'conversations.message_id', '=', 'senders.message_id')
            ->whereRaw('(sender = ' . $contributor_id . ' OR receiver = ' . $contributor_id . ')')
            ->whereRaw('IF(message_sender = ' . $contributor_id . ', is_available_sender, is_available_receiver) = 1 ')
            ->orderBy('id', 'desc');

        /*
         * --------------------------------------------------------------------------
         * Grouping at once
         * --------------------------------------------------------------------------
         * Group the conversation by message_id, it mean same result of group by
         * contributor who talk with then select the partner of conversation,
         * because we just show the opposite of us as contributor.
         */

        $messages = $this->select(DB::raw('contributors.id AS contributor_id, name, username, avatar, conversations.*, CASE WHEN following IS NULL THEN 0 ELSE 1 END AS is_following, COUNT(*) as conversation_total'))
            ->from(DB::raw("({$conversation->toSql()}) as conversations"))
            ->join('contributors', 'contributors.id', '=', 'conversations.interact_with')
            ->leftJoin(DB::raw("(SELECT following FROM followers WHERE contributor_id = {$id}) followings"), 'contributors.id', '=', 'followings.following')
            ->groupBy('message_id')->orderBy('conversations.created_at', 'desc')
            ->paginate(10);

        return $this->preMessageModifier($messages);
    }

    /**
     * Modifying the message data for javascript template.
     * 
     * @param $messages
     * @return mixed
     */
    public function preMessageModifier($messages)
    {
        foreach ($messages as $message):

            $message->contributor_ref = route('contributor.stream', [$message->username]);
            $message->conversation_ref = route('account.message.conversation', [$message->username]);
            $message->avatar_ref = asset("images/contributors/{$message->avatar}");
            $message->message = str_limit($message->message, 30);
            $message->following_status = ($message->is_following) ? 'btn-unfollow active' : 'btn-follow';
            $message->following_text = ($message->is_following) ? 'UNFOLLOW' : 'FOLLOW';

        endforeach;

        return $messages;
    }
}

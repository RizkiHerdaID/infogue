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
        $sender = "
            SELECT
              conversations.message_id AS message_id,
              sender AS message_sender
            FROM conversations
              JOIN (SELECT message_id, MIN(created_at) AS timestamp FROM conversations GROUP BY conversations.message_id) dates_min
                ON conversations.message_id = dates_min.message_id
                   AND created_at = dates_min.timestamp
            WHERE
              (sender = " . $contributor_id . " OR receiver = " . $contributor_id . ")
        ";

        $conversation = Conversation::select(
            DB::raw('
                id,
                conversations.message_id AS message_id,
                IF(sender = ' . $contributor_id . ', receiver, sender) AS interact_with,
                message_sender,
                message,
                conversation_total,
                conversations.created_at AS created_at'))
            ->join(DB::raw('(SELECT message_id, COUNT(*) as conversation_total, MAX(created_at) AS timestamp FROM conversations GROUP BY message_id) dates'), function ($join) {
                $join->on('conversations.message_id', '=', 'dates.message_id');
                $join->on('created_at', '=', 'dates.timestamp');
            })
            ->join(DB::raw('(' . $sender . ') AS first_sender'), 'conversations.message_id', '=', 'first_sender.message_id')
            ->whereRaw('(sender = ' . $contributor_id . ' OR receiver = ' . $contributor_id . ')')
            ->whereRaw('IF(message_sender = ' . $contributor_id . ', is_available_sender, is_available_receiver) = 1 ')
            ->orderBy('conversations.created_at', 'desc');

        /*
         * --------------------------------------------------------------------------
         * Grouping at once
         * --------------------------------------------------------------------------
         * Group the conversation by message_id, it mean same result of group by
         * contributor who talk with then select the partner of conversation,
         * because we just show the opposite of us as contributor.
         * message_sender is the one who sent email first.
         */
        $contributor = Contributor::select(
            DB::raw("
                conversations.id, 
                message_id, 
                message_sender, 
                contributors.id AS contributor_id,
                name, 
                username,
                avatar,
                message,
                conversation_total,
                conversations.created_at"))
            ->join(DB::raw("({$conversation->toSql()}) AS conversations"), 'conversations.interact_with', '=', 'contributors.id')
            ->orderBy('conversations.created_at', 'desc')
            ->paginate(10);

        return $this->preMessageModifier($contributor);
    }

    /**
     * Modifying the message data for javascript template.
     *
     * @param $messages
     * @return mixed
     */
    public function preMessageModifier($messages)
    {
        $route = Auth::guard('admin')->check() ? 'admin' : 'account';
        foreach ($messages as $message):

            $message->contributor_ref = route('contributor.stream', [$message->username]);
            $message->conversation_ref = route($route . '.message.conversation', [$message->username]);
            $message->avatar_ref = asset("images/contributors/{$message->avatar}");
            $message->message = str_limit($message->message, 30);
            $message->following_status = ($message->is_following) ? 'btn-unfollow active' : 'btn-follow';
            $message->following_text = ($message->is_following) ? 'UNFOLLOW' : 'FOLLOW';

        endforeach;

        return $messages;
    }
}

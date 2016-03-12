<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Message extends Model
{
    public function conversations()
    {
        $this->hasMany('Infogue\Conversation');
    }

    public function retrieveMessages($contributor_id)
    {
        $id = 0;

        if (Auth::check()) {
            $id = Auth::id();
        }

        $conversation = Conversation::select(DB::raw('conversations.*, message_sender, IF(sender = '.$contributor_id.', receiver, sender) AS interact_with'))
            ->join(DB::raw('
            (SELECT message_id, sender AS message_sender
            FROM  conversations
            WHERE (sender = '.$contributor_id.' OR receiver = '.$contributor_id.')
            GROUP BY message_id) senders'), 'conversations.message_id', '=', 'senders.message_id')
            ->whereRaw('(sender = '.$contributor_id.' OR receiver = '.$contributor_id.')')
            ->whereRaw('IF(message_sender = '.$contributor_id.', is_available_sender, is_available_receiver) = 1 ')
            ->orderBy('id', 'desc');

        $messages = $this->select(DB::raw('contributors.id AS contributor_id, name, username, avatar, conversations.*, CASE WHEN following IS NULL THEN 0 ELSE 1 END AS is_following, COUNT(*) as conversation_total'))
            ->from(DB::raw("({$conversation->toSql()}) as conversations"))
            ->join('contributors', 'contributors.id', '=', 'conversations.interact_with')
            ->leftJoin(DB::raw("(SELECT following FROM followers WHERE contributor_id = {$id}) followings"), 'contributors.id', '=', 'followings.following')
            ->groupBy('message_id')->orderBy('conversations.created_at','desc')
            ->paginate(10);

        return $this->preMessageModifier($messages);
    }

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

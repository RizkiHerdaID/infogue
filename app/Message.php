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

    public function preMessageModifier($contributors)
    {
        foreach ($contributors as $contributor):

            $contributor->contributor_ref = route('contributor.stream', [$contributor->username]);
            $contributor->conversation_ref = route('account.message.conversation', [$contributor->username]);
            $contributor->avatar_ref = asset("images/contributors/{$contributor->avatar}");
            $contributor->message = substr($contributor->message, 30);
            $contributor->following_status = ($contributor->is_following) ? 'btn-unfollow active' : 'btn-follow';
            $contributor->following_text = ($contributor->is_following) ? 'UNFOLLOW' : 'FOLLOW';

        endforeach;

        return $contributors;
    }
}

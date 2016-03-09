<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Feedback extends Model
{
    protected $table = 'feedback';

    protected $fillable = ['name', 'email', 'message', 'label'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('latest', function(Builder $builder) {
            $builder->orderBy('feedback.created_at', 'desc');
        });
    }

    public function retrieveFeedback($data, $by, $sort, $query = null){
        $feedback = $this->select('*');

        if($query != null && $query != ''){
            $feedback->where('name', 'like', "%{$query}%")
                ->orWhere('email', 'like', "%{$query}%")
                ->orWhere('message', 'like', "%{$query}%");
        }

        if($data != 'all'){
            $feedback->where('label', $data);
        }

        if($by == 'date'){
            $feedback->orderBy('created_at', $sort);
        }
        else if($by == 'name' || $by == 'email'){
            $feedback->orderBy($by, $sort);
        }

        return $feedback->paginate(10);
    }

    public function reply($id, $name, $email, $message, $reply)
    {
        $data = ['name' => $name, 'feedback' => $message, 'reply' => $reply];

        Mail::send('emails.admin.feedback', $data, function ($message) use ($id, $name, $email) {

            $message->from('no-reply@infogue.id', 'Infogue.id');

            $message->replyTo('no-reply@infogue.id', 'Infogue.id');

            $message->to($email)->subject('Reply feedback ticket #'.$id);

        });

        return count(Mail::failures() == 0) ? true : false;
    }
}

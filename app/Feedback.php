<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Feedback extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'feedback';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'message', 'label'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('latest', function (Builder $builder) {
            $builder->orderBy('feedback.created_at', 'desc');
        });
    }

    /**
     * Retrieve feedback and filter it.
     *
     * @param $data
     * @param $by
     * @param $sort
     * @param null $query
     * @return mixed
     */
    public function retrieveFeedback($data, $by, $sort, $query = null)
    {
        $feedback = $this->select('*');

        /*
         * --------------------------------------------------------------------------
         * Searching
         * --------------------------------------------------------------------------
         * Check if query passed as param and is not empty, try guess similarity by
         * name, email, message.
         */

        if ($query != null && $query != '') {
            $feedback->where('name', 'like', "%{$query}%")
                ->orWhere('email', 'like', "%{$query}%")
                ->orWhere('message', 'like', "%{$query}%");
        }

        /*
         * --------------------------------------------------------------------------
         * Data filter
         * --------------------------------------------------------------------------
         * Except all data filter find feedback by certain label.
         */

        if ($data != 'all') {
            $feedback->where('label', $data);
        }

        /*
         * --------------------------------------------------------------------------
         * Sorting the data
         * --------------------------------------------------------------------------
         * Just simply data order, sort by date, name, and email in ascending,
         * descending or shuffle list.
         */

        if ($by == 'date') {
            $feedback->orderBy('created_at', $sort);
        } else if ($by == 'name' || $by == 'email') {
            $feedback->orderBy($by, $sort);
        }

        return $feedback->paginate(10);
    }

    /**
     * Reply feedback to sender via email.
     *
     * @param $id
     * @param $name
     * @param $email
     * @param $message
     * @param $reply
     * @return bool
     */
    public function reply($id, $name, $email, $message, $reply)
    {
        $data = ['name' => $name, 'feedback' => $message, 'reply' => $reply];

        Mail::send('emails.admin.feedback', $data, function ($message) use ($id, $name, $email) {

            $message->from('no-reply@infogue.id', 'Infogue.id');

            $message->replyTo('no-reply@infogue.id', 'Infogue.id');

            $message->to($email)->subject('Reply feedback ticket #' . $id);

        });

        return count(Mail::failures() == 0) ? true : false;
    }
}

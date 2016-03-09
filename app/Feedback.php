<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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
        $feedback = $this;

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

    public function reply($to, $subject)
    {

    }

    public function mark($label, $id)
    {

    }
}

<?php

namespace Infogue;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at'];

    /**
     * Retrieve updates newsletter by certain period
     *
     * @param string $range
     * @return Collection
     */
    public function newsletter($range = 'daily')
    {
        $date = Carbon::now()->addDay(-3);
        $take = 5;

        if ($range == 'daily') {
            $date = Carbon::now()->addDay(-1);
        } else if ($range == 'weekly') {
            $date = Carbon::now()->addWeek(-1);
            $take = 10;
        } else if ($range == 'monthly') {
            $date = Carbon::now()->addMonth(-1);
            $take = 20;
        }

        $newsletters = Article::where('articles.created_at', '>', $date)->orderBy('view')->take($take)->get();

        return $newsletters;
    }
}

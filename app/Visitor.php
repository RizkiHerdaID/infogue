<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Visitor extends Model
{
    protected $fillable = ['date', 'hit', 'unique'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('latest', function(Builder $builder) {
            $builder->orderBy('visitors.created_at', 'desc');
        });
    }

    public function checkVisitor()
    {
        if (isset($_COOKIE["infogue-visitor"]) && $_COOKIE["infogue-visitor"] == Request::ip()) {
            if(Request::segment(1) == null){
                $this->hit();
            }
        } else {
            $this->revisit();
        }
    }

    public function hit()
    {
        $current_date = date("Y-m-d");

        $result = $this->where('date', $current_date)->first();

        if (count($result) > 0) {
            $result->hit = $result->hit + 1;
            $result->save();
        } else {
            $visitor = new Visitor();
            $visitor->date = $current_date;
            $visitor->unique = 1;
            $visitor->hit = 1;
            $visitor->save();
        }
    }

    public function revisit()
    {
        $cookie_visitor = "infogue-visitor";
        $cookie_ip = Request::ip();

        setcookie($cookie_visitor, $cookie_ip, time() + 86400, "/");

        $current_date = date("Y-m-d");

        $result = $this->where('date', $current_date)->first();

        if (count($result) > 0) {
            $result->unique = $result->unique + 1;
            $result->save();
        } else {
            $visitor = new Visitor();
            $visitor->date = $current_date;
            $visitor->unique = 1;
            $visitor->hit = 0;
            $visitor->save();
        }
    }
}

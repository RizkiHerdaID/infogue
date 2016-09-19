<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    const TYPE_WITHDRAWAL = "withdrawal";
    const TYPE_REWARD = "reward";

    const STATUS_PENDING = "pending";
    const STATUS_PROCEED = "proceed";
    const STATUS_SUCCESS = "success";
    const STATUS_CANCEL = "cancel";

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('latest', function (Builder $builder) {
            $builder->orderBy('transactions.created_at', 'desc');
        });
    }

    /**
     * Additional query scope, select pending transactions only.
     *
     * @param $query
     * @return mixed
     */
    public function scopePending($query)
    {
        return $query->where('transactions.status', 'pending');
    }

    /**
     * Additional query scope, select proceed transactions only.
     *
     * @param $query
     * @return mixed
     */
    public function scopeProceed($query)
    {
        return $query->where('transactions.status', 'proceed');
    }

    /**
     * Additional query scope, select success transactions only.
     *
     * @param $query
     * @return mixed
     */
    public function scopeSuccess($query)
    {
        return $query->where('transactions.status', 'success');
    }

    /**
     * Additional query scope, select canceled transactions only.
     *
     * @param $query
     * @return mixed
     */
    public function scopeCancel($query)
    {
        return $query->where('transactions.status', 'cancel');
    }
}

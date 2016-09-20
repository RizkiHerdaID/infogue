<?php

namespace Infogue;

use Illuminate\Database\Eloquent\Builder;
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

    /**
     * Many-to-one relationship, transaction owner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contributor()
    {
        return $this->belongsTo(Contributor::class);
    }

    /**
     * Retrieve all transaction with filter and query search.
     *
     * @param $data
     * @param $status
     * @param $by
     * @param $sort
     * @param null $query
     * @return mixed
     */
    public function retrieveTransaction($data, $status, $by, $sort, $query = null)
    {
        $transactions = $this
            ->select('transactions.id', 'type', 'description', 'amount', 'transactions.status',
                'transactions.created_at', 'contributor_id', 'name', 'username', 'avatar', 'account_name', 'account_number', 'bank', 'code')
            ->join('contributors', 'contributors.id', '=', 'contributor_id')
            ->leftJoin('banks', 'banks.id', '=', 'bank_id');

        if ($query != null && $query != '') {
            $transactions
                ->where('transactions.id', 'like', "%{$query}%")
                ->orWhere('name', 'like', "%{$query}%")
                ->orWhere('transactions.status', 'like', "%{$query}%")
                ->orWhere('type', 'like', "%{$query}%");
        }

        if ($data != 'all' && $data != 'all-data') {
            $transactions->where('type', $data);
        }

        if ($status != 'all' && $data != 'all-data') {
            $transactions->where('transactions.status', $status);
        }

        if ($by == 'date') {
            $transactions->orderBy('transactions.created_at', $sort);
        } else if ($by == 'name') {
            $transactions->orderBy('name', $sort);
        } else if ($by == 'amount') {
            $transactions->orderBy('amount', $sort);
        } else if ($by == 'status') {
            $transactions->orderBy('status', $sort);
        }

        return $transactions;
    }

}

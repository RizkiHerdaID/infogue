<?php

namespace Infogue\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Infogue\Contributor;
use Infogue\Http\Controllers\Controller;
use Infogue\Transaction;

class TransactionController extends Controller
{
    /**
     * Show all transactions with filter and query.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        /*
         * --------------------------------------------------------------------------
         * Filtering transaction
         * --------------------------------------------------------------------------
         * Populate optional filter on url break down in data, sorting by and sorting
         * method, retrieve the transaction.
         */

        $filter_data = Input::has('data') ? Input::get('data') : 'all';
        $filter_status = Input::has('status') ? Input::get('status') : 'all';
        $filter_by = Input::has('by') ? Input::get('by') : 'date';
        $filter_sort = Input::has('sort') ? Input::get('sort') : 'desc';
        $query = Input::has('query') ? Input::get('query') : null;

        $countWithdrawal = Transaction::where('type', Transaction::TYPE_WITHDRAWAL)->count();
        $countReward = Transaction::where('type', Transaction::TYPE_REWARD)->count();
        $sumWithdrawal = Transaction::where('type', Transaction::TYPE_WITHDRAWAL)->sum('amount');
        $sumReward = Transaction::where('type', Transaction::TYPE_REWARD)->sum('amount');

        $transaction = new Transaction();
        $transactions = $transaction->retrieveTransaction($filter_data, $filter_status, $filter_by, $filter_sort, $query);

        return view('admin.transaction.index', compact('transactions', 'countWithdrawal', 'countReward', 'sumWithdrawal', 'sumReward'));
    }

    /**
     * Update transaction status and send notification to contributor.
     *
     * @param Request $request
     * @param $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $status)
    {
        $contributor_id = $request->input('contributor_id');
        $transaction_id = $request->input('transaction_id');

        $contributor = Contributor::findOrFail($contributor_id);
        $transaction = $contributor->transactions()->findOrFail($transaction_id);
        $transaction->status = $status;
        if ($transaction->save()) {
            // notify the contributor
            Mail::send('emails.receipt', ['transaction' => $transaction, 'contributor' => $contributor], function ($message) use ($transaction, $contributor) {
                $message->from(env('MAIL_ADDRESS', 'no-reply@infogue.id'), env('MAIL_NAME', 'Infogue.id'));
                $message->replyTo('no-reply@infogue.id', env('MAIL_NAME', 'Infogue.id'));
                $message->to('anggadarkprince@gmail.com')->subject('Withdrawal status transaction ID ' . $transaction->id);
            });

            return redirect()->back()->with([
                'status' => ($status == 'success') ? 'success' : 'warning',
                'message' => "Status transaction ID {$transaction_id} was updated <strong>{$status}</strong>"
            ]);
        } else {
            return redirect()->back()
                ->withErrors(['error' => Lang::get('alert.error.database')]);
        }
    }
}

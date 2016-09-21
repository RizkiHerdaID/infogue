<?php

namespace Infogue\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Infogue\Setting;
use Infogue\Transaction;
use Infogue\User;

class TransactionController extends Controller
{
    /**
     * Show transaction history, reward from published article which approved by admin,
     * and application request to withdraw reward money.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $filter_data = Input::has('data') ? Input::get('data') : 'all';
        $filter_status = 'all';
        $filter_by = Input::has('by') ? Input::get('by') : 'date';
        $filter_sort = Input::has('sort') ? Input::get('sort') : 'desc';

        $transaction = new Transaction();
        $transactions = $transaction->retrieveTransaction($filter_data, $filter_status, $filter_by, $filter_sort)
            ->whereContributorId(Auth::user()->id)->paginate(10);

        $deferred = $this->getDefferWithdrawal();

        return view('contributor.wallet', compact('transactions', 'deferred'));
    }

    /**
     * Show withdrawal application / form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function withdrawal()
    {
        $deferred = $this->getDefferWithdrawal();
        return view('contributor.wallet_withdraw', compact('deferred'));
    }

    /**
     * Calculate withdrawal, check if there are deferred transaction before,
     * subtract with current balance and subtract again with current request amount of withdrawal,
     * maximum transaction it's depend on their available balance, if they have a lot of money,
     * limit each withdrawal by 5 million rupiah.
     *
     * @param Request $request
     * @return $this|string
     */
    public function withdraw(Request $request)
    {
        $contributor = Auth::user();
        $deferred = $this->getDefferWithdrawal();
        $balance = $contributor->balance;
        $withdraw = $request->input('amount');

        $minWithdraw = Setting::whereKey('Withdrawal Minimum')->first()->value;
        $maxWithdraw = $balance - $deferred;
        if ($maxWithdraw > 5000000) {
            $maxWithdraw = 5000000;
        }
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:' . $minWithdraw . '|max:' . $maxWithdraw,
        ]);

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        if ($maxWithdraw - $withdraw >= 0) {
            if ($request->has('confirm')) {
                $transaction = new Transaction();
                $transaction->type = Transaction::TYPE_WITHDRAWAL;
                $transaction->description = $contributor->name . " request money withdrawal";
                $transaction->status = Transaction::STATUS_PENDING;
                $transaction->amount = $withdraw;

                $contributor->transactions()->save($transaction);

                $admins = User::all(['name', 'email']);
                foreach ($admins as $admin) {
                    if ($admin->email != 'anggadarkprince@gmail.com' && $admin->email != 'sketchprojectstudio@gmail.com') {
                        Mail::send('emails.admin.withdraw', ['contributor' => $contributor, 'transaction' => $transaction], function ($message) use ($admin, $contributor, $transaction) {
                            $message->from(env('MAIL_ADDRESS', 'no-reply@infogue.id'), env('MAIL_NAME', 'Infogue.id'));
                            $message->replyTo($contributor->email, $contributor->name);
                            $message->to($admin->email)->subject($contributor->name . " request money withdrawal IDR " . number_format($transaction->amount, 0, ',', ','));
                        });
                    }
                }
                return redirect(route('account.wallet'))->with([
                    'status' => 'success',
                    'message' => 'Withdrawal application has been sent'
                ]);
            } else {
                return view('contributor.wallet_preview', compact('balance', 'deferred', 'withdraw'));
            }
        }

        $insufficient = [
            'balance' => 'You have tried to withdraw IDR ' . number_format($withdraw, 0, ',', '.'),
            'error' => 'Your balance is insufficient (IDR ' . number_format($balance, 0, ',', '.') . ')',
        ];

        if ($deferred > 0) {
            $insufficient['deffer'] = 'You still have deffer transaction IDR ' . number_format($deferred, 0, ',', '.');
        }

        return redirect()->route('account.wallet.withdrawal')->withErrors($insufficient);
    }

    /**
     * Delete transaction data before it processes more further.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel(Request $request)
    {
        $transactionId = $request->input('transaction_id');
        $contributor = Auth::user();
        $transaction = $contributor->transactions()->findOrFail($transactionId);
        $transaction->status = Transaction::STATUS_CANCEL;

        if ($transaction->save()) {
            // notify the contributor
            Mail::send('emails.receipt', ['transaction' => $transaction, 'contributor' => $contributor], function ($message) use ($transaction, $contributor) {
                $message->from(env('MAIL_ADDRESS', 'no-reply@infogue.id'), env('MAIL_NAME', 'Infogue.id'));
                $message->replyTo('no-reply@infogue.id', env('MAIL_NAME', 'Infogue.id'));
                $message->to($contributor->email)->subject('Withdrawal status transaction ID ' . $transaction->id . ' is cancelled');
            });

            // notify all admins via email so they could proceed the transaction as soon as possible
            $admins = User::all(['name', 'email']);
            foreach ($admins as $admin) {
                if ($admin->email != 'anggadarkprince@gmail.com' && $admin->email != 'sketchprojectstudio@gmail.com') {
                    Mail::send('emails.admin.cancel', ['contributor' => $contributor, 'transaction' => $transaction], function ($message) use ($admin, $contributor, $transaction) {
                        $message->from(env('MAIL_ADDRESS', 'no-reply@infogue.id'), env('MAIL_NAME', 'Infogue.id'));
                        $message->replyTo($contributor->email, $contributor->name);
                        $message->to($admin->email)->subject($contributor->name . " cancel their withdrawal ID #" . $transaction->id);
                    });
                }
            }

            return redirect(route('account.wallet'))->with([
                'status' => 'warning',
                'message' => 'Transaction ' . $transactionId . ' was cancelled',
            ]);
        }

        return redirect()->back()->withErrors(['error' => Lang::get('alert.error.database')]);
    }

    /**
     * Get withdrawal transaction which still in progress.
     *
     * @return mixed
     */
    private function getDefferWithdrawal()
    {
        return Auth::user()->transactions()
            ->whereType(Transaction::TYPE_WITHDRAWAL)
            ->where(function ($query) {
                $query->where('status', '=', Transaction::STATUS_PENDING);
                $query->orWhere('status', '=', Transaction::STATUS_PROCEED);
            })
            ->sum('amount');
    }
}

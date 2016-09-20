<?php

namespace Infogue\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Infogue\Contributor;
use Infogue\Http\Controllers\Controller;
use Infogue\Setting;
use Infogue\Transaction;
use Infogue\User;

class TransactionController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Transaction Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling withdrawal request and provide
    | transaction detail each contributors.
    |
    */

    /**
     * attach auth api middleware on all methods.
     *
     * TransactionController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Retrieve all transaction's contributor and fetch data by 10 rows,
     * send along with deffer total transaction (pending/proceed).
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // populate contributor inputs
        $contributor_id = $request->input('contributor_id');
        $transactions = Contributor::find($contributor_id)
            ->transactions()
            ->paginate(10);

        // find out the pending / proceed transaction before
        $deferred = $this->getDefferWithdrawal($contributor_id);

        return response()->json([
            'request_id' => uniqid(),
            'status' => 'success',
            'timestamp' => Carbon::now(),
            'transactions' => $transactions,
            'deferred' => $deferred
        ]);
    }

    /**
     * Proceed withdrawal application, check balance after subtracted by deferred
     * transaction and current withdraw amount, send admin email notification as well.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function withdraw(Request $request)
    {
        // populate the contributor's inputs
        $contributorId = $request->input('contributor_id');
        $withdraw = $request->input('amount');

        $contributor = Contributor::findOrFail($contributorId);
        $balance = $contributor->balance;
        $deferred = $this->getDefferWithdrawal($contributorId);

        // find out the limit of withdrawal transaction (max request is 5 million rupiah)
        $minWithdraw = Setting::whereKey('Withdrawal Minimum')->first()->value;
        $maxWithdraw = $balance - $deferred;
        if ($maxWithdraw > 5000000) {
            $maxWithdraw = 5000000;
        }

        // check validation for amount value, make sure it would between min and max
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:' . $minWithdraw . '|max:' . $maxWithdraw,
        ]);
        if ($validator->fails()) {
            // invalid input, amount is bellow the minimum value or over the maximum balance
            return response()->json([
                'request_id' => uniqid(),
                'status' => 'denied',
                'message' => "Amount must be range between {$minWithdraw} and {$maxWithdraw}",
                'timestamp' => Carbon::now(),
            ], 400);
        }

        // make sure the amount does not over the balance
        if ($maxWithdraw - $withdraw >= 0) {
            // store new withdrawal transaction
            $transaction = new Transaction();
            $transaction->type = Transaction::TYPE_WITHDRAWAL;
            $transaction->status = Transaction::STATUS_PENDING;
            $transaction->description = $contributor->name . " request money withdrawal";
            $transaction->amount = $withdraw;

            if ($contributor->transactions()->save($transaction)) {
                // notify all admins via email so they could proceed the transaction as soon as possible
                $admins = User::all(['name', 'email']);
                foreach ($admins as $admin) {
                    if ($admin->email != 'anggadarkprince@gmail.com' && $admin->email != 'sketchprojectstudio@gmail.com') {
                        Mail::send('emails.admin.withdraw', ['contributor' => $contributor, 'transaction' => $transaction], function ($message) use ($admin, $contributor, $transaction) {
                            $message->from(env('MAIL_ADDRESS', 'no-reply@infogue.id'), env('MAIL_NAME', 'Infogue.id'));
                            $message->replyTo($contributor->email, $contributor->name);
                            $message->to('anggadarkprince@gmail.com')->subject($contributor->name . " request money withdrawal IDR " . number_format($transaction->amount, 0, ',', ','));
                        });
                    }
                }
                // withdrawal request succeed.
                return response()->json([
                    'request_id' => uniqid(),
                    'status' => 'success',
                    'message' => "Withdrawal application has been sent",
                    'timestamp' => Carbon::now(),
                ]);
            }

            // something goes wrong, return internal server error (500)
            return response()->json([
                'request_id' => uniqid(),
                'status' => 'failure',
                'message' => Lang::get('alert.error.generic'),
                'timestamp' => Carbon::now(),
            ], 500);
        }

        // contributor making withdrawal over the balance return bad request (400)
        return response()->json([
            'request_id' => uniqid(),
            'status' => 'denied',
            'message' => "Insufficient balance, you can withdraw max {$maxWithdraw}",
            'timestamp' => Carbon::now(),
        ], 400);
    }

    /**
     * As long as the request does not proceed yet by admin, contributor can cancel
     * their withdrawal application.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $transactionId = $request->input('id');
        $contributorId = $request->input('contributor_id');
        $transaction = Contributor::findOrFail($contributorId)
            ->transactions()
            ->findOrFail($transactionId);

        if ($transaction->delete()) {
            return response()->json([
                'request_id' => uniqid(),
                'status' => 'success',
                'message' => 'Transaction ' . $transactionId . ' was deleted',
                'timestamp' => Carbon::now(),
            ]);
        }

        return response()->json([
            'request_id' => uniqid(),
            'status' => 'failure',
            'message' => Lang::get('alert.error.generic'),
            'timestamp' => Carbon::now(),
        ], 500);
    }

    /**
     * Find out accumulation of deferred transaction before, 'deferred transaction' means
     * all withdrawal request which does not proceed yet by admin and contributor's balance
     * never touch (subtracted) so it need to recalculate again before next request comes in.
     *
     * @param $contributor_id
     * @return mixed
     */
    private function getDefferWithdrawal($contributor_id)
    {
        return Contributor::find($contributor_id)
            ->transactions()
            ->whereType(Transaction::TYPE_WITHDRAWAL)
            ->where(function ($query) {
                $query->where('status', '=', Transaction::STATUS_PENDING);
                $query->orWhere('status', '=', Transaction::STATUS_PROCEED);
            })
            ->sum('amount');
    }
}

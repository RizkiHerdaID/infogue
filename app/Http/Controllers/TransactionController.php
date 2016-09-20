<?php

namespace Infogue\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Infogue\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $filter_data = Input::has('data') ? Input::get('data') : 'all';
        $filter_status = 'all';
        $filter_by = Input::has('by') ? Input::get('by') : 'date';
        $filter_sort = Input::has('sort') ? Input::get('sort') : 'desc';

        $transaction = new Transaction();
        $transactions = $transaction->retrieveTransaction($filter_data, $filter_status, $filter_by, $filter_sort)
        ->whereContributorId(Auth::user()->id)->paginate(10);

        return view('contributor.wallet', compact('transactions'));
    }

    public function withdrawal()
    {

    }

    public function withdraw(Request $request)
    {

    }
}

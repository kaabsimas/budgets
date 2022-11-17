<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostTransactionRequest;
use App\Models\Ledger;
use App\Models\Transaction;
use Illuminate\Support\Facades\Redirect;

class TransactionController extends Controller
{
    public function store(Ledger $ledger, PostTransactionRequest $request) 
    {
        $fromAccount = $ledger->accounts()->whereName($request->from)->first();
        $toAccount = $ledger->accounts()->whereName($request->to)->first();

        $ledger->transactions()->create([
            'from_account_id' => $fromAccount->id,
            'to_account_id' => $toAccount->id,
            'amount' => $request->amount,
            'description' => $request->description,
            'status' => Transaction::STATUS_PENDING,
            'transfered_at' => $request->date
        ]);

        return Redirect::route('ledger.index', ['ledger' => $ledger->id]);
    }

    public function delete(Ledger $ledger, Transaction $transaction)
    {
        $transaction->delete();

        return Redirect::route('ledger.index', ['ledger' => $ledger->id]);
    }
}

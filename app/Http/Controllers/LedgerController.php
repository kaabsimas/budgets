<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class LedgerController extends Controller
{
    public function index(Ledger $ledger)
    {
        $today = Carbon::now();

        $estimations = $ledger
            ->estimations()
            ->whereBetween('expected_at', [$today->startOfMonth()->toDateTimeString(), $today->endOfMonth()->toDateTimeString()])
            ->with('account')->get();
        
        $accounts = $ledger->accounts;

        $transactions = $ledger
            ->transactions()
            ->whereBetween('transfered_at', [$today->startOfMonth()->toDateTimeString(), $today->endOfMonth()->toDateTimeString()])
            ->with(['fromAccount', 'toAccount'])
            ->orderBy('transfered_at')
            ->get();
            
        return Inertia::render('Ledger/Index', compact('ledger', 'estimations', 'accounts', 'transactions'));
    }

    public function list(): JsonResponse
    {
        $user = Auth::user();
        $ledgers = Ledger::where('user_id', $user->id)->get();

        return new JsonResponse($ledgers);
    }
}

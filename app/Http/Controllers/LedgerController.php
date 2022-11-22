<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LedgerController extends Controller
{
    public function index(Ledger $ledger, Request $request)
    {
        if($request->has("display_month") && $request->session()->missing("display_month")) {
            $displayDate = Carbon::create($request->display_month);
            $request->session()->put('display_month', $displayDate);
        } else if($request->missing("display_month")){ 
            $displayDate = Carbon::now();
            $request->session()->put('display_month', $displayDate);
        } else {
            $displayDate = $request->session()->get('display_month');
        }

        $estimations = $ledger
            ->estimations()
            ->whereBetween('expected_at', [$displayDate->startOfMonth()->toDateTimeString(), $displayDate->endOfMonth()->toDateTimeString()])
            ->with('account')->get();
        
        $accounts = $ledger->accounts;

        $transactions = $ledger
            ->transactions()
            ->whereBetween('transfered_at', [$displayDate->startOfMonth()->toDateTimeString(), $displayDate->endOfMonth()->toDateTimeString()])
            ->with(['fromAccount', 'toAccount'])
            ->orderBy('transfered_at')
            ->get();
            
        return Inertia::render('Ledger/Index', compact('ledger', 'estimations', 'accounts', 'transactions', 'displayDate'));
    }

    public function list(): JsonResponse
    {
        $user = Auth::user();
        $ledgers = Ledger::where('user_id', $user->id)->get();

        return new JsonResponse($ledgers);
    }
}

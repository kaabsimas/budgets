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
        if($request->has("display_month")) {
            $displayDate = Carbon::createFromFormat('Y-m', $request->display_month);
            $request->session()->put('display_month', $displayDate);
        } else if($request->session()->has("display_month")){
            $aux = $request->session()->get('display_month');
            $displayDate = Carbon::createFromFormat('Y-m', $aux);
        } else {
            $displayDate = Carbon::now();
        }

        $request->session()->put('display_month', $displayDate);

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

        $displayMonth = $displayDate->format('Y-m');
            
        return Inertia::render('Ledger/Index', compact('ledger', 'estimations', 'accounts', 'transactions', 'displayMonth'));
    }

    public function list(): JsonResponse
    {
        $user = Auth::user();
        $ledgers = Ledger::where('user_id', $user->id)->get();

        return new JsonResponse($ledgers);
    }
}

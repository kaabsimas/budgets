<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LedgerController extends Controller
{
    public function index(Ledger $ledger)
    {
        $accounts = $ledger->accounts;
        return Inertia::render('Ledger/Index', compact('ledger', 'accounts'));
    }

    public function list(): JsonResponse
    {
        $user = \Auth::user();
        $ledgers = Ledger::where('user_id', $user->id)->get();

        return new JsonResponse($ledgers);
    }
}

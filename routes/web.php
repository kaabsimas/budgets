<?php

use App\Http\Controllers\LedgerController;
use App\Models\Ledger;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    Log::debug("User", [$user]);
    $ledgers = Ledger::where('user_id', $user->id)->with('user')->get();

    return Inertia::render('Dashboard', compact('ledgers'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('/ledger')->group(function(){
    Route::get('/{ledger}', [LedgerController::class, 'index'])->name('ledger.index');
});

require __DIR__.'/auth.php';

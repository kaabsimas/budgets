<?php

namespace App\Models;

use Database\Factories\EstimationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimation extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'description', 'expected_at', 'status', 'type'];

    protected static function newFactory()
    {
        return EstimationFactory::new();
    }

    public function ledger()
    {
        return $this->belongsTo(Ledger::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}

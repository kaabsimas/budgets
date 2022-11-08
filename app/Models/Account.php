<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, SoftDeletes;

    public function ledger()
    {
        return $this->belongsTo(Ledger::class);
    }

    public function estimations()
    {
        return $this->hasMany(Estimation::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}

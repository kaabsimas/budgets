<?php

namespace App\Models;

use Database\Factories\LedgerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ledger extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description'];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return LedgerFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function estimations()
    {
        return $this->hasManyThrough(Estimation::class, Account::class);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Ledger;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LedgerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();
        Ledger::factory()->create(['title' => 'Orçamento de Casa', 'user_id' => $user->id]);
        Ledger::factory()->create(['title' => 'Orçamento Empresa', 'user_id' => $user->id]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Account;
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
        $casa = Ledger::factory()->create(['title' => 'Orçamento de Casa', 'user_id' => $user->id]);

        $casa->accounts()->createMany([
            ['name' => 'Aluguel', 'type' => 'expense'],
            ['name' => 'Salário', 'type' => 'revenue'],
            ['name' => 'Dívida Banco', 'type' => 'liability'],
            ['name' => 'Poupança', 'type' => 'asset'],
            ['name' => 'Escola', 'type' => 'expense'],
            ['name' => 'Luz', 'type' => 'expense']
        ]);

        Ledger::factory()->create(['title' => 'Orçamento Empresa', 'user_id' => $user->id]);
    }
}

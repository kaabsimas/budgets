<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Estimation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstimationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Account::whereName('Aluguel')
            ->first()
            ->estimations()
            ->save(
                Estimation::factory()->state(['amount' => 1500.98, 'type' => 'expense'])->make()
            );
        
        Account::whereName('Salário')
            ->first()
            ->estimations()
            ->save(
                Estimation::factory()->state(['amount' => 6200, 'type' => 'income'])->make()
            );

        Account::whereName('Escola')
            ->first()
            ->estimations()
            ->save(
                Estimation::factory()->state(['amount' => 800.78, 'type' => 'expense'])->make()
            );

        Account::whereName('Luz')
            ->first()
            ->estimations()
            ->save(
                Estimation::factory()->state(['amount' => 460, 'type' => 'expense'])->make()
            );

        // Account::whereName('Ocasionais')
        //     ->first()
        //     ->estimations()
        //     ->saveMany(
        //         Estimation::factory()->count(50)->make()
        //     );
    }
}

<?php

namespace Database\Factories;

use App\Models\Estimation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estimation>
 */
class EstimationFactory extends Factory
{
    protected $model = Estimation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'amount' => fake()->randomFloat(2, 20, 500),
            'description' => fake()->sentence(4),
            'expected_at' => fake()->dateTimeThisMonth(),
            'status' => fake()->randomElement(['pending', 'confirmed']),
            'type' => fake()->randomElement(['income', 'expense']),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends Factory<Currency>
 */
class CurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code'=>$this->faker->currencyCode(),
            'currency_rate'=> $this->faker->randomFloat(5, 0.00001, 99999),
            'country' => $this->faker->country(),
            'created_by'=> User::factory(),
            'updated_by'=> User::factory(),
        ];
    }
}

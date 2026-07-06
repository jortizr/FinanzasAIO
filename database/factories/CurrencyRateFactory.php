<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\CurrencyRate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CurrencyRate>
 */
class CurrencyRateFactory extends Factory
{
    protected $model = CurrencyRate::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //obtener las monedas
        $fromCurrency = Currency::inRandomOrder()->first();

        //buscamos la segunda moneda
        $toCurrency = Currency::where('id', '!=', $fromCurrency->id)->inRandomOrder()->first() ?? Currency::factory()->create();

        return [
            'from_currency_id'=> $fromCurrency->id,
            'to_currency_id'=> $toCurrency->id,
            'rate'=> $this->faker->randomFloat(4, 0.5, 150),
            'rate_date' => $this->faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
            'created_by'=> User::factory(),
            'updated_by'=> User::factory(),
        ];
    }
}

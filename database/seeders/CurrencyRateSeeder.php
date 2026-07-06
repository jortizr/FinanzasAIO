<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Currency;
use App\Models\CurrencyRate;

class CurrencyRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = Currency::all();

        if ($currencies->isEmpty()) {
            return;
        }

        // Generamos combinaciones controladas para no repetir par + fecha
        foreach ($currencies as $from) {
            // Tomamos 3 monedas de destino al azar para este origen (para no saturar la BD)
            $targets = $currencies->where('id', '!=', $from->id)->random(3);

            foreach ($targets as $to) {
                // Creamos un histórico de tasas para los últimos 5 días
                for ($i = 0; $i < 5; $i++) {
                    CurrencyRate::factory()->create([
                        'from_currency_id' => $from->id,
                        'to_currency_id' => $to->id,
                        'rate_date' => now()->subDays($i)->format('Y-m-d'),
                    ]);
                }
            }
        }

    }
}

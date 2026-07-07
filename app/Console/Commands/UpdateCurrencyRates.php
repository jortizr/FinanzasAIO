<?php

namespace App\Console\Commands;

use App\Models\Currency;
use App\Models\CurrencyRate;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

#[Signature('app:update-currency-rates')]
#[Description('Command description')]
class UpdateCurrencyRates extends Command
{
    protected $description = 'Obtiene las tasas de cambio diarias desde una API externa y las registra';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Iniciando la actualizacion de tasas de cambios...');

        //configuracion de la API
        $apiKey = config('services.exchangerate.api_key');
        $baseCurrency = 'USD';
        if(!$apiKey){
            $this->error('No se encontro la API key en la configuracion.');
            return Command::FAILURE;
        }

        $response = Http::get("https://v6.exchangerate-api.com/v6/{$apiKey}/latest/{$baseCurrency}");

        if($response->failed()){
            $this->error('Error al conectar con la API de tasas de cambio'. $response->status());
            return Command::FAILURE();
        }

        $data = $response->json();
        $rates = $data['conversion_rates'] ?? [];
        $today = Carbon::today()->toDateString();

        //obtener los IDs de tus monedas mapeadas en la base de datos
        $currencies = Currency::pluck('id', 'code');
        $fromCurrencyId = $currencies[$baseCurrency] ?? null;

        if(!$fromCurrencyId){
            $this->error("La moneda base {$baseCurrency} no existe en la base de datos");
            return Command::FAILURE;
        }

        //insertar o actualizar respetando el indice unico
        foreach($rates as $currencyCode => $rate){
            if(isset($currencies[$currencyCode])){
                CurrencyRate::updateOrCreate([
                    'from_currency_id' => $fromCurrencyId,
                    'to_currency_id' => $currencies[$currencyCode],
                    'rate_date' => $today,
                    ],
                    [
                        'rate' => $rate,
                        'created_by' => 1,
                        'updated_by' => 1,
                    ]
                );
            }
        }

        $this->info('Tasas de cambio actualizasas e historizadas correctamente');
        return Command::SUCCESS;
    }
}

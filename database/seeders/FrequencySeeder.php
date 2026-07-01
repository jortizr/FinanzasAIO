<?php

namespace Database\Seeders;

use App\Models\Frequency;
use Illuminate\Database\Seeder;


class FrequencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Frequency::factory()->count(10)->create();
    }
}

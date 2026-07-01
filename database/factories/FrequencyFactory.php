<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Frequency;

/**
 * @extends Factory<Model>
 */
class FrequencyFactory extends Factory
{
    protected $model = Frequency::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=> $this->faker->words(2, true),
            'period'=> $this->faker->randomElement(["Diario", "Semanal", "Quincenal", "Mensual"]),
            'created_by' => User::factory(),
            'updated_by' => User::factory(),
        ];
    }
}

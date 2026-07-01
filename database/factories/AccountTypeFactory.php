<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\AccountType;

/**
 * @extends Factory<Model>
 */
class AccountTypeFactory extends Factory
{
    protected $model = AccountType::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'created_by' => User::factory(),
            'updated_by' => User::factory(),
        ];
    }
}

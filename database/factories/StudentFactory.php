<?php

namespace Database\Factories;

use App\Models\Claass;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->name(),
            "claass_id" => Claass::inRandomOrder()->first()->id,
            "guardian_name" => fake()->name(),
        ];
    }
}

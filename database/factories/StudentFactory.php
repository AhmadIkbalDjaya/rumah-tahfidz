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
            // "claass_id" => Claass::inRandomOrder()->first()->id,
            "claass_id" => null,
            "guardian_name" => fake()->name(),
            "class_name" => fake()->randomElement(["1 SD", "2 SD", "3 SD", "4 SD", "5 SD", "6 SD", "1 SMP", "2 SMP", "3 SMP", "1 SMA", "2 SMA", "3 SMA"]),
        ];
    }
}

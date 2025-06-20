<?php

namespace Database\Factories;

use App\Models\Hifz;
use App\Models\Student;
use App\Models\Surah;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hifz>
 */
class HifzFactory extends Factory
{
    /**
     * Define the model"s default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $surah = Surah::inRandomOrder()->first();
        $verseStart = $this->faker->numberBetween(1, $surah->varse_count);
        $verseEnd = $this->faker->numberBetween($verseStart, $surah->varse_count);

        return [
            "student_id"   => Student::inRandomOrder()->first()->id,
            "surah_id"     => $surah->id,
            "verse_start"  => $verseStart,
            "verse_end"    => $verseEnd,
            "review_count" => $this->faker->numberBetween(1, 5),
            "score"        => $this->faker->randomElement(["A", "B", "C"]),
            "recorded_at"  => $this->faker->dateTimeBetween("-1 year", "now"),
        ];
    }
}

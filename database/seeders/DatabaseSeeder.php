<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            "username" => "breakpoint",
            "password" => "2thepoint",
        ]);
        $this->call([
            ClaassSeeder::class,
            StudentSeeder::class,
            SurahSeeder::class,
            HifzSeeder::class,
        ]);
    }
}

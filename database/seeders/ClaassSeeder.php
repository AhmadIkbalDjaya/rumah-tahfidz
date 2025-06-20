<?php

namespace Database\Seeders;

use App\Models\Claass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClaassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = ["10", "11", "12"];

        foreach ($classes as $class) {
            Claass::insert([
                "name" => $class,
                "created_at" => now(),
                "updated_at" => now()
            ]);
        }
    }
}

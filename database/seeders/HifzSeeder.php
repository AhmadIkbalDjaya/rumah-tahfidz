<?php

namespace Database\Seeders;

use App\Models\Hifz;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HifzSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hifz::factory(250)->create();
    }
}

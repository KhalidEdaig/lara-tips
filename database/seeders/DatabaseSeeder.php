<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Consumer;
use App\Models\Dossier;
use App\Models\Optician;
use App\Models\Refund;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CostRangeSeeder::class,
            MeterSeeder::class
        ]);
        Optician::factory(10)->create();
        Consumer::factory(20)->create();
        Dossier::factory(10)->create();
        Refund::factory(10)->create();

    }
}

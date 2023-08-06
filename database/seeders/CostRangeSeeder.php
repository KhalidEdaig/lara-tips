<?php

namespace Database\Seeders;

use App\Models\CostRange;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CostRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        CostRange::insert([
            [
                'from' => 0,
                'to' => 99,
                'price' => 120,
            ],
            [
                'from' => 100,
                'to' => 199,
                'price' => 200,
            ],
            [
                'from' => 200,
                'to' => 299,
                'price' => 220,
            ],
            [
                'from' => 300,
                'to' => 399,
                'price' => 250,
            ],
            [
                'from' => 400,
                'to' => null,
                'price' => 260,
            ]
        ]);
    }
}

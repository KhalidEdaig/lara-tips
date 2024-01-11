<?php

namespace Database\Factories;

use App\Models\Consumer;
use App\Models\Optician;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dossier>
 */
class DossierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'consumer_id'=>Consumer::inRandomOrder()->first()->id,
            'optician_id'=>Optician::inRandomOrder()->first()->id,
        ];
    }
}

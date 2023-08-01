<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = array("QA123214", "FB122134", "FB00000");
        $data = [];
        for ($i = 0; $i < 100000; $i++) {
            array_push($data, [
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'bod' => fake()->date(),
                'age' => fake()->randomNumber(),
                'city' => fake()->name(),
                'company' => fake()->name(),
                'amount' => fake()->randomDigit(),
                'cin' => $array[array_rand($array, 1)],
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'created_at'=>now(),
                'updated_at'=>now()
            ]);
        }
        foreach (array_chunk($data, 1000) as $chunk) User::insert($chunk);
    }
}

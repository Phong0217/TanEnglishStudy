<?php

namespace Database\Factories;

use App\Models\Center;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Center> */
class CenterFactory extends Factory
{
    public function definition(): array
    {
        return ['name' => fake()->company().' English Center', 'code' => fake()->unique()->bothify('CTR-###'), 'timezone' => 'Asia/Bangkok', 'status' => 'ACTIVE'];
    }
}

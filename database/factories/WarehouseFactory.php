<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Warehouse>
 */
class WarehouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'name'       => 'Warehouse ' . $this->faker->city,
        'code'       => strtoupper($this->faker->unique()->bothify('WH-###')),
        'address'    => $this->faker->streetAddress,
        'city'       => $this->faker->city,
        'state'      => $this->faker->state,
        'country'    => $this->faker->country,
        'is_active'  => $this->faker->randomElement([0, 1]),
        'created_at' => now(),
        'updated_at' => now(),
        ];
    }
}

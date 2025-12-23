<?php

namespace Database\Factories;

use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         return [
        'name'            => $this->faker->company,
        'code'            => strtoupper($this->faker->unique()->bothify('SUP-###')),
        'contact_person'  => $this->faker->name,
        'email'           => $this->faker->unique()->safeEmail,
        'phone'           => $this->faker->numerify('9#########'),
        'address'         => $this->faker->streetAddress,
        'city'            => $this->faker->city,
        'state'           => $this->faker->state,
        'country'         => $this->faker->country,
        'is_active'       => $this->faker->randomElement([0, 1]),
        'created_at'      => now(),
        'updated_at'      => now(),
        ];
    }
}

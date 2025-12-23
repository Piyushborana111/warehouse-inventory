<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Supplier;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'           => $this->faker->words(3, true),
            'sku'            => strtoupper($this->faker->unique()->bothify('PRD-####')),
            'category_id'    => Category::inRandomOrder()->first()->id,
            'supplier_id'    => Supplier::inRandomOrder()->first()->id,
            'description'    => $this->faker->sentence(15),
            'purchase_price' => $this->faker->numberBetween(100, 3000),
            'selling_price'  => $this->faker->numberBetween(3500, 8000),
            'reorder_level'  => $this->faker->numberBetween(5, 50),
            'is_active'      => $this->faker->randomElement([0, 1]),
            'created_at'     => now(),
            'updated_at'     => now(),
        ];
    }
}

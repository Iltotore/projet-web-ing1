<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            "name" => fake()->word(),
            "description" => fake()->sentences(asText: true),
            "icon" => fake()->filePath(),
            "amount" => fake()->numberBetween(),
            "unit_price" => fake()->randomFloat(),
            "category_id" => Category::factory()
        ];
    }
}

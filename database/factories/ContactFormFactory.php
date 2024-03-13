<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactForm>
 */
class ContactFormFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->name(),
            "firstname" => fake()->firstName(),
            "email" => fake()->email(),
            "gender" => fake()->boolean(),
            "birth" => fake()->date(),
            "job_id" => Category::factory(),
            "subject" => fake()->word(),
            "content" => fake()->sentences(asText: true)
        ];
    }
}

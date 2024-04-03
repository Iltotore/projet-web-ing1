<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Job;
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
            "first_name" => fake()->firstName(),
            "last_name" => fake()->lastName(),
            "email" => fake()->email(),
            "gender" => fake()->boolean(),
            "birth" => fake()->date(),
            "job_id" => Job::factory(),
            "subject" => fake()->word(),
            "content" => fake()->sentences(asText: true)
        ];
    }
}

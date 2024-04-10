<?php

namespace Tests\Feature;

use App\Models\ContactForm;
use App\Models\Job;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ContactTest extends TestCase {
    use RefreshDatabase;

    /**
     * Return errors when sent data are either missing or invalid.
     */
    public function test_create_invalid(): void {
        $missingResponse = $this->post("/contact/create");
        $missingResponse->assertRedirect();
        $missingResponse->assertInvalid(["first_name", "last_name", "birth", "job_id", "subject", "content"]);

        $invalidResponse = $this->post(
            "/contact/create",
            [
                "first_name" => "",
                "last_name" => "",
                "email" => "abc",
                "gender" => "potato",
                "birth" => 4,
                "job_id" => 1,
                "subject" => str_repeat("a", 101),
                "content" => str_repeat("a", 1001)
            ]
        );

        $invalidResponse->assertRedirect();
        $invalidResponse->assertInvalid(["first_name", "last_name", "birth", "job_id", "subject", "content"]);
    }

    /**
     * Successfully create a contact ticket if the passed arguments are valid.
     */
    public function test_create_successful(): void {
        $job = Job::factory()->create();

        $response = $this->post(
            "/contact/create",
            [
                "first_name" => fake()->firstName(),
                "last_name" => fake()->lastName(),
                "email" => fake()->email(),
                "gender" => fake()->randomElement(["male", "female", null]),
                "birth" => fake()->date(),
                "job_id" => $job->id,
                "subject" => fake()->sentence(nbWords: 2),
                "content" => fake()->sentences(asText: true)
            ]
        );

        $response->assertRedirect();
        $response->assertValid();

        $this->assertEquals(1, ContactForm::count());
    }

    /**
     * Return errors when sent data are either missing or invalid.
     */
    public function test_delete_invalid() {
        $user = User::factory()->create(["is_admin" => true]);
        Auth::login($user);

        $missingResponse = $this->post("/contact/delete");
        $missingResponse->assertInvalid(["id"]);

        $invalidResponse = $this->postJson("/contact/delete", ["id" => 1]);
        $invalidResponse->assertInvalid(["id"]);
    }

    /**
     * Successfully delete a contact ticket if the passed arguments are valid.
     */
    public function test_delete_successful() {
        $user = User::factory()->create(["is_admin" => true]);
        Auth::login($user);

        $form = ContactForm::factory()->create();

        $response = $this->postJson("/contact/delete", ["id" => $form->id]);
        $response->assertSuccessful();
        $response->assertValid();

        $this->assertEquals(0, ContactForm::count());
    }
}

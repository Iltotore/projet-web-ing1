<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AuthTest extends TestCase {
    use RefreshDatabase;

    /**
     * Return errors when sent data are either missing or invalid.
     */
    public function test_login_invalid_data(): void {
        $missingResponse = $this->post("/auth/login");

        $missingResponse->assertRedirect();
        $missingResponse->assertInvalid(["name", "password"]);

        $invalidResponse = $this->post(
            "/auth/login",
            [
                "name" => str_repeat("a", 256),
                "password" => "test"
            ]
        );

        $invalidResponse->assertRedirect();
        $invalidResponse->assertInvalid(["name"]);
    }

    /**
     * Disallow login with invalid credentials.
     */
    public function test_login_invalid_credentials(): void {
        $response = $this->post(
            "/auth/login",
            [
                "name" => "steve",
                "password" => "test"
            ]
        );

        $response->assertRedirect();
        $response->assertInvalid("name");
    }

    /**
     * Successfully authenticate the user when valid credentials are given.
     */
    public function test_login_success() {
        $user = User::factory()->create(["password" => "abcd"]);

        $response = $this->post(
            "/auth/login",
            [
                "name" => $user->name,
                "password" => "abcd"
            ]
        );

        $response->assertRedirect("/");
        $response->assertValid();
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Successfully logout the user.
     */
    public function test_logout_success() {
        $user = User::factory()->create();
        Auth::login($user);

        $this->assertAuthenticatedAs($user);

        $response = $this->post("/auth/logout");

        $response->assertRedirect("/");
        $this->assertGuest();
    }
}

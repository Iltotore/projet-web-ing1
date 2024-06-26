<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
                "name" => fake()->userName(),
                "password" => fake()->password(8, 100)
            ]
        );

        $response->assertRedirect();
        $response->assertInvalid("name");
    }

    /**
     * Successfully authenticate the user when valid credentials are given.
     */
    public function test_login_success() {
        $password = fake()->password(8, 100);
        $user = User::factory()->create(["password" => $password]);

        $response = $this->post(
            "/auth/login",
            [
                "name" => $user->name,
                "password" => $password
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

        $response = $this->get("/auth/logout");

        $response->assertRedirect("/");
        $this->assertGuest();
    }

    /**
     * Return errors when sent data are either missing or invalid.
     */
    public function test_register_invalid_data() {
        $missingResponse = $this->post("/auth/register");

        $missingResponse->assertRedirect();
        $missingResponse->assertInvalid(["name", "email", "password", "password_confirmation"]);

        $invalidResponse = $this->post(
            "/auth/register",
            [
                "name" => str_repeat("a", 256),
                "email" => fake()->email(),
                "password" => fake()->password(),
                "password_confirmation" => fake()->password()
            ]
        );

        $invalidResponse->assertRedirect();
        $invalidResponse->assertInvalid(["name"]);
    }

    /**
     * Return errors when the name/email already exists.
     */
    public function test_register_existing_credentials() {
        $existingUser = User::factory()->create();

        $request = $this->post(
            "/auth/register",
            [
                "name" => $existingUser->name,
                "email" => $existingUser->email,
                "password" => fake()->password(),
                "password_confirmation" => fake()->password()
            ]
        );

        $request->isRedirect();
        $request->assertInvalid(["name", "email"]);
    }

    /**
     * Return an error when the password and confirmation do not match together.
     */
    public function test_register_password_unconfirmed() {
        $request = $this->post(
            "/auth/register",
            [
                "name" => fake()->userName(),
                "email" => fake()->email(),
                "password" => fake()->password(maxLength: 10),
                "password_confirmation" => fake()->password(minLength: 11)
            ]
        );

        $request->isRedirect();
        $request->assertInvalid(["password"]);
    }

    /**
     * Successfully register a new user for valid form parameters.
     */
    public function test_register_successful() {
        $name = fake()->userName();
        $email = fake()->email();
        $password = fake()->password(8, 100);

        $request = $this->post(
            "/auth/register",
            [
                "name" => $name,
                "email" => $email,
                "password" => $password,
                "password_confirmation" => $password
            ]
        );

        $request->assertRedirect();
        $request->assertValid();

        User::query()
            ->where("name", "=", $name)
            ->where("email", "=", $email)
            ->count() == 1;
    }

    /**
     * Return an error when the password and confirmation do not match together.
     */
    function test_update_invalid() {
        $user = User::factory()->create();
        Auth::login($user);

        $missingResponse = $this->post("/auth/update");
        $missingResponse->assertRedirect();
        $missingResponse->assertInvalid(["name", "email"]);

        $invalidResponse = $this->post(
            "/auth/update",
            [
                "name" => "",
                "email" => "abc",
                "password" => "b",
                "password_confirmation" => "a",
                "first_name" => str_repeat("a", 256),
                "last_name" => str_repeat("a", 256),
                "birth" => "",
                "job_id" => 2
            ]
        );

        $invalidResponse->assertRedirect();
        $invalidResponse->assertInvalid(["name", "email", "password", "first_name", "last_name", "birth", "job_id"]);
    }

    /**
     * Successfully register a new user for valid form parameters and no password.
     */
    function test_update_successful_no_password() {
        $user = User::factory()->create();
        $passwordHash = $user->password;
        Auth::login($user);

        $body = [
            "name" => fake()->name(),
            "email" => fake()->email(),
            "first_name" => fake()->firstName(),
            "last_name" => fake()->lastName(),
            "birth" => fake()->date()
        ];

        $noPassword = $this->post("/auth/update", $body);

        $noPassword->assertRedirect();
        $noPassword->assertValid();

        $user->refresh();

        foreach (["name", "email", "first_name", "last_name", "birth"] as $column) {
            $this->assertEquals($body[$column], $user[$column]);
        }

        $this->assertEquals($passwordHash, $user->password);
    }

    /**
     * Successfully register a new user for valid form parameters and empty password.
     */
    function test_update_successful_empty_password() {
        $user = User::factory()->create();
        $passwordHash = $user->password;
        Auth::login($user);

        $body = [
            "name" => fake()->name(),
            "email" => fake()->email(),
            "first_name" => fake()->firstName(),
            "last_name" => fake()->lastName(),
            "birth" => fake()->date(),
            "gender" => "other",
            "password" => "",
            "password_confirmation" => ""
        ];

        $noPassword = $this->post("/auth/update", $body);

        $noPassword->assertRedirect();
        $noPassword->assertValid();

        $user->refresh();

        foreach (["name", "email", "first_name", "last_name", "birth"] as $column) {
            $this->assertEquals($body[$column], $user[$column]);
        }

        $this->assertEquals($passwordHash, $user->password);
    }

    /**
     * Successfully register a new user for valid form parameters.
     */
    function test_update_successful_new_password() {
        $password = fake()->password(minLength: 8, maxLength: 50);
        $user = User::factory()->create(["password" => $password]);
        $passwordHash = $user->password;
        Auth::login($user);

        $newPassword = fake()->password(minLength: 50, maxLength: 100);

        $body = [
            "name" => fake()->name(),
            "email" => fake()->email(),
            "first_name" => fake()->firstName(),
            "last_name" => fake()->lastName(),
            "birth" => fake()->date(),
            "gender" => "other",
            "password" => $newPassword,
            "password_confirmation" => $newPassword
        ];

        $noPassword = $this->post("/auth/update", $body);

        $noPassword->assertRedirect();
        $noPassword->assertValid();

        $user->refresh();

        foreach (["name", "email", "first_name", "last_name", "birth"] as $column) {
            $this->assertEquals($body[$column], $user[$column]);
        }

        $this->assertNotEquals($passwordHash, $user->password);
    }

    /**
     * Successfully register a new user for valid form parameters and no password.
     */
    function test_update_successful_same_data() {
        $user = User::factory()->create();
        Auth::login($user);

        $body = [
            "name" => $user->name,
            "email" => $user->email,
            "first_name" => $user->firstName ?? "",
            "last_name" => $user->lastName ?? "",
            "birth" => $user->birth,
            "gender" => $user->gender ?? "other"
        ];

        $response = $this->post("/auth/update", $body);

        $response->assertRedirect();
        $response->assertValid();

        $user->refresh();

        foreach (["name", "email", "first_name", "last_name", "birth"] as $column) {
            $this->assertEquals($body[$column], $user[$column]);
        }
    }
}

<?php

namespace Tests\Feature;

use App\Http\Middleware\Authenticate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class MiddlewareTest extends TestCase
{

    protected function setUp(): void {
        parent::setUp();

        $okResponse = function () {
            return response(status: 200);
        };

        Route::get("/test/admin", $okResponse)->middleware("admin");
        Route::get("/test/auth", $okResponse)->middleware("auth");
    }

    /**
     * Abort with 404 if user is not logged in.
     */
    public function test_admin_guest(): void
    {
        $response = $this->get("/test/admin");
        $response->assertNotFound();
    }

    /**
     * Abort with 404 if user is not an admin.
     */
    public function test_admin_no_permission(): void
    {
        $user = User::factory()->create(["is_admin" => false]);
        Auth::login($user);

        $response = $this->get("/test/admin");
        $response->assertNotFound();
    }

    /**
     * Do not redirect the user if logged in with an admin account.
     */
    public function test_admin_ok(): void
    {
        $user = User::factory()->create(["is_admin" => true]);
        Auth::login($user);

        $response = $this->get("/test/auth");
        $response->assertSuccessful();
    }

    /**
     * Redirect the user if not logged in
     */
    public function test_auth_redirect(): void
    {
        $response = $this->get("/test/auth");
        $response->assertRedirect("http://localhost/login?redirect=http%3A%2F%2Flocalhost%2Ftest%2Fauth");
    }

    /**
     * Do not redirect the user if logged in.
     */
    public function test_auth_ok(): void
    {
        $user = User::factory()->create();
        Auth::login($user);

        $response = $this->get("/test/auth");
        $response->assertSuccessful();
    }
}

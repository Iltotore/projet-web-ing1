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

        Route::get("/test/auth", function () {
            return response(status: 200);
        })->middleware("auth");
    }

    /**
     * Redirect the user if not logged in
     */
    public function test_auth_redirect(): void
    {
        $response = $this->get("/test/auth");
        $response->assertRedirect("/login?redirect=http://localhost/test/auth");
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

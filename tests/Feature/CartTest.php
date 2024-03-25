<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CartTest extends TestCase {
    use RefreshDatabase;

    /**
     * Return errors when sent data are either missing or invalid.
     */
    public function test_add_invalid_data(): void {
        $user = User::factory()->create();

        Auth::login($user);

        $missingData = $this->postJson("/cart/add");
        $missingData->assertInvalid(["product", "amount"]);

        $invalidData = $this->postJson(
            "/cart/add",
            [
                "product" => 1,
                "amount" => -5
            ]
        );

        $invalidData->assertInvalid(["product", "amount"]);
    }

    /**
     * Successfully add item when valid arguments are given.
     */
    public function test_add_successful() {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        Auth::login($user);

        $response = $this->postJson(
            "/cart/add",
            [
                "product" => $product->id,
                "amount" => 5
            ]
        );

        $response->assertSuccessful();
        $this->assertEquals(5, $user->cart()->find($product)->pivot->amount);

        $response = $this->postJson(
            "/cart/add",
            [
                "product" => $product->id,
                "amount" => 5
            ]
        );

        $response->assertSuccessful();
        $this->assertEquals(10, $user->cart()->find($product)->pivot->amount);
    }

    /**
     * Return errors when sent data are either missing or invalid.
     */
    public function test_set_invalid_data(): void {
        $user = User::factory()->create();

        Auth::login($user);

        $missingData = $this->postJson("/cart/set");
        $missingData->assertInvalid(["product", "amount"]);

        $invalidData = $this->postJson(
            "/cart/set",
            [
                "product" => 1,
                "amount" => -5
            ]
        );

        $invalidData->assertInvalid(["product", "amount"]);
    }

    /**
     * Successfully set item when valid arguments are given.
     */
    public function test_set_successful() {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        Auth::login($user);

        $response = $this->postJson(
            "/cart/set",
            [
                "product" => $product->id,
                "amount" => 5
            ]
        );

        $response->assertSuccessful();
        $this->assertEquals(5, $user->cart()->find($product)->pivot->amount);
    }

    /**
     * Return errors when sent data are either missing or invalid.
     */
    public function test_remove_invalid_data(): void {
        $user = User::factory()->create();

        Auth::login($user);

        $missingData = $this->postJson("/cart/remove");
        $missingData->assertInvalid(["product"]);

        $invalidData = $this->postJson(
            "/cart/set",
            [
                "product" => 1
            ]
        );

        $invalidData->assertInvalid(["product"]);
    }

    /**
     * Successfully remove item from cart when valid arguments are given.
     */
    public function test_remove_successful() {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        Auth::login($user);

        $response = $this->postJson(
            "/cart/remove",
            [
                "product" => $product->id,
            ]
        );

        $response->assertSuccessful();
        $this->assertEquals(null, $user->cart()->find($product));
    }
}

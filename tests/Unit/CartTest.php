<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

class CartTest extends TestCase {
    use RefreshDatabase;

    /**
     * Get user's cart items.
     */
    public function test_get_items() {
        $products = Product::factory()->count(5)->create();
        $user = User::factory()->create();

        foreach ($products as $product) {
            $user->cart()->attach($product, ["amount" => 1]);
        }

        foreach ($user->getCartItems() as $item) {
            $exists = false;

            foreach ($products as $product) {
                if($product->id == $item->id) {
                    $exists = true;
                    break;
                }
            }

            assertTrue($exists);
        }
    }

    /**
     * Add product to cart with given amount and increase it if it exists.
     */
    public function test_add_item(): void {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $user->addCartItem($product, 5);
        $this->assertEquals(5, $user->getAmount($product));

        $user->addCartItem($product, 5);
        $this->assertEquals(10, $user->getAmount($product));
    }

    /**
     * Remove product from cart with given amount and delete it if final amount is < 0.
     */
    public function test_remove_item(): void {
        $user = User::factory()->create();
        $product = Product::factory()->create(["amount" => fake()->numberBetween(int1: 10)]);
        $user->cart()->attach($product, ["amount" => 10]);

        $user->removeCartItem($product, 5);
        $this->assertEquals(5, $user->getAmount($product));

        $user->removeCartItem($product, 5);
        $this->assertEquals(null, $user->cart()->find($product));
    }

    /**
     * Set product with given amount in cart.
     */
    public function test_set_item(): void {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $user->setCartItem($product, 5);
        $this->assertEquals(5, $user->getAmount($product));
    }

    /**
     * Delete product from cart.
     */
    public function test_delete_item(): void {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $user->cart()->attach($product, ["amount" => 1]);

        $user->deleteCartItem($product);
        assertEquals(0, $user->cart()->count());
    }
}

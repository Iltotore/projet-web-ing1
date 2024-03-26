<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        "email",
        "password",
        "is_admin"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        "password",
        "remember_token",
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "email_verified_at" => "datetime",
        "password" => "hashed"
    ];

    public function cart(): BelongsToMany {
        return $this
            ->belongsToMany(Product::class, table: "shopping_cart")
            ->withPivot(["amount"]);
    }

    /**
     * Get items in this user's cart.
     *
     * @return array the products added to cart with their amount
     */
    public function getCartItems(): array {
        return $this->cart()->getResults()->all();
    }

    /**
     * Get quantity of given product in cart.
     *
     * @param Product|int $product the product type
     * @return int the amount of `$product` in this user's cart
     */
    public function getAmount(Product|int $product): int {
        $result = $this->cart()->find($product);
        return $result ? $result->pivot->amount : 0;
    }

    /**
     * Add a product in given quantity to cart.
     *
     * @param Product|int $product the product type to add
     * @param int $amount the amount of the given product to add
     * @return void
     */
    public function addCartItem(Product $product, int $amount): CartResult {
        $validAmount = max($amount, 1);
        $existing = $this->cart()->find($product);
        $available = $product->amount;
        if ($existing == null) {
            $finalAmount = min(max($validAmount, 0), $available);
            $this->cart()->attach($product, ["amount" => $finalAmount]);
        } else {
            $finalAmount = min(max($existing->pivot->amount + $validAmount, 0), $available);
            if($finalAmount == 0) {
                $this->deleteCartItem($product);
                return CartResult::delete();
            } else $existing->pivot->update(["amount" => $finalAmount]);
        }

        return $finalAmount == $available ? CartResult::full($finalAmount) : CartResult::ok($finalAmount);
    }

    public function removeCartItem(Product $product, int $amount): CartResult {
        $validAmount = max($amount, 1);
        $existing = $this->cart()->find($product);
        $available = $product->amount;
        if ($existing == null) return CartResult::doesNotExist();
        else {
            $finalAmount = min(max($existing->pivot->amount - $validAmount, 0), $available);
            if($finalAmount == 0) {
                $this->deleteCartItem($product);
                return CartResult::delete();
            }
            else {
                $existing->pivot->update(["amount" => $finalAmount]);
                return $finalAmount == $available ? CartResult::full($finalAmount) : CartResult::ok($finalAmount);
            }
        }
    }

    /**
     * Set a product in given quantity in this user's cart.
     *
     * @param Product|int $product the product type to set
     * @param int $amount the amount of the given product to set
     * @return void
     */
    public function setCartItem(Product|int $product, int $amount): void {
        $validAmount = max($amount, 0);
        $existing = $this->cart()->find($product);
        if ($existing == null) $this->cart()->attach($product, ["amount" => $validAmount]);
        else {
            $existing->pivot->update(["amount" => $validAmount]);
        }
    }

    /**
     * Remove a product from this user's cart, no matter how much is present.
     *
     * @param Product|int $product the product type to remove
     * @return void
     */
    public function deleteCartItem(Product|int $product): void {
        $this->cart()->detach($product);
    }

    /**
     * Remove all items from cart.
     *
     * @return void
     */
    public function clearCart(): void {
        $this->cart()->delete();
    }

    /**
     * The "login" column used for authentication.
     */
    public function username() {
        return "name";
    }
}

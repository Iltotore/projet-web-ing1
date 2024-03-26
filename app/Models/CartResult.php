<?php

namespace App\Models;

class CartResult {

    private int $amount;
    private CartResultState $state;

    public function __construct(int $amount, CartResultState $state) {
        $this->amount = $amount;
        $this->state = $state;
    }

    /**
     * @return int
     */
    public function getAmount(): int {
        return $this->amount;
    }

    /**
     * @return CartResultState
     */
    public function getState(): CartResultState {
        return $this->state;
    }

    public function toJson(): array {
        return match ($this->state) {
            CartResultState::Ok, CartResultState::Full => ["state" => $this->state, "amount" => $this->amount],
            CartResultState::Delete, CartResultState::DoesNotExist => ["state" => $this->state]
        };
    }

    public static function ok(int $amount): CartResult {
        return new CartResult($amount, CartResultState::Ok);
    }

    public static function full(int $amount): CartResult {
        return new CartResult($amount, CartResultState::Full);
    }

    public static function delete() {
        return new CartResult(0, CartResultState::Delete);
    }

    public static function doesNotExist() {
        return new CartResult(0, CartResultState::DoesNotExist);
    }
}

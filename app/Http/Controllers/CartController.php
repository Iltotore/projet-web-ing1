<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller {

    /**
     * Add a product in given amount to cart.
     *
     * @param Request $request
     * @return Response
     */
    public function add(Request $request): Response {
        $args = $request->validate([
            "product" => ["required", "exists:products,id"],
            "amount" => ["required", "numeric", "gt:0"]
        ]);

        Auth::user()->addCartItem($args["product"], $args["amount"]);

        return response(status: 200);
    }

    /**
     * Set product amount in cart.
     *
     * @param Request $request
     * @return Response
     */
    public function set(Request $request): Response {
        $args = $request->validate([
            "product" => ["required", "exists:products,id"],
            "amount" => ["required", "numeric", "gt:0"]
        ]);

        Auth::user()->setCartItem($args["product"], $args["amount"]);

        return response(status: 200);
    }

    /**
     * Remove product from cart.
     *
     * @param Request $request
     * @return Response
     */
    public function remove(Request $request): Response {
        $args = $request->validate([
            "product" => ["required", "exists:products,id", ]
        ]);

        Auth::user()->removeCartItem($args["product"]);

        return response(status: 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller {

    /**
     * Add a product in given amount to cart.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request): JsonResponse {
        $args = $request->validate([
            "product" => ["required", "exists:products,id"],
            "amount" => ["required", "numeric", "gt:0"]
        ]);

        $result = Auth::user()->addCartItem(Product::find($args["product"]), $args["amount"]);

        return response()->json($result->toJson());
    }

    /**
     * Remove a product in given amount from cart.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function remove(Request $request): JsonResponse {
        $args = $request->validate([
            "product" => ["required", "exists:products,id"],
            "amount" => ["required", "numeric", "gt:0"]
        ]);

        $result = Auth::user()->removeCartItem(Product::find($args["product"]), $args["amount"]);

        return response()->json($result->toJson());
    }

    /**
     * Delete product from cart.
     *
     * @param Request $request
     * @return Response
     */
    public function delete(Request $request): Response {
        $args = $request->validate([
            "product" => ["required", "exists:products,id", ]
        ]);

        Auth::user()->deleteCartItem($args["product"]);

        return response(status: 200);
    }
}

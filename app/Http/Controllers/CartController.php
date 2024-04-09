<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
     * @return JsonResponse
     */
    public function add(Request $request): JsonResponse {
        $args = $request->validate([
            "product" => ["required", "exists:products,id"],
            "amount" => ["required", "integer", "gt:0"]
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
            "amount" => ["required", "integer", "gt:0"]
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

    /**
     * Delete all items from cart.
     *
     * @return Response
     */
    public function clear(): Response {
        Auth::user()->clearCart();

        return response(status: 200);
    }

    /**
     * Buy items in cart then clear it.
     *
     * @return RedirectResponse
     */
    public function buy(): RedirectResponse {
        $user = Auth::user();
        $inCart = $user->getCartItems();

        $errorItems = [];

        foreach ($inCart as $item) {
            if ($item->pivot->amount > $item->amount) array_push($errorItems, $item);
        }

        if(empty($errorItems)) {
            foreach ($inCart as $item) {
                $item->amount -= $item->pivot->amount;
                $item->save();
            }
            $user->clearCart();
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors(["tooManyItems" => $errorItems]);
        }
    }

    /**
     * Get items in cart.
     *
     * @return JsonResponse
     */
    public function getCart(): JsonResponse {
        $user = Auth::user();
        $inCart = $user->getCartItems();

        return response()->json($inCart);
    }
}

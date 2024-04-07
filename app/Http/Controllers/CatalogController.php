<?php

namespace App\Http\Controllers;

use App\Models\Product;
use http\Exception\RuntimeException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CatalogController extends Controller
{

    /**
     * Get products of a category.
     *
     * @return JsonResponse
     */
    public function getProducts(Request $request): JsonResponse
    {
        $args = $request->validate([
            "category" =>  ["required", "integer", "exists:categories,id"]
        ]);

        $products = Product::where("category_id", "=", $args["category"])->get();

        return response()->json($products);
    }
}
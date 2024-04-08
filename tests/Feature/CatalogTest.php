<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Get the product list in a specific category.
     */
    public function test_products(): void
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class]);

        $maxCategory = Category::max('category_id');
        $category = fake()->numberBetween(0, $maxCategory);

        $defaultCategory = $this->get("/catalog/products?category=" . $category);

        $defaultCategory->assertJsonIsArray();

        $products = Product::where("category_id", "=", $category)->get()->toArray();
        $defaultCategory->assertJson($products);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\ContactForm;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use PhpParser\Parser\Php7;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Successfully get the product list.
     */
    public function test_getProducts_successful() {
        $user = User::factory()->create(["is_admin" => true]);
        $product = Product::factory()->create();

        Auth::login($user);

        $response = $this->postJson("/admin/product/get");
        $response->assertSuccessful();
    }

    /**
     * Return errors when sent product data are either missing or invalid.
     */
    public function test_add_invalid_product(): void {
        $user = User::factory()->create(["is_admin" => true]);

        Auth::login($user);

        $missingData = $this->postJson("/admin/product/add");
        $missingData->assertInvalid(["name", "description", "icon", "unit_price", "amount", "category_id"]);

        $invalidData = $this->postJson(
            "/admin/product/add",
            [
                "name" => "",
                "description" => "",
                "icon" => "file",
                "unit_price" => -0.5,
                "amount" => -5,
                "category_id" => 9999
            ]
        );

        $invalidData->assertInvalid(["name", "description", "icon", "unit_price", "amount", "category_id"]);
    }

    /**
     * Successfully add product when valid arguments are given.
     */
    public function test_add_successful_product() {
        $user = User::factory()->create(["is_admin" => true]);
        $category = Category::factory()->create(["id" => 1]);

        Auth::login($user);

        $response = $this->postJson(
            "/admin/product/add",
            [
                "name" => "product 01",
                "description" => "This is the product n°01",
                "icon" => fake()->file,
                "unit_price" => 0.5,
                "amount" => 5,
                "category_id" => $category->id
            ]
        );
        $response->assertSuccessful();
    }

    /**
     * Return errors when sent product data are either missing or invalid.
     */
    public function test_remove_invalid_product(): void {
        $user = User::factory()->create(["is_admin" => true]);

        Auth::login($user);

        $missingData = $this->postJson("/admin/product/remove");
        $missingData->assertInvalid(["id"]);

        $invalidData = $this->postJson(
            "/admin/product/remove",
            [
                "id" => 9999
            ]
        );

        $invalidData->assertInvalid(["id"]);
    }

    /**
     * Successfully remove product when valid arguments are given.
     */
    public function test_remove_successful_product() {
        $user = User::factory()->create(["is_admin" => true]);
        $product = Product::factory()->create(["id" => 1]);

        Auth::login($user);

        $response = $this->postJson(
            "/admin/product/remove",
            [
                "id" => 1
            ]
        );
        $response->assertSuccessful();
    }

    /**
     * Return errors when sent product data are either missing or invalid.
     */
    public function test_update_invalid_product(): void {
        $user = User::factory()->create(["is_admin" => true]);

        Auth::login($user);

        $missingData = $this->postJson("/admin/product/update");
        $missingData->assertInvalid(["id"]);

        $invalidData = $this->postJson(
            "/admin/product/update",
            [
                "id" => 9999,
                "icon" => "test",
                "unit_price" => "abc",
                "amount" => -1,
                "category_id" => 9999
            ]
        );

        $invalidData->assertInvalid(["id", "icon", "unit_price", "amount", "category_id"]);
    }

    /**
     * Successfully update product when valid arguments are given.
     */
    public function test_update_successful_product() {
        $user = User::factory()->create(["is_admin" => true]);
        $category = Category::factory()->create(["id" => 1]);
        $category2 = Category::factory()->create(["id" => 2]);
        $product = Product::factory()->create(["id" => 1, "category_id" => 1]);

        Auth::login($user);

        $response = $this->postJson(
            "/admin/product/update",
            [
                "id" => 1,
                "name" => "abc",
                "description" => "abc",
                "icon" => "file.webp",
                "unit_price" => 10.10,
                "amount" => 10,
                "category_id" => 2
            ]
        );
        $response->assertSuccessful();
    }

    /**
     * Successfully get the category list.
     */
    public function test_getCategories_successful() {
        $user = User::factory()->create(["is_admin" => true]);
        $category = Category::factory()->create();

        Auth::login($user);

        $response = $this->postJson("/admin/category/get");
        $response->assertSuccessful();
    }

    /**
     * Return errors when sent category data are either missing or invalid.
     */
    public function test_add_invalid_category(): void {
        $user = User::factory()->create(["is_admin" => true]);

        Auth::login($user);

        $missingData = $this->postJson("/admin/product/add");
        $missingData->assertInvalid(["name", "icon"]);

        $invalidData = $this->postJson(
            "/admin/category/add",
            [
                "name" => "",
                "icon" => "file"
            ]
        );

        $invalidData->assertInvalid(["name", "icon"]);
    }

    /**
     * Successfully add category when valid arguments are given.
     */
    public function test_add_successful_category() {
        $user = User::factory()->create(["is_admin" => true]);
        $category = Category::factory()->create(["id" => 1]);

        Auth::login($user);

        $response = $this->postJson(
            "/admin/category/add",
            [
                "name" => "product 01",
                "icon" => "product01.webp"
            ]
        );
        $response->assertSuccessful();
    }

    /**
     * Return errors when sent category data are either missing or invalid.
     */
    public function test_remove_invalid_category(): void {
        $user = User::factory()->create(["is_admin" => true]);

        Auth::login($user);

        $missingData = $this->postJson("/admin/product/add");
        $missingData->assertInvalid(["name", "icon"]);

        $invalidData = $this->postJson(
            "/admin/category/remove",
            [
                "id" => 9999
            ]
        );

        $invalidData->assertInvalid(["id"]);
    }

    /**
     * Successfully remove category when valid arguments are given.
     */
    public function test_remove_successful_category() {
        $user = User::factory()->create(["is_admin" => true]);
        $category = Category::factory()->create(["id" => 1]);

        Auth::login($user);

        $response = $this->postJson(
            "/admin/category/remove",
            [
                "id" => 1
            ]
        );
        $response->assertSuccessful();
    }

    /**
     * Return errors when sent user data are either missing or invalid.
     */
    public function test_add_invalid_user(): void {
        $user = User::factory()->create(["is_admin" => true]);

        Auth::login($user);

        $missingData = $this->postJson("/admin/user/add");
        $missingData->assertInvalid(["name", "email", "password", "is_admin"]);

        $invalidData = $this->postJson(
            "/admin/user/add",
            [
                "name" => $user->name,
                "email" => "email",
                "password" => "1234",
                "is_admin" => -1
            ]
        );

        $invalidData->assertInvalid(["name", "email", "password", "is_admin"]);
    }

    /**
     * Successfully add user when valid arguments are given.
     */
    public function test_add_successful_user() {
        $user = User::factory()->create(["is_admin" => true]);

        Auth::login($user);

        $response = $this->postJson(
            "/admin/user/add",
            [
                "name" => "name",
                "email" => "name@email.com",
                "password" => "123456789",
                "is_admin" => 0
            ]
        );
        $response->assertSuccessful();
    }

    /**
     * Return errors when sent user data are either missing or invalid.
     */
    public function test_remove_invalid_user(): void {
        $user = User::factory()->create(["is_admin" => true]);

        Auth::login($user);

        $missingData = $this->postJson("/admin/user/remove");
        $missingData->assertInvalid(["id"]);

        $invalidData = $this->postJson(
            "/admin/user/remove",
            [
                "id" => 99999
            ]
        );

        $invalidData->assertInvalid(["id"]);
    }

    /**
     * Successfully remove user when valid arguments are given.
     */
    public function test_remove_successful_user() {
        $user = User::factory()->create(["is_admin" => true]);
        $user2 = User::factory()->create();

        Auth::login($user);

        $response = $this->postJson(
            "/admin/user/remove",
            [
                "id" => $user2->id
            ]
        );
        $response->assertSuccessful();
    }

    /**
     * Return errors when sent user data are either missing or invalid.
     */
    public function test_resetPassword_invalid(): void {
        $user = User::factory()->create(["is_admin" => true]);

        Auth::login($user);

        $missingData = $this->postJson("/admin/user/resetPassword");
        $missingData->assertInvalid(["id"]);

        $invalidData = $this->postJson(
            "/admin/user/resetPassword",
            [
                "id" => 9999
            ]
        );

        $invalidData->assertInvalid(["id"]);
    }

    /**
     * Successfully reset user password when valid arguments are given.
     */
    public function test_resetPassword_successful() {
        $user = User::factory()->create(["is_admin" => true]);
        $user2 = User::factory()->create();

        Auth::login($user);

        $response = $this->postJson(
            "/admin/user/resetPassword",
            [
                "id" => $user2->id
            ]
        );
        $response->assertSuccessful();
    }

    /**
     * Return errors when sent user data are either missing or invalid.
     */
    public function test_replyContactForm_invalid(): void {
        $user = User::factory()->create(["is_admin" => true]);

        Auth::login($user);

        $missingData = $this->postJson("/admin/contactForm/reply");
        $missingData->assertInvalid(["id", "mailBody"]);

        $invalidData = $this->postJson(
            "/admin/contactForm/reply",
            [
                "id" => 9999,
                "mailBody" => ""
            ]
        );

        $invalidData->assertInvalid(["id", "mailBody"]);
    }

    /**
     * Successfully reply to a contact form when valid arguments are given.
     */
    public function test_replyContactForm_successful() {
        $user = User::factory()->create(["is_admin" => true]);
        $form = ContactForm::factory()->create();

        Auth::login($user);

        $response = $this->postJson(
            "/admin/contactForm/reply",
            [
                "id" => $form->id,
                "mailBody" => fake()->sentences
            ]
        );
        $response->assertSuccessful();
    }


    /**
     * Successfully get the contact form list.
     */
    public function test_getContactForms_successful() {
        $user = User::factory()->create(["is_admin" => true]);
        $form = ContactForm::factory()->create();

        Auth::login($user);

        $response = $this->postJson("/admin/contactForm/get");
        $response->assertSuccessful();
    }
}

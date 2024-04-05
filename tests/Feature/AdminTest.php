<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\ContactForm;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use PhpParser\Parser\Php7;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase; // refresh database between tests

    /**
     * Successfully get the product list.
     */
    public function test_getProducts_successful() {
        $user = User::factory()->create(["is_admin" => true]);
        $category = Category::factory()->create();
        $product = Product::factory()->create(["category_id" => $category->id]);

        Auth::login($user);

        $response = $this->postJson(
            "/admin/product/get",
            [
                "category" => $product->category_id
            ]
        );
        $response->assertSuccessful();
    }

    /**
     * Return errors when sent product data are either missing or invalid.
     */
    public function test_add_invalid_product(): void {
        $user = User::factory()->create(["is_admin" => true]);

        Auth::login($user);

        $missingData = $this->postJson("/admin/product/add");
        $missingData->assertInvalid(["name", "description", "icon_data", "unit_price", "amount", "category_id"]);

        $invalidData = $this->postJson(
            "/admin/product/add",
            [
                "name" => "",
                "description" => "",
                "icon_data" => "file",
                "unit_price" => -0.5,
                "amount" => -5,
                "category_id" => 9999
            ]
        );

        $invalidData->assertInvalid(["name", "description", "icon_data", "unit_price", "amount", "category_id"]);
    }

    /**
     * Successfully add product when valid arguments are given.
     */
    public function test_add_successful_product() {
        $user = User::factory()->create(["is_admin" => true]);
        $category = Category::factory()->create();
        $file = UploadedFile::fake()->create('fake.webp');

        Auth::login($user);

        $response = $this->postJson(
            "/admin/product/add",
            [
                "name" => "product 01",
                "description" => "This is the product n°01",
                "icon_data" => $file,
                "unit_price" => 0.5,
                "amount" => 5,
                "category_id" => $category->id
            ]
        );
        $response->assertSuccessful();
        $response->assertJson([
            "id" => 1,
            "name" => "product 01",
            "description" => "This is the product n°01",
            "unit_price" => 0.5,
            "amount" => 5,
            "category_id" => $category->id
        ]);
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
        $product = Product::factory()->create();

        Auth::login($user);

        $response = $this->postJson(
            "/admin/product/remove",
            [
                "id" => $product->id
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
                "icon_data" => "test",
                "unit_price" => "abc",
                "amount" => -1,
                "category_id" => 9999
            ]
        );

        $invalidData->assertInvalid(["id", "icon_data", "unit_price", "amount", "category_id"]);
    }

    /**
     * Successfully update product when valid arguments are given.
     */
    public function test_update_successful_product() {
        $user = User::factory()->create(["is_admin" => true]);
        $category = Category::factory()->create();
        $category2 = Category::factory()->create(["id" => 2]);
        $product = Product::factory()->create(["category_id" => $category->id]);
        $file = UploadedFile::fake()->create('fake.webp');

        Auth::login($user);

        $response = $this->postJson(
            "/admin/product/update",
            [
                "id" => $product->id,
                "name" => "abc",
                "description" => "abc",
                "icon_data" => $file,
                "unit_price" => 10.10,
                "amount" => 10,
                "category_id" => $category2->id
            ]
        );
        $response->assertSuccessful();
        $response->assertJson([
            "id" => $product->id,
            "name" => "abc",
            "description" => "abc",
            "unit_price" => 10.10,
            "amount" => 10,
            "category_id" => 2
        ]);
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
        $missingData->assertInvalid(["name", "icon_data"]);

        $invalidData = $this->postJson(
            "/admin/category/add",
            [
                "name" => "",
                "icon_data" => "file"
            ]
        );

        $invalidData->assertInvalid(["name", "icon_data"]);
    }

    /**
     * Successfully add category when valid arguments are given.
     */
    public function test_add_successful_category() {
        $user = User::factory()->create(["is_admin" => true]);
        $category = Category::factory()->create(["id" => 1]);
        $file = UploadedFile::fake()->create('fake.webp');

        Auth::login($user);

        $response = $this->postJson(
            "/admin/category/add",
            [
                "name" => "product 01",
                "icon_data" => $file
            ]
        );
        $response->assertSuccessful();
        $response->assertJson([
            "name" => "product 01"
        ]);
    }

    /**
     * Return errors when sent category data are either missing or invalid.
     */
    public function test_remove_invalid_category(): void {
        $user = User::factory()->create(["is_admin" => true]);

        Auth::login($user);

        $missingData = $this->postJson("/admin/category/remove");
        $missingData->assertInvalid(["id"]);

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
        $category = Category::factory()->create();

        Auth::login($user);

        $response = $this->postJson(
            "/admin/category/remove",
            [
                "id" => $category->id
            ]
        );
        $response->assertSuccessful();
    }

    /**
     * Return errors when sent product data are either missing or invalid.
     */
    public function test_update_invalid_category(): void {
        $user = User::factory()->create(["is_admin" => true]);

        Auth::login($user);

        $missingData = $this->postJson("/admin/category/update");
        $missingData->assertInvalid(["id", "name", "icon_data"]);

        $invalidData = $this->postJson(
            "/admin/category/update",
            [
                "id" => 9999,
                "name" => "",
                "icon_data" => "file"
            ]
        );

        $invalidData->assertInvalid(["id", "name", "icon_data"]);
    }

    /**
     * Successfully update product when valid arguments are given.
     */
    public function test_update_successful_category() {
        $user = User::factory()->create(["is_admin" => true]);
        $category = Category::factory()->create();
        $file = UploadedFile::fake()->create('fake.webp');

        Auth::login($user);

        $response = $this->postJson(
            "/admin/category/update",
            [
                "id" => $category->id,
                "name" => "abc",
                "icon_data" => $file
            ]
        );
        $response->assertSuccessful();
        $response->assertJson([
            "id" => $category->id,
            "name" => "abc"
        ]);
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
        $response->assertJson([
            "name" => "name",
            "email" => "name@email.com",
            "is_admin" => 0
        ]);
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
        $response->assertJson([
            "id" => $user2->id
        ]);
    }

    /**
     * Return errors when sent user data are either missing or invalid.
     */
    public function test_replyContactForm_invalid(): void {
        $user = User::factory()->create(["is_admin" => true]);

        Auth::login($user);

        $missingData = $this->postJson("/admin/contact/reply");
        $missingData->assertInvalid(["id", "mailBody"]);

        $invalidData = $this->postJson(
            "/admin/contact/reply",
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
        $sentences = fake()->sentences(asText: true);

        Auth::login($user);

        $response = $this->postJson(
            "/admin/contact/reply",
            [
                "id" => $form->id,
                "mailBody" => $sentences
            ]
        );
        $response->assertSuccessful();
    }


    /**
     * Successfully get the contact form list.
     */
    public function test_getContacts_successful() {
        $user = User::factory()->create(["is_admin" => true]);
        $form = ContactForm::factory()->create();

        Auth::login($user);

        $response = $this->postJson("/admin/contact/get");
        $response->assertSuccessful();
    }
}

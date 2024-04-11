<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ContactForm;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class AdminController extends Controller
{
    /**
     * get the products.
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

    /**
     * Add a given product in the database.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function addProduct(Request $request): JsonResponse
    {
        $args = $request->validate([
            "name" => ["required", "string", "max:255"],
            "description" => ["required", "string", "max:255"],
            "icon_data" => ["required", "file"],
            "unit_price" => ["required", "numeric", "gt:0"],
            "amount" => ["required", "integer", "gte:0"],
            "category_id" => ["required", "exists:categories,id", "integer", "gte:0"]
        ]);

        // Store the file in storage\app\public folder
        $file = $request->file('icon_data');
        $filePath = $file->store('uploads', 'public');

        $args["icon"] = $filePath;

        $result = Product::create($args);

        return response()->json($result);
    }


    /**
     * Remove a given product from the database.
     *
     * @param Request $request
     * @return Response
     */
    public function removeProduct(Request $request): Response {
        $args = $request->validate([
            "id" => ["required", "exists:products,id"]
        ]);

        Product::find($args["id"])->delete();

        return response(status: 200);
    }

    /**
     * Update a given product in the database.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateProduct(Request $request): JsonResponse {

        $args = $request->validate([
            "id" => ["required", "exists:products,id"],
            "name" => ["required", "max:255", "string"],
            "description" => ["required", "max:255", "string"],
            "icon_data" => ["required", "file"],
            "unit_price" => ["required", "numeric", "gt:0"],
            "amount" => ["required", "integer", "gte:0"],
            "category_id" => ["required", "integer", "exists:categories,id", "gte:0"]
        ]);

        $product = Product::find($args["id"]);

        $product->name = $args["name"];
        $product->description = $args["description"];
        $product->unit_price = $args["unit_price"];
        $product->amount = $args["amount"];
        $product->category_id = $args["category_id"];

        // Store the file in storage\app\public folder
        $file = $request->file('icon_data');
        $filePath = $file->store('uploads', 'public');

        $product["icon"] = $filePath;

        $product->save();

        return response()->json($product);
    }

    /**
     * get the categories.
     *
     * @return JsonResponse
     */
    public function getCategories(): JsonResponse
    {
        $categories = Category::all();

        return response()->json($categories);
    }

    /**
     * Add a given category in the database.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function addCategory(Request $request): JsonResponse {
        $args = $request->validate([
            "name" => ["required", "string", "max:255"],
            "icon_data" => ["required", "file"]
        ]);

        // Store the file in storage\app\public folder
        $file = $request->file('icon_data');
        $filePath = $file->store('uploads', 'public');

        $args["icon"] = $filePath;

        $result = Category::create($args);

        return response()->json($result);
    }

    /**
     * Remove a given category from the database.
     *
     * @param Request $request
     * @return Response
     */
    public function removeCategory(Request $request): Response {
        $args = $request->validate([
            "id" => ["required", "exists:categories,id"]
        ]);

        Category::find($args["id"])->delete();

        return response(status: 200);
    }

    /**
     * Update a given category in the database.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateCategory(Request $request): JsonResponse {

        $args = $request->validate([
            "id" => ["required", "exists:categories,id"],
            "name" => ["required", "string", "max:255"],
            "icon_data" => ["required", "file"]
        ]);

        $category = Category::find($args["id"]);

        $category->name = $args["name"];

        // Store the file in storage\app\public folder
        $file = $request->file('icon_data');
        $filePath = $file->store('uploads', 'public');

        $category["icon"] = $filePath;

        $category->save();

        return response()->json($category);
    }

    /**
     * get the users list.
     *
     * @return JsonResponse
     */
    public function getUsers(): JsonResponse
    {
        $users = User::all();

        return response()->json($users);
    }

    /**
     * Add a given user in the database.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function addUser(Request $request): JsonResponse {
        $args = $request->validate([
            "name" => ["required", "string", "max:255", "unique:users,name"],
            "email" => ["required", "email", "unique:users,email"],
            "password" => ["required", "between:8,100"],
            "is_admin" => ["required", "integer", "gte:0", "lte:1"]
        ]);

        $result = User::create($args);

        return response()->json($result);
    }

    /**
     * Remove a given user from the database.
     *
     * @param Request $request
     * @return Response
     */
    public function removeUser(Request $request): Response {
        $args = $request->validate([
            "id" => ["required", "exists:users,id"]
        ]);

        $result = User::find($args["id"])->delete();

        return response(status: 200);
    }

    /**
     * Reset the password of a given user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function resetPassword(Request $request): JsonResponse {
        $args = $request->validate([
            "id" => ["required", "exists:users,id"]
        ]);

        $user = User::find($args["id"]);

        Password::sendResetLink([$user->email]);

        return response()->json($user);
    }

    /**
     * Reply to a given contact form.
     *
     * @param Request $request
     * @return Response
     */
    public function replyContact(Request $request): Response {
        $args = $request->validate([
            "id" => ["required", "exists:contact_forms,id"],
            "mailBody" => ["required", "string", "max:500", "min:1"]
        ]);

        $contactForm = ContactForm::find($args["id"]);

        // TODO send email and change return

        return response(status: 200);
    }

    /**
     * get the contact forms.
     *
     * @return JsonResponse
     */
    public function getContacts(): JsonResponse
    {
        $contacts = ContactForm::all();

        return response()->json($contacts);
    }

}

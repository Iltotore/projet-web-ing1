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

class AdminController extends Controller
{
    /**
     * get the products.
     *
     * @return JsonResponse
     */
    public function getProducts(): JsonResponse
    {
        $products = Product::all();

        return response()->json($products);
    }

    /**
     * Add a given product in the database.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function addProduct(Request $request): RedirectResponse {
        $args = $request->validate([
            "name" => ["required", "string", "max:255"],
            "description" => ["required", "string", "max:255"],
            "icon" => ["required", "file"],
            "unit_price" => ["required", "numeric", "gt:0"],
            "amount" => ["required", "integer", "gte:0"],
            "category_id" => ["required", "exists:categories,id", "integer", "gte:0"]
        ]);

        Product::create($args);

        return redirect()->back();
    }

    /**
     * Remove a given product from the database.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function removeProduct(Request $request): RedirectResponse {
        $args = $request->validate([
            "id" => ["required", "exists:products,id"]
        ]);

        Product::find($args["id"])->delete();

        return redirect()->back();
    }

    /**
     * Update a given product in the database.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateProduct(Request $request): RedirectResponse {

        $args = $request->validate([
            "id" => ["required", "exists:products,id"],
            "name" => ["required", "max:255", "string"],
            "description" => ["required", "max:255", "string"],
            "icon" => ["required", "file"],
            "unit_price" => ["required", "numeric", "gt:0"],
            "amount" => ["required", "integer", "gte:0"],
            "category_id" => ["required", "integer", "exists:categories,id", "gte:0"]
        ]);

        $product = Product::find($args["id"]);

        $product->name = $args["name"];
        $product->descripton = $args["description"];
        $product->icon = $args["icon"];
        $product->unit_price = $args["unit_price"];
        $product->amount = $args["amount"];
        $product->category_id = $args["category_id"];

        $product->save();

        return redirect()->back();
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
     * @return RedirectResponse
     */
    public function addCategory(Request $request): RedirectResponse {
        $args = $request->validate([
            "name" => ["required", "string", "max:255"],
            "icon" => ["required", "file"]
        ]);

        Category::create($args);

        return redirect()->back();
    }

    /**
     * Remove a given category from the database.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function removeCategory(Request $request): RedirectResponse {
        $args = $request->validate([
            "id" => ["required", "exists:categories,id"]
        ]);

        Product::find($args["id"])->delete();

        return redirect()->back();
    }

    /**
     * Add a given user in the database.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function addUser(Request $request): RedirectResponse {
        $args = $request->validate([
            "name" => ["required", "string", "max:255", "unique:users,name"],
            "email" => ["required", "email", "unique:users,email"],
            "password" => ["required", "between:8,100"],
            "is_admin" => ["required", "integer", "gte:0", "lte:1"]
        ]);

        User::create($args);

        return redirect()->back();
    }

    /**
     * Remove a given user from the database.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function removeUser(Request $request): RedirectResponse {
        $args = $request->validate([
            "id" => ["required", "exists:users,id"]
        ]);

        User::find($args["id"])->delete();

        return redirect()->back();
    }

    /**
     * Reset the password of a given user.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function resetPassword(Request $request): RedirectResponse {
        $args = $request->validate([
            "id" => ["required", "exists:users,id"]
        ]);

        $user = User::find($args["id"]);

        // TODO send email

        return redirect()->back();
    }

    /**
     * Reply to a given contact form.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function replyContactForm(Request $request): RedirectResponse {
        $args = $request->validate([
            "id" => ["required", "exists:contact_form,id"],
            "mailBody" => ["required", "string", "max:500", "gt:1"]
        ]);

        $contactForm = ContactForm::find($args["id"]);

        // TODO send email

        return redirect()->back();
    }

    /**
     * get the contact forms.
     *
     * @return JsonResponse
     */
    public function getContactForms(): JsonResponse
    {
        $contacts = ContactForm::all();

        return response()->json($contacts);
    }

}

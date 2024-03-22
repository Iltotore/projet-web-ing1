<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller for authentification-related requests.
 */
class AuthController extends Controller {

    /**
     * Handle an authentication attempt.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse {

        $credentials = $request->validate([
            "name" => ["required", "string", "max:255"],
            "password" => ["required"],
        ]);

        $redirect = $request->redirect ?? "/";

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->to($redirect);
        } else {
            return back()->withErrors([
                "name" => "Nom d'utilisateur ou mot de passe invalide",
            ])->onlyInput("name");
        }
    }

    /**
     * Logout the connected user.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse {
        Auth::logout();

        $request->session()->invalidate();

        return redirect("/");
    }

    /**
     * Register a new user.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function register(Request $request): RedirectResponse {
        $infos = $request->validate([
            "name" => ["required", "string", "max:255", "unique:users,name"],
            "email" => ["required", "email", "unique:users,email"],
            "password" => ["required", "confirmed"],
            "password_confirmation" => ["required"]
        ]);

        $newUser = User::create([
            "name" => $infos["name"],
            "email" => $infos["email"],
            "password" => $infos["password"],
            "is_admin" => false
        ]);

        return redirect()
            ->to("/registered")
            ->with(["user" => $newUser]);
    }
}

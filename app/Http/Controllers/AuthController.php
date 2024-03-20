<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller for authentification-related requests.
 */
class AuthController extends Controller {

    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request): RedirectResponse {

        $credentials = $request->validate([
            "name" => ["required", "string", "max:255"],
            "password" => ["required"],
        ]);

        $redirect = $request->validate([
            "redirect" => ["nullable", "url"]
        ]) ?? "/";

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
     */
    public function logout(Request $request): RedirectResponse {
        Auth::logout();

        $request->session()->invalidate();

        return redirect("/");
    }
}

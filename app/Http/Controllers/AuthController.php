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
        $remember_me = $request->remember_me ?? false;

        if (Auth::attempt($credentials, $remember_me)) {
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
            "password_confirmation" => ["required"],
            "first_name" => ["string", "max:255"],
            "last_name" => ["string", "max:255"],
            "birth" => ["date"],
            "job_id" => ["exists:jobs,id"]
        ]);

        $gender = $request->gender;

        if($gender == null) $infos["gender"] = null;
        else if($gender == "male") $infos["gender"] = false;
        else if($gender == "female") $infos["gender"] = true;
        else return back()->withErrors(["gender" => "Invalid gender"]);

        $infos["is_admin"] = false;

        $newUser = User::create($infos);

        return redirect()
            ->to("/registered")
            ->with(["user" => $newUser]);
    }

    /**
     * Update the current user.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request) {
        $infos = $request->validate([
            "name" => ["required", "string", "max:255", "unique:users,name"],
            "email" => ["required", "email", "unique:users,email"],
            "password" => ["confirmed"],
            "password_confirmation" => [],
            "first_name" => ["string", "max:255"],
            "last_name" => ["string", "max:255"],
            "birth" => ["date"],
            "job_id" => ["exists:jobs,id"]
        ]);

        $gender = $request->gender;

        if($gender == null) $infos["gender"] = null;
        else if($gender == "male") $infos["gender"] = false;
        else if($gender == "female") $infos["gender"] = true;
        else return back()->withErrors(["gender" => "Invalid gender"]);

        Auth::user()->update($infos);

        return redirect()->back();
    }
}

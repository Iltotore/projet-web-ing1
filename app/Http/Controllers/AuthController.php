<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

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
            "password" => ["required", "between:8,100"],
        ]);

        $redirect = $request->redirect ?? "/";
        $remember_me = $request->remember_me ?? false;

        if (Auth::attempt($credentials, $remember_me)) {
            $request->session()->regenerate();

            Log::info("Redirect to " . $redirect);

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
            "password" => ["required", "confirmed", "between:8,100"],
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
        Auth::login($newUser);
        $newUser->sendEmailVerificationNotification();

        return redirect("/registered")
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
            "name" => ["required", "string", "max:255"],
            "email" => ["required", "email"],
			"password" => [/*"between:8,100"*/],
            //"password_confirmation" => [],
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

		// If password is missing, set it to the already existing password
		if($infos["password"] = "") $infos["password"] = Auth::user()->password;

        Auth::user()->update($infos);

        return redirect()->back();
    }

    public function verifyEmail(EmailVerificationRequest $request): RedirectResponse {
        $request->fulfill();
        Log::info($request->getUser() . " registered");

        return redirect('/');
    }

    public function resetPassword(Request $request): RedirectResponse {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->to('/login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function passwordRequest(Request $request): RedirectResponse {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? redirect("/reset-sent")
            : back()->withErrors(['email' => __($status)]);
    }
}

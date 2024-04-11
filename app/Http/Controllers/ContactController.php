<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactController extends Controller {

    /**
     * Create a new ticket.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    function create(Request $request): RedirectResponse {
        $args = $request->validate([
            "first_name" => ["required", "string", "max:255"],
            "last_name" => ["required", "string", "max:255"],
            "email" => ["required", "email"],
            "birth" => ["required", "date"],
            "job_id" => ["required", "exists:jobs,id"],
            "subject" => ["required", "max:100"],
            "content" => ["required", "max:1000"]
        ]);

        $gender = $request->gender;

        if($gender == null) $args["gender"] = null;
        else if($gender == "male") $args["gender"] = 0;
        else if($gender == "female") $args["gender"] = 1;
        else return back()->withErrors(["gender" => "Invalid gender"]);

        ContactForm::create($args);

        //TODO send mail

        return redirect()->to("/");
    }

    /**
     * Delete an existing ticket.
     *
     * @param Request $request
     * @return Response
     */
    function delete(Request $request): Response {
        $args = $request->validate([
            "id" => ["required", "exists:contact_forms"]
        ]);

        ContactForm::find($args["id"])->delete();

        return response(status: 200);
    }
}

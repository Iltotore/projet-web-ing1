<?php

namespace Database\Seeders;

use App\Models\ContactForm;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //$user = User::find(0);

        ContactForm::create([
            "id" => 0,
            /*"first_name" => $user->first_name,
            "last_name" => $user->last_name,
            "email" => $user->email,
            "gender" => $user->gender,
            "job_id" => $user->job_id,
            "birth" => $user->birth,*/
            "first_name" => "Steve",
            "last_name" => "Rogers",
            "email" => "steve@minecraft.block",
            "gender" => 0,
            "job_id" => 1,
            "birth" => "1970-01-01",
            "subject" => "This website is so cool",
            "content" => "This is just a supportive message to tell you just how awesome your website is.",
            ]);
    }
}

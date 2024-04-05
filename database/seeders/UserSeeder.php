<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
        // required data
            "name" => "Steve", // pseudo
            "email" => "steve@minecraft.block",
            "email_verified_at" => "2009-05-17",
            "password" => "Hmmmmmmm",
            "is_admin" => false,
        // optional data
            "first_name" => "Steve",
            "last_name" => "Rogers",
            "birth" => "1970-01-01",
            "gender" => "0", // male
            "job_id" => ""

        ]);

        User::create([
        // required data
            "name" => "Notch", // pseudo
            "email" => "notch@minecraft.block",
            "email_verified_at" => "2009-05-17",
            "password" => "Hmm",
            "is_admin" => true,
        // optional data
            "first_name" => "Markus",
            "last_name" => "Persson",
            "birth" => "1979-06-01",
            "gender" => "0", // male
            "job_id" => ""

        ]);
    }
}

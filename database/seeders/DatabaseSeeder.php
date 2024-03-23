<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// TODO  sudo apt install php8.1-mbstring

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(CategorySeeder::class);
        $this->call(JobSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(UserSeeder::class);
    }
}

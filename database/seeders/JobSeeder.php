<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Job::create([
            "name" => "sans emploi",
            "image" => "Villageois_Plaines.webp"
        ]);

        Job::create([
            "name" => "armurier",
            "image" => "Villageois_Plaines_Armurier.webpp"
        ]);

        Job::create([
            "name" => "berger",
            "image" => "Villageois_Plaines_Berger.webp"
        ]);

        Job::create([
            "name" => "bibliothécaire",
            "image" => "Villageois_Plaines_Bibliothecaire.webp"
        ]);

        Job::create([
            "name" => "boucher",
            "image" => "Villageois_Plaines_Boucher.webp"
        ]);

        Job::create([
            "name" => "cartographe",
            "image" => "Villageois_Plaines_Cartographe.webp"
        ]);

        Job::create([
            "name" => "fermier",
            "image" => "Villageois_Plaines_Fermier.webp"
        ]);

        Job::create([
            "name" => "fléchier",
            "image" => "Villageois_Plaines_Flechier.webp"
        ]);

        Job::create([
            "name" => "forgeron",
            "image" => "Villageois_Plaines_Forgeron_d'outils.webp"
        ]);

        Job::create([
            "name" => "maçon",
            "image" => "Villageois_Plaines_Macon.webp"
        ]);

        Job::create([
            "name" => "pêcheur",
            "image" => "Villageois_Plaines_Pecheur.webp"
        ]);

        Job::create([
            "name" => "prêtre",
            "image" => "Villageois_Plaines_Pretre.webp"
        ]);

        Job::create([
            "name" => "tanneur",
            "image" => "Villageois_Plaines_Tanneur.webp"
        ]);


    }
}

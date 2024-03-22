<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            "id" => 0,
            "name" => "armures",
            "icon" => "Haut_fourneau_allume.webp"
        ]);

        Category::create([
            "id" => 1,
            "name" => "textiles et literie",
            "icon" => "Metier_a_tisser.webp"
        ]);

        Category::create([
            "id" => 2,
            "name" => "bibliothèque",
            "icon" => "Pupitre.webp"
        ]);

        Category::create([
            "id" => 3,
            "name" => "viandes",
            "icon" => "Fumoir_allume.webp"
        ]);

        Category::create([
            "id" => 4,
            "name" => "cartographie",
            "icon" => "Table_de_cartographie.webp"
        ]);

        Category::create([
            "id" => 5,
            "name" => "fruits et douceurs",
            "icon" => "Composteur_rempli.webp"
        ]);

        Category::create([
            "id" => "6",
            "name" => "archerie",
            "icon" => "Table_d_archerie.webp"
        ]);

        Category::create([
            "id" => 7,
            "name" => "armes et outils",
            "icon" => "Table_de_forgeron.webp"
        ]);

        Category::create([
            "id" => 8,
            "name" => "roches",
            "icon" => "Tailleur_de_pierre.webp"
        ]);

        Category::create([
            "id" => 9,
            "name" => "pêche et poissons",
            "icon" => "Tonneau_ouvert.webp"
        ]);

        Category::create([
            "id" => 10,
            "name" => "alchimie",
            "icon" => "Alambic.webp"
        ]);

        Category::create([
            "id" => 11,
            "name" => "articles en cuir",
            "icon" => "Chaudron_plein.webp"
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $armors = Category::find(0);
        $textiles = Category::find(1);
        $books = Category::find(2);
        $meat = Category::find(3);
        $cartography = Category::find(4);
        $fruits = Category::find(5);
        $arrows = Category::find(6);
        $tools = Category::find(7);
        $rocks = Category::find(8);
        $fishes = Category::find(9);
        $alchemy = Category::find(10);
        $leather = Category::find(11);

        $alchemy->products()->create([
            "name" => "fiole d'expérience",
            "icon" => "Fiole_d_expérience.webp",
            "description" => "La fiole d'expérience est un objet permettant au joueur de gagner de l'expérience. ",
            "unit_price" => 49.99,
            "amount" => 10
        ]);

        $alchemy->products()->create([
            "name" => "lapis-lazuli",
            "icon" => "Lapis-lazuli.webp",
            "description" => "Le lapis-lazuli est un objet principalement obtenu en minant du minerai de lapis-lazuli. Il est utilisé pour créer de la teinture bleue et est nécessaire pour les enchantements d'armures, d'armes, d'outils et de livres. ",
            "unit_price" => 20.4,
            "amount" => 24
        ]);

        $alchemy->products()->create([
            "name" => "perle de l'Ender",
            "icon" => "Perle_de_l'Ender.webp",
            "description" => "La perle de l'Ender est un objet qui s'obtient principalement en vainquant des Endermen et qui permet au joueur de se téléporter. ",
            "unit_price" => 23.65,
            "amount" => 29
        ]);

        $alchemy->products()->create([
            "name" => "pierre lumineuse",
            "icon" => "Pierre_lumineuse.webp",
            "description" => "La pierre lumineuse est un bloc lumineux qui se génère dans le Nether. ",
            "unit_price" => 7.99,
            "amount" => 40
        ]);

        $armors->products()->create([
            "name" => "poudre de redstone",
            "icon" => "Redstone.webp",
            "description" => "La poudre de redstone peut être obtenue en minant du minerai de redstone avec une pioche en fer ou de qualité supérieure, ou en vainquant une sorcière. ",
            "unit_price" => 5.01,
            "amount" => 50
        ]);

        $alchemy->products()->create([
            "name" => "émeraude",
            "icon" => "émeraude.webp",
            "description" => "L'émeraude est un objet servant de monnaie, utilisé dans le commerce entre les villageois et le joueur. Il est extrait du minerai d'émeraude. Il permet d'acheter toutes sortes de blocs et objets. ",
            "unit_price" => 30,
            "amount" => 25
        ]);

        $arrows->products()->create([
            "name" => "arbalète",
            "icon" => "Arbalète.webp",
            "description" => "L'arbalète est une arme à distance puissante qui utilise des flèches ou des fusées de feu d'artifice comme munitions. ",
            "unit_price" => 5,
            "amount" => 7
        ]);

        $arrows->products()->create([
            "name" => "arc",
            "icon" => "Arc.webp",
            "description" => "L'arc est une arme à distance qui permet de tirer des flèches. ",
            "unit_price" => 2.55,
            "amount" => 10
        ]);

        $arrows->products()->create([
            "name" => "flèche",
            "icon" => "Arrow_JE2_BE1.webp",
            "description" => "Les flèches sont des projectiles tirés plus ou moins loin avec un arc. ",
            "unit_price" => 0.99,
            "amount" => 64
        ]);

        $arrows->products()->create([
            "name" => "flèche spectrale",
            "icon" => "Spectral_Arrow_JE3.webp",
            "description" => "Les flèches spectrales sont des flèches qui, une fois tirées, donnent l'effet Surbrillance qui fait apparaître un contour blanc autour de la créature ou du joueur touché pendant quelques secondes. ",
            "unit_price" => 1.5,
            "amount" => 64
        ]);

        $tools->products()->create([
            "name" => "hache en diamant",
            "icon" => "Diamond_Axe_JE2_BE2.webp",
            "description" => "Les haches sont des outils auxiliaires utilisés pour faciliter la collecte du bois et autres objets en bois (planches, coffres, bibliothèques, etc...), mais ne sont cependant pas indispensables pour collecter ces objets. Elles peuvent également être utilisées en tant qu’armes. ",
            "unit_price" => 40,
            "amount" => 2
        ]);

        $tools->products()->create([
            "name" => "houe en diamant",
            "icon" => "Houe_en_diamant.webp",
            "description" => "La houe est un outil servant à labourer la terre et les blocs d'herbe pour les changer en terre labourée, ainsi qu'à récolter plus rapidement certains blocs. ",
            "unit_price" => 39.99,
            "amount" => 2
        ]);

        $tools->products()->create([
            "name" => "houe en fer",
            "icon" => "Houe_en_fer.webp",
            "description" => "La houe est un outil servant à labourer la terre et les blocs d'herbe pour les changer en terre labourée, ainsi qu'à récolter plus rapidement certains blocs. ",
            "unit_price" => 19.95,
            "amount" => 7
        ]);

        $tools->products()->create([
            "name" => "houe en pierre",
            "icon" => "Houe_en_pierre.webp",
            "description" => "La houe est un outil servant à labourer la terre et les blocs d'herbe pour les changer en terre labourée, ainsi qu'à récolter plus rapidement certains blocs. ",
            "unit_price" => 5,
            "amount" => 10
        ]);

        $tools->products()->create([
            "name" => "hache en fer",
            "icon" => "Iron_Axe_JE5_BE2.webp",
            "description" => "Les haches sont des outils auxiliaires utilisés pour faciliter la collecte du bois et autres objets en bois (planches, coffres, bibliothèques, etc...), mais ne sont cependant pas indispensables pour collecter ces objets. Elles peuvent également être utilisées en tant qu’armes. ",
            "unit_price" => 18.69,
            "amount" => 8
        ]);

        $tools->products()->create([
            "name" => "pelle en diamant",
            "icon" => "Pelle_en_diamant.webp",
            "description" => "Les pelles sont des outils auxiliaires utilisés pour faciliter la collecte de terre, de sable, de gravier, d'argile et de neige. ",
            "unit_price" => 34.5,
            "amount" => 3
        ]);

        $tools->products()->create([
            "name" => "pelle en fer",
            "icon" => "Pelle_en_fer.webp",
            "description" => "Les pelles sont des outils auxiliaires utilisés pour faciliter la collecte de terre, de sable, de gravier, d'argile et de neige. ",
            "unit_price" => 12.99,
            "amount" => 10
        ]);

        $tools->products()->create([
            "name" => "pelle en pierre",
            "icon" => "Pelle_en_pierre.webp",
            "description" => "Les pelles sont des outils auxiliaires utilisés pour faciliter la collecte de terre, de sable, de gravier, d'argile et de neige. ",
            "unit_price" => 5,
            "amount" => 9
        ]);

        $tools->products()->create([
            "name" => "pioche en diamant",
            "icon" => "Pioche_en_diamant.webp",
            "description" => "Les pioches figurent parmi les outils les plus utilisés de Minecraft, étant requises pour récupérer la roche et ses dérivés ainsi que les minerais de tout type. Il existe différentes qualités de pioches, certains minerais ne peuvent être extraits qu'avec une pioche d'une certaine qualité. ",
            "unit_price" => 41,
            "amount" => 3
        ]);

        $tools->products()->create([
            "name" => "pioche en fer",
            "icon" => "Pioche_en_fer.webp",
            "description" => "Les pioches figurent parmi les outils les plus utilisés de Minecraft, étant requises pour récupérer la roche et ses dérivés ainsi que les minerais de tout type. Il existe différentes qualités de pioches, certains minerais ne peuvent être extraits qu'avec une pioche d'une certaine qualité. ",
            "unit_price" => 15,
            "amount" => 12
        ]);

        $tools->products()->create([
            "name" => "pioche en pierre",
            "icon" => "Pioche_en_pierre.webp",
            "description" => "Les pioches figurent parmi les outils les plus utilisés de Minecraft, étant requises pour récupérer la roche et ses dérivés ainsi que les minerais de tout type. Il existe différentes qualités de pioches, certains minerais ne peuvent être extraits qu'avec une pioche d'une certaine qualité. ",
            "unit_price" => 5,
            "amount" => 15
        ]);

        $tools->products()->create([
            "name" => "hache en pierre",
            "icon" => "Stone_Axe_JE2_BE2.webp",
            "description" => "Les haches sont des outils auxiliaires utilisés pour faciliter la collecte du bois et autres objets en bois (planches, coffres, bibliothèques, etc...), mais ne sont cependant pas indispensables pour collecter ces objets. Elles peuvent également être utilisées en tant qu’armes. .webp",
            "unit_price" => 5,
            "amount" => 16
        ]);

        $tools->products()->create([
            "name" => "épée en diamant",
            "icon" => "épée_en_diamant.webp",
            "description" => "Les épées sont des armes qui servent à infliger des dégâts aux créatures et autres joueurs au corps-à-corps. ",
            "unit_price" => 30.99,
            "amount" => 3
        ]);

        $tools->products()->create([
            "name" => "épée en fer",
            "icon" => "épée_en_fer.webp",
            "description" => "Les épées sont des armes qui servent à infliger des dégâts aux créatures et autres joueurs au corps-à-corps. ",
            "unit_price" => 15,
            "amount" => 11
        ]);

        $tools->products()->create([
            "name" => "épée en pierre",
            "icon" => "épée_en_pierre.webp",
            "description" => "Les épées sont des armes qui servent à infliger des dégâts aux créatures et autres joueurs au corps-à-corps. ",
            "unit_price" => 5,
            "amount" => 16
        ]);

        $armors->products()->create([
            "name" => "bottes en diamant",
            "icon" => "Bottes_en_diamant.webp",
            "description" => "L'armure est un ensemble d'objets pouvant être équipés par le joueur, lui ajoutant une protection. Elle permet de réduire les dégâts que reçoivent les joueurs, mais perdra de ce fait en durabilité.",
            "unit_price" => 35,
            "amount" => 3
        ]);

        $armors->products()->create([
            "name" => "bottes en fer",
            "icon" => "Bottes_en_fer.webp",
            "description" => "L'armure est un ensemble d'objets pouvant être équipés par le joueur, lui ajoutant une protection. Elle permet de réduire les dégâts que reçoivent les joueurs, mais perdra de ce fait en durabilité.",
            "unit_price" => 7,
            "amount" => 8
        ]);

        $armors->products()->create([
            "name" => "bouclier",
            "icon" => "Bouclier.webp",
            "description" => "Le bouclier est une arme défensive pour parer les attaques des créatures ou des joueurs. ",
            "unit_price" => 5,
            "amount" => 10
        ]);

        $armors->products()->create([
            "name" => "casque en diamant",
            "icon" => "Casque_en_diamant.webp",
            "description" => "L'armure est un ensemble d'objets pouvant être équipés par le joueur, lui ajoutant une protection. Elle permet de réduire les dégâts que reçoivent les joueurs, mais perdra de ce fait en durabilité.",
            "unit_price" => 32,
            "amount" => 2
        ]);

        $armors->products()->create([
            "name" => "casque en fer",
            "icon" => "Casque_en_fer.webp",
            "description" => "L'armure est un ensemble d'objets pouvant être équipés par le joueur, lui ajoutant une protection. Elle permet de réduire les dégâts que reçoivent les joueurs, mais perdra de ce fait en durabilité.",
            "unit_price" => 7,
            "amount" => 10
        ]);

        $armors->products()->create([
            "name" => "jambières en diamant",
            "icon" => "Jambières_en_diamant.webp",
            "description" => "L'armure est un ensemble d'objets pouvant être équipés par le joueur, lui ajoutant une protection. Elle permet de réduire les dégâts que reçoivent les joueurs, mais perdra de ce fait en durabilité.",
            "unit_price" => 39.99,
            "amount" => 2
        ]);

        $armors->products()->create([
            "name" => "jambières en fer",
            "icon" => "Jambières_en_fer.webp",
            "description" => "L'armure est un ensemble d'objets pouvant être équipés par le joueur, lui ajoutant une protection. Elle permet de réduire les dégâts que reçoivent les joueurs, mais perdra de ce fait en durabilité.",
            "unit_price" => 10,
            "amount" => 9
        ]);

        $armors->products()->create([
            "name" => "plastron en diamant",
            "icon" => "Plastron_en_diamant.webp",
            "description" => "L'armure est un ensemble d'objets pouvant être équipés par le joueur, lui ajoutant une protection. Elle permet de réduire les dégâts que reçoivent les joueurs, mais perdra de ce fait en durabilité.",
            "unit_price" => 30.95,
            "amount" => 3
        ]);

        $armors->products()->create([
            "name" => "plastron en fer",
            "icon" => "Plastron_en_fer.webp",
            "description" => "L'armure est un ensemble d'objets pouvant être équipés par le joueur, lui ajoutant une protection. Elle permet de réduire les dégâts que reçoivent les joueurs, mais perdra de ce fait en durabilité.",
            "unit_price" => 10,
            "amount" => 10
        ]);

        $leather->products()->create([
            "name" => "armure en cuir pour cheval",
            "icon" => "Armure_en_cuir_pour_cheval.webp",
            "description" => "L'armure pour cheval est un type d'armure spécifique aux chevaux. ",
            "unit_price" => 10,
            "amount" => 4
        ]);

        $leather->products()->create([
            "name" => "bottes en cuir",
            "icon" => "Bottes_en_cuir.webp",
            "description" => "L'armure est un ensemble d'objets pouvant être équipés par le joueur, lui ajoutant une protection. Elle permet de réduire les dégâts que reçoivent les joueurs, mais perdra de ce fait en durabilité.",
            "unit_price" => 5,
            "amount" => 10
        ]);

        $leather->products()->create([
            "name" => "chapeau en cuir",
            "icon" => "Chapeau_en_cuir.webp",
            "description" => "L'armure est un ensemble d'objets pouvant être équipés par le joueur, lui ajoutant une protection. Elle permet de réduire les dégâts que reçoivent les joueurs, mais perdra de ce fait en durabilité.",
            "unit_price" => 4,
            "amount" => 7
        ]);

        $leather->products()->create([
            "name" => "pantalon en cuir",
            "icon" => "Pantalon_en_cuir.webp",
            "description" => "L'armure est un ensemble d'objets pouvant être équipés par le joueur, lui ajoutant une protection. Elle permet de réduire les dégâts que reçoivent les joueurs, mais perdra de ce fait en durabilité.",
            "unit_price" => 6,
            "amount" => 6
        ]);

        $leather->products()->create([
            "name" => "selle de cheval",
            "icon" => "Saddle_(Horse)_JE2_BE2.webp",
            "description" => "Les selles de cheval sont des objets qui permettent au joueur de monter et conduire des chevaux. ",
            "unit_price" => 7,
            "amount" => 4
        ]);

        $leather->products()->create([
            "name" => "selle de cochon",
            "icon" => "Saddle_(Pig)_JE2_BE2.webp",
            "description" => "Les selles de cochons sont des objets qui permettent au joueur de monter et conduire des cochons. ",
            "unit_price" => 7,
            "amount" => 4
        ]);

        $leather->products()->create([
            "name" => "tunique en cuir",
            "icon" => "Tunique_en_cuir.webp",
            "description" => "L'armure est un ensemble d'objets pouvant être équipés par le joueur, lui ajoutant une protection. Elle permet de réduire les dégâts que reçoivent les joueurs, mais perdra de ce fait en durabilité. ",
            "unit_price" => 7,
            "amount" => 5
        ]);

        $books->products()->create([
            "name" => "bibliothèque",
            "icon" => "Bibliothèque.webp",
            "description" => "La bibliothèque est un bloc qui s'obtient principalement via l'artisanat et qui permet d'augmenter le niveau des enchantements proposés par une table d'enchantement. ",
            "unit_price" => 10,
            "amount" => 15
        ]);

        $books->products()->create([
            "name" => "étiquette",
            "icon" => "Etiquette.webp",
            "description" => "L'étiquette est un objet utilisé pour nommer les créatures. ",
            "unit_price" => 4.99,
            "amount" => 16
        ]);

        $books->products()->create([
            "name" => "livre",
            "icon" => "Livre.webp",
            "description" => "Les livres sont des objets fabriqués à partir de papier et de cuir, ou s'obtenant directement dans les coffres des forts. Ils servent à fabriquer les bibliothèques, les livres éditables et les tables d'enchantement. ",
            "unit_price" => 3.99,
            "amount" => 30
        ]);

        $books->products()->create([
            "name" => "livre enchanté",
            "icon" => "Livre_enchanté.webp",
            "description" => "Un livre enchanté est un objet qui permet d'enchanter ses outils, armes ou armures en le combinant dans une enclume avec un de ces éléments. Le livre enchanté se présente sous la forme d’un livre avec une aura d’enchantement et un ruban rouge. ",
            "unit_price" => 12.99,
            "amount" => 12
        ]);

        $books->products()->create([
            "name" => "papier",
            "icon" => "Papier.webp",
            "description" => "Le papier est un objet qui s'obtient principalement à partir de la canne à sucre. ",
            "unit_price" => 1.99,
            "amount" => 64
        ]);

        $books->products()->create([
            "name" => "poche d'encre",
            "icon" => "Poche_d'encre.webp",
            "description" => "La poche d'encre est un objet notamment utilisé pour fabriquer de la teinture noire, mais aussi des livres éditables, qui s'obtient en tuant des poulpes. ",
            "unit_price" => 4,
            "amount" => 23
        ]);

        $cartography->products()->create([
            "name" => "cadre",
            "icon" => "Cadre.webp",
            "description" => "Le cadre est une entité qui affiche l'objet ou le bloc qui est à l'intérieur.",
            "unit_price" => 5,
            "amount" => 15
        ]);

        $cartography->products()->create([
            "name" => "carte",
            "icon" => "Carte_(objet).webp",
            "description" => "La carte est un objet utilisé pour voir le monde exploré. ",
            "unit_price" => 7,
            "amount" => 10
        ]);

        $cartography->products()->create([
            "name" => "carte d'exploration",
            "icon" => "Carte_exploration.webp",
            "description" => "Les cartes d'exploration sont des carte utilisées pour trouver des structures naturelles rares. ",
            "unit_price" => 15,
            "amount" => 8
        ]);

        $cartography->products()->create([
            "name" => "boussole",
            "icon" => "Compass_JE3_BE3.webp",
            "description" => "La boussole est un objet permettant au joueur de s'orienter ou de fabriquer des cartes. ",
            "unit_price" => 3.5,
            "amount" => 10
        ]);

        $fruits->products()->create([
            "name" => "carotte dorée",
            "icon" => "Carotte_dorée.webp",
            "description" => "La carotte dorée est un aliment de valeur et un ingrédient utilisé en alchimie. ",
            "unit_price" => 5,
            "amount" => 64
        ]);

        $fruits->products()->create([
            "name" => "cookie",
            "icon" => "Cookie.webp",
            "description" => "Les cookies sont des aliments qui s'obtiennent facilement mais qui ne restaurent pas beaucoup de faim ou de saturation. ",
            "unit_price" => 3.5,
            "amount" => 64
        ]);

        $fruits->products()->create([
            "name" => "gâteau",
            "icon" => "Gâteau.webp",
            "description" => "Le gâteau est un aliment sous forme de bloc qui peut être mangé par le joueur. ",
            "unit_price" => 5,
            "amount" => 64
        ]);

        $armors->products()->create([
            "name" => "pain",
            "icon" => "Pain.webp",
            "description" => "Le pain est un aliment qui s'obtient principalement à partir du blé. Consommé il restaure Faim et saturation. ",
            "unit_price" => 2,
            "amount" => 64
        ]);

        $fruits->products()->create([
            "name" => "pomme",
            "icon" => "Pomme.webp",
            "description" => "La pomme est un aliment mangeable par le joueur. ",
            "unit_price" => 1.5,
            "amount" => 64
        ]);

        $fruits->products()->create([
            "name" => "tarte à la citrouille",
            "icon" => "Tarte_à_la_citrouille.webp",
            "description" => "La tarte à la citrouille est un aliment qui permet au joueur de restaurer sa barre de faim. ",
            "unit_price" => 2.5,
            "amount" => 64
        ]);

        $fruits->products()->create([
            "name" => "tranche de pastèque scintillante",
            "icon" => "Tranche_de_pastèque_scintillante.webp",
            "description" => "La tranche de pastèque scintillante est un objet qui s'obtient via la fabrication à partir d'une tranche de pastèque et de pépites d'or. Elle est utilisée en alchimie pour fabriquer des potions de santé instantanée. ",
            "unit_price" => 5,
            "amount" => 64
        ]);

        $fruits->products()->create([
            "name" => "feu de camp",
            "icon" => "Campfire_JE2_BE2.webp",
            "description" => "Le feu de camp est un bloc lumineux pouvant être utilisé pour cuire de la nourriture ou émettre des signaux de fumée. ",
            "unit_price" => 3,
            "amount" => 16
        ]);

        $fishes->products()->create([
            "name" => "canne à pêche",
            "icon" => "Canne_à_pêche.webp",
            "description" => "La canne à pêche est un outil dont le but premier est d'obtenir du poisson. ",
            "unit_price" => 6,
            "amount" => 6
        ]);

        $fishes->products()->create([
            "name" => "morue",
            "icon" => "Morue_crue.webp",
            "description" => "La morue est un aliment.",
            "unit_price" => 2.99,
            "amount" => 16
        ]);

        $fishes->products()->create([
            "name" => "saumon",
            "icon" => "Saumon_cru.webp",
            "description" => "Le saumon est un aliment.",
            "unit_price" => 2.49,
            "amount" => 16
        ]);

        $rocks->products()->create([
            "name" => "brique",
            "icon" => "Brique.webp",
            "description" => "La brique est un objet utilisé pour fabriquer des bloc de briques, des pots de fleurs et des vases décorés. ",
            "unit_price" => 1,
            "amount" => 64
        ]);

        $rocks->products()->create([
            "name" => "pierre sculptée",
            "icon" => "Pierre_sculptée.webp",
            "description" => "La pierre sculptée est une autre variante de la pierre taillée qui se trouve dans les temples de la jungle et dans les sous-sols des igloos. ",
            "unit_price" => 2,
            "amount" => 64
        ]);

        $textiles->products()->create([
            "name" => "bannière blanche",
            "icon" => "Bannière_blanche.webp",
            "description" => "Les bannières ou drapeaux sont des blocs décoratifs pouvant être personnalisés grâce à des teintures et des motifs de bannière. Elles peuvent aussi être utilisées pour marquer des endroits sur une carte. ",
            "unit_price" => 4.9,
            "amount" => 64
        ]);

        $textiles->products()->create([
            "name" => "laine blanche",
            "icon" => "Laine_blanche.webp",
            "description" => "La laine est un bloc issu des moutons, qui peut être teint avec 16 colorants. ",
            "unit_price" => 0.49,
            "amount" => 64
        ]);

        $armors->products()->create([
            "name" => "lit blanc",
            "icon" => "Lit_blanc.webp",
            "description" => "Les lits sont des blocs permettant au joueur de dormir pour faire passer la nuit beaucoup plus rapidement et de réinitialiser son point d'apparition dans le monde normal. ",
            "unit_price" => 10,
            "amount" => 16
        ]);

        $textiles->products()->create([
            "name" => "tableau",
            "icon" => "Tableau.webp",
            "description" => "Les tableaux sont des versions simplifiées et basse résolution de véritables toiles. Les tableaux ne sont pas inflammables et peuvent empêcher les blocs inflammables de prendre feu. ",
            "unit_price" => 3.5,
            "amount" => 10
        ]);

        $textiles->products()->create([
            "name" => "tapis blanc",
            "icon" => "Tapis_blanc.webp",
            "description" => "Les tapis sont des blocs décoratifs existant en 16 couleurs différentes. ",
            "unit_price" => 3.5,
            "amount" => 16
        ]);

        $meat->products()->create([
            "name" => "côtelette de porc cuite",
            "icon" => "Côtelette_de_porc_cuite.webp",
            "description" => "La côtelette de porc cuite est un aliment qui peut être mangé par les joueurs et les loups. ",
            "unit_price" => 7.5,
            "amount" => 9
        ]);

        $meat->products()->create([
            "name" => "lapin cuit",
            "icon" => "Lapin_cuit.webp",
            "description" => "Le lapin cuit est un aliment qui s'obtient en faisant cuire du lapin cru. Chaque unité de lapin cuit restaure faim et saturation. ",
            "unit_price" => 10.7,
            "amount" => 10
        ]);

        $meat->products()->create([
            "name" => "mouton cuit",
            "icon" => "Mouton_cuit.webp",
            "description" => "Le mouton cuit est un aliment qui s'obtient en faisant cuire du mouton cru dans un fourneau. ",
            "unit_price" => 10,
            "amount" => 8
        ]);

        $meat->products()->create([
            "name" => "poulet",
            "icon" => "Poulet_rôti.webp",
            "description" => "Le poulet rôti est un aliment obtenu après cuisson du poulet cru, ou après la mort d'une poule par le feu. Il restaure faim et saturation. ",
            "unit_price" => 6.55,
            "amount" => 16
        ]);

        $meat->products()->create([
            "name" => "ragoût de lapin",
            "icon" => "Ragoût_de_lapin.webp",
            "description" => "Le ragoût de lapin est un aliment. ",
            "unit_price" => 10,
            "amount" => 8
        ]);

        $meat->products()->create([
            "name" => "steak",
            "icon" => "Steak.webp",
            "description" => "Le steak est une forme de nourriture obtenue principalement en faisant cuire du bœuf cru. Le steak restaure faim et saturation. ",
            "unit_price" => 3.5,
            "amount" => 16
        ]);
    }
}

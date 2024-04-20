<!DOCTYPE html>
<html>
    <body>
        <div class="box">
            <div class="box2">
                <div class="subsign">
                    <div id="title">Bienvenue</div>
                    <hr/>
                    <div>Créé par La Ligue des Villageois et Marchands Humains (LVMH), HurrShop est le site de référence pour l'achat rapide d'objets disponibles dans les villages. Retrouvez vos produits favoris issus de l'Overworld, du Nether ou de l'Ender à moindre prix.
                    </div>
                </div>
                <div class="subsign">
                    <div id="title">Votre profil :</div>
                    <hr/>
                    <div class="button">
                        @auth
                            <button onclick="window.location.href = '/profile'">Votre profil</button>
                        @else
                            <button onclick="window.location.href = '/login'">Se connecter</button>
                        @endauth

                    </div>
                </div>
            </div>
            <div class="sign">
                <div id="title">Catalogue :</div>
                <hr/>
                <div class="slider">
                    <div class="slider-viewport">
                        @foreach(\App\Models\Category::all()->sortBy('name') as $category)
                           <div id="img_{{$category->name}}" class="slider-content">
                                <a href="/catalog?category={{$category->id}}">
                                    <img src="{{ asset("category/" . $category['icon']) }}" alt="{{$category->name}} category image">
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="slider-nav">
                        @foreach(\App\Models\Category::all()->sortBy('name') as $category)
                            <a href="#img_{{$category->name}}"></a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

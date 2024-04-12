<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
    </head>
    <body onload="loadProducts('{{csrf_token()}}')">
        <div class="box">
            <div id="container">
                <div id="title">Catalogue: {{$category_name}}</div>
                <hr />
            </div>
            <div id="details" hidden>
                <div class="box2">
                    <div class="imgbox2">
                        <img id="icon" src="{{ asset("img/placeholder.png") }}" alt="icon"/>
                    </div>
                    <div>
                        <h1 id="name"></h1>
                        <label>Prix:</label>
                        <label id="price"></label>
                        <label>En stock:</label>
                        <label id="available"></label>
                        <label>Dans le panier:</label>
                        <label id="in_cart"></label>
                    </div>
                </div>
                <p id="description"></p>
                <div id="actions">
                    <input name="amount" type="number" value="1">
                    <button id="add" onclick="addItem()">Ajouter au panier</button>
                    <button id="remove" onclick="removeItem()">Supprimer du panier</button>
                    <button id="close" onclick="closeProduct()">Fermer</button>
                </div>
            </div>
        </div>
    </body>
</html>

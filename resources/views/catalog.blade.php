<!DOCTYPE html>
<body onload="loadProducts('{{csrf_token()}}')">
<div id="container"></div>
<div id="details" hidden>
    <img id="icon" src="{{ asset("img/placeholder.png") }}" alt="icon"/>
    <h1 id="name"></h1>
    <label>Prix:</label>
    <label id="price"></label>
    <label>En stock:</label>
    <label id="available"></label>
    <p id="description"></p>
    <div id="actions">
        <input name="amount" type="number" value="1">
        <button id="add" onclick="addItem()">Ajouter au panier</button>
        <button id="remove" onclick="removeItem()">Supprimer du panier</button>
        <button id="close" onclick="closeProduct()">Fermer</button>
    </div>
</div>
</body>

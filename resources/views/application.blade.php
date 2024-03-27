<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<link rel="icon" href="{{ asset("img/icon.webp") }}">
		<title>HurrShop</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="{{ asset('css/application.css') }}">
		<link href="https://fonts.cdnfonts.com/css/minecraft-4" rel="stylesheet">

		<!-- Style de la zone main -->
		<link rel="stylesheet" href="{{ asset('css/'.($page_to_load ?? "error").'.css') }}">
	</head>
    <!-- Contenu de la page -->
	<body>
		<header>
			<div id="logo_zone">
				<img id="logo_icon" src="{{ asset("img/icon.webp") }}"/>
				<img id="logo_text" src="{{ asset('img/logo.webp') }}"/>
			</div>

			<div id="header_end_zone">
				<div id="account_zone">
					<a>USERNAME</a>
					-
					<a>Se connecter</a>
				</div>
				<div id="link_zone">
					<a>Accueil</a>
					<a>Link2</a>
					<a>Link3</a>
					<a>Link4</a>
					<a>Contact</a>
				</div>
			</div>
		</header>

		<div id="middle_zone">
			<nav>
				<p>HurrShop est votre nouvel espace de vente de materiaux.</p>
				<hr>
				<ul>
					<li><a>Home</a></li>
					<li><a>About</a></li>
					<li><a>FAQ</a></li>
					<li><a>Contact</a></li>
				</ul>
			</nav>
			<main>
				@include($page_to_load ?? "error")
			</main>
		</div>

		<footer>
			<div class="footer_grid">
				<div class="footer_column">
					<a>Plan du site</a>
				</div>
				<div class="footer_column">
					<a>A propos</a>
					<a>Contact</a>
					<a>FAQ</a>
				</div>
				<div class="footer_column">
					<a href="https://minecraft.wiki/w/Villager">Reseaux sociaux</a>
				</div>
				<div class="footer_column">
					<a class="emerald">Emerald.net</a>
					<a>Ender.man</a>
					<a href="https://www.reddit.com/r/Minecrafthmmm/">r/Minecrafthmmm</a>
					<a class="blaze" href="https://minecraft.wiki/w/Blaze">Blazes.hot (+18)</a>
					<a>StopTradingHalls.org</a>
				</div>
			</div>
			<p>© 2024 HurrShop. Tous droits réservés.</p>
			<p class="please_dont_see_this">HurrShop est un produit de Hrmmm.Inc.<br>En utilisant ce site, vous acceptez de ne pas nous envoyer un proces pour arnaque.</p>
		</footer>
	</body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<link rel="icon" href="{{ asset("img/icon.webp") }}">
		<title>HurrShop{{ isset($title) ? ' - ' . $title : '' }}</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="{{ asset('css/application.css') }}">
		<link href="https://fonts.cdnfonts.com/css/minecraft-4" rel="stylesheet">

		<!-- Style de la zone main -->
		<link rel="stylesheet" href="{{ asset('css/'.($page_to_load ?? "error").'.css') }}">
	</head>
    <!-- Contenu de la page -->
	<body>
		<nav id="navbar">
			<p>HurrShop est votre nouvel espace d'achat d'equipements et materiaux.</p>
			<hr>
			<ul>
				<li><a href="/">Page d'accueil</a></li>
			</ul>
			<hr>
			<ul id="product_list">
				<h3>Produits</h3>
				@foreach(\App\Models\Category::all()->sortBy('name') as $category)
					<li><img src="{{ asset("img/placeholder.png") }}"/><a>{{ Illuminate\Support\Str::ascii($category['name']) }}</a></li>
				@endforeach
			</ul>
			<hr>
			<ul>
				<li><a href="/about">A propos</a></li>
				<li><a>FAQ</a></li>
				<li><a>Contact</a></li>
			</ul>
		</nav>

		<div id="overlay"></div>

		<div id="page_content">
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
						<a>Produits</a>
						<a>Contact</a>
					</div>
				</div>
			</header>

			<main>
				@include($page_to_load ?? "error")
			</main>

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
		</div>

		<script>
			const navbar = document.getElementById('navbar');
			const overlay = document.getElementById('overlay');

			navbar.addEventListener('mouseenter', function() {
				navbar.classList.toggle('active');
				overlay.classList.toggle('active');
			});

			overlay.addEventListener('mouseenter', function() {
				navbar.classList.remove('active');
				overlay.classList.remove('active');
			});
		</script>
	</body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<link rel="icon" href="{{ asset("img/icon.webp") }}">
		<title>HurrShop{{ isset($title) ? ' - ' . $title : '' }}</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="{{ asset('css/application.css') }}">
        <script type="text/javascript" src="{{asset("js/app.js")}}"></script>
        <script type="text/javascript" src="{{asset("js/util.js")}}"></script>

		<!-- Style de la zone main -->
        @if(file_exists(public_path("css/" . ($page_to_load ?? "error") . ".css")))
		    <link rel="stylesheet" href="{{ asset('css/'.($page_to_load ?? "error").'.css') }}">
        @endif

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
	</head>
    <!-- Contenu de la page -->
	<body onload="loadNavbarLogic()">
		<nav id="navbar">
			<p>HurrShop est votre nouvel espace d'achat d'équipements et de matériaux.</p>
			<hr>
			<ul>
				<li><a href="/">Page d'accueil</a></li>
			</ul>
			<hr>
			<ul id="product_list">
				<h3>Produits</h3>
				@foreach(\App\Models\Category::all()->sortBy('name') as $category)
					<li><a href="/catalog?category={{$category->id}}"><img src="{{ asset("category/" . $category['icon']) }}" alt="{{$category->name}} category image"/>{{ ucfirst($category['name']) }}</a></li>
				@endforeach
			</ul>
			<hr>
			<ul>
				<li><a href="/about">À propos</a></li>
				<li><a>FAQ</a></li>
				<li><a href="/contact">Contact</a></li>
			</ul>
		</nav>

		<div id="overlay"></div>

		<div id="page_content">
			<header>
				<a href="/" id="logo_zone">
					<img id="logo_icon" src="{{ asset("img/icon.webp") }}" alt="logo image"/>
					<img id="logo_text" src="{{ asset('img/logo.webp') }}" alt="logo text image"/>
				</a>

				<div id="header_end_zone">
					<div id="account_zone">
						@auth
							<a href="/profile">{{ Auth::user()->name }}</a>
							-
							<a href="/auth/logout">Se déconnecter</a>
						@else
							<a href="/login">Se connecter</a>
						@endauth
					</div>
					<div id="link_zone">
						<a href="/">Accueil</a>
						<a href="/catalog">Produits</a>
						@auth
							<a href="/profile">Compte</a>
                            <a href="/cart">Panier</a>
							<!-- If user is admin, add admin link -->
							@if(Auth::user()->is_admin)
								<a href="/admin">Admin</a>
							@endif
						@endauth
						<a href="/contact">Contact</a>
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
						<a href="/about">À propos</a>
						<a href="/contact">Contact</a>
						<a>FAQ</a>
					</div>
					<div class="footer_column">
						<a href="https://minecraft.wiki/w/Villager">Réseaux sociaux</a>
					</div>
					<div class="footer_column">
						<a class="emerald">Emerald.net</a>
						<a>Ender.man</a>
						<a href="https://www.reddit.com/r/Minecrafthmmm/">r/Minecrafthmmm</a>
						<a class="blaze" href="https://minecraft.wiki/w/Blaze">Blazes.com</a>
						<a>StopTradingHalls.org</a>
					</div>
				</div>
				<p>© 2024 HurrShop. Tous droits réservés.</p>
				<p class="please_dont_see_this">HurrShop est un produit de Hrmmm.Inc.<br>En utilisant ce site, vous acceptez de ne pas nous envoyer un procès pour arnaque.</p>
			</footer>
		</div>
	</body>

	@if(file_exists(public_path("js/" . $page_to_load . ".js")))
		<script type="text/javascript" src="{{asset("js/" . $page_to_load . ".js")}}"></script>
	@endif
</html>

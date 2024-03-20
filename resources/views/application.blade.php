<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<link rel="icon" href="https://minecraftfaces.com/wp-content/bigfaces/big-villager-face.png">
		<title>HurrShop</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="{{ asset('css/application.css') }}">
		<link href="https://fonts.cdnfonts.com/css/minecraft-4" rel="stylesheet">
	</head>
    <!-- Contenu de la page -->
	<body>
		<header>
			<div id="logo_zone">
				<img id="logo_icon" src="https://minecraftfaces.com/wp-content/bigfaces/big-villager-face.png"/>
				<img id="logo_text" src="{{ asset('img/logo.png') }}"/>
			</div>

			<div id="link_zone">
				<a>Link1</a>
				<a>Link2</a>
				<a>Link3</a>
				<a>Link4</a>
				<a>Link5</a>
			</div>
		</header>

		<div id="middle_zone">
			<nav>
				<ul>
					<li><a>Home</a></li>
					<li><a>About</a></li>
					<li><a>FAQ</a></li>
					<li><a>Contact</a></li>
				</ul>
			</nav>
			<main>
				@include('home_content')
			</main>
		</div>

		<footer>
			<div class="footer_column">
				<a>Link1</a>
				<a>Link2</a>
				<a>Link3</a>
				<a>Link4</a>
				<a>Link5</a>
			</div>
			<div class="footer_column">
				<a>Link1</a>
				<a>Link2</a>
				<a>Link3</a>
				<a>Link4</a>
				<a>Link5</a>
			</div>
			<div class="footer_column">
				<a>Link1</a>
				<a>Link2</a>
				<a>Link3</a>
				<a>Link4</a>
				<a>Link5</a>
			</div>
		</footer>
	</body>
</html>
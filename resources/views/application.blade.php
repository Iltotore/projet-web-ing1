<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<link rel="icon" href="https://minecraftfaces.com/wp-content/bigfaces/big-villager-face.png">
		<title>HurrShop</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="{{ asset('css/application.css') }}">
	</head>
    <!-- Contenu de la page -->
	<body>
		<header>
			<img id="logo" src="https://minecraftfaces.com/wp-content/bigfaces/big-villager-face.png"/>
			<h2>HurrShop</h2>
		</header>

		<div id="container">
			<nav>
				<ul>
					<li>Home</li>
					<li>About</li>
					<li>FAQ</li>
					<li>Contact</li>
				</ul>
			</nav>
			<main>
				@include('home_content')
			</main>
		</div>

		<footer>
			<p>Plan</p>
			<p>Mention</p>
			<p>Contact</p>
		</footer>
	</body>
</html>
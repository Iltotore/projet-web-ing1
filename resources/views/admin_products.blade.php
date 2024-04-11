<h1>Gestionnaire produits</h1>
<div id="product_manager_zone">
	<div id="category_list">
		@foreach(\App\Models\Category::all()->sortBy('name') as $category)
			<button class="category_button" onclick="loadCategoryProducts({{ $category }})">
				<img class="category_button_image" src="{{ asset("category/" . $category['icon']) }}"/>
			</button>
		@endforeach
		<button class="category_button">+</button>
	</div>
	<div id="manager_bottom">
		<div id="product_list">
			<table>
				<thead>
					<tr>
						<th>Id</th>
						<th>Produit</th>
						<th>Categorie</th>
						<th>Prix</th>
					</tr>
				</thead>

				<tbody id="product_table">

				</tbody>
			</table>
		</div>
		<div id="details">
		
		</div>
	</div>

	<script type="text/javascript">
		let product_table = document.getElementById('product_table');

		function loadCategoryProducts(category) {
			fetch("/admin/product/get", {
				method: "POST",
				headers: {
					"Content-Type": "application/json",
					"Accept": "application/json",
				},
				body: JSON.stringify({
					"_token": "{{ csrf_token() }}",
					"category": category.id
				})
			})
			.then(response => response.json());
			// Can go further once the JSON response is valid.
		}
	</script>
</div>
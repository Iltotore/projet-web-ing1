<h1>Gestionnaire produits</h1>
<div id="product_manager_zone">
	<div id="category_list">
		@foreach(\App\Models\Category::all()->sortBy('name') as $category)
			<button class="category_button" onclick="loadCategoryProducts({{$category}})">
				<img class="category_button_image" src="{{ asset("category/" . $category['icon']) }}"/>
			</button>
		@endforeach
		<button class="category_button">+</button>
	</div>
	<div id="manager_bottom">
		<div id="product_list">
			<table id="product_table">
				<thead>
					<tr>
						<th>Id</th>
						<th>Icône</th>
						<th>Produit</th>
						<th>Quantité</th>
						<th>Prix</th>
					</tr>
				</thead>

				<tbody id="product_table_list_container">

				</tbody>
			</table>
		</div>
		<div id="details">
		
		</div>
	</div>

	<script type="text/javascript">
		let product_table_list_container = document.getElementById('product_table_list_container');

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
			.then(response => response.json())
			.then(products => {
				// Empty the table
				product_table_list_container.innerHTML = "";

				products.forEach(product => {
					product_table_list_container.innerHTML += `
						<tr onclick="showProduct(${product.id})" class="product_row">
							<td>${product.id}</td>
							<td><img src="/product/${product.icon}" alt="icon" class="product_icon"/></td>
							<td>${product.name}</td>
							<td>${product.amount}</td>
							<td>${product.unit_price}€</td>
						</tr>
					`;
				});
			});
		}
	</script>
</div>
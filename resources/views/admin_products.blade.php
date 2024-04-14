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
		<div id="details_zone">
			<div id="placeholder">
				<h2>Veuillez sélectionner une catégorie ou un produit.</h2>
			</div>

			<div id="product_details" class="hidden">
				<form action="/admin/product/update" method="post" >
					@csrf
					<!-- Nom -->
					<div class="product_details_field">
						<label for="name">Nom :</label>
						<input type="text" id="product_name" name="name" required/>
					</div>

					<!-- Icône -->
					<div class="product_details_field">
						<label for="icon_data">Icône :</label>
						<input type="text" id="product_icon" name="icon_data" required/>
					</div>

					<!-- Description -->
					<div class="product_details_field">
						<label for="description">Description :</label>
						<textarea name="description" id="product_description" maxlength="1000" required></textarea>
					</div>

					<!-- Amount -->
					<div class="product_details_field">
						<label for="amount">Quantité :</label>
						<input type="number" id="product_amount" name="amount" min=0 required/>
					</div>

					<!-- Price -->
					<div class="product_details_field">
						<label for="price">Prix :</label>
						<input type="number" id="product_price" name="price" step=0.01 min=0 required/>
					</div>

					<!-- Submit -->
					<div class="product_details_field">
						<input type="submit" value="Enregistrer"/>
					</div>
				</form>
			</div>

			<div id="category_details" class="hidden">
				<form action="/admin/category/update" method="post" >
					@csrf

					<input type="hidden" id="category_id" name="id"/>

					<!-- Name -->
					<div class="product_details_field">
						<label for="name">Nom :</label>
						<input type="text" id="category_name" name="name" required/>
					</div>

					<!-- Icon -->
					<div class="product_details_field">
						<label for="icon_data">Icône :</label>
						<input type="text" id="category_icon" name="icon_data" required/>
					</div>

					<!-- Submit -->
					<div class="product_details_field">
						<input type="submit" value="Enregistrer"/>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		const product_table_list_container = document.getElementById('product_table_list_container');

		// Workaround to pass the product object to the onclick in loaded products
		let current_product_list = [];

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
				// Empty the table and list
				product_table_list_container.innerHTML = "";
				current_product_list = [];

				products.forEach(product => {
					const product_name = product.name.charAt(0).toUpperCase() + product.name.slice(1)
					product_table_list_container.innerHTML += `
						<tr onclick="showProduct(${product.id})" class="product_row">
							<td>${product.id}</td>
							<td><img src="/product/${product.icon}" alt="icon" class="product_icon"/></td>
							<td>${product_name}</td>
							<td>${product.amount}</td>
							<td>${product.unit_price}€</td>
						</tr>
					`;

					current_product_list[product.id] = product;
				});

				// Show the category details
				showCategory(category);
			});
		}
		
		const placeholder = document.getElementById('placeholder');
		const category_details = document.getElementById('category_details');
		const product_details = document.getElementById('product_details');

		// Fields
		const product_id = document.getElementById('product_id');
		const product_name = document.getElementById('product_name');
		const product_icon = document.getElementById('product_icon');
		const product_description = document.getElementById('product_description');
		const product_amount = document.getElementById('product_amount');
		const product_price = document.getElementById('product_price');

		function showProduct(product_id) {
			const product = current_product_list[product_id];

			// Swap views
			placeholder.classList.add('hidden');
			category_details.classList.add('hidden');
			product_details.classList.remove('hidden');

			// Set values
			product_name.value = product.name;
			product_icon.value = product.icon;
			product_description.value = product.description;
			product_amount.value = product.amount;
			product_price.value = product.unit_price;
		}

		// Fields
		const category_id = document.getElementById('category_id');
		const category_name = document.getElementById('category_name');
		const category_icon = document.getElementById('category_icon');

		function showCategory(category) {
			// Swap views
			placeholder.classList.add('hidden');
			product_details.classList.add('hidden');
			category_details.classList.remove('hidden');

			// Set values
			category_name.value = category.name;
			category_icon.value = category.icon;
			category_id.value = category.id;
		}
	</script>
</div>
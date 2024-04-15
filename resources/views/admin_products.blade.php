<h1>Gestionnaire produits</h1>
<div id="product_manager_zone">
	<div id="category_list">
		@foreach(\App\Models\Category::all()->sortBy('name') as $category)
			<button class="category_button" onclick="loadCategoryProducts({{$category}})">
				<img class="category_button_image" src="{{ asset("category/" . $category['icon']) }}"/>
			</button>
		@endforeach
		<button class="category_button" onclick="showAddCategory()">+</button>
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
				<form id="product_form" action="/admin/product/update" method="post" >
					@csrf

					<input type="hidden" id="product_id" name="id"/>

					<!-- Nom -->
					<div class="product_details_field">
						<label for="name">Nom :</label>
						<input type="text" id="product_name" name="name" required/>
					</div>

					<!-- Icône -->
					<div class="product_details_field">
						<label for="icon_data">Icône :</label>
						<input type="file" id="product_icon" name="icon_data" required/>
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

				<!-- Delete -->
				<div class="product_details_field" id="delete_product_div"></div>
			</div>

			<div id="category_details" class="hidden">
				<form id="category_form" action="/admin/category/update" method="post" >
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
						<input type="file" id="category_icon" name="icon_data" required/>
					</div>

					<!-- Submit -->
					<div class="product_details_field">
						<input type="submit" value="Enregistrer"/>
					</div>
				</form>

				<!-- Delete -->
				<div class="product_details_field" id="delete_category_div">

				</div>

				<!-- Add product -->
				<button onclick="showAddProduct()" id="add_product_button">Ajouter un produit</button>
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

		const delete_product_div = document.getElementById('delete_product_div');

		const product_form = document.getElementById('product_form');

		function showProduct(product_id) {
			product_form.action = `/admin/product/update`

			// Swap views
			placeholder.classList.add('hidden');
			category_details.classList.add('hidden');
			product_details.classList.remove('hidden');

			const product = current_product_list[product_id];
			// Set values
			product_name.value = product.name;
			// product_icon.value = product.icon;
			product_description.value = product.description;
			product_amount.value = product.amount;
			product_price.value = product.unit_price;

			// Delete button
			delete_product_div.innerHTML = `
				<button onclick="deleteProduct(${product_id})">Supprimer</button>
			`;
		}

		function showAddProduct() {
			product_form.action = "/admin/product/add";

			// Swap views
			placeholder.classList.add('hidden');
			category_details.classList.add('hidden');
			product_details.classList.remove('hidden');

			// Set values
			product_id.value = "";
			product_name.value = "";
			// product_icon.value = "";
			product_description.value = "";
			product_amount.value = "";
			product_price.value = "";

			// Delete button
			delete_product_div.innerHTML = "";
		}

		function deleteProduct(product_id) {
			fetch("/admin/product/remove", {
				method: "POST",
				headers: {
					"Content-Type": "application/json",
					"Accept": "application/json",
				},
				body: JSON.stringify({
					"_token": "{{ csrf_token() }}",
					"id": product_id
				})
			})
			.then(response => location.reload()); // Reload the page
		}

		// Fields
		const category_id = document.getElementById('category_id');
		const category_name = document.getElementById('category_name');
		const category_icon = document.getElementById('category_icon');

		const delete_category_div = document.getElementById('delete_category_div');

		const category_form = document.getElementById('category_form');
		const add_product_button = document.getElementById('add_product_button');

		function showCategory(category) {
			category_form.action = "/admin/category/update";
			add_product_button.classList.remove('hidden');

			// Swap views
			placeholder.classList.add('hidden');
			product_details.classList.add('hidden');
			category_details.classList.remove('hidden');

			// Set values
			category_name.value = category.name;
			// category_icon.value = category.icon;
			category_id.value = category.id;

			// Delete button
			delete_category_div.innerHTML = `
				<button onclick="deleteCategory(${category.id})">Supprimer</button>
			`;
		}

		function deleteCategory(category_id) {
			fetch("/admin/category/remove", {
				method: "POST",
				headers: {
					"Content-Type": "application/json",
					"Accept": "application/json",
				},
				body: JSON.stringify({
					"_token": "{{ csrf_token() }}",
					"id": category_id
				})
			})
			.then(response => location.reload()); // Reload the page
		}

		function showAddCategory() {
			category_form.action = "/admin/category/add";
			add_product_button.classList.add('hidden');

			// Swap views
			placeholder.classList.add('hidden');
			product_details.classList.add('hidden');
			category_details.classList.remove('hidden');

			// Set values
			category_id.value = "";
			category_name.value = "";
			// category_icon.value = "";

			// Delete button
			delete_category_div.innerHTML = "";
		}
	</script>
</div>
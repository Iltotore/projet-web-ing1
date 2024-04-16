<h1>Gestionnaire produits</h1>
@foreach($errors->all() as $error)
	<div class="notif error">
		<img src="{{ asset('img/white-cross.png') }}" alt="Croix blanche" onclick="closeWidget(this.parentNode)"/>
		<p>{{$error}}</p>
	</div>
@endforeach
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
				<form id="product_form" method="post" >
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
						<label for="unit_price">Prix :</label>
						<input type="number" id="product_price" name="unit_price" step=0.01 min=0 required/>
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
				<form id="category_form" method="post" >
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
</div>
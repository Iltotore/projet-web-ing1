<h1>Gestionnaire utilisateurs</h1>
@foreach($errors->all() as $error)
    <div class="notif error">
        <img src="{{ asset('img/white-cross.png') }}" alt="Croix blanche" onclick="closeWidget(this.parentNode)"/>
        <p>{{$error}}</p>
    </div>
@endforeach
<div class=manager>
	<div id="user_list">
		<div class="top_bar">
			<div class="search_container">
				<img class="search_icon" src="{{ asset('img/search-icon.svg') }}" alt="search icon">
				<input type="text" class="search_input" placeholder="Rechercher...">
			</div>

			<button onclick="displayUserAddMenu()">+</button>
		</div>
		<hr>
		<div id="user_table">
			<table>
				<thead>
					<tr>
						<th>Id</th>
						<th>Utilisateur</th>
						<th>Admin</th>
					</tr>
				</thead>

				<tbody>
					@foreach(\App\Models\User::all() as $user)
						<tr onclick="displayUserEditMenu({{ $user }})">
							<td>{{ $user->id }}</td>
							<td>{{ $user->name }}</td>
							@if ($user->is_admin) <td>✅</td> @else <td>❌</td> @endif
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<div id="user_details">
		<div id="user_details_empty">
			<h2>Veuillez sélectionner un utilisateur</h2>
		</div>

		<div id="user_details_add" class="hidden">
			<form action="/admin/user/add" method="post" autocomplete="off" >
				@csrf

				<!-- Nom d'utilisateur -->
				<div class="user_details_field">
					<label for="name">Nom d'utilisateur :</label>
					<input type="text" id="name" name="name" required/>
				</div>

				<!-- E-mail -->
				<div class="user_details_field">
					<label for="email">E-mail :</label>
					<input type="text" id="email" name="email" required/>
				</div>

				<!-- Mot de passe -->
				<div class="user_details_field">
					<label for="password">Mot de passe :</label>
					<input type="password" name="password" id="password" autocomplete="new-password"/>
				</div>

				<!-- Admin -->
				<div class="user_details_field">
					<label for="is_admin">Admin :</label>
					<!-- Workaround for a route limitation -->
					<input type="hidden" name="is_admin" value="0">
  					<input type="checkbox" id="checkbox" name="is_admin" value="1">
				</div>

				<input type="submit" value="Enregistrer"/>
			</form>
		</div>

		<div id="user_details_edit" class="hidden">
			<!-- Reset password button -->
			<div class="user_details_field">
				<form action="/admin/user/resetPassword" method="post">
					@csrf
					<input type="hidden" id="user_id_password_reset" name="id"/>
					<input type="submit" value="Reinitialiser le mot de passe"/>
				</form>
			</div>

			<!-- Delete button -->
			<div class="user_details_field">
                <br>
				<form action="/admin/user/remove" method="post">
					@csrf
					<input type="hidden" id="user_id_delete" name="id"/>
					<input type="submit" value="Supprimer"/>
				</form>
			</div>
		</div>
	</div>
</div>

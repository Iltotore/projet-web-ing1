<h1>Gestionnaire utilisateurs</h1>
@foreach($errors->all() as $error)
        <div class="notif error">
            <img src="{{ asset('img/white-cross.png') }}" alt="Croix blanche" onclick="closeWidget(this.parentNode)"/>
            <p>{{$error}}</p>
        </div>
@endforeach
<div class=manager>
	<div id="user_list">
		<div class="search_container">
			<img class="search_icon"src="{{ asset('img/search-icon.svg') }}">
			<input type="text" class="search_input" placeholder="Rechercher...">
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
						<tr onclick="displayUserDetails({{ $user }})">
							<td>{{ $user->id }}</td>
							<td>{{ $user->name }}</td>
							@if ($user->is_admin) <td>✅</td> @else <td>❌</td> @endif
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<script>
		// Seach system
		document.querySelector('.search_input').addEventListener('input', function() {
			var searchValue = this.value.toLowerCase();
			var rows = document.querySelectorAll('#user_table tbody tr');
			rows.forEach(function(row) {
				var userName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
				if (userName.indexOf(searchValue) > -1) {
					row.style.display = '';
				} else {
					row.style.display = 'none';
				}
			});
		});
	</script>


	<div id="user_details">
		<div id="user_details_not_loaded">
			<h2>Veuillez sélectionner un utilisateur</h2>
		</div>
		<div id="user_details_loaded" class="hidden">
			<!-- img src="../img/user_image.jpg" /-->
			<form action="/auth/update" method="post" >
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

				<!-- First name -->
				<div class="user_details_field">
					<label for="first_name">Prénom :</label>
					<input type="text" id="first_name" name="first_name" required/>
				</div>

				<!-- Last name -->
				<div class="user_details_field">
					<label for="last_name">Nom :</label>
					<input type="text" id="last_name" name="last_name" required/>
				</div>

				<!-- Date de naissance -->
				<div class="user_details_field">
					<label for="birthday">Date de naissance :</label>
					<input type="date" id="birthday" name="birth" required/>
				</div>

				<!-- Genre -->
				<div class="user_details_field">
					<label for="gender">Genre :</label>
					<div id="gender">
						<input type="radio" name="gender" value="male"/>
						<label for="gender">Homme</label>
						<input type="radio" name="gender" value="female"/>
						<label for="gender">Femme</label>
						<input type="radio" name="gender" value="null"/>
						<label for="female">Autre</label>
					</div>
				</div>

				<!-- Métier -->
				<div class="user_details_field">
					<label for="job">Métier :</label>
					<input type="text" id="job" name="job_id"/>
				</div>

				<!-- Mot de passe : Ne pas l'afficher, simplement en autoriser la modification -->
				<div class="user_details_field">
					<label for="password">Mot de passe :</label>
					<input type="password" name="password" id="password"/>
				</div>

				<!-- Submit -->
				<div class="user_details_field">
					<input type="submit" value="Enregistrer"/>
				</div>
			</form>
		</div>
	</div>
	<script>
		// User details
		let not_loaded_div = document.querySelector('#user_details_not_loaded');
		let loaded_div = document.querySelector('#user_details_loaded');

		let username_field = document.querySelector('#name');
		let email_field = document.querySelector('#email');
		let first_name_field = document.querySelector('#first_name');
		let last_name_field = document.querySelector('#last_name');
		let birthday_field = document.querySelector('#birthday');
		let gender_field = {
			0: document.querySelector('input[name="gender"][value="male"]'),
			1: document.querySelector('input[name="gender"][value="female"]'),
			2: document.querySelector('input[name="gender"][value="null"]'),
		};
		let job_field = document.querySelector('#job');
		let password_field = document.querySelector('#password');
		function displayUserDetails(user) {
			loaded_div.classList.remove('hidden');
			not_loaded_div.classList.add('hidden');

			// Set values
			username_field.value = user.name;
			email_field.value = user.email;
			first_name_field.value = user.first_name;
			last_name_field.value = user.last_name;
			birthday_field.value = user.birth;
			switch (user.gender) {
				case 0:
					gender_field[0].checked = true;
					break;
				case 1:
					gender_field[1].checked = true;
					break;
				default:
					gender_field[2].checked = true;
					break;
			}
			job_field.value = user.job;
		}
	</script>
</div>
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

	<div id="user_details">
		<div id="user_details_not_loaded">
			<h2>Veuillez sélectionner un utilisateur</h2>
		</div>
		<div id="user_details_loaded" class="hidden">
			<!-- img src="../img/user_image.jpg" /-->
			<form action="/auth/update" method="post" autocomplete="off" >
				@csrf

				<input type="hidden" id="user_id" name="id"/>

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
					<label for="job">Métier: </label>
					<select name="job" id="job">
						<option value="null"></option>
						@foreach(\App\Models\Job::all() as $job)
							<option value="{{$job->id}}" @if(Auth::user()->job_id == $job->id) selected @endif>{{$job->name}} </option>
						@endforeach
					</select>
				</div>

				<!-- Mot de passe : Ne pas l'afficher, simplement en autoriser la modification -->
				<div class="user_details_field">
					<label for="password">Mot de passe :</label>
					<input type="password" name="password" id="password" autocomplete="new-password"/>
				</div>

				<!-- Submit -->
				<div class="user_details_field">
					<input type="submit" value="Enregistrer"/>
				</div>
			</form>

			<!-- Delete button -->
			<div class="user_details_field">
				<form action="/admin/user/remove" method="post">
					@csrf
					<input type="hidden" id="user_id_delete" name="id"/>
					<input type="submit" value="Supprimer"/>
				</form>
			</div>
		</div>
	</div>
</div>
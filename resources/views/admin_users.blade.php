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
					<th>Role</th>
				</tr>
			</thead>

			<tbody>
				@foreach(\App\Models\User::all() as $user)
					<tr>
						<td>{{ $user->id }}</td>
						<td>{{ $user->name }}</td>
						<td>{{ $user->role }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<script>
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

</div>
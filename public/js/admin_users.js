// Seach system
document.querySelector('.search_input').addEventListener('input', function() {
	let searchValue = this.value.toLowerCase();
	let rows = document.querySelectorAll('#user_table tbody tr');
	rows.forEach(function(row) {
		let userName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
		if (userName.indexOf(searchValue) > -1) {
			row.style.display = '';
		} else {
			row.style.display = 'none';
		}
	});
});

// User details system
let not_loaded_div = document.querySelector('#user_details_not_loaded');
let loaded_div = document.querySelector('#user_details_loaded');

let user_id = document.querySelector('#user_id');
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
let user_id_delete = document.querySelector('#user_id_delete');

function displayUserDetails(user) {
	loaded_div.classList.remove('hidden');
	not_loaded_div.classList.add('hidden');

	// Set values
	user_id.value = user.id;
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
	job_field.value = user.job_id;
	user_id_delete.value = user.id;
}
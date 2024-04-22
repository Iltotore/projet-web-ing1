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

let user_details_empty = document.querySelector('#user_details_empty');
let user_details_add = document.querySelector('#user_details_add');
let user_details_edit = document.querySelector('#user_details_edit');

// Add user

function displayUserAddMenu() {
	// Display add menu
	user_details_empty.classList.add('hidden');
	user_details_edit.classList.add('hidden');
	user_details_add.classList.remove('hidden');
}

// Edit user

let user_id_password_reset = document.querySelector('#user_id_password_reset');
let user_id_delete = document.querySelector('#user_id_delete');
let user_details_username = document.querySelector('#user_details_username');

function displayUserEditMenu(user) {
	// Display edit menu
	user_details_empty.classList.add('hidden');
	user_details_add.classList.add('hidden');
	user_details_edit.classList.remove('hidden');

	// Set fields to the appropriate values
	user_id_password_reset.value = user.id
	user_id_delete.value = user.id
	user_details_username.textContent = user.name
}
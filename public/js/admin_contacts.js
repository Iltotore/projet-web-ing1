// Seach system
document.querySelector('.search_input').addEventListener('input', function() {
	let searchValue = this.value.toLowerCase();
	let rows = document.querySelectorAll('#contact_table tbody tr');
	rows.forEach(function(row) {
		let contact = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
		if (contact.indexOf(searchValue) > -1) {
			row.style.display = '';
		} else {
			row.style.display = 'none';
		}
	});
});

// contact details system
let not_loaded_div = document.querySelector('#contact_details_not_loaded');
let loaded_div = document.querySelector('#contact_details_loaded');

let contact_id = document.querySelector('#contact_id');
let email_field = document.querySelector('#email');
let first_name_field = document.querySelector('#first_name');
let last_name_field = document.querySelector('#last_name');
let birthday_field = document.querySelector('#birthday');
let gender_field = document.querySelector('#gender');
let job_field = document.querySelector('#job');
let subject_field = document.querySelector('#subject');
let content_field = document.querySelector('#content');
let contact_id_delete = document.querySelector('#contact_id_delete');

function displayContactDetails(contact) {
	loaded_div.classList.remove('hidden');
	not_loaded_div.classList.add('hidden');

	// Set values
	contact_id.value = contact.id;
	email_field.value = contact.email;
	first_name_field.value = contact.first_name;
	last_name_field.value = contact.last_name;
	birthday_field.value = contact.birth;
	switch (contact.gender) {
		case 0:
			gender_field = "Homme";
			break;
		case 1:
			gender_field = "Femme";
			break;
		default:
			gender_field = "Autre";
			break;
	}
	job_field.value = contact.job_id;
    subject_field.value = contact.subject;
    content_field.value = contact.content;
	contact_id_delete.value = contact.id;
}

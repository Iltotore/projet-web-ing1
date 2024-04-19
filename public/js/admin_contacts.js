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
let jobs_field = document.querySelector('#job').getElementsByTagName('div');
let subject_field = document.querySelector('#subject');
let content_field = document.querySelector('#content');
let contact_id_delete = document.querySelector('#contact_id_delete');

function displayContactDetails(contact) {
	loaded_div.classList.remove('hidden');
	not_loaded_div.classList.add('hidden');

	// Set values
	contact_id.value = contact.id;
	email_field.textContent = contact.email;
	first_name_field.textContent = contact.first_name;
	last_name_field.textContent = contact.last_name;
	birthday_field.textContent = contact.birth;
	switch (contact.gender) {
		case 0:
			gender_field.textContent = "Homme";
			break;
		case 1:
			gender_field.textContent = "Femme";
			break;
		default:
			gender_field.textContent = "Autre";
			break;
	}
    for(let i=0; i< jobs_field.length; i++ ) {
        jobs_field[i].setAttribute("hidden", "");
    }
    jobs_field[contact.job_id-1].removeAttribute("hidden");
    subject_field.textContent = contact.subject;
    content_field.textContent = contact.content;
	contact_id_delete.value = contact.id;
}


$(document).ready(function() {
	$("#edo-doantion").validate({
		rules: {
			first_name: "required",
			last_name: "required",
			"vol-first-name": "required", 
			"vol-last-name": "required",
			email: {
				required: true,
				email: true
			},
			"vol-email": {
				required: true,
				email: true
			}
		},
		messages: {
			firstname: "Please enter your first name",
			lastname: "Please enter your last name",
			email: {
				required: "Please enter your email",
				email: "Please enter a valid email"
			},
			"vol-first-name": "Please enter your first name",
			"vol-last-name": "Please enter your last name",
			"vol-email": {
				required: "Please enter your email",
				email: "Please enter a valid email"
			}
		}
	});
});
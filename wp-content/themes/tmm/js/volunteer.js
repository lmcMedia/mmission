$(document).ready(function() {
	$(".vol-txt-date").datepicker({
		buttonImage: '../../../wp-content/themes/tmm/images/vol_icon_calenda.png',
		buttonImageOnly: true,
        changeMonth: true,
        changeYear: true,
        showOn: 'both',
        dateFormat: 'mm-dd-yy'
	});
	$(".vol-txt-date").datepicker().datepicker('setDate', new Date());
	
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
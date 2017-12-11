$(function() {
	$("form").on("submit", function(e) {
		clearAllErrors();
		
		var user_first_name = $("input[name='user_first_name']").val().trim();
		if (user_first_name == "") {
			e.preventDefault();
			$(".error-user_first_name").html("First Name is required");
		}

		var user_email = $("input[name='user_email']").val().trim();
		if (user_email == "") {
			e.preventDefault();
			$(".error-user_email").html("Email is required");
		}

		var user_password = $("input[name='user_password']").val().trim();
		if (user_password == "") {
			e.preventDefault();
			$(".error-user_password").html("Password is required");
		}

		var user_confirm_password = $("input[name='user_confirm_password']").val().trim();
		if (user_confirm_password == "") {
			e.preventDefault();
			$(".error-user_confirm_password").html("Confirm Password is required");
		} else {
			if (user_confirm_password != user_password) {
				e.preventDefault();
				$(".error-user_confirm_password").html("Confirm Password does not match Password");
			}
		}
	});
});
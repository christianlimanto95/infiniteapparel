$(function() {
	$("#navigation").val(navigation);
	
	$(".form-change-password").on("submit", function(e) {
		var valid = true;
		var error = "Error :";

		var current_password = $("input[name='current_password']").val();
		if (current_password == "") {
			valid = false;
			error += "\nPassword lama harus diisi";
		}

		var new_password = $("input[name='new_password']").val();
		if (new_password == "") {
			valid = false;
			error += "\nPassword baru harus diisi";
		}

		var confirm_new_password = $("input[name='confirm_new_password']").val();
		if (confirm_new_password == "") {
			valid = false;
			error += "\nConfirm Password Baru harus diisi";
		} else if (new_password != confirm_new_password) {
			valid = false;
			error += "\nConfirm Password Baru harus sama dengan Password Baru";
		}

		if (valid) {
			if (!confirm('Yakin mau ganti password?')) {
				e.preventDefault();
			}
		} else {
			e.preventDefault();
			alert(error);
		}
	});
});
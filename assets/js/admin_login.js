$(function() {
	$(".form").on("submit", function(e) {
		var valid = cek_form();
		if (!valid) {
			e.preventDefault();
		}
	});
});

function cek_form() {
	var valid = true;
	if ($(".username").val().trim() == "" || $(".password").val().trim() == "") {
		$(".error").html("Username / Password tidak boleh kosong");
		valid = false;
	}

	return valid;
}
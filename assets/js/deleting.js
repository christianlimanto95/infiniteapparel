$(function() {
	$("#navigation").val(navigation);
	
	$(".form-delete").on("submit", function(e) {
		if (!confirm('Yakin mau delete?')) {
			e.preventDefault();
		}
	});
});
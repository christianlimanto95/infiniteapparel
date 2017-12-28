$(function() {
	$("#navigation").val(navigation);

	$("form").on("submit", function(e) {
		if (!confirm('Yakin confirm pembayaran ini?')) {
			e.preventDefault();
		}
	});
});
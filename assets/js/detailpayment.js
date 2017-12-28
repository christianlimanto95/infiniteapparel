$(function() {
	$("#navigation").val(navigation);

	$(".form-confirm").on("submit", function(e) {
		if (!confirm('Yakin confirm pembayaran ini?')) {
			e.preventDefault();
		}
	});

	$(".form-decline").on("submit", function(e) {
		if (!confirm('Yakin decline pembayaran ini?')) {
			e.preventDefault();
		}
	});
});
$(function() {
	$("#navigation").val(navigation);
	
	$("#cbOrder").change(function() {
		$("#formOrder").submit();
	});

	$(".form-add-resi").on("submit", function(e) {
		var valid = true;

		var resi = $("input[name='resi']").val();
		if (resi == "") {
			valid = false;
			alert("Nomor resi belum diisi");
		}

		if (valid) {
			if (!confirm('Set nomor resi ' + resi + '?')) {
				e.preventDefault();
			}
		} else {
			e.preventDefault();
		}
	});
	
	$("#formDeliver").on("submit", function() {
		var nomor_resi = $(this).data("nomor_resi");
		var sure = confirm("Nomor Resi : " + nomor_resi + "\nAre You Sure?");
		if (!sure) {
			return false;
		}
	});
});
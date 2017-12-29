$(document).ready(function() {
	$("#cbId").change(function() {
		$("#formIdBarang").submit();
	});
	
	$("textarea").keydown(function(e) {
		if (e.which == 9)
		{
			e.preventDefault();
			var value = $(this).val();
			value += "\t";
			$(this).val(value);
		}
	});

	$(".form-update-item").on("submit", function(e) {
		var valid = true;
		var error = "Error : ";

		var item_price = $("input[name='urharga']:checked").val();
		if (item_price == "other") {
			item_price = $("input[name='hargaupdate']").val();
		}
		item_price = parseInt(item_price);
		if (isNaN(item_price) || item_price == 0) {
			valid = false;
			error += "\nHarga tidak valid";
		}

		if (valid) {
			if (!confirm('Yakin mau update?')) {
				e.preventDefault();
			}
		} else {
			e.preventDefault();
			alert(error);
		}
	});
});
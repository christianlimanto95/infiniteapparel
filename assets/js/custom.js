$(function() {
	$(".select-type").on("change", function() {
		var custom_type_id = this.value;
		var element = "";
		for (var i = 0; i < designs.length; i++) {
			if (designs[i].custom_type_id == custom_type_id) {
				element += "<div class='color' style='background-color: #" + designs[i].custom_color_hex + ";' data-id='" + designs[i].custom_id + "'></div>";
			}
		}
		
		$(".designs-color-container").html(element);
	});

	$(document).on("click", ".color", function() {
		var custom_id = $(this).attr("data-id");
	});
});
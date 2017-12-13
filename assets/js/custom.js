$(function() {
	$(".select-type").on("change", function() {
		var custom_type_id = this.value;
		var element = "";
		var first_custom_id = -1;
		for (var i = 0; i < designs.length; i++) {
			if (designs[i].custom_type_id == custom_type_id) {
				if (first_custom_id == -1) {
					first_custom_id = designs[i].custom_id;
				}
				element += "<div class='color' style='background-color: #" + designs[i].custom_color_hex + ";' data-id='" + designs[i].custom_id + "'></div>";
			}
		}
		
		var designColorContainer = $(".designs-color-container");
		designColorContainer.html(element);
		setColor(first_custom_id, designColorContainer);
	});

	$(document).on("click", ".color", function() {
		var custom_id = $(this).attr("data-id");
		var colorContainer = $(this).closest(".color-container");
		setColor(custom_id, colorContainer);
	});
});

function setColor(custom_id, container) {
	var color = null;
	if (container.hasClass("designs-color-container")) {
		var iLength = designs.length;
		for (var i = 0; i < iLength; i++) {
			if (designs[i].custom_id == custom_id) {
				color = designs[i];
				break;
			}
		}
		$(".design-image").css("background-image", "url(" + color.image + ")");
	} else {
		var iLength = shirts.length;
		for (var i = 0; i < iLength; i++) {
			if (shirts[i].custom_id == custom_id) {
				color = shirts[i];
				break;
			}
		}
		$(".shirt-image").css("background-image", "url(" + color.image + ")");
	}
	container.find(".selected").removeClass("selected");
	$(".color[data-id='" + custom_id + "']").addClass("selected");
}
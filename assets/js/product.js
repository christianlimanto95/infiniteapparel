$("body").on("allLoaded", function() {
	$(".section-1").addClass("show");
});

var imageIndex = 1;
$(function() {
	$(document).off("click", ".btn-add-to-bag");
	$(document).on("click", ".btn-add-to-bag", function() {
		showLoader();
		var id = $(".section-1").attr("data-id");
		var size = $(".select-size").val();
		var qty = $(".input-qty").val();
		
		ajaxCall(add_to_cart_url, {item_id: id, item_size: size, item_qty: qty, item_type: 1}, function(json) {
			hideLoader();
			get_cart();        
			closeModal(element);
		});
	});

	$(".product-image-thumbnail").on("mouseenter", function() {
		var index = parseInt($(this).data("image-index"));
		if (index != imageIndex) {
			imageIndex = index;
			var backgroundImage = $(this).css("background-image").slice(4, -1).replace(/["|']/g, "");
			$(".product-image").css("background-image", "url('" + backgroundImage + "')")
		}
	});
});
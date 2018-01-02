var imageIndex = 1;
$(function() {
	$(document).off("click", ".btn-add-to-bag");
	$(document).on("click", ".btn-add-to-bag", function() {
		showLoader();
		var id = $(".section-1").attr("data-id");
		var size = $(".select-size").val();
		var qty = $(".input-qty").val();
		
		ajaxCall(add_to_cart_url, {item_id: id, item_size: size, item_qty: qty, item_type: 1}, function(json) {
            get_cart();
            $(".bags-message").addClass("show");
            $(".bags-message").one('webkitAnimationEnd oanimationend oAnimationEnd msAnimationEnd animationend', function(e) {
                $(".bags-message").removeClass("show");
            });
			closeModal();
		});
	});

	$(document).off("click", ".btn-buy-now");
	$(document).on("click", ".btn-buy-now", function() {
		showLoader();
		var id = $(".section-1").attr("data-id");
		var size = $(".select-size").val();
		var qty = $(".input-qty").val();
		
		ajaxCall(add_to_cart_url, {item_id: id, item_size: size, item_qty: qty, item_type: 1}, function(json) {
			get_cart();
			closeModal();
			checkout();
		});
	});

	$(".input-qty").on("change", function() {
        checkInputNumber(this);
    });

	$(".btn-view-size-chart").on("click", function() {
		$(".size-chart").addClass("show");
	});

	$(".size-chart").on("click", function() {
		$(this).removeClass("show");
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
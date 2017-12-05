$("body").on("allLoaded", function() {
	$(".section-1").addClass("show");
});

var imageIndex = 1;
$(function() {
	$(".product-image-thumbnail").on("mouseenter", function() {
		var index = parseInt($(this).data("image-index"));
		if (index != imageIndex) {
			imageIndex = index;
			var backgroundImage = $(this).css("background-image").slice(4, -1).replace(/["|']/g, "");
			$(".product-image").css("background-image", "url('" + backgroundImage + "')")
		}
	});
});
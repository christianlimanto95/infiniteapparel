$(function() {
    $(".header-btn-login").off("click");
	$(".header-btn-login").on("click", function() {
        showLoginModal(catalog_url);
    });
});
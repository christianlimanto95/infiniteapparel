var header, container;
$(window).on("load", function() {
    $("body").trigger("allLoaded");
    $(".container")[0].focus();
});

$(function() {
    header = $(".header");
    container = $(".container");

    $(".header-btn-login").on("click", function() {
        var modal_login = $(".modal-login");
        modal_login.addClass("show");
        $(".modal-box").one('webkitAnimationEnd oanimationend oAnimationEnd msAnimationEnd animationend', function(e) {
			modal_login.addClass("shown").removeClass("show");
		});
    });

    $(".modal-close-button").on("click", function() {
        var modal = $(this).closest(".modal");
        modal.addClass("hide");
        modal.one('webkitAnimationEnd oanimationend oAnimationEnd msAnimationEnd animationend', function(e) {
			modal.removeClass("shown").removeClass("hide");
		});
    });
});
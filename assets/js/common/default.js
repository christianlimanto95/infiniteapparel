var header, container;
$(window).on("load", function() {
    $("body").trigger("allLoaded");
    $(".container")[0].focus();
});

$(function() {
    header = $(".header");
    container = $(".container");

    $(".header-btn-login").on("click", function() {
        var modal = $(".modal-login");
        modal.addClass("show");
        modal.find(".modal-box").one('webkitAnimationEnd oanimationend oAnimationEnd msAnimationEnd animationend', function(e) {
            modal.addClass("shown").removeClass("show");
            modal.find(".form-input-email").select();
		});
    });
    
    $(".bags-container").on("click", function() {
        var modal = $(".modal-bags");
        modal.addClass("show");
        modal.find(".modal-box").one('webkitAnimationEnd oanimationend oAnimationEnd msAnimationEnd animationend', function(e) {
            modal.addClass("shown").removeClass("show");
		});
    });

    $(".modal-close-button").on("click", function() {
        closeModal();
    });

    $(document).on("keyup", function(e) {
        if (e.keyCode == 27) {
            closeModal();
        }
    });
});

function clearModalInputs(modal) {
    modal.find(".form-input").val("");
}

function closeModal() {
    var modal = $(".modal.shown");
    if (modal.length > 0) {
        modal.addClass("hide");
        modal.one('webkitAnimationEnd oanimationend oAnimationEnd msAnimationEnd animationend', function(e) {
            modal.removeClass("show").removeClass("shown").removeClass("hide");
            clearModalInputs(modal);
        });
    }
}
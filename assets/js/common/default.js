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

    $(document).on("click", ".btn-add-to-bag", function() {
        var id = $(this).data("id");
        var modal = $(".modal-size-qty");
        modal.attr("data-id", id);
        modal.addClass("show");
        modal.find(".modal-box").one('webkitAnimationEnd oanimationend oAnimationEnd msAnimationEnd animationend', function(e) {
            modal.addClass("shown").removeClass("show");
		});
    });

    $(document).on("click", ".modal-btn-confirm-size-qty", function() {
        var modal = $(this).closest(".modal");
        var id = modal.attr("data-id");
        var size = modal.find(".form-input-size").val();
        var qty = modal.find(".form-input-qty").val();
        
        ajaxCall(add_to_cart_cookie_url, {item_id: id, item_size: size, item_qty: qty}, function(json) {
            var result = jQuery.parseJSON(json);
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
    modal.find(".form-input:not([data-auto-clear='false'])").val("");
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

function ajaxCall(url, data, callback) {
	return $.ajax({
		url: url,
		data: data,
		type: 'POST',
		error: function(jqXHR, exception) {
			if (exception != "abort") {
				console.log(jqXHR + " : " + jqXHR.responseText);
			}
		},
		success: function(result) {
			callback(result);
		}
	});
}

function get_cart_from_cookie() {
    
}
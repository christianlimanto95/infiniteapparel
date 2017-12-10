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

    get_cart();
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

function get_cart() {
    ajaxCall(get_cart_url, null, function(json) {
        var result = jQuery.parseJSON(json);
        var iLength = result.length;
        if (iLength > 0) {
            var element = "";
            for (var i = 0; i < iLength; i++) {
                element += "<tr>";
                element += "<td data-col='name'>";
                element += "<div class='bags-td-name-image' style='background-image: url(" + product_url + "/" + result[i].item_id + "_1.png);'></div>";
                element += "<div class='bags-td-name-text'>" + result[i].item_name + "</div>";
                element += "</td>";
                element += "<td data-col='size'>";
                element += "<select><option value='xxl'>XXL</option><option value='xl'>XL</option><option value='l'>L</option><option value='m'>M</option><option value='s'>S</option><option value='xs'>XS</option></select>";
                element += "</td>";
                element += "<td data-col='price'>";
                element += "IDR " + result[i].item_price;
                element += "</td>";
                element += "<td data-col='qty'><input type='number' min='1' max='999' value='" + result[i].item_qty + "' /></td>";
                element += "<td data-col='subtotal'>IDR " + result[i].item_subtotal + "</td>";
                element += "<td data-col='action'></td>";
                element += "</tr>";
            }

            $(".modal-bags-table tbody").html(element);
        }
    });
}
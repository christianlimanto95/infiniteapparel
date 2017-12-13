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
            modal.find(".modal-input-email").select();
		});
    });

    $(".header-btn-logout").on("click", function() {
        showLoader();
        ajaxCall(logout_url, null, function() {
            hideLoader();
            location.reload(true);
        });
    });

    $(".modal-btn-login").on("click", function() {
        var valid = true;
        var email = $(".modal-input-email").val().trim();
        var password = $(".modal-input-password").val().trim();
        clearAllErrors();
        if (email == "") {
            valid = false;
            $(".error-modal-input-email").html("Email is required");
        }
        if (password == "") {
            valid = false;
            $(".error-modal-input-password").html("Password is required");
        }

        if (valid) {
            showLoader();
            ajaxCall(login_url, {user_email: email, user_password: password}, function(json) {
                hideLoader();
                var result = jQuery.parseJSON(json);
                if (result.status == "success") {
                    location.reload(true);
                } else {
                    $(".error-modal-input-email").html("Wrong email / password");
                }
            });
        }
    });

    $(".modal-input-email, .modal-input-password").on("keypress", function(e) {
        if (e.keyCode == 13) {
            $(".modal-btn-login").click();
        }
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
        add_to_cart(this);
    });

    $(document).on("click", ".bags-add-item", function() {
        var id = $(this).closest("tr").attr("data-id");
        var modal = $(".modal-size-qty");
        modal.attr("data-close-self", "true");
        modal.attr("data-id", id);
        modal.addClass("show");
        modal.find(".modal-box").one('webkitAnimationEnd oanimationend oAnimationEnd msAnimationEnd animationend', function(e) {
            modal.addClass("shown").removeClass("show");
		});
    });

    $(document).on("click", ".bags-remove-item", function() {
        var tr = $(this).closest("tr");
        var index = tr.attr("data-index");
        var dcart_id = tr.attr("data-dcart-id");
        remove_from_cart(index, dcart_id);
    });

    $(document).on("change", ".bags-input-size", function() {
        cart_change_size(this);
    });

    $(document).on("change", ".bags-input-qty", function() {
        cart_change_qty(this);
    });

    $(".modal-close-button").on("click", function() {
        closeModal(this);
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

function clearAllErrors() {
	$(".error").html("");
}

function closeModal(element) {
    var modal;
    if (element != null) {
        modal = $(element).closest(".modal");
        if (modal.attr("data-close-self") === undefined) {
            modal = $(".modal.shown");
        } else {
            modal.removeAttr("data-close-self");
        }
    } else {
        modal = $(".modal.shown");
    }
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
        var total_qty = result.total_qty;
        var total_subtotal = result.total_subtotal;
        result = result.data;
        var iLength = result.length;
        var element = "";
        if (iLength > 0) {
            for (var i = 0; i < iLength; i++) {
                var select = [];
                select["xxl"] = "";
                select["xl"] = "";
                select["l"] = "";
                select["m"] = "";
                select["s"] = "";
                select["xs"] = "";
                select[result[i].item_size] = " selected";

                element += "<tr data-index='" + i + "' data-id='" + result[i].item_id + "' data-dcart-id='" + result[i].dcart_id + "'>";
                element += "<td data-col='name'>";
                if (result[i].item_type == 1) {
                    element += "<div class='bags-td-name-image' style='background-image: url(" + product_url + "/" + result[i].item_id + "_1.png);'></div>";
                } else {
                    element += "<div class='bags-td-name-image-shirt' style='background-image: url(" + product_custom_url + "/" + result[i].shirt_custom_id + ".png);'></div>";
                    element += "<div class='bags-td-name-image-design' style='background-image: url(" + product_custom_url + "/" + result[i].design_custom_id + ".png);'></div>";
                }
                element += "<div class='bags-td-name-text'>" + result[i].item_name + "</div>";
                element += "</td>";
                element += "<td data-col='size'>";
                element += "<select class='bags-input-size'><option value='xxl'" + select["xxl"] + ">XXL</option><option value='xl'" + select["xl"] + ">XL</option><option value='l'" + select["l"] + ">L</option><option value='m'" + select["m"] + ">M</option><option value='s'" + select["s"] + ">S</option><option value='xs'" + select["xs"] + ">XS</option></select>";
                element += "</td>";
                element += "<td data-col='price'>";
                element += "IDR " + result[i].item_price;
                element += "</td>";
                element += "<td data-col='qty'><input type='number' class='bags-input-qty' min='1' max='999' value='" + result[i].item_qty + "' /></td>";
                element += "<td data-col='subtotal'>IDR " + result[i].item_subtotal + "</td>";
                element += "<td data-col='action'><div class='bags-add-item' title='add another size' style='background-image: url(" + bags_add_item_url + ");'></div><div class='bags-remove-item' title='remove' style='background-image: url(" + bags_remove_item_url + ");'></div></td>";
                element += "</tr>";
            }
           
        }

        $(".modal-bags-table tbody").html(element);
        $(".bags-ctr").html(total_qty);
        $(".modal-bags-header-left span").html("(" + total_qty + " items)");
        $(".modal-bags-total").html("IDR " + total_subtotal);

        if (total_qty > 0) {
            $(".modal-btn-checkout").removeClass("disabled");
        } else {
            $(".modal-btn-checkout").addClass("disabled");
        }
    });
}

function add_to_cart(element) {
    showLoader();
    var modal = $(element).closest(".modal");
    var id = modal.attr("data-id");
    var size = modal.find(".form-input-size").val();
    var qty = modal.find(".form-input-qty").val();
    
    ajaxCall(add_to_cart_url, {item_id: id, item_size: size, item_qty: qty, item_type: 1}, function(json) {
        hideLoader();
        get_cart();        
        closeModal(element);
    });
}

function remove_from_cart(index, dcart_id) {
    showLoader();
    ajaxCall(remove_from_cart_url, {index: index, dcart_id: dcart_id}, function() {
        hideLoader();
        get_cart();
    });
}

function cart_change_qty(element) {
    showLoader();
    var tr = $(element).closest("tr");
    var index = tr.attr("data-index");
    var dcart_id = tr.attr("data-dcart-id");
    var item_qty = tr.find(".bags-input-qty").val();
    
    ajaxCall(cart_change_qty_url, {index: index, item_qty: item_qty, dcart_id: dcart_id}, function() {
        hideLoader();
        get_cart();
    });
}

function cart_change_size(element) {
    showLoader();
    var tr = $(element).closest("tr");
    var index = tr.attr("data-index");
    var dcart_id = tr.attr("data-dcart-id");
    var item_size = tr.find(".bags-input-size").val();
    
    ajaxCall(cart_change_size_url, {index: index, item_size: item_size, dcart_id: dcart_id}, function() {
        hideLoader();
        get_cart();
    });
}

function showLoader() {
    $(".loader-container").addClass("show");
}

function hideLoader() {
    $(".loader-container").removeClass("show");
}

function addThousandSeparator(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}
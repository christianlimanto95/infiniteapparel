var shipping = [];

$(function() {
    get_checkout_cart();
    get_city();

    $(".form-input-city").on("change", function() {
        var city_id = $(this).val();
        get_shipping_service(city_id);
    });

    $(".form-input-shipping").on("change", function() {
        var shipping_name = $(this).val();
        setShippingServiceCombobox(shipping_name);
    });

    $(".form-input-service").on("change", function() {
        var value = $(this).find("option:selected").attr("data-value");
        setShippingCost(value);
    });

    $(".btn-submit-checkout").on("click", function() {
        clearAllErrors();

        var valid = true;
        var first_name = $(".form-input-first-name").val().trim();
        if (first_name == "") {
            valid = false;
            $(".error-first-name").html("Required");
        }
        var last_name = $(".form-input-last-name").val().trim();
        var city_id = $(".form-input-city").val();
        var address = $(".form-input-address").val().trim();
        if (address == "") {
            valid = false;
            $(".error-address").html("Required");
        }
        var handphone = $(".form-input-phone").val().trim();
        if (handphone == "") {
            valid = false;
            $(".error-phone").html("Required");
        }

        var shipping_name = $(".form-input-shipping").val();
        var shipping_service = $(".form-input-service").val();
        if (shipping_service == "") {
            valid = false;
            $(".error-service").html("Required");
        }

        if (valid) {
            showLoader();
            var data = {
                first_name: first_name,
                last_name: last_name,
                city_id: city_id,
                address: address,
                handphone: handphone,
                shipping_name: shipping_name,
                shipping_service: shipping_service
            };
            ajaxCall(do_checkout_url, data, function(json) {
                hideLoader();
                var result = jQuery.parseJSON(json);
                if (result.status == "success") {
                    window.location = order_list_url;
                } else {

                }
            });
        }
    });

    $(document).on("click", ".checkout-item-image, .checkout-item-image-design", function() {
        if ($(this).attr("data-item-type") == "1") {
            var image = $(this).css("background-image").slice(4, -1).replace(/["|']/g, "");
            $(".bags-preview-image").css("background-image", "url(" + image + ")");
        } else {
            var checkoutItem = $(this).closest(".checkout-item");
            var shirtImage = checkoutItem.find(".checkout-item-image").css("background-image").slice(4, -1).replace(/["|']/g, "");
            var designImage = checkoutItem.find(".checkout-item-image-design").css("background-image").slice(4, -1).replace(/["|']/g, "");
            $(".bags-preview-image").css("background-image", "url(" + shirtImage + ")");
            $(".bags-preview-image-design").css("background-image", "url(" + designImage + ")");
        }
        $(".bags-preview").addClass("show");
    });
});

function get_checkout_cart() {
    ajaxCall(get_cart_url, null, function(json) {
        hideLoader(".custom-loader-container");
        var result = jQuery.parseJSON(json);
        var data = result.data;
        var iLength = data.length;
        if (iLength > 0) {
            var element = "";
            for (var i = 0; i < iLength; i++) {
                element += "<div class='checkout-item'>";
                element += "<div class='checkout-item-number checkout-item-col'>" + (i + 1) + ".</div>";
                if (data[i].item_type == 1) {
                    element += "<div class='checkout-item-image checkout-item-col' data-item-type='1' style='background-image: url(" + product_url + "/" + data[i].item_id + "_1.png);'></div>";
                } else {
                    element += "<div class='checkout-item-image checkout-item-col' data-item-type='2' style='background-image: url(" + product_custom_url + "/" + data[i].shirt_custom_id + ".png);'></div>";
                    element += "<div class='checkout-item-image-design checkout-item-col' data-item-type='2' style='background-image: url(" + product_custom_url + "/" + data[i].design_custom_id + ".png);'></div>";
                }
                element += "<div class='checkout-item-text checkout-item-col'>";
                element += "<div class='checkout-item-name'>" + data[i].item_name + "</div>";
                element += "<div class='checkout-item-size'>Size: " + data[i].item_size.toUpperCase() + "</div>";
                element += "<div class='checkout-item-qty'>Qty: " + data[i].item_qty + "</div>";
                element += "</div>";
                element += "<div class='checkout-item-subtotal'>IDR " + data[i].item_subtotal + "</div>";
                element += "</div>";
            }
            $(".checkout-item-container").html(element);
        }
        $(".total-item-value-subtotal").html(result.total_subtotal);
    });
}

function get_city() {
    ajaxCall(get_city_url, null, function(json) {
        var result = jQuery.parseJSON(json);
        var iLength = result.length;
        var element = "";
        for (var i = 0; i < iLength; i++) {
            element += "<option value='" + result[i].city_id + "'>" + result[i].city_name + "</option>";
        }
        $(".form-input-city").html(element);
        $(".form-input-city").val("444");
        get_shipping_service(444);
    });
}

function get_shipping_service(city_id) {
    showLoader();
    ajaxCall(get_shipping_cost_url, {city_id: city_id}, function(json) {
        hideLoader();
        var result = jQuery.parseJSON(json);
        var shipping_element = "";
        var service_element = "";
        var shipping_name;
        shipping = [];
        for (shipping_name in result) {
            if (result.hasOwnProperty(shipping_name)) {
                var shipping_service = [];
                for (var service in result[shipping_name]) {
                    if (result[shipping_name].hasOwnProperty(service)) {
                        shipping_service.push({
                            name: service,
                            value: result[shipping_name][service]
                        });
                    }
                }
                shipping.push({
                    name: shipping_name,
                    service: shipping_service
                });
                shipping_element += "<option value='" + shipping_name + "'>" + shipping_name.toUpperCase() + "</option>";
            }
        }
        if (shipping.length > 0) {
            for (var i = 0; i < shipping[0].service.length; i++) {
                var service = shipping[0].service;
                service_element += "<option value='" + service[i].name + "' data-value='" + service[i].value + "'>" + service[i].name + " : IDR " + addThousandSeparator(service[i].value) + "</option>";
            }
            setShippingCost(shipping[0].service[0].value);
        }
        $(".form-input-shipping").html(shipping_element);
        $(".form-input-service").html(service_element);
    });
}

function setShippingServiceCombobox(shipping_name) {
    for (var i = 0; i < shipping.length; i++) {
        if (shipping[i].name == shipping_name) {
            var service_element = "";
            for (var j = 0; j < shipping[i].service.length; j++) {
                var service = shipping[i].service;
                service_element += "<option value='" + service[j].name + "' data-value='" + service[j].value + "'>" + service[j].name + " : IDR " + addThousandSeparator(service[j].value) + "</option>";
            }
            $(".form-input-service").html(service_element);
            setShippingCost(shipping[i].service[0].value);
            break;
        }
    }
}

function setShippingCost(cost) {
    var subtotal = parseInt($(".total-item-value-subtotal").html().replace(/\./g,''));
    var total = addThousandSeparator(subtotal + parseInt(cost));
    $(".total-item-value-disc").html(addThousandSeparator(cost));
    $(".total-item-value-total").html(total);
}
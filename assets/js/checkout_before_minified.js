var shipping = [];
var total_qty = 0;
var checkout_cart_done = false;
var city_valid = false;
var get_city_ajax = null;
var subtotal = 0;
var discount = 0;
var shipping_cost = 0;
var total = 0;
var get_shipping_service_done = false;
$(function() {
    get_checkout_cart();

    $(".form-input-city").on("keydown", function(e) {
        if (e.which == 40) {
            e.preventDefault();
            var cityAutocompleteItemActive = $(".city-autocomplete-item.active");
            if (cityAutocompleteItemActive.length == 0) {
                $(".city-autocomplete-item").first().addClass("active");
            } else {
                var next = cityAutocompleteItemActive.next();
                cityAutocompleteItemActive.removeClass("active");
                if (next.hasClass("city-autocomplete-item")) {
                    next.addClass("active");
                } else {
                    $(".city-autocomplete-item").first().addClass("active");
                }
            }
        } else if (e.which == 38) {
            e.preventDefault();
            var cityAutocompleteItemActive = $(".city-autocomplete-item.active");
            if (cityAutocompleteItemActive.length == 0) {
                $(".city-autocomplete-item").first().addClass("active");
            } else {
                var prev = cityAutocompleteItemActive.prev();
                cityAutocompleteItemActive.removeClass("active");
                if (prev.hasClass("city-autocomplete-item")) {
                    prev.addClass("active");
                } else {
                    $(".city-autocomplete-item").last().addClass("active");
                }
            }
        } else {
            var keyword = $(this).val();
            get_city(keyword);
        }
    });

    $(document).on("click", ".city-autocomplete-item", function(e) {
       fillInputCity($(this));
       return false;
    });

    $(document).on("click", function(e) {
        if (!$(e.target).is(".city-autocomplete-item")) {
            hideCityAutocomplete();
        }
    });

    $(".form-input-city").on("keypress", function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            var selectedAutocompleteItem = $(".city-autocomplete-item.active");
            if (selectedAutocompleteItem.length > 0) {
                fillInputCity(selectedAutocompleteItem);
            }
        }
    });

    $(".form-input-shipping").on("change", function() {
        var shipping_name = $(this).val();
        setShippingServiceCombobox(shipping_name);
    });

    $(".form-input-service").on("change", function() {
        var value = $(this).find("option:selected").attr("data-value");
        setShippingCost(value);
    });

    $(".btn-submit-checkout").on("click", do_checkout);

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

function do_checkout() {
    clearAllErrors();

    var valid = true;
    var first_name = $(".form-input-first-name").val().trim();
    if (first_name == "") {
        valid = false;
        $(".error-first-name").html("Required");
    }
    var last_name = $(".form-input-last-name").val().trim();
    var city_name_input = $(".form-input-city").val().trim();
    var city_name = $("input[name='city-name']").val();
    var city_id = $("input[name='city-id']").val();
    if (city_name_input == "") {
        valid = false;
        $(".error-city").html("Required");
    } else {
        if (city_id == "") {
            valid = false;
            $(".error-city").html("City not valid");
        }
    }

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
    
    if (shipping_service == "" || shipping_service == null) {
        valid = false;
        $(".error-service").html("Required");
    }

    if (valid) {
        $(".btn-submit-checkout").off("click");
        $(".btn-submit-checkout").addClass("disabled");
        showLoader();
        var data = {
            first_name: first_name,
            last_name: last_name,
            city_id: city_id,
            city_name: city_name,
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
            }
        });
    }
}

function fillInputCity(selectedAutocompleteItem) {
    var city_id = selectedAutocompleteItem.data("id");
    var city_name = selectedAutocompleteItem.html();
    $("input[name='city-id']").val(city_id);
    $("input[name='city-name']").val(city_name);
    $(".form-input-city").val(city_name);
    city_valid = true;
    hideCityAutocomplete();

    get_shipping_service();
}

function showCityAutocomplete() {
    $(".form-input-city-autocomplete").addClass("show");
    $(".city-autocomplete-item").first().addClass("active");
}

function hideCityAutocomplete() {
    $(".form-input-city-autocomplete").removeClass("show");
    $(".form-input-city-autocomplete").html("");
}

function get_checkout_cart() {
    ajaxCall(get_cart_url, null, function(json) {
        hideLoader(".custom-loader-container");
        var result = jQuery.parseJSON(json);
        total_qty = result.total_qty;
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
                if (data[i].category_id == 1) {
                    element += "<div class='checkout-item-size'>Size: " + data[i].item_size.toUpperCase() + "</div>";
                }
                element += "<div class='checkout-item-qty'>Qty: " + data[i].item_qty + "</div>";
                element += "</div>";
                element += "<div class='checkout-item-subtotal'>IDR " + data[i].item_subtotal + "</div>";
                element += "</div>";
            }
            $(".checkout-item-container").html(element);
            
        }
        $(".total-item-value-subtotal").html(result.total_subtotal);
        subtotal = parseInt((result.total_subtotal + "").replace(".", ""));
        get_discount();
    });
}

function get_discount() {
    ajaxCall(get_discount_url, null, function(json) {
        var result = jQuery.parseJSON(json);
        if (result.discount == "yes") {
            discount = subtotal / 10;
            $(".total-item-value-disc").html("-" + addThousandSeparator(discount));

            if (total != 0) {
                total = addThousandSeparator(subtotal - discount + shipping_cost);
                $(".total-item-value-total").html(total);
            }
        } else {
            discount = 0;
        }
    });
}

function get_city(keyword) {
    if (get_city_ajax != null) {
        get_city_ajax.abort();
    }

    showLoader();
    get_city_ajax = ajaxCall(get_city_url, {keyword: keyword}, function(json) {
        hideLoader();
        var result = jQuery.parseJSON(json);
        var iLength = result.length;
        if (iLength == 1 && result[0].id == "0") {

        } else {
            var element = "";
            for (var i = 0; i < iLength; i++) {
                element += "<div class='city-autocomplete-item' data-id='" + result[i].id + "'>" + result[i].value + "</div>";
            }
            $(".form-input-city-autocomplete").html(element);
            showCityAutocomplete();
        }
    });
}

function get_shipping_service() {
    showLoader();
    var city_id = $("input[name='city-id']").val();
    var city_name = $("input[name='city-name']").val();
    ajaxCall(get_shipping_cost_url, {city_id: city_id, city_name: city_name, total_qty: total_qty}, function(json) {
        hideLoader();
        var result = jQuery.parseJSON(json);
        
        /*var shipping_element = "";
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
            get_shipping_service_done = true;
            for (var i = 0; i < shipping[0].service.length; i++) {
                var service = shipping[0].service;
                service_element += "<option value='" + service[i].name + "' data-value='" + service[i].value + "'>" + service[i].name + " : IDR " + addThousandSeparator(service[i].value) + "</option>";
            }
            setShippingCost(shipping[0].service[0].value);
        } else {
            get_shipping_service_done = false;
        }*/

        shipping = [];
        var shipping_service = [];

        var service_element = "";
        for (var i = 0; i < result.length; i++) {
            service_element += "<option value='" + result[i].name + "' data-value='" + result[i].cost + "'>" + result[i].name + " IDR " + addThousandSeparator(result[i].cost) + " (" + result[i].time + ")" + "</option>";
            shipping_service.push({
                name: result[i].name,
                value: result[i].cost
            });
        }

        shipping.push({
            name: "JNE",
            service: shipping_service
        });

        if (result.length > 0) {
            get_shipping_service_done = true;
            setShippingCost(shipping[0].service[0].value);
        } else {
            get_shipping_service_done = false;
        }

        //$(".form-input-shipping").html(shipping_element);
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
    shipping_cost = parseInt(cost);
    total = addThousandSeparator(subtotal - discount + parseInt(cost));
    
    $(".total-item-value-tax").html(addThousandSeparator(cost));
    $(".total-item-value-total").html(total);
}
$(function() {
    get_checkout_cart();
    get_city();

    $(".form-input-city").on("change", function() {
        
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
                    element += "<div class='checkout-item-image checkout-item-col' style='background-image: url(" + product_url + "/" + data[i].item_id + "_1.png);'></div>";
                } else {
                    element += "<div class='checkout-item-image checkout-item-col' style='background-image: url(" + product_custom_url + "/" + data[i].shirt_custom_id + ".png);'></div>";
                    element += "<div class='checkout-item-image-design checkout-item-col' style='background-image: url(" + product_custom_url + "/" + data[i].design_custom_id + ".png);'></div>";
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
    });
}
$(function() {
    get_order();

    $(document).on("click", ".btn-view-details", function() {
        var modal = $(".modal-order-detail");
        modal.addClass("show");
        var order_item = $(this).closest(".order-item");
        get_order_detail(order_item);
        modal.find(".modal-box").one('webkitAnimationEnd oanimationend oAnimationEnd msAnimationEnd animationend', function(e) {
            modal.addClass("shown").removeClass("show");
		});
    });

    $(".modal-order-detail").on("modal-close", function() {
        $(".modal-order-detail-header-normal").html("0");
        $(".order-detail-subtotal").html("0");
        $(".order-detail-shipping-cost").html("0");
        $(".order-detail-discount").html("0");
        $(".order-detail-total").html("0");
        $(".modal-order-detail-table tbody").html("");
    });
});

function get_order() {
    ajaxCall(get_order_url, null, function(json) {
        hideLoader(".custom-loader-container");
        var result = jQuery.parseJSON(json);
        var iLength = result.length;
        var element = "";
        for (var i = 0; i < iLength; i++) {
            element += "<div class='order-item' data-order-id='" + result[i].hjual_id + "' data-total-price='" + result[i].hjual_total_price + "' data-discount='" + result[i].hjual_discount + "' data-shipping-cost='" + result[i].hjual_shipping_cost + "' data-grand-total-price='" + result[i].hjual_grand_total_price + "'>";
                element += "<div class='left-border'></div>";
                element += "<div class='order-item-inner'>";
                    element += "<div class='order-item-inner-left'>";
                        element += "<div class='order-item-row'>";
                            element += "<div class='order-item-label'>Order Number : </div>";
                            element += "<div class='order-item-value'>" + result[i].hjual_id + "</div>";
                        element += "</div>";
                        element += "<div class='order-item-row'>";
                            element += "<div class='order-item-label'>Total Payment : </div>";
                            element += "<div class='order-item-value'>IDR " + result[i].hjual_grand_total_price + "</div>";
                        element += "</div>";
                        element += "<div class='order-item-row'>";
                            element += "<div class='order-item-label'>Status : </div>";
                            element += "<div class='order-item-value'>";
                                var status_name = "";
                                switch (result[i].hjual_status) {
                                    case "1":
                                        status_name = "Waiting Payment";
                                        break;
                                    case "2":
                                        status_name = "Waiting Admin Confirmation";
                                        break;
                                    case "3":
                                        status_name = "Delivering";
                                        break;
                                    case "4":
                                        status_name = "Finished";
                                        break;
                                }
                                element += "<span class='status-badge' data-status='" + result[i].hjual_status + "'>" + status_name + "</span>";
                                if (result[i].hjual_status == "1") {
                                    element += "<a href='" + confirm_payment_url + "' class='btn-confirm-payment'>Confirm Payment</a>";
                                }
                            element += "</div>";
                        element += "</div>";
                        element += "<div class='order-item-row'>";
                            element += "<div class='order-item-label'>Shipping Number : </div>";
                            var shipping_number = "-";
                            if (result[i].hjual_nomor_resi != null) {
                                shipping_number = result[i].hjual_nomor_resi;
                            }
                            element += "<div class='order-item-value'>" + shipping_number + "</div>";
                        element += "</div>";
                    element += "</div>";
                    element += "<div class='order-item-inner-right'>";
                        element += "<div class='order-item-row'>";
                            element += "<div class='order-item-label'>Name : </div>";
                            element += "<div class='order-item-value'>" + result[i].pemesanan_first_name + " " + result[i].pemesanan_last_name + "</div>";
                        element += "</div>";
                        element += "<div class='order-item-row'>";
                            element += "<div class='order-item-label'>Address : </div>";
                            element += "<div class='order-item-value'>" + result[i].pemesanan_address + "</div>";
                        element += "</div>";
                        element += "<div class='order-item-row'>";
                            element += "<div class='order-item-label'>Phone : </div>";
                            element += "<div class='order-item-value'>" + result[i].pemesanan_handphone + "</div>";
                        element += "</div>";
                        element += "<div class='btn-view-details btn-view-details-view show'>View Details</div>";
                    element += "</div>";
                element += "</div>";
            element += "</div>";
        }

        $(".section-1-inner").html(element);
    });
}

function get_order_detail(order_item) {
    var order_id = order_item.attr("data-order-id");
    var total = order_item.attr("data-total-price");
    var shipping_cost = order_item.attr("data-shipping-cost");
    var discount = order_item.attr("data-discount");
    var grand_total = order_item.attr("data-grand-total-price");

    $(".modal-order-detail-header-normal").html(order_id);
    $(".order-detail-subtotal").html(total);
    $(".order-detail-shipping-cost").html(shipping_cost);
    $(".order-detail-discount").html(discount);
    $(".order-detail-total").html(grand_total);

    ajaxCall(get_order_detail_url, {order_id: order_id}, function(json) {
        var result = jQuery.parseJSON(json);
        var iLength = result.length;
        var element = "";
        for (var i = 0; i < iLength; i++) {
            element += "<tr data-index='" + i + "' data-id='" + result[i].item_id + "'>";
            element += "<td data-col='name'>";
            if (result[i].item_type == 1) {
                element += "<div class='order-detail-td-name-image' style='background-image: url(" + product_url + "/" + result[i].item_id + "_1.png);'></div>";
            } else {
                element += "<div class='order-detail-td-name-image-shirt' style='background-image: url(" + product_custom_url + "/" + result[i].shirt_custom_id + ".png);'></div>";
                element += "<div class='order-detail-td-name-image-design' style='background-image: url(" + product_custom_url + "/" + result[i].design_custom_id + ".png);'></div>";
            }
            element += "<div class='order-detail-td-name-text'>" + result[i].item_name + "</div>";
            element += "</td>";
            element += "<td data-col='size'>";
            element += result[i].item_size;
            element += "</td>";
            element += "<td data-col='price'>";
            element += "IDR " + result[i].item_price;
            element += "</td>";
            element += "<td data-col='qty'>" + result[i].item_qty + "</td>";
            element += "<td data-col='subtotal'>IDR " + result[i].djual_subtotal + "</td>";
            element += "</tr>";
        }
        $(".modal-order-detail-table tbody").html(element);
    });
}
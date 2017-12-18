$(function() {
    get_order();

    $(document).on("click", ".btn-view-details-view", function() {
        
    });

    $(document).on("click", ".btn-view-details-hide", function() {
        
    });
});

function get_order() {
    ajaxCall(get_order_url, null, function(json) {
        hideLoader(".custom-loader-container");
        var result = jQuery.parseJSON(json);
        var iLength = result.length;
        var element = "";
        for (var i = 0; i < iLength; i++) {
            element += "<div class='order-item'>";
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
                                    element += "<div class='btn-confirm-payment'>Confirm Payment</div>";
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
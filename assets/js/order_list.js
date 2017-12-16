$(function() {
    $(document).on("click", ".btn-view-details-view", function() {
        var orderItem = $(this).closest(".order-item");
        showDetails(orderItem);
    });

    $(document).on("click", ".btn-view-details-hide", function() {
        var orderItem = $(this).closest(".order-item");
        hideDetails(orderItem);
    });
});

function showDetails(orderItem) {
    orderItem.find(".order-item-detail").addClass("show");
    orderItem.find(".btn-view-details-view").removeClass("show");
    orderItem.find(".btn-view-details-hide").addClass("show");
}

function hideDetails(orderItem) {
    orderItem.find(".order-item-detail").removeClass("show");
    orderItem.find(".btn-view-details-hide").removeClass("show");
    orderItem.find(".btn-view-details-view").addClass("show");
}
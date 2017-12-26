$(function() {
    $(".btn-edit").on("click", function() {
        $(this).parent().removeClass("show");
        $(this).closest(".form-item").find(".form-edit").addClass("show");
    });

    $(".btn-cancel").on("click", function() {
        $(this).parent().removeClass("show");
        $(this).parent().prev().addClass("show");
    });
});
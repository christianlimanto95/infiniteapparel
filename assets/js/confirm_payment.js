$(function() {
    $(".input-bank").on("change", function() {
        var id = this.id;
        if (id == "bank-other") {
            $(".input-other-bank").addClass("show");
            $(".input-other-bank").select();
        } else {
            $(".input-other-bank").removeClass("show");
        }
    });
});
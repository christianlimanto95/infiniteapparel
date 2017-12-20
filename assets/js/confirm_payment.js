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

    $(".form-input-proof").on("change", function() {
		var previewElement = $(".proof-image");
		var reader = new FileReader();
		reader.onload = function(e) {
			previewElement.attr("src", e.target.result);
		};
		reader.readAsDataURL($(this)[0].files[0]);
	});

    $(".btn-confirm-payment").on("click", function() {
        clearAllErrors();
        var valid = true;
        var bank = $(".input-bank:checked").val();
        if (bank == undefined) {
            valid = false;
            $(".bank-error").html("Choose bank");
        } else {
            if (bank == "other") {
                var value = $(".input-other-bank").val().trim();
                if (value == "") {
                    valid = false;
                    $(".bank-error").html("Fill bank name");
                } else {
                    bank = value;
                }
            }
        }

        var bank_account_number = $(".form-input-account-number").val().trim();
        if (bank_account_number == "") {
            valid = false;
            $(".bank-account-number-error").html("Required");
        }

        var bank_account_name = $(".form-input-account-name").val().trim();
        if (bank_account_name == "") {
            valid = false;
            $(".bank-account-name-error").html("Required");
        }

        if ($(".form-input-proof")[0].files.length == 0) {
            valid = false;
            $(".proof-of-payment-error").html("Required");
        }

        if (valid) {
            
        }
    });
});
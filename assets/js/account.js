$(function(){$(".btn-edit").on("click",function(){$(".form-edit").removeClass("show");$(".custom-form-input").addClass("show");$(this).parent().removeClass("show");$(this).closest(".form-item").find(".form-edit").addClass("show")});$(".btn-cancel").on("click",function(){$(this).parent().removeClass("show");$(this).parent().prev().addClass("show");clearAllErrors()});$(".form-edit").on("submit",function(e){clearAllErrors();var valid=!0;var data_form_edit=$(this).data("form-edit");switch(data_form_edit){case "name":var value=$(this).find(".form-input-first-name").val().trim();if(value==""){valid=!1;$(".error-name").html("First Name Required")}
break;case "address":var value=$(this).find(".form-input").val().trim();if(value==""){valid=!1;$(".error-address").html("Address cannot be empty")}
break;case "handphone":var value=$(this).find(".form-input").val().trim();if(value==""){valid=!1;$(".error-phone").html("Phone Number cannot be empty")}
break;case "password":var currentPassword=$(this).find(".form-input-current-password").val().trim();if(currentPassword==""){valid=!1;$(".error-current-password").html("Current Password is required")}
var newPassword=$(this).find(".form-input-new-password").val().trim();if(newPassword==""){valid=!1;$(".error-new-password").html("New Password is required")}
var confirmPassword=$(this).find(".form-input-confirm-password").val().trim();if(confirmPassword==""){valid=!1;$(".error-confirm-new-password").html("Confirm New Password is required")}else if(confirmPassword!=newPassword){valid=!1;$(".error-confirm-new-password").html("Confirm New Password does not match New Password")}
break}
if(valid){showLoader()}else{e.preventDefault()}})})
var ctrImage = 1;
$(function() {
	$("textarea").keydown(function(e) {
		if (e.which == 9)
		{
			e.preventDefault();
			var value = $(this).val();
			value += "\t";
			$(this).val(value);
		}
	});

	$(document).on("change", ".input-image", function() {
		var rightExtension = true;
		
		var dataCtr = $(this).attr("data-ctr");
		var fileName = this.files[0].name;
		var dotIndex = fileName.lastIndexOf(".");
		var extension = fileName.substring(dotIndex + 1);
		if (dataCtr == "1") {
			if (extension != "png") {
				rightExtension = false;
				$(this).val("");
				alert("Gambar pertama harus extensi .png");
			}
		} else {
			if (extension != "jpg") {
				rightExtension = false;
				$(this).val("");
				alert("Gambar kedua dan seterusnya harus extensi .jpg");
			}
		}

		if (rightExtension) {
			var validProof = true;
			var previewElement = $(this).next();
			var reader = new FileReader();
			reader.onload = function(e) {
				previewElement.attr("src", e.target.result);
			};
			var size = this.files[0].size;
			if (size > 5242880) {
				validProof = false;
				alert("ukuran file harus di bawah 32 mb");
				$(this).val("");
			} else {
				reader.readAsDataURL($(this)[0].files[0]);
			}
		}
	});

	$(".btn-add-image").on("click", function() {
		ctrImage++;
		var element = "<input type='file' name='image_" + ctrImage + "' data-ctr='" + ctrImage + "' class='input-image' /><img class='preview' data-ctr='" + ctrImage + "' />";
		$(".input-image-container").append(element);
	});

	$(".btn-remove-image").on("click", function() {
		if (ctrImage > 1) {
			$(".input-image[data-ctr='" + ctrImage + "']").remove();
			$(".preview[data-ctr='" + ctrImage + "']").remove();
			ctrImage--;
		}
	});
});
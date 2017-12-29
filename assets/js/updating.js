$(document).ready(function() {
	$("#cbId").change(function() {
		$("#formIdBarang").submit();
	});
	
	$("textarea").keydown(function(e) {
		if (e.which == 9)
		{
			e.preventDefault();
			var value = $(this).val();
			value += "\t";
			$(this).val(value);
		}
	});
});
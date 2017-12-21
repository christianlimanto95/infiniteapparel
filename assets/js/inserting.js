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
});
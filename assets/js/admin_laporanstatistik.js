$(function() {
	$("#navigation").val(navigation);
	
	var dateFrom = $(".dateFrom").val();
	var dateTo = $(".dateTo").val();
	
	$(".dateFrom").datepicker().on("changeDate", function(e) {
		var newDateFrom = $(".dateFrom").val();
		if (dateFrom != newDateFrom)
		{
			dateFrom = newDateFrom;
			
			var endDate = new Date(e.date.valueOf());
			endDate.setDate(endDate.getDate(new Date(e.date.valueOf())));
			$('.dateTo').datepicker('setStartDate', endDate);
			
			dateTo = $(".dateTo").val();
			if (dateTo != "")
			{
				$("#formLaporanPenjualan").submit();
			}
		}
	}).on("show", function(e) {
		$(".datepicker-days").css("display", "block");
	});
	
	$(".dateTo").datepicker().on("changeDate", function(e) {
		var newDateTo = $(".dateTo").val();
		if (dateTo != newDateTo)
		{
			dateTo = newDateTo;
			
			var startDate = new Date(e.date.valueOf());
			startDate.setDate(startDate.getDate(new Date(e.date.valueOf())));
			$('.dateFrom').datepicker('setEndDate', startDate);
			
			dateFrom = $(".dateFrom").val();
			if (dateFrom != "")
			{
				$("#formLaporanPenjualan").submit();
			}
		}
	}).on("show", function(e) {
		$(".datepicker-days").css("display", "block");
	});
	
	$(".result-each").click(function() {
		var href = $(this).data("href");
		window.location.assign(href);
	});
});
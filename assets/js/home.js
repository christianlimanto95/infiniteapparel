$(function() {
	if ($(window).scrollTop() > 0) {
		$(document).on("scroll", checkHeaderScrollDown);
	} else {
		$(document).on("scroll", checkHeaderScrollUp);
	}
	$(document).scroll();
});

function checkHeaderScrollDown() {
	if ($(window).scrollTop() > 0) {
		$(".logo").off('webkitAnimationEnd oanimationend oAnimationEnd msAnimationEnd animationend');
		header.removeClass("animated").removeClass("animating-close").addClass("animating");
		$(".logo").one('webkitAnimationEnd oanimationend oAnimationEnd msAnimationEnd animationend', function(e) {
			header.addClass("animated").removeClass("animating");
		});
		$(document).off("scroll", checkHeaderScrollDown);
		$(document).on("scroll", checkHeaderScrollUp);
	}
}

function checkHeaderScrollUp() {
	if ($(window).scrollTop() == 0) {
		$(".logo").off('webkitAnimationEnd oanimationend oAnimationEnd msAnimationEnd animationend');
		header.addClass("animated").removeClass("animating").addClass("animating-close");
		
		$(document).on("scroll", checkHeaderScrollDown);
		$(document).off("scroll", checkHeaderScrollUp);
	}
}
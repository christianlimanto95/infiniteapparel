$("body").on("allLoaded", function() {
	$(".section-1").addClass("show");
});

var section1, section2, section2Threshold, section3, section3Threshold;

$(function() {
	section1 = $(".section-1");
	section2 = $(".section-2");
	section3 = $(".section-3");

	setVH();
	setSectionThreshold();
	
	container.on("scroll", checkHeaderScrollDown);
	container.on("scroll", checkSection2Threshold);
	container.on("scroll", checkSection3Threshold);
	container.scroll();
});

function setVH() {
    vh100 =  parseInt(section1.css("height"));
}

function setSectionThreshold() {
    section2Threshold = section1.offset().top + vh100 / 1.5;
    if (!isMobile) {
        section3Threshold = section2.offset().top + container.scrollTop() + parseInt(section2.css("height")) / 2;
    } else {
        section3Threshold = section2.offset().top + container.scrollTop() + parseInt(section2.css("height")) / 6;
    }
}

function checkHeaderScrollDown() {
	if (container.scrollTop() > 0) {
		$(".logo").off('webkitAnimationEnd oanimationend oAnimationEnd msAnimationEnd animationend');
		header.removeClass("animated").removeClass("animating-close").addClass("animating");
		$(".logo").one('webkitAnimationEnd oanimationend oAnimationEnd msAnimationEnd animationend', function(e) {
			header.addClass("animated").removeClass("animating");
		});
		container.off("scroll", checkHeaderScrollDown);
		container.on("scroll", checkHeaderScrollUp);
	}
}

function checkHeaderScrollUp() {
	if (container.scrollTop() == 0) {
		$(".logo").off('webkitAnimationEnd oanimationend oAnimationEnd msAnimationEnd animationend');
		header.addClass("animated").removeClass("animating").addClass("animating-close");
		$(".logo").one('webkitAnimationEnd oanimationend oAnimationEnd msAnimationEnd animationend', function(e) {
			header.removeClass("animated").removeClass("animating-close");
		});
		container.on("scroll", checkHeaderScrollDown);
		container.off("scroll", checkHeaderScrollUp);
	}
}

function checkSection2Threshold() {
	if (container.scrollTop() > section2Threshold) {
		section2.addClass("show");
		container.off("scroll", checkSection2Threshold);
	}
}

function checkSection3Threshold() {
	if (container.scrollTop() > section3Threshold) {
		section3.addClass("show");
		container.off("scroll", checkSection3Threshold);
	}
}
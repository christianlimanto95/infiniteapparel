$("body").on("allLoaded", function() {
	var preloader = $(".preloader");
	if (!preloader.hasClass("hidden")) {
		setTimeout(function() {
			preloader.addClass("hide");
			setTimeout(function() {
				preloader.addClass("hidden");
				$(".section-1").addClass("show");
			}, 1200);
		}, 2800);
	} else {
		$(".section-1").addClass("show");
	}
});

var section1, section2, section2Threshold, section3, section3Threshold;

$(function() {
	section1 = $(".section-1");
	section2 = $(".section-2");
	section3 = $(".section-3");

	setVH();
	setSectionThreshold();

	if (!isMobile) {
		container.on("scroll", checkHeaderScrollDown);
		container.on("scroll", setParalax);
	} else {
		container.off("scroll", checkHeaderScrollDown);
		container.off("scroll", setParalax);
	}
	
	container.on("scroll", checkSection2Threshold);
	container.on("scroll", checkSection3Threshold);
	
	var section1Image = $(".section-1-image");
	var btnExplore = $(".explore-products-container");
	container.scroll();

	$(".btn-buy-now, .btn-add-to-bag").on("click", function(e) {
		e.preventDefault();
	});

	$(window).on("resize", function() {
		setVH();
		setSectionThreshold();
		
		if (!isMobile) {
			container.on("scroll", checkHeaderScrollDown);
			container.on("scroll", setParalax);
		} else {
			container.off("scroll", checkHeaderScrollDown);
			container.off("scroll", setParalax);
		}

		container.on("scroll", checkSection2Threshold);
		container.on("scroll", checkSection3Threshold);
	});
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

function setParalax() {
	section1Image.css("transform", "translateY(" + (container.scrollTop() / 1.5) + "px)");
	btnExplore.css("transform", "translateY(" + (container.scrollTop() / 3) + "px)");
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
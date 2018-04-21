$(function(){
	var mySwiper1 = new Swiper('#swiper-container1', {
		watchSlidesProgress: true,
		watchSlidesVisibility: true,
		allowSwipeToNext : false,
		allowSwipeToPrev : false,
		slidesPerView: 2,
		onTap: function() {
			mySwiper2.slideTo(mySwiper1.clickedIndex)
		}
	})

	var isLoadVideoArr = [];
	var mySwiper2 = new Swiper('#swiper-container2', {

		autoHeight: true,
		freeModeMomentumBounce: false,
		onSlideChangeStart: function() {
			updateNavPosition()
		},
		onSetTranslate: function(){
		}

	})

	function updateNavPosition() {
		$('#swiper-container1 .active-nav').removeClass('active-nav')
		var activeNav = $('#swiper-container1 .swiper-slide').eq(mySwiper2.activeIndex).addClass('active-nav');
		if (!activeNav.hasClass('swiper-slide-visible')) {
			if (activeNav.index() > mySwiper1.activeIndex) {
				var thumbsPerNav = Math.floor(mySwiper1.width / activeNav.width()) - 1
				mySwiper1.slideTo(activeNav.index() - thumbsPerNav)
			} else {
				mySwiper1.slideTo(activeNav.index())
			}
		}
	}
	$("#swiper-container2").delegate(".video-wrap", "click", function(){
		var t = $(this), video = t.find("video"), id = video.attr("id"), videoObj = document.getElementById(id), bg = t.find('.bg');
		if(videoObj.paused && $.inArray(id, isLoadVideoArr) ){
			isLoadVideoArr.push(id);
			t.addClass("video-wrap-nb");
			video.show();bg.hide();
			videoObj.play();
		}
	});
	// $('.dynamic_lead ul li').click(function(){
	// 	var  u = $(this);
	// 	var index = u.index();
	// 	$('.dynamic_list .dynamic_tc_list').eq(index).show();
	// 	$('.dynamic_list .dynamic_tc_list').eq(index).siblings().hide();
	// 	u.addClass('active-nav');
	// 	u.siblings('li').removeClass('active-nav');
	// })
})
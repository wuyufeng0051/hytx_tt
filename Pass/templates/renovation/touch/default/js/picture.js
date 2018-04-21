$(function() {
	var device = navigator.userAgent;
	if (device.indexOf('huoniao_iOS') > -1) {
		$('body').addClass('padTop20');
	}

	var height = $(window).height()-$('.photo-head-h').height() - $('.space').height() ;
	$('.swiper-container,.swiper-slide').css('height',height);
	$('.swiper-slide').css('line-height',height+'px');


	var mySwiper = new Swiper('.swiper-container', {
		onSlideChangeStart: function(swiper){
			getImage(swiper.activeIndex);
		},
        preloadImages: false,
        lazyLoading: true
	});


	var  atPage = 0;
	getImage(atPage);

	function getImage(index){
		var li = $(".swiper-container li:eq("+index+")"), type = li.data("type"), img = li.find("img"), src = img.data("src"), alt = img.attr("alt");

		img.attr("src", src);
		$(".f14").html(alt);
	}

	$('.swiper-container').click(function(){
		if ($('.photo-head').css("display")=="none") {
			$('.photo-head,.f10,.btn-box').show();
		}else{
			$('.photo-head,.f10,.btn-box').hide();
		}
	})
})

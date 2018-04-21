$(function(){

	var mySwiper = new Swiper('.swiper-container', {
		loop : true,
		pagination: '.swiper-pagination',
		paginationType: 'fraction',
	})

// function check(){
// 	$('#page-index').text(mySwiper.activeIndex + 1);
// 	$('#page-num').text($('.swiper-slide').length)
// }

// setInterval(check, 100);


	$('.h-menu').on('click', function() {
		if ($('.nav,.mask').css("display") == "none") {
			$('.nav,.mask').show();
			$('.header').css('z-index', '101');

		} else {
			$('.nav,.mask').hide();
			$('.header').css('z-index', '99');

		}
	})
	$('.mask').on('touchmove', function() {
		$(this).hide();
		$('.nav').hide();

	})
	$('.mask').on('click', function() {
		$(this).hide();
		$('.nav').hide();
		$('.header').css('z-index', '99');

	})

	$('.more_xq').click(function() {
		$('.esf-info-con').toggleClass('close');
	})

})
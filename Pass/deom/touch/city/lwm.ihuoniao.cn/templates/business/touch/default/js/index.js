$(function(){


	//导航
	$('.header-r').click(function(){

		var nav = $('.nav'),
		      t = $('.nav').css('display') == "none";

		if (t) {nav.show();}else{nav.hide();}


	})

	// 滑动导航
	var mySwiper = new Swiper('.mainNav',{pagination : '.swiper-pagination',})
	var NewSwiper = new Swiper('.bd',{autoplay : 5000,loop : true,onlyExternal : true,})
	var HotSwiper = new Swiper('.hot-list', {freeMode: true,freeModeFluid: true,spaceBetween: 10,slidesPerView: 'auto',cssWidthAndHeight: false});


})
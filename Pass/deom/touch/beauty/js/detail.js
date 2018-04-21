$(function(){
	var init = true;
	$('.top_area .search_area').click(function(){
		$('.jubao').show();
	})
	$('.white .cancle').click(function(){
		$('.jubao').hide();
	})
	$('.jubao p').click(function(){
		$('.jubao').hide();
	})
	$('.bottom .liao_tian').click(function(){
		$('.grey').show();
		$('.chajian').show();
		if(init){
			swripInit();
		}
	})
	$('.grey img').click(function(){
		$(this).parent().hide();
		$('.chajian').hide();
	})
	$(window).scroll(function(){
		$('.top_area').addClass('color')
	})
	function swripInit(){
		init = false;
		var mySwiper = new Swiper(".swiper-container",{
		    slidesPerView: "auto",
		    centeredSlides: !0,
		    watchSlidesProgress: !0,
		    pagination: ".swiper-pagination",
		    paginationClickable: !0,
		    
		    onProgress: function(a) {
		        var b, c, d;
		        for (b = 0; b < a.slides.length; b++)
		            c = a.slides[b],
		            d = c.progress,
		            scale = 1 - Math.min(Math.abs(.2 * d), 1),
		            es = c.style,
		            es.opacity = 1 - Math.min(Math.abs(d / 2), 1),
		            es.webkitTransform = es.MsTransform = es.msTransform = es.MozTransform = es.OTransform = es.transform = "translate3d(0px,0," + -Math.abs(150 * d) + "px)"
		    },
		    onSetTransition: function(a, b) {
		        for (var c = 0; c < a.slides.length; c++)
		            es = a.slides[c].style,
		            es.webkitTransitionDuration = es.MsTransitionDuration = es.msTransitionDuration = es.MozTransitionDuration = es.OTransitionDuration = es.transitionDuration = b + "ms"
		    }
		});

	}

	
})
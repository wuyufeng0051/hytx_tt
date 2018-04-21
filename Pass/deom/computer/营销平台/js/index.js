$(function(){
	// 选择时段
	$('.main .content_box .content .con_txt .screen .week ul li').click(function(){
		var x = $(this);
		x.addClass('scr_bc');
		x.siblings().removeClass('scr_bc');
	})


	// 自定义时间段
	$('.main .content_box .content .con_txt .screen .week ul li').click(function(){
		if ($('.ziding').hasClass('scr_bc')) {
			$('.time').show();
		}else{
			$('.time').hide();
		};
	})

	// 左侧栏吸顶
	var Ggoffset = $('.ce').offset().top;
	$(window).bind("scroll",function(){
		var d = $(document).scrollTop()+2;
		if(Ggoffset < d){
			$('.ce').addClass('fixed');
		}else{
			$('.ce').removeClass('fixed');
		}
	});
	
})
$(function(){
	// 首页幻灯片
	$('.list').slide({mainCell:".bd", titCell:".hd ul li", autoPlay:true,effect:"fold"})

	// 房产tab切换
	$('.main .main_right .house .house_news .hn_lead ul li').hover(function(){
		var x = $(this),
			index = x.index();
		$('.hn_list .hn_txt').eq(index).show();
		$('.hn_list .hn_txt').eq(index).siblings().hide();
		x.addClass('hn_bc');
		x.siblings().removeClass("hn_bc");
	})
	// 左侧导航栏置顶
	var Ggoffset = $('.main_left').offset().top;
	$(window).bind("scroll",function(){
		var d = $(document).scrollTop();
		if(Ggoffset < d){
			$('.main_left').addClass('fixed');
		}else{
			$('.main_left').removeClass('fixed');
		}
	});
})
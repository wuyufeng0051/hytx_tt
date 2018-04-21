$(function(){
	// 首页幻灯片
	$('.list').slide({mainCell:".bd", titCell:".hd ul", autoPlay:true,autoPage:true,effect:"fold"})
	// 左侧导航栏置顶
	var Ggoffset = $('.main_left').offset().top;
	$(window).bind("scroll",function(){
		var d = $(document).scrollTop()+40;
		if(Ggoffset < d){
			$('.main_left').addClass('fixed');
		}else{
			$('.main_left').removeClass('fixed');
		}
	});
})
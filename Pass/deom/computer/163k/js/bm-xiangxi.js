$(function(){
	// 图片
	$('.highslide-gallery').slide({mainCell:".bd ul",
	 autoPlay:true, autoPage:true,vis:6,effect:"left"});
	// 联系我们
	$('.service-lead ul li').hover(function(){
		var x = $(this);
		var index = x.index();
		$('.service-txt ul li').eq(index).show();
		$('.service-txt ul li').eq(index).siblings().hide();
		x.addClass('selected');
		x.siblings("li").removeClass('selected');
	})
	// 评论
	$('.report a span').click(function(){
		$('.service-txt ul li').hide();
		$('.comment').show();
		$('.service-lead li:last').addClass('selected').siblings("li").removeClass('selected');

	})
	// 地图
		$('.mapr-l ul li').click(function(){
		var s = $(this);
		var index = s.index();
		$('.mapr-m ul ').eq(index).show();
		$('.mapr-m ul ').eq(index).siblings().hide();
		s.addClass('yop');
		s.siblings("li").removeClass('yop');
	})

})
	


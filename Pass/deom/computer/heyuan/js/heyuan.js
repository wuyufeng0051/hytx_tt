$(function(){
	// 导航条
	$('.box_1200 .tt').hover(function(){
			var i = $(this);
			i.addClass("onChannel");
		}, function(){
			var i = $(this);
			i.removeClass("onChannel");
	})

	// 幻灯片
	$('.flash ').slide({mainCell:".bd", titCell:".hd ul", autoPlay:true, autoPage:true,effect:"fold"})	

	// 打折情报站
	$('.box_1200').slide({mainCell:"#scrollDiv_keleyi_com ul ",autoPage:true,effect:"topLoop",autoPlay:true,vis:5});

	// 新房中心
	$('.xin-f .fang-toggle ').hover(function(){
		var  u = $(this);
		var index = u.index();
		$('.xin-f1 .fang-list').eq(index).show().animate({opacity:1});
		$('.xin-f1 .fang-list').eq(index).siblings().hide().css('opacity', 0);
		u.addClass('cur-fang');
    	u.siblings('.fang-toggle ').removeClass('cur-fang');
	})


	// 二手房
	$('.ershou-l .tab-toggle ').hover(function(){
		var  u = $(this);
		var index = u.index();
		$('.zufang-t .zufang-right-box').eq(index).show().animate({opacity:1});
		$('.zufang-t .zufang-right-box').eq(index).siblings().hide().css('opacity', 0);
		u.addClass('cur-tab');
    	u.siblings('.tab-toggle ').removeClass('cur-tab');
	})

	// 建材商城
	$('.listTitle7 .ui-corner-top ').hover(function(){
		var  u = $(this);
		var index = u.index();
		$('.tab7con .hidden').eq(index).show().animate({opacity:1});
		$('.tab7con .hidden').eq(index).siblings().hide().css('opacity', 0);
		u.addClass('nc');
    	u.siblings('.ui-corner-top ').removeClass('nc');
	})
})
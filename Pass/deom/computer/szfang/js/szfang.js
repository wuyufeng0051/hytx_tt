$(function(){
	// 滚动条
	$(".attitude").mCustomScrollbar({theme:"minimal-dark"});
	// 头部导航栏
	$('.lead-s .s5').hover(function(){
			var i = $(this);
			i.addClass("on");
		}, function(){
			var i = $(this);
			i.removeClass("on");
	})
	$('.newnavnr .s4a').hover(function(){
			var i = $(this);
			i.addClass("on");
		}, function(){
			var i = $(this);
			i.removeClass("on");
	})

	// 幻灯片
	$('#dsy_D02_16').slide({mainCell:"#banner_show ", titCell:"#banner_ctr", autoPlay:true, autoPage:true,effect:"fold"})	
	// 房产快讯 
	$("#feature-slide-block").slide({titCell:"#feature-slide-list-items",mainCell:".ne-list",effect:"fold",autoPage:true,autoPlay:true,
prevCell:".feature-slide-list #feature-slide-list-previous",nextCell:".feature-slide-list #feature-slide-list-next"});

	// 搜索栏
	$('.s1 a').hover(function(){
			var u = $(this);
			var index = u.index();
			$('.news03 .search-ll').eq(index).show();
			$('.news03 .search-ll').eq(index).siblings().hide();
			u.addClass("cur");
			u.siblings('a').removeClass('cur');
	})


	// 热销楼盘
	$('.tetit .s2').hover(function(){
		var  u = $(this);
		var index = u.index();
		$('.yy .tenr').eq(index).show();
		$('.yy .tenr').eq(index).siblings().hide();
		u.addClass('s1');
    	u.siblings('.s2').removeClass('s1');
	})

	// 新房列表
	$('.tit655 .s2').hover(function(){
		var  x = $(this)
		var box = x.closest('.a978');
		var index = x.index();
		box.find('.a655nr').eq(index).show();
		box.find('.a655nr').eq(index).siblings().hide();
		x.addClass('s1');
    	x.siblings('.s2').removeClass('s1');
	})
	// 家居装修
	$('.item').hover(function(){
			var x = $(this);
			x.find('.item-list').show();
		}, function(){
			$(this).find('.item-list').hide();
		})

	$('.item').hover(function(){
			var i = $(this);
			i.addClass("hover");
		}, function(){
			var i = $(this);
			i.removeClass("hover");
		})

	// 房地产排行榜
	$('.phtita .s2').hover(function(){
		var  x = $(this)
		var box = x.closest('.l382');
		var index = x.index();
		box.find('.paihang-1').eq(index).show();
		box.find('.paihang-1').eq(index).siblings().hide();
		x.addClass('s1');
    	x.siblings('.s2').removeClass('s1');
	})
	$('.phtita .s2').hover(function(){
		var  x = $(this)
		var box = x.closest('.l370');
		var index = x.index();
		box.find('.paihang-1').eq(index).show();
		box.find('.paihang-1').eq(index).siblings().hide();
		x.addClass('s1');
    })	
    $('.phtita .s2').hover(function(){
		var  x = $(this)
		var box = x.closest('.l330r');
		var index = x.index();
		box.find('.paihang-1').eq(index).show();
		box.find('.paihang-1').eq(index).siblings().hide();
		x.addClass('s1');
    })	

})
$(function(){
	// 网站导航
	$('.area a').click(function(){
		var x = $(this);
		var index = x.index();
    	x.addClass('area_bc');
    	x.siblings('a').removeClass('area_bc');
	})
	// 搜索框选择
	$('.choice_list p').click(function(){
		var  x = $(this);
		var  b = x.text();
		$('.choice em').text(b);
	})
	// 地区选择
	$('.lo_lead  li').hover(function(){
		var  u = $(this);
		var index = u.index();
		$('.city ul').eq(index).show();
		$('.city ul').eq(index).siblings().hide();
		u.addClass('location_bc');
		u.siblings('li').removeClass('location_bc');
	})
	// 头部下拉菜单
	$('.lead .lead_list .ll').hover(function(){
		var x = $(this);
		x.closest('.lead').find('.con_tent ').show();
	}, function(){
		$(this).closest('.lead').find('.con_tent ').hide();
	})
	$('.pl_left ul li').hover(function(){
		var  u = $(this);
		var index = u.index();
		$('.pl_list .pl_right').eq(index).show();
		$('.pl_list .pl_right').eq(index).siblings().hide();
		u.addClass('pro_lead_bc');
		u.siblings('li').removeClass('pro_lead_bc');
	})
})
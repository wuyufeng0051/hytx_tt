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
	// 劳动争议知识
	$('.know_com ul li').hover(function(){
		var  u = $(this);
		var index = u.index();
		$('.know_list .kn_t').eq(index).show();
		$('.know_list .kn_t').eq(index).siblings().hide();
		u.addClass('zq');
		u.siblings('li').removeClass('zq');
	})
	// 友情链接
	$('.p8_lead ul li').hover(function(){
		var  u = $(this);
		var index = u.index();
		$('.p8_txt .p8_list').eq(index).show();
		$('.p8_txt .p8_list').eq(index).siblings().hide();
		u.addClass('p8_bc');
		u.siblings('li').removeClass('p8_bc');
	})



	// 按地区找律师
	$('.areabox select').change(function(){
		var t = $(this), val = t.val(), parent = t.closest('.areabox');
		parent.find('span em').text(val);
	})

	// 热门话题
	$('.part_2 .hot .hot_d select').change(function(){
		var t = $(this), val = t.val(), parent = t.closest('.select-item');
		parent.find('span em').text(val);
	})


	// 委托我们的优势
	$('.part_3 .advantage .adv_1 select').change(function(){
		var t = $(this), val = t.val(), parent = t.closest('.select-item');
		parent.find('span em').text(val);
	})



})

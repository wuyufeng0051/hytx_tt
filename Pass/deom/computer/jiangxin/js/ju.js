$(function(){
	$('.list-3').slide({mainCell:".bd", titCell:".hd ul", autoPlay:true, autoPage:true,effect:"fold",prevCell:".prev",nextCell:".next"});
	$('.list-4').slide({mainCell:".bd", titCell:".hd ul", autoPlay:true, autoPage:true,effect:"fold",prevCell:".prev",nextCell:".next"});



	// 导航栏
	$('#JS_mll_menu_map  li').hover(function(){
		$(this).addClass('hover');
	},function(){
		$(this).removeClass('hover');
	})
	// 楼层复选
	$('#JS_floor_nav_1 li').hover(function(){
		var  u = $(this);
		var index = u.index();
		var dom = u.closest('.w').find('.fol_1 .floor-right');
		dom.eq(index).show();
		dom.eq(index).siblings().hide();
		u.addClass('hover');
		u.siblings('li').removeClass('hover');
	})
})
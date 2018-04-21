$(function(){
	$('.sc_1 ul li').click(function(){
		var  u = $(this);
		u .hide();
	})
	// 排行榜
	$('.rank ul li').hover(function(){
		var  u = $(this);
		var index = u.index();
		$('.rank_tab .rank_list').eq(index).show();
		$('.rank_tab .rank_list').eq(index).siblings().hide();
		u.addClass('rank_bc');
		u.siblings('li').removeClass('rank_bc');
	})
})
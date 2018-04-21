$(function(){
	$('.more a').hover(function(){
		var x = $(this),
			index = x.index();
		$('.rank_list .rank_txt').eq(index).show();
		$('.rank_list .rank_txt').eq(index).siblings().hide();
		x.addClass('rank_bc').siblings().removeClass('rank_bc');
	})
})
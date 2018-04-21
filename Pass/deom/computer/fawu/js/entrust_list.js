$(function(){
	$('.type  ul li').click(function(){
		var  u = $(this);
		var index = u.index();
		u.addClass('en_bc');
		u.siblings('li').removeClass('en_bc');
	})

	// 服务内容
	$('.money_list .ml_txt').click(function(){
		var  u = $(this);
		var index = u.index();
		$('.fu_list .fu_1').eq(index).show();
		$('.fu_list .fu_1').eq(index).siblings().hide();
		u.addClass('en_bc');
		u.siblings('.ml_txt').removeClass('en_bc');
	})
})
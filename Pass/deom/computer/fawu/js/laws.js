$(function(){
	$('.pl_lead ul li').hover(function(){
		var  u = $(this);
		var index = u.index();
		$('.pl_list .pp').eq(index).show();
		$('.pl_list .pp').eq(index).siblings().hide();
		u.addClass('on');
		u.siblings('li').removeClass('on');
	})
})
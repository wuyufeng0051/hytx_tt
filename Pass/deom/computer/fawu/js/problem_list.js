$(function(){
	$('.sc_1 ul li').click(function(){
		var  u = $(this);
		var index = u.index();
		u.addClass('sc_bc');
		u.siblings('li').removeClass('sc_bc');
	})
})
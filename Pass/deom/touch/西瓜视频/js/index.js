$(function(){
	$('.menu_list a').click(function(){
		var x = $(this);
		x.addClass('menu_bc').siblings().removeClass('menu_bc');
	})
})
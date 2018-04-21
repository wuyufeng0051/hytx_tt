$(function(){
	$('.list .list_left .list_smail_pic ul li').click(function(){
		var x = $(this),
			index = x.index();
		$('.list_main_pic ul li').eq(index).show().siblings().hide();
		x.addClass('smail_bc');
		x.siblings().removeClass('smail_bc');
	})
	$('.list .list_right .color ul li').click(function(){
		var x = $(this);
		x.addClass('color_bc').siblings().removeClass('color_bc');
	})
	$('.list .list_right .infor span').click(function(){
		var x = $('.all_car');
		if (x.css('display','none')) {
			$('.disk').show();
			x.show();
		}else{
		};
	})
	$('.all_car .all_lead i').click(function(){
		$('.all_car').hide();
		$('.disk').hide();
	})
})
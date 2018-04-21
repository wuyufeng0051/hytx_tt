$(function(){

	
	// 查看更多车款
	$('.on_sale .os_more span').click(function(){
		var x = $(this);
		if ($('.os_list').hasClass('auto')) {
			$('.os_list').removeClass('auto');
		}else{
			$('.os_list').addClass('auto');
		};
	})


	// 选择省市
	$('.dealer .dealer_lead .name .place .place_box ul li').click(function(){
		var x = $(this);
		x.addClass('plb_bc');
		x.siblings().removeClass('plb_bc');
	})


	// 选择地区
	$('.dealer .dealer_choice dl dd ul.ch_first li').click(function(){
		var x = $(this);
		x.addClass('chf_bc');
		x.siblings().removeClass('chf_bc');
	})


})
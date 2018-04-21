$(function(){
	// 案情反馈
	$('.p3l_lead span').click(function(){
		var x = $(this);
		x.hide();
		$('.p3l_lead p').show();
		$('.wenben_1').hide();
		$('.wenben').show();
	})

	$('.part_3 .p3_left .p3l_down ul li span').click(function(){
		var x = $(this);
		var find = x.closest('li');
		find.hide()
	})
})
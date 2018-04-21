$(function(){

	// 日期tab切换
	$('.data_nav ul li').click(function(){
		var x = $(this),
			index = x.index();
		x.addClass('dn_bc').siblings().removeClass('dn_bc');
		$(".time_box .time_list").eq(index).show().siblings().hide();
	})
})
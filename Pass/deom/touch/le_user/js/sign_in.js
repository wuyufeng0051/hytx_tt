$(function(){
	$('.qd_list .on').click(function(){
		$(this).hide();
		$('.shuru').hide();
		$('.gift').hide();
		$('.qd_list .down').show();
		$('.qd_list').css('margin-bottom','0.2rem');
	})
})
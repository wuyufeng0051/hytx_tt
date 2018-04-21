$(function(){

	// 联系方式弹出层
	$('.mer_detail .tel').click(function(){
		$('.phone').show();
		$('.disk').show();
	})
	$('.close').click(function(){
		$('.phone').hide();
		$('.disk').hide();
	})
	$('.disk').click(function(){
		$('.phone').hide();
		$('.disk').hide();
	})
})
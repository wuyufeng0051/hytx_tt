$(function(){
	// 取消订单
	$('.indent_information h1 em').click(function(){
		if ($('.sure').css('display','none')) {
			$('.disk').show();
			$('.sure').show();
		}else{
			$('.disk').hide();
			$('.sure').hide();
		};
	})
	$('.cancle').click(function(){
		$('.disk').hide();
		$('.sure').hide();
	})
})
$(function(){

	var device = navigator.userAgent;
	if (device.indexOf('huoniao_iOS') > -1) {
		$('.gs-tit').css('margin-top', 'calc(.9rem + 20px)');
	}

	$('.tab-box span').click(function(){
		var index = $(this).index(),
			 wrap = $('.choose-box .wrapper').eq(index);
		$(this).addClass('active').siblings().removeClass('active');
		if (wrap.css('display') == "none") {
			wrap.show().siblings().hide();
		}
	})


})

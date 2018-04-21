$(function(){

  // 系统截图展示
	$("#slider").slide({mainCell:".bd ul",effect:"leftLoop",autoPlay:true,autoPage:'<li>></li>', vis: 15, interTime: 3000});

	// 最后一个模块
	$(window).on('scroll', function(){
		var sct = $(window).scrollTop(), offset = $('.module-3').offset().top - 500;
		if (sct > offset) {
			$('.module-3').addClass('show');
		}
	})

})

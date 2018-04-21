$(function(){
	// 顶部二维码
	$('.topbarlink li').hover(function(){
		var s = $(this);
		s.find('.pop').show();
	}, function(){
		$(this).find('.pop').hide();
	})
})
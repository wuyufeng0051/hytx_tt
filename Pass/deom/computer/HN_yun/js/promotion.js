$(function(){
	$(".qa-list li").click(function(){
		var x = $(this);
		if (x.find('.q').hasClass('active')) {
			x.find('.q').removeClass('active');
			x.find('.a').hide();
		}else{
			x.find('.q').addClass('active');
			x.find('.a').show();
		}
	})
})
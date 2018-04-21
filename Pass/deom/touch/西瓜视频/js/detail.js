$(function(){
	$('.infor_title img').click(function(){
		var x = $(this);
		if ($(".infor_title em").hasClass('line')) {
			$(".infor_title em").removeClass('line');
			$('.video_author').show();
			x.addClass('rotate');
		}else{
			$(".infor_title em").addClass('line');
			$('.video_author').hide();
			x.removeClass('rotate');
		}
	})

	$('.guan').click(function(){
		var x = $(this);
		if (x.hasClass('guaned')) {
			x.removeClass('guaned');
			x.text('关注')
		}else{
			x.addClass('guaned');
			x.text('已关注')
		}
	})
})
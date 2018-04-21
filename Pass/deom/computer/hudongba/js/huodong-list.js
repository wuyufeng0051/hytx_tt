$(function(){
	// 顶部二维码
	$('.topbarlink li').hover(function(){
		var s = $(this);
		s.find('.pop').show();
	}, function(){
		$(this).find('.pop').hide();
	})
	// 活动分类选择
	$('.list-1 ul li').click(function(){
		var i = $(this);
		i.addClass("bc");
		i.siblings("li").removeClass("bc");
	})
	// 下方列表二维码
	$('.pice span').hover(function(){
		var x = $(this);
		x.find('.erwei').show();
	}, function(){
		$(this).find('.erwei').hide();
	})
	// 导航栏置顶
	var Ggoffset = $('.head').offset().top;
	$(window).bind("scroll",function(){
		var d = $(document).scrollTop();
		if(Ggoffset < d){
				$('.head').addClass('fixed');
		}else{
			$('.head').removeClass('fixed');
		}
	});
})
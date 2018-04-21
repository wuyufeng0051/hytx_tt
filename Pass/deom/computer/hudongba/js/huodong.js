$(function(){
	// 顶部换灯片
	$('.list').slide({mainCell:".bd", titCell:".hd ul", autoPlay:true, autoPage:true,effect:"fold"})
	
	// 顶部二维码
	$('.topbarlink li').hover(function(){
		var s = $(this);
		s.find('.pop').show();
	}, function(){
		$(this).find('.pop').hide();
	})
	// 下方列表二维码
	$('.pice span').hover(function(){
		var x = $(this);
		x.find('.erwei').show();
	}, function(){
		$(this).find('.erwei').hide();
	})
	// 上方列表二维码
	$('.nar-list1 b i').hover(function(){
		var s = $(this);
		s.find('.erwei-1').show();
	}, function(){
		$(this).find('.erwei-1').hide();
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
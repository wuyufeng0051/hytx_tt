$(function(){
	jQuery(".txtMarquee-left").slide({mainCell:".bd ul",autoPlay:true,effect:"leftMarquee",interTime:50,trigger:"click"});

	// 顶部二维码
	$('.lead_p').hover(function(){
			var i = $('.pop');
			i.addClass("hover");
		}, function(){
			var i = $('.pop');
			i.removeClass("hover");
	})
	$('.lead_x').hover(function(){
			var i = $('.pop-1');
			i.addClass("hover");
		}, function(){
			var i = $('.pop-1');
			i.removeClass("hover");
	})
	// 热门楼盘选项卡
	$('.cate a').hover(function(){
		var  u = $(this);
		var index = u.index();
		$('.hr_list ul').eq(index).show();
		$('.hr_list ul').eq(index).siblings().hide();
		u.addClass('zq');
		u.siblings('a').removeClass('zq');
	})

	// 房产要闻换一换
	$(".hr_information").slide({mainCell:".flash",titCell:".ls ul",effect:"fold",autoPage:true,autoPlay:true,nextCell:".hr_change .btn",prevCell:".prev",nextCell:".next"});

	// 表单验证
	$('#joinform button').click(function(){
		var tel = $('.phone').val();
		if ($('.name').val() == "") {
			$('.name-1').show();
	    	setTimeout(function(){$('.name-1').hide()},1000);
		}
		else if ($('.phone').val() == "") {
			$('.phone-1').show();
	    	setTimeout(function(){$('.phone-1').hide()},1000);
		}
		else if (!(/^1[34578]\d{9}$/.test(tel))){
			$('.phone-1').text('请填写正确的手机号').show();
	    	setTimeout(function(){$('.phone-1').hide()},1000);
		}
		else if ($('.city').val() == '--请选择楼盘--') {
			$('.city-1').show();
	    	setTimeout(function(){$('.city-1').hide()},1000);
		};
	})
})
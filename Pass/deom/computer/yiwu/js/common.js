$(function(){
// 头部导航
	var allkinds = $('.all_kinds'),kindList = $('.kindslist'),hdt;

	$('.all_kinds').hover(function(){
		kindList.show();
	}, function(){
		kindList.hide();
	})

	$('.kindslist li').hover(function(){
		$(this).addClass('curr');
	},function(){
		$(this).removeClass('curr');
	})

	// 切换城市
	$('.change p').click(function(){
		$('.citybox').show();
	})

	$('.citybox dd a').click(function(){
		var t = $(this), val = t.text();
		$('.cityname').html(val);
		$('.citybox').hide();
	})

	$('.citybox .close').click(function(){
		$('.citybox').hide();
	})

})

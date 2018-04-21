$(function(){
	// 搜索栏tab切换
	$('.n4l_lead ul li').hover(function(){
		var x = $(this),
			index = x.index();
		$('.n4l_list ul').eq(index).show().siblings().hide();
	})

	$('.n4l_bc1').hover(function(){
		$(".n4l_lead").css("background-image","url(../images/i3.gif)");  
	})
	$('.n4l_bc2').hover(function(){
		$(".n4l_lead ").css("background-image","url(../images/i3_3.gif)");  
	})
	$('.n4r_lead ul li').hover(function(){
	var x = $(this),
		index = x.index();
	$('.n4r_list .nn').eq(index).show().siblings().hide();
	})

	$('.n4rl_1').hover(function(){
		$(".n4r_lead ul").css("background-image","url(../images/i6.jpg)");  
	})
	$('.n4rl_2').hover(function(){
		$(".n4r_lead ul ").css("background-image","url(../images/i6_6.jpg)");  
	})

	// 选择日期
	$('.date_list ul li').click(function(){
			var  x = $(this);
			var  b = x.text();
			$('.date span').text(b);
			$('.date_list').hide();
	})
	$('.date').click(function(){
		if ($('.date_list').css('display') == 'none') {
			$('.date_list').show();
		}else{
			$('.date_list').hide();
		};
	})
	
	// 友情链接选项卡切换
	$('.part_12 .p12_lead ul li').hover(function(){
		var x = $(this),index = x.index(),close = x.closest('.part_12 ').find('.p12_list .p12_ll');
		close.eq(index).show().siblings().hide();
		x.addClass('p12_bc');
		x.siblings().removeClass('p12_bc');
	})
})
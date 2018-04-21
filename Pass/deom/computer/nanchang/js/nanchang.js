$(function(){
	// 头部幻灯片
	$('.list').slide({mainCell:".bd", titCell:".hd ul", autoPlay:true, autoPage:true,effect:"fold"})

	$('.arr').hover(function(){
		$('.guanzhu-er').show();
	},function(){
		$('.guanzhu-er').hide();
	})


	// 公告选项卡
	$('.gg-lead ul li').hover(function(){
		var  u = $(this);
		var index = u.index();
		$('.gg-txt ul').eq(index).show();
		$('.gg-txt ul').eq(index).siblings().hide();
		u.addClass('kk');
		u.siblings('li').removeClass('kk');
	})


	// 商家选项卡
	$('.mer-list ul li').hover(function(){
			var x = $(this);
			x.find('.mer-con').show();
		}, function(){
			$(this).find('.mer-con').hide();
		})

		$('.mer-list ul li').hover(function(){
			var i = $(this);
			i.addClass("mer");
		}, function(){
			var i = $(this);
			i.removeClass("mer");
		})

	// 招聘频道
	$(".recruit-l").slide({titCell:".recruit-lead ul li",mainCell:".recruit-txt",effect:"left",autoPlay:true,scroll:1,vis:1,prevCell:".prev",nextCell:".next"});


	// 滚动条
	$(".attitude").mCustomScrollbar({theme:"minimal-dark"});


	// 精彩活动
	$(".jingcai").slide({mainCell:".jc-news",autoPage:true,effect:"left",autoPlay:true,scroll:1,vis:1,prevCell:".prev",nextCell:".next"});


	// 网友点评
	$(".remark").slide({mainCell:".remark-list ",effect:"topLoop",autoPlay:true,vis:3,nextCell:".remark-lead a p"});


	$(".flash").slide({mainCell:".flashtext",effect:"fold",autoPage:true,autoPlay:true,nextCell:".flash-lead a p"});

	
	// 房产快讯
	$('.recop-l .pic-txt').hover(function(){
		var x = $(this);
		var gy = x.siblings('.pic-1');
		if (gy.css('display') == 'none') {
			$('.pic-1').hide();
			x.closest('.recop-l').find('.pic-1').show();
			$('.pic-txt').show();
			x.hide();
		}else{
		}
	})

	// 装修图片
	$('.fp-1 a').hover(function(){
		var  u = $(this);
		u.closest('.fp-1').find('p').animate({top:'304px'},{queue:false,duration:180});
	},function(){
		var  u = $(this);
		u.closest('.fp-1').find('p').animate({top:'334px'},{queue:false,duration:180});
	})
	$('.fp-2 a').hover(function(){
		var  u = $(this);
		u.closest('.fp-2').find('p').animate({top:'135px'},{queue:false,duration:180});
	},function(){
		var  u = $(this);
		u.closest('.fp-2').find('p').animate({top:'165px'},{queue:false,duration:180});
	})
	$('.fp-3 a').hover(function(){
		var  u = $(this);
		u.closest('.fp-3').find('p').animate({top:'304px'},{queue:false,duration:180});
	},function(){
		var  u = $(this);
		u.closest('.fp-3').find('p').animate({top:'334px'},{queue:false,duration:180});
	})


	// 汽车登记
	$(".pinpai dt").click(function(){
    if( $(".pinpai dd").css("display")=='none' ) { 
        $(".pinpai dd ").show();
    }else{
        $(".pinpai dd ").hide();
    }
    })
    $('.pinpai dd ul li').click(function(){
		var  x = $(this);
		var  b = x.text();
		$('.pinpai dt').text(b);
		$('.pinpai dd').hide();
	})
	$(".chexing dt").click(function(){
    if( $(".chexing dd").css("display")=='none' ) { 
        $(".chexing dd ").show();
    }else{
        $(".chexing dd ").hide();
    }
    })
	$('.chexing dd ul li').click(function(){
		var  x = $(this);
		var  b = x.text();
		$('.chexing dt').text(b);
		$('.chexing dd').hide();
	})


	// 浮动导航
	$('.scroll li').hover(function(){
		$(this).find('.code-box').show();
	},function(){
		$(this).find('.code-box').hide();
	})


	//返回顶部
	$(".scroll .top").bind("click", function(){
		$('html, body').animate({scrollTop:0}, 300);
	});
})


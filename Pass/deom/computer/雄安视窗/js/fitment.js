$(function(){
	jQuery(".p_lead").slide({mainCell:".gg_list",autoPlay:true,effect:"topMarquee",vis:1,interTime:100,trigger:"click"});

	// 装修流程
	$('.formlist li').hover(function(){
		var x = $(this),index = x.index(),close = x.closest('.tdform ').find('.formcon ul li');
		close.eq(index).show().siblings().hide();
		x.addClass(' act');
		x.siblings().removeClass(' act');
	})

	//侧栏分类
	$(".sb-type").hover(function(){
		var height = 0;
		$(this).find("dl").each(function(){
			height = height + $(this).height() + 20;
		});
		$(this).stop().animate({height: height+"px"}, 200);
	}, function(){
		$(this).stop().animate({height: "390px"}, 200);
	});

	//设计师
	$("#designer .plist li").each(function(i){ $("#designer .plist li").slice(i*5,i*5+5).wrapAll("<ul></ul>");});

	//设计师列表
	$("#designer .plist").cycle({
		fx: 'scrollHorz',
		speed: 300,
		next:	'#designer .next',
		prev:	'#designer .prev',
		pause: true
	});

	$("#designer").hover(function(){
		$(this).find(".prev, .next").show();
	}, function(){
		$(this).find(".prev, .next").hide();
	});

	//slideshow_710_400
	var sid = 710400;
	$("#slideshow"+sid).cycle({
		fx: 'scrollHorz',
		speed: 300,
		pager: '#slidebtn'+sid,
		next:	'#slidebtn'+sid+'_next',
		prev:	'#slidebtn'+sid+'_prev',
		pause: true
	});

	$(".slideshow_710_400").hover(function(){
		$(this).find(".prev, .next").show();
	}, function(){
		$(this).find(".prev, .next").hide();
	});

	//推荐优质商家
	$(".business .ad1 li").hover(function(){
		var t = $(this);
		t.find("img").stop().animate({"margin-left": "-10px"}, 200);
		t.find(".enter").stop().animate({"right": "0", "opacity": ".8"}, 200);
	}, function(){
		var t = $(this);
		t.find("img").stop().animate({"margin-left": "0"}, 200);
		t.find(".enter").stop().animate({"right": "-185px", "opacity": "0"}, 200);
	});
})
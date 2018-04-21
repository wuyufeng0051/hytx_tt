$(function(){

    //标题
    $('.lead li').hover(function(){
    	var x = $(this);
    	var index = x.index();
    	x.addClass('op');
    	x.siblings('li').removeClass('op');
    })

	//新闻专题
	$('.zt-lead p').hover(function(){
		var  u = $(this);
		var index = u.index();
		$('.xuanze .tt').eq(index).show();
		$('.xuanze .tt').eq(index).siblings().hide();
		u.addClass('zq');
		u.siblings('p').removeClass('zq');
	})

	//图片新闻
	$('.point span').hover(function(){
		var  u = $(this);
		var index = u.index();
		$('.hhh .top-in').eq(index).show();
		$('.hhh .top-in').eq(index).siblings().hide();
	})


	// 排行榜
	$('.Ranking-lead li').hover(function(){
		var  u = $(this);
		var index = u.index();
		$('.ph ul').eq(index).show();
		$('.ph ul').eq(index).siblings().hide();
		u.find('p').addClass('ou');
		u.siblings('.ll').find('p').removeClass('ou');
	})

})
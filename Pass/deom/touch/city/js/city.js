$(function(){

  // 幻灯片
   $('.picscroll .count').text($('#picscroll li').length);
    $('#picscroll').slider({changedFun:function(n){
        var li = $('#picscroll ul li'), active = li.eq(n);
        if(n < li.length - 1) {
            if(!active.hasClass('showed')) {
                active.addClass('showed');
            }
            var next = li.eq(n+1);
            next.addClass('showed');
        }
        $('.picscroll .page').text(++n);
    }})

    // 附近小区
    $('.nei-lead li').click(function(){
		var  u = $(this);
		var index = u.index();
		$('.bbb .nei-txt ').eq(index).show();
		$('.bbb .nei-txt ').eq(index).siblings().hide();
		u.addClass('nei');
		u.siblings('li').removeClass('nei');
	})

	// 今日热点
	$('.hot-lead ul li').click(function(){
		var  u = $(this);
		var index = u.index();
		$('.hot-txt .ht-1').eq(index).show();
		$('.hot-txt .ht-1').eq(index).siblings().hide();
		u.addClass('nei');
		u.siblings('li').removeClass('nei');
	})
  
  	// 热卖商品
  	$('.shop-lead ul li').click(function(){
		var  u = $(this);
		var index = u.index();
		$('.shop-txt .st ').eq(index).show();
		$('.shop-txt .st ').eq(index).siblings().hide();
		u.addClass('nei');
		u.siblings('li').removeClass('nei');
	})


})
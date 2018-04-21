$(function(){
	$("img").scrollLoading();

	//大图幻灯
	$("#slide").cycle({ 
		pager: '#slidebtn',
		pause: true,
		prev:'.prev',
        next:'.next'
	});

	//热卖爆款
	$('.player').cycle({
		pager: '.number',
		pause: true
	})

	//品牌汇
	$('.player1').cycle({
		pager: '.number1',
		pause: true
	})

	//展开和收起
	$(".classify .more a").on("click",function(){
		var t=$(this).closest(".more");
		if(!t.hasClass("on")){
			t.addClass("on");
			$(".classify ul").css("height","auto");
		}else{
			t.removeClass("on");
			$(".classify ul").css("height","200px");
		}
		
	})
})
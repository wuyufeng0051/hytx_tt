$(function(){
	$('.list').slide({mainCell:".bd", titCell:".hd ul", autoPlay:true, autoPage:true,effect:"fold"})


	// 头部导航
	var allkinds = $('.all_kinds'),kindList = $('.kindslist'),hdt;


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
	
	// 猜你喜欢
	$('.like-tit .change a').click(function(){

		var box = $('.like-box'), showUl = $(".like-box .showUl"), index = showUl.index();

		showUl.removeClass("showUl");
		if(index == box.find("ul").length - 1){
			box.find("ul:eq(0)").addClass("showUl");
		}else{
			showUl.next("ul").addClass("showUl");
		}


	})
})
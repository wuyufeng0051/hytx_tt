$(function(){
	// 公告选项卡
	$('.fu_lead a').click(function(){
		var  u = $(this);
		var index = u.index();
		$('#J_homelist .home_i').eq(index).show();
		$('#J_homelist .home_i').eq(index).siblings().hide();
		u.addClass('active');
		u.siblings('a').removeClass('active');
	})
	// 加入购物车
	$('.book-btn-1').click(function(){
		var box = $('.gou_detail')
		if (box.css("display")=="none") {
			box.show();
			$('.disk').show();
		}else{
			box.hide();
			$('.disk').hide();
		}
	})
	$('.gou_detail .close,.gou_2 span').click(function(){
		$('.gou_detail').hide();
		$('.disk').hide();
	})

	// 计算金额
	$('.pp').keyup(function(){
		var x = $('.l_3').data('value');
		var	y = $(".pp").val();
		var money = x * y;
		$('.l_2 i').text(money);
	})
	



	window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},"image":{"viewList":[],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":[]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
})
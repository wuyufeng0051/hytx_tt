$(function(){
	// 回复评论
	$('.com_ago .coma_list .com_box_de .content_box .content_bt span').click(function(){
		var x = $(this),
			find = x.closest('.com_box_de').find('.content_txt');
		if (find.hasClass('none')) {
			x.addClass('bt_bc');
			find.removeClass('none');
		}else{
			x.removeClass('bt_bc');
			find.addClass('none');
		};
	})


	// 滚动条
	$(".attitude").mCustomScrollbar({theme:"minimal-dark"});


	// 点赞，收藏
	$('.video .video_de .ts .share ul li a.zan').click(function(){
		var x = $(this);
		if (x.hasClass('zan_bc')) {
			x.removeClass('zan_bc');
		}else{
			x.addClass('zan_bc');
		};
	})
	$('.video .video_de .ts .share ul li a.cang').click(function(){
		var x = $(this);
		if (x.hasClass('cang_bc')) {
			x.removeClass('cang_bc');
		}else{
			x.addClass('cang_bc');
		};
	})


	// 百度分享
	window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},"image":{"viewList":[],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":[]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
})
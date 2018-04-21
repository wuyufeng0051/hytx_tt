$(function(){
	window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},"image":{"viewList":["qzone","tsina"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
	// 左侧导航栏置顶
	var Ggoffset = $('.share,.hot').offset().top;
	$(window).bind("scroll",function(){
		var d = $(document).scrollTop()+40;
		if(Ggoffset < d){
			$('.share').addClass('fixed');
		}else{
			$('.share').removeClass('fixed');
		}
	});
	// $(window).bind("scroll",function(){
	// 	var d = $(document).scrollTop()+40;
	// 	if(Ggoffset < d){
	// 		$('.hot').addClass('fixed_2');
	// 	}else{
	// 		$('.hot').removeClass('fixed_2');
	// 	}
	// });
})
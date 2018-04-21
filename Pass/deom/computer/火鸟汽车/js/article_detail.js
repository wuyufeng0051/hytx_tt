$(function(){
// 百度分享
	window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},"image":{"viewList":["tsina","weixin","qzone"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["tsina","weixin","qzone"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];


// 点击回复评论
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


// 热门品牌tab切换
	$('.hot .hot_title ul li').hover(function(){
		var x = $(this),
			index = x.index();
		$('.hot_box .hot_txt').eq(index).show();
		$('.hot_box .hot_txt').eq(index).siblings().hide();
		x.addClass('hot_bc');
		x.siblings().removeClass('hot_bc');
	})


// 左侧分享吸顶
	var top    = $('.al_share').offset().top;
	$(window).scroll(function(){
		var topOff = $('.about').offset().top - 200;
		var sct = $(window).scrollTop();
		if(sct >= top && sct <= topOff) {
			if(!$('.al_share').hasClass('fixed')){
				$('.al_share').hide().addClass('fixed').slideDown();
			}
		} else {
			$('.al_share').removeClass('fixed');
		}
	})


// 文章点，踩按钮+1显示
	$('.pk_zan').click(function(){
		$('.pk_zan span').show();
		setTimeout(function(){$('.pk_zan span').hide()},1000);
	})
	$('.pk_cai').click(function(){
		$('.pk_cai span').show();
		setTimeout(function(){$('.pk_cai span').hide()},1000);
	})

	
// 收藏文章按钮
	$('.article_list .article .article_detail .art_share .art_share_list ul li.art_sc a span').click(function(){
		var x = $(this);
		if ($('.art_sc .sc').hasClass('none')) {
			$('.art_sc .sc').removeClass('none');
			$('.art_sc .done').addClass('none');
			
		}else{
			$('.art_sc .sc').addClass('none');
			$('.art_sc .done').removeClass('none');
		};
	})
})


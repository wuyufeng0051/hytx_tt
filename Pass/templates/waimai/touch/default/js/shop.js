$(function(){

	var mySwiper = new Swiper('.slideBox',{pagination : '.swiper-pagination',})

	$('.shop-txt-store').click(function(){
		if ($('.shop-txt-store').hasClass('shou')) {
			$('.shop-txt-store').removeClass('shou');

			$.post("/include/ajax.php?service=member&action=collect&module=waimai&temp=shop&type=del&id="+id);
		}else{
			$('.shop-txt-store').addClass('shou');

			$.post("/include/ajax.php?service=member&action=collect&module=waimai&temp=shop&type=add&id="+id);
		};
	})


	//微信分享
	wx.config({
	    debug: false,
	    appId: wxconfig.appId,
	    timestamp: wxconfig.timestamp,
	    nonceStr: wxconfig.nonceStr,
	    signature: wxconfig.signature,
	    jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ', 'onMenuShareWeibo', 'onMenuShareQZone']
	});
	wx.ready(function() {
	    wx.onMenuShareAppMessage({
	        title: wxconfig.title,
	        desc: wxconfig.description,
	        link: wxconfig.link,
	        imgUrl: wxconfig.imgUrl,
	        trigger: function (res) {},
	    });
	    wx.onMenuShareTimeline({
	        title: wxconfig.title,
	        link: wxconfig.link,
	        imgUrl: wxconfig.imgUrl,
	    });
	    wx.onMenuShareQQ({
	        title: wxconfig.title,
	        desc: wxconfig.description,
	        link: wxconfig.link,
	        imgUrl: wxconfig.imgUrl,
	    });
	    wx.onMenuShareWeibo({
	        title: wxconfig.title,
	        desc: wxconfig.description,
	        link: wxconfig.link,
	        imgUrl: wxconfig.imgUrl,
	    });
	    wx.onMenuShareQZone({
	        title: wxconfig.title,
	        desc: wxconfig.description,
	        link: wxconfig.link,
	        imgUrl: wxconfig.imgUrl,
	    });
	});
})

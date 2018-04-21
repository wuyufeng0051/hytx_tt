$(function(){

	var mySwiper = new Swiper('.slideBox',{pagination : '.swiper-pagination',})

	$('.lead b').click(function(){
		if ($('.lead b').hasClass('lead_bc')) {
			$('.lead b').removeClass('lead_bc');

			$.post("/include/ajax.php?service=member&action=collect&module=waimai&temp=shop&type=del&id="+id);
		}else{
			$('.lead b').addClass('lead_bc');

			$.post("/include/ajax.php?service=member&action=collect&module=waimai&temp=shop&type=add&id="+id);
		};
	})

	var loading = $(".loading"), page = 1;

	function getList(first){

		isload = true;

		var data = [];
		data.push('sid='+id);

		loading.show();

		$.ajax({
			url: masterDomain + '/include/ajax.php?service=waimai&action=common&page='+page+'&pageSize=5',
			type: 'get',
			data: data.join("&"),
			dataType: 'jsonp',
			success: function(data){
				if(data && data.state == 100){

					var list = data.info.list, html = [];

					if(list.length > 0){
						for(var i = 0; i < list.length; i++){
							var obj = list[i], item = [];
							item.push('<div class="item">');
							item.push('<div class="com_txt">');
							item.push('<span class="user">'+obj.user+'</span><p>'+obj.content+'</p>');
							item.push('<span class="date fn-clear"><em>'+obj.pubdatef+'</em></span>');
							item.push('<div class="pingjia star'+obj.star+'"><i></i></div>');
							item.push('</div>');
							if(obj.reply != "" && obj.replaydate != 0){
								item.push('<div class="reply">');
								item.push('<p>【店家回复】'+obj.reply+'<span>'+obj.replydatef+'</span></p>');
								item.push('</div>');
							}
							item.push('</div>');

							html.push(item.join(""));
						}

						loading.hide().before(html.join(""));

						isload = false;

					}else{
						loading.text("暂无评论");
					}
				}else{
					loading.text("暂无评论");
				}
			},
			error: function(){
				isload = false;
				loading.text("网络错误，获取失败！");
			}
		})

	}

	getList();


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

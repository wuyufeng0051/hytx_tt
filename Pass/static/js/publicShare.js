$(function(){

	$("head").append('<link rel="stylesheet" type="text/css" href="'+staticPath+'css/publicShare.css?t='+~(-new Date())+'">');

	var hnShare = {
		showShareBox: function(){
			$("#publit_shear_load").remove();
			$('#HN_PublicShare_shearBox').css('bottom','0');
			$('#HN_PublicShare_shearBox .HN_PublicShare_bg').css({'height':'100%','opacity':1});
		}

		,closeShearBox: function(){
			$('#HN_PublicShare_shearBox').css('bottom','-100%');
			$('#HN_PublicShare_shearBox .HN_PublicShare_bg').css({'height':'0','opacity':0});
		}

		,showQRBox: function(){
			$('#HN_PublicShare_shearBox').css('bottom','-100%');
			$('#HN_PublicShare_codeBox').css('bottom','0');
		}
		,closeQRBox: function(){
	        $('#HN_PublicShare_codeBox').css('bottom','-100%');
	        $('.HN_PublicShare_shearBox .HN_PublicShare_bg').css({'height':'0','opacity':0});
    	}
    	,showSRBox: function(){
			$('.HN_PublicShare_zhiyin').show();
			$('.HN_PublicShare_zhiyin .HN_PublicShare_bg').css({'height':'100%','opacity':1});
    	}
    	,closeSRBox: function(){
			$('.HN_PublicShare_zhiyin').hide();
		    $('.HN_PublicShare_zhiyin .HN_PublicShare_bg').css({'height':'0','opacity':0});
    	}
	}

	var shareHtml = '<div class="HN_PublicShare_shearBox"id="HN_PublicShare_shearBox" ><div class="HN_PublicShare_sheark1"><div class="HN_PublicShare_sheark2"><div class="HN_PublicShare_HN_style_32x32"><ul class="fn-clear"><li><a class="HN_button_qzone" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='+window.location+'&desc='+document.title+'"></a>QQ空间</li><li><a class="HN_button_tsina" href="http://service.weibo.com/share/share.php?url='+window.location+'&desc='+document.title+'"></a>新浪微博</li><li><a class="HN_button_tweixin"></a>微信</li><li><a class="HN_button_ttqq"></a>QQ好友</li><li><a class="HN_button_comment"><span class="HN_txt jtico jtico_comment"></span></a>朋友圈</li><li><a class="HN_button_code"><span class="HN_txt jtico jtico_code"></span></a>二维码</li></ul></div></div><div class="HN_PublicShare_cancel"id="HN_PublicShare_cancelShear">取消</div></div><div class="HN_PublicShare_bg"id="HN_PublicShare_shearBg"></div></div><div class="HN_PublicShare_shearBox HN_PublicShare_codeBox"id="HN_PublicShare_codeBox"><div class="HN_PublicShare_sheark1"><img src=""alt=""width="130"height="130"><p>让朋友扫一扫访问当前网页</p><div class="HN_PublicShare_cancel"id="HN_PublicShare_cancelcode">取消</div></div><div class="HN_PublicShare_bg"></div></div><div class="HN_PublicShare_zhiyin"><div class="HN_PublicShare_bg"><div class="HN_PublicShare_zhibox"><img src="'+staticPath+'images/HN_Public_sharezhi.png"alt=""></div></div></div>';

	$("head").append('<style id="publit_shear_load">.HN_PublicShare_shearBox,.HN_PublicShare_zhiyin {display:none;}</style>');
	$("body").append(shareHtml);




	$("body").delegate(".HN_PublicShare", "click tap", function(){
		//非客户端下调用默认分享功能
		if(appInfo.device == ""){
			hnShare.showShareBox();

		//客户端下调用原生分享功能
		}else{
          setupWebViewJavascriptBridge(function(bridge) {
			bridge.callHandler("appShare", {
				"platform": "all",
				"title": wxconfig.title,
				"url": wxconfig.link,
				"imageUrl": wxconfig.imgUrl,
				"summary": wxconfig.description
			}, function(responseData){
				var data = JSON.parse(responseData);
				// if(data.state == 100){
				// 	alert("分享成功！");
				// }else{
				// 	alert(data.info);
				// }
			})
		  });
        }
	});


	//单独分享
	$("body").delegate(".HN_PublicShare_Singel", "tap click", function(event){
		event.preventDefault();
		var id = $(this).attr("data-id");
		if(appInfo.device != ""){
			setupWebViewJavascriptBridge(function(bridge) {
				bridge.callHandler("appShare", {
					"platform": id,
					"title": wxconfig.title,
					"url": wxconfig.link,
					"imageUrl": wxconfig.imgUrl,
					"summary": wxconfig.description
				}, function(responseData){
					var data = JSON.parse(responseData);
					// if(data.state == 100){
					// 	alert("分享成功！");
					// }else{
					// 	alert(data.info);
					// }
				})
			});
		}else{
			if(id == "Qzone"){
				location.href = 'http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='+window.location+'&desc='+document.title;
			}else if(id == "sina"){
				location.href = 'http://service.weibo.com/share/share.php?url='+window.location+'&desc='+document.title;
			}else if(id == "wechat"){
				var code = masterDomain+'/include/qrcode.php?data='+encodeURIComponent(window.location);
				hnShare.showQRBox();
				hnShare.showSRBox();
				// $('.HN_PublicShare_bg').css({'height':'100%','opacity':1});
				$('#HN_PublicShare_codeBox img').attr('src', code);
			}else if(id == "QQ"){
				var code = masterDomain+'/include/qrcode.php?data='+encodeURIComponent(window.location);
				hnShare.showQRBox();
				hnShare.showSRBox();
				// $('.HN_PublicShare_bg').css({'height':'100%','opacity':1});
				$('#HN_PublicShare_codeBox img').attr('src', code);
			}
		}
	});

	$("body").delegate("#HN_PublicShare_shearBg", "tap click", function(){
		hnShare.closeShearBox();
		hnShare.closeQRBox();
		hnShare.closeSRBox();
	});

	$("body").delegate(".HN_PublicShare_bg", "tap click", function(){
		hnShare.closeShearBox();
		hnShare.closeQRBox();
		hnShare.closeSRBox();
	});

	$("body").delegate("#HN_PublicShare_cancelShear", "tap click", function(){
		hnShare.closeShearBox();
	});

	$("body").delegate("#HN_PublicShare_cancelcode", "tap click", function(){
		hnShare.closeQRBox();
	});

	$("body").delegate(".HN_button_code", "tap", function(){
		var code = masterDomain+'/include/qrcode.php?data='+encodeURIComponent(window.location);
		hnShare.showQRBox();
		$('#HN_PublicShare_codeBox img').attr('src', code);
	});

	$('.HN_button_tweixin, .HN_button_ttqq, .HN_button_comment').click(function(){
		hnShare.closeShearBox();
		hnShare.showSRBox();
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
          trigger: function (res) {
            hnShare.closeSRBox();
          },
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
});

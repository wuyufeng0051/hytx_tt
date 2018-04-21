$(function(){

	$("head").append('<link rel="stylesheet" type="text/css" href="'+staticPath+'css/publicShare.css?t='+~(-new Date())+'">');

	var hnShare = {
		showShareBox: function(){
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

	$("body").append(shareHtml);

	//注册webview
	function setupWebViewJavascriptBridge(callback){
		if(window.WebViewJavascriptBridge){
			callback(WebViewJavascriptBridge);
		}else{
			document.addEventListener("WebViewJavascriptBridgeReady", function() {
				callback(WebViewJavascriptBridge);
			}, false);
		}

		if(window.WVJBCallbacks){return window.WVJBCallbacks.push(callback);}
		window.WVJBCallbacks = [callback];
		var WVJBIframe = document.createElement("iframe");
		WVJBIframe.style.display = "none";
		WVJBIframe.src = "wvjbscheme://__BRIDGE_LOADED__";
		document.documentElement.appendChild(WVJBIframe);
		setTimeout(function(){document.documentElement.removeChild(WVJBIframe) }, 0);
	}


	var appInfo = {"device": "", "version": ""};
    setupWebViewJavascriptBridge(function(bridge) {

		alert(bridge);

    	//设备信息
    	bridge.callHandler("getAppInfo", {}, function(responseData){
			alert(responseData);
			var data = JSON.parse(responseData);
			appInfo = data;
        });

        $("body").delegate(".HN_PublicShare", "click", function(){
			alert(1);
			bridge.callHandler("appShare", {
				"title": wxconfig.title,
				"url": wxconfig.link,
				"imageUrl": wxconfig.imgUrl,
				"summary": wxconfig.description
			}, function(responseData){
				alert(responseData);
				var data = JSON.parse(responseData);
				// if(data.state == 100){
				// 	alert("分享成功！");
				// }else{
				// 	alert(data.info);
				// }
			})
		});

    });

	$("body").delegate(".HN_PublicShare", "click", function(){
		if(appInfo.device == ""){
			alert(2);
			hnShare.showShareBox();
		}
	});

	$("body").delegate("#HN_PublicShare_shearBg", "click", function(){
		hnShare.closeShearBox();
		hnShare.closeQRBox();
		hnShare.closeSRBox();
	});

	$("body").delegate(".HN_PublicShare_bg", "click", function(){
		hnShare.closeShearBox();
		hnShare.closeQRBox();
		hnShare.closeSRBox();
	});

	$("body").delegate("#HN_PublicShare_cancelShear", "click", function(){
		hnShare.closeShearBox();
	});

	$("body").delegate("#HN_PublicShare_cancelcode", "click", function(){
		hnShare.closeQRBox();
	});

	$("body").delegate(".HN_button_code", "click", function(){
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

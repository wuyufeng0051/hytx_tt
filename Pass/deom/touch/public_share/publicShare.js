$(function(){

	$("head").append('<link rel="stylesheet" type="text/css" href="publicShare.css?t='+~(-new Date())+'">');

	var masterDomain = 'http://imenhu.cc'

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

	var shareHtml = '<div class="HN_PublicShare_shearBox"id="HN_PublicShare_shearBox" ><div class="HN_PublicShare_sheark1"><div class="HN_PublicShare_sheark2"><div class="HN_PublicShare_HN_style_32x32"><ul class="fn-clear"><li><a class="HN_button_qzone" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='+window.location+'&desc='+document.title+'"></a>QQ空间</li><li><a class="HN_button_tsina" href="http://service.weibo.com/share/share.php?url='+window.location+'&desc='+document.title+'"></a>新浪微博</li><li><a class="HN_button_tweixin"></a>微信</li><li><a class="HN_button_ttqq"></a>QQ好友</li><li><a class="HN_button_comment"><span class="HN_txt jtico jtico_comment"></span></a>朋友圈</li><li><a class="HN_button_code"><span class="HN_txt jtico jtico_code"></span></a>二维码</li></ul></div></div><div class="HN_PublicShare_cancel"id="HN_PublicShare_cancelShear">取消</div></div><div class="HN_PublicShare_bg"id="HN_PublicShare_shearBg"></div></div><div class="HN_PublicShare_shearBox HN_PublicShare_codeBox"id="HN_PublicShare_codeBox"><div class="HN_PublicShare_sheark1"><img src=""alt=""width="130"height="130"><p>让朋友扫一扫访问当前网页</p><div class="HN_PublicShare_cancel"id="HN_PublicShare_cancelcode">取消</div></div><div class="HN_PublicShare_bg"></div></div><div class="HN_PublicShare_zhiyin"><div class="HN_PublicShare_bg"></div><div class="HN_PublicShare_zhibox"><img src="images/HN_Public_sharezhi.png"alt=""><p>点击右上角，分享给朋友</p></div></div>';

	$("body").append(shareHtml);

	$("body").delegate(".HN_PublicShare", "click", function(){
		hnShare.showShareBox();
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
		hnShare.showQRBox();
		$('#HN_PublicShare_codeBox img').attr('src', code);
	});
	
	$('.HN_button_tweixin, .HN_button_ttqq, .HN_button_comment').click(function(){
		hnShare.closeShearBox();
		hnShare.showSRBox();
	})
	
});
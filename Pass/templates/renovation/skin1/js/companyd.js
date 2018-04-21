$(function(){

	$('#container').waterfall({
		itemCls: 'item',
		prefix: 'container',
		colWidth: 290,
		gutterWidth: 14,
		gutterHeight: 14,
		minCol: 4,
		maxCol: 4,
		loadingMsg: ''
	});

	//立即预约
	$(".connect .sub a").bind("click", function(){
		$('.leaveMsg .k1').click();
	});

	// 分享
	window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"4","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"12"},"share":{"bdSize":0}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
	// 条件筛选
	$('.screen dd a').click(function(){
		var a = $(this);
		if(a.hasClass('curr')) return;
		a.addClass('curr').siblings('a').removeClass('curr');
	})

	//收藏
	$(".collect").bind("click", function(){
		var t = $(this), type = "add", oper = "+1", txt = "已收藏";

		var userid = $.cookie(cookiePre+"login_user");
		if(userid == null || userid == ""){
			huoniao.login();
			return false;
		}

		if(!t.hasClass("icon-collect-sel")){
			t.addClass("icon-collect-sel");
		}else{
			type = "del";
			t.removeClass("icon-collect-sel");
			oper = "-1";
			txt = "收藏";
		}

		var $i = $("<b>").text(oper);
		var x = t.offset().left, y = t.offset().top;
		$i.css({top: y - 10, left: x + 17, position: "absolute", "z-index": "10000", color: "#E94F06"});
		$("body").append($i);
		$i.animate({top: y - 50, opacity: 0, "font-size": "2em"}, 800, function(){
			$i.remove();
		});

		t.html("<i></i>"+txt);

		$.post("/include/ajax.php?service=member&action=collect&module=renovation&temp=company-detail&type="+type+"&id="+company);

	});

})

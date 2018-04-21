$(function(){

	//错误提示
	var showErrTimer, showErr = function(txt){
		showErrTimer && clearTimeout(showErrTimer);
		$(".gzAddrErr").remove();
		$("body").append('<div class="gzAddrErr"><p>'+txt+'</p></div>');
		$(".gzAddrErr p").css({"margin-left": -$(".gzAddrErr p").width()/2, "left": "50%"});
		$(".gzAddrErr").css({"visibility": "visible"});
		showErrTimer = setTimeout(function(){
			$(".gzAddrErr").fadeOut(300, function(){
				$(this).remove();
			});
		}, 1500);
	}

	//验证是否在客户端访问
	setTimeout(function(){
		if(appInfo.device == ""){
			if(navigator.userAgent.toLowerCase().match(/micromessenger/)){
				$("#alipayObj").remove();
			}else{
				$("#wxpayObj").remove();
			}
		}else{
			$("#payform").append('<input type="hidden" name="app" value="1" />');
		}
		$("input[name=paytype]:first").attr("checked", true);
		$(".check-item, .confirm").css({"visibility": "visible"});
	}, 500);

	//提交支付
	$("#payBtn").bind("click", function(event){
		var t = $(this), paytype = $("input[name=paytype]:checked").val();

		if($("#ordernum").val() == ""){
			// showErr("订单号获取失败，请刷新页面重试！");
			// return false;
		}
		if(paytype == "" || paytype == undefined){
			showErr("请选择支付方式！");
			return false;
		}

		if (paytype == "wxpay" && !navigator.userAgent.toLowerCase().match(/micromessenger/) && appInfo.device == "") {
			showErr("请使用微信打开网页进行支付！");
			return false;
		}

		if (paytype == "alipay" && navigator.userAgent.toLowerCase().match(/micromessenger/) && appInfo.device == "") {
			showErr("微信浏览器暂不支持支付宝付款<br />请使用其他浏览器！");
			return false;
		}

		$("#payform").submit();

	});

})

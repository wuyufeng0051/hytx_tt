$(function(){
	var device = navigator.userAgent;
	if (device.indexOf('huoniao_iOS') > -1) {
		$('body').addClass('huoniao_iOS');
	}

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
			}
		}else{
			$("#payform").append('<input type="hidden" name="app" value="1" />');
		}
		$("input[name=paytype]:first").attr("checked", true);
		$(".check-item, .confirm").css({"visibility": "visible"});
	}, 500);


	//使用余额
	$("#useBalance").bind("click", function(){
		if($(this).is(":checked")){
			$(".balancePwd").show();

			var balanceTotal = totalBalance;
			if(totalBalance > totalAmount){
				balanceTotal = totalAmount;
			}
			$("#useBcount").val(balanceTotal);

			var payAmount = (totalAmount-balanceTotal).toFixed(2);

			//如果支付金额小于等于0，则隐藏支付平台
			if(payAmount <= 0){
				$(".pay-check").hide();
				$("#payBtn span").html("");
			}else{
				$("#payBtn").html(langData['siteConfig'][16][68]+"<span>" + echoCurrency("symbol") + payAmount + "</span>");
			}

			$("#deliveryObj").hide();
			$(".check-item").eq(0).find('[name=paytype]').prop('checked', true);

		}else{
			$(".pay-check").show();
			$(".balancePwd").hide();
			$("#useBcount").val(0);
			$("#payBtn").html(langData['siteConfig'][6][42]+"<span>" + echoCurrency("symbol") + totalAmount + "</span>");

			$("#deliveryObj").show();
		}
	});


	//提交支付
	$("#payBtn").bind("click", function(event){
		var t = $(this), paytype = $("input[name=paytype]:checked").val();

		if(t.hasClass("disabled")) return false;

		if($("#ordernum").val() == ""){
			// showErr("订单号获取失败，请刷新页面重试！");
			// return false;
		}

		if($("#useBalance").is(":checked") && $("#paypwd").val() == ""){
			showErr(langData['siteConfig'][20][213]);
			return false;
		}

		if(paytype == "" || paytype == undefined){
			showErr(langData['siteConfig'][20][203]);
			return false;
		}

		if (paytype == "alipay" && navigator.userAgent.toLowerCase().match(/micromessenger/) && appInfo.device == "") {
			showErr(langData['siteConfig'][20][378]);
			return false;
		}

		var btnHtml = t.html();
		var service = $("#service").val();
		$("#action").val(service == "waimai" || service == "huodong" ? "pay" : "checkPayAmount");
		t.addClass("disabled").html(langData['siteConfig'][6][35]+"...");

		var data = $("#payform").serialize();
		if(service == "waimai" || service == "huodong"){
			data += "&check=1";
		}

		$.ajax({
			url: masterDomain+"/include/ajax.php",
			data: data,
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				if(data && data.state == 100){
					$("#action").val("pay");
					$("#payform").submit();

					setTimeout(function(){
						t.removeClass("disabled").html(btnHtml);

						//验证是否支付成功，如果成功跳转到指定页面
						setTimeout(function(){
							var timer = setInterval(function(){
								$.ajax({
									type: 'POST',
									async: false,
									url: '/include/ajax.php?service=member&action=tradePayResult&type=1&order='+$("#ordernum").val(),
									dataType: 'json',
									success: function(str){
										if(str.state == 100 && str.info != ""){
											//如果已经支付成功，则跳转到指定页面
											location.href = str.info;
										}
									}
								});
							}, 2000);
						}, 3000)

					}, 3000);

				}else{
					$("#action").val("pay");
					showErr(data.info);
					t.removeClass("disabled").html(btnHtml);
				}
			},
			error: function(){
				$("#action").val("pay");
				showErr(langData['siteConfig'][20][183]);
				t.removeClass("disabled").html(btnHtml);
			}
		});

	});

})

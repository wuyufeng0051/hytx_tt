$(function(){


	$('.add-tip i').click(function(){
		$(this).closest('.add-tip').hide();
	})


	//计算最多可用多少个积分
	if(totalPoint > 0 && totalCoupon > 0){

		var pointMoney = totalPoint / pointRatio, cusePoint = totalPoint;

		//填充可使用的最大值
		$("#cusePoint").html(cusePoint.toFixed(2));
		// $("#usePcount").val(cusePoint.toFixed(2));
		$("#disMoney").html(cusePoint / pointRatio);
	}



	var anotherPay = {

		//使用积分
		usePoint: function(){
			// $("#usePcount").val(cusePoint.toFixed(2));  //重置为最大值

			//判断是否使用余额
			if($("#useBalance").attr("checked")){
				this.useBalance();
			}
		}

		//使用余额
		,useBalance: function(){

			var balanceTotal = totalBalance;

			//判断是否使用积分
			if($("#usePinput").attr("checked")){

				// var pointSelectMoney = Number($("#usePcount").val()) / pointRatio;
				// //如果余额不够支付所有费用，则把所有余额都用上
				// if(totalAmount - pointSelectMoney < totalBalance){
				// 	balanceTotal = totalAmount - pointSelectMoney;
				// }

			//没有使用积分
			}else{

				//如果余额大于订单总额，则将可使用额度重置为订单总额
				if(totalBalance > totalAmount){
					balanceTotal = totalAmount;
				}

			}

			balanceTotal = balanceTotal < 0 ? 0 : balanceTotal;
			balanceTotal = balanceTotal.toFixed(2);
			cuseBalance = balanceTotal;
			$("#useBcount").val(balanceTotal);
			// $("#balMoney, #cuseBalance").html(balanceTotal);  //计算抵扣值
		}

		//重新计算还需支付的值
		,resetTotalMoney: function(){

			var totalPayMoney = totalAmount, usePcountInput = Number($("#usePcount").val()), useBcountInput = Number($("#useBcount").val());

			if($("#usePinput").attr("checked") && usePcountInput > 0){
				totalPayMoney -= usePcountInput / pointRatio;
			}
			if($("#useBalance").attr("checked") && useBcountInput > 0){
				totalPayMoney -= useBcountInput;
			}

			$("#totalPayMoney").html(totalPayMoney.toFixed(2));

			if(totalPayMoney <= 0){
				$(".btmCartWrap .submit").val("确认提交");
			}else{
				$(".btmCartWrap .submit").val("去付款");
			}
		}

	}


	//使用积分抵扣/余额支付
	$("#usePinput, #useBalance").bind("click", function(){
		var t = $(this), ischeck = t.attr("checked"), type = t.attr("name");

		//积分
		if(type == "usePinput"){

			//确定使用
			if(ischeck){
				anotherPay.usePoint();

			//如果不使用积分，重新计算余额
			}else{

				$("#usePcount").val("0");

				//判断是否使用余额
				if($("#useBalance").attr("checked")){
					anotherPay.useBalance();
				}
			}

		//余额
		}else if(type == "useBalance"){

			//确定使用
			if(ischeck){
				anotherPay.useBalance();
				$("#userYue").show();
				$("#paypwd").focus();
			}else{
				$("#useBcount").val("0");
				$("#userYue").hide();
			}
		}

		anotherPay.resetTotalMoney();
	});







	//提交支付
	$(".submit").bind("click", function(event){
		var t = $(this);

		if(t.hasClass("disabled")) return false;

		if($("#pros").val() == ""){
			alert("商品获取失败，请刷新页面重试！");
			return false;
		}
		if($("#address").val() == 0 || $("#address").val() == ""){
			alert("请选择收货地址！");
			return false;
		}

		t.addClass("disabled").html("提交中...");
		$.ajax({
			url: $("#payform").attr("action"),
			data: $("#payform").serialize(),
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				if(data && data.state == 100){

					//从购物车中删除提交后的商品
					var cartData = $.cookie(cookiePre+"build_cart"), prosval = $("#pros").val();
					if(cartData && prosval){
						var cartDataArr = cartData.split("|"), newCartData = cartDataArr, proArr = prosval.split("|");
						for(var p = 0; p < proArr.length; p++){
							val = proArr[p].split(",");
							for(var i = 0; i < cartDataArr.length; i++){
								var cData = cartDataArr[i].split(",");
								if(val[0] == cData[0] && val[1] == cData[1]){
									newCartData.splice(i,1);
								}
							}
						}
						$.cookie(cookiePre+"build_cart", newCartData.join("|"), {expires: 7, domain: cookieDomain, path: '/'});
					}

					location.href = data.info;
				}else{
					alert(data.info);
					t.removeClass("disabled").html("去付款");
				}
			},
			error: function(){
				alert("网络错误，请重试！");
				t.removeClass("disabled").html("去付款");
			}
		});

	});


})



//地址选择成功
function chooseAddressOk(addrArr){
	$("#addressid").val(addrArr.id);
	$(".chooseAddress").html('<i class="icon-map"></i><div class="address-info"><span class="name">'+addrArr.people+'</span><span class="tel">'+addrArr.contact+'</span><span class="address-txt">'+addrArr.addrname+' '+addrArr.address+'</span></div><i class="icon-right"></i>');
}

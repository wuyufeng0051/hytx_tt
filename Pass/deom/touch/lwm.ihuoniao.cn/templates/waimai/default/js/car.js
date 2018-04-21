$(function(){

	//选中第一种支付方式
	$(".pay_style li:eq(0)").addClass("pay_bc");

	//加载购物车内容
	var cartHistory = utils.getStorage("wm_cart_"+shopid);
	if(cartHistory){

		order_content = cartHistory;

		var list = [];
		for(var i = 0; i < cartHistory.length; i++){

			//商品价格
			var price = (cartHistory[i].price + cartHistory[i].nprice) * cartHistory[i].count;
			foodTotalPrice += price;

			//打包费用
			if(cartHistory[i].dabao > 0){
				dabaoTotalPrice += cartHistory[i].dabao * cartHistory[i].count;
			}

			list.push('<div class="car_t1 fn-clear"><div class="car_pic"><img src="'+cartHistory[i].pic+'" onerror="this.src=\'/static/images/food.png\'"></div><h1>'+cartHistory[i].title+'</h1><h2>'+cartHistory[i].ntitle+'&nbsp;</h2><span class="fn-clear"><em>&yen;'+price.toFixed(2)+'</em><p>× '+cartHistory[i].count+(cartHistory[i].unit ? cartHistory[i].unit : "")+'</p></span></div>');

		}

		//商品总价 && 打包费
		$("#totalFoodPrice").html(foodTotalPrice);
		if(dabaoTotalPrice > 0){
			$("#dabaoPrice").html(dabaoTotalPrice);
			$("#dabao").show();
		}

		//满减
		var manjianTxt = "";
		if(promotions.length > 0){
			for(var i = 0; i < promotions.length; i++){
				if(promotions[i][0] > 0 && promotions[i][0] <= foodTotalPrice * discount_value / 10){
					manjianTxt = "满"+promotions[i][0]+"减"+promotions[i][1]+"元";
					manjianPrice = promotions[i][1];
				}
			}
		}
		if(manjianPrice > 0){
			$("#manjian").html(manjianTxt).show();
		}

		//增值服务
		var addserviceTxt = "", nowt = Number(nowTime.replace(":", ""));
		if(addservice){
			for(var i = 0; i < addservice.length; i++){
				var tit = addservice[i][0], start = Number(addservice[i][1].replace(":", "")), end = Number(addservice[i][2].replace(":", "")), pri = parseFloat(addservice[i][3]);
				if(start < nowt && end > nowt && pri > 0){
					addserviceTxt = tit + "：" + pri + "元";
					addservicePrice = pri;
				}
			}
		}
		$("#addservice").html(addserviceTxt).show();

		//配送费

		//固定起送价、配送费
		if(delivery_fee_mode == 1){

			//满额减
			if(delivery_fee_type == 2 && foodTotalPrice <= delivery_fee_value){
				delivery_fee = 0;
			}

		}

		//按区域
		if(delivery_fee_mode == 2){

		}

		//按距离
		if(delivery_fee_mode == 3 && range_delivery_fee_value.length > 0){
			for(var i = 0; i < range_delivery_fee_value.length; i++){
				var sj = parseFloat(range_delivery_fee_value[i][0]), ej = parseFloat(range_delivery_fee_value[i][1]), ps = parseFloat(range_delivery_fee_value[i][2]), qs = parseFloat(range_delivery_fee_value[i][3]);
				if(sj <= juli && ej >= juli){
					delivery_fee = ps;
					basicprice = qs;
				}
			}
		}


		// if(delivery_fee_type == 1 || (delivery_fee_type == 2 && foodTotalPrice <= delivery_fee_value)){
		//
		// 	//开启按距离收取不同的配送费和不同的起送价
		// 	if(open_range_delivery_fee && range_delivery_fee_value.length > 0){
		//
		// 		for(var i = 0; i < range_delivery_fee_value.length; i++){
		// 			var sj = parseFloat(range_delivery_fee_value[i][0]), ej = parseFloat(range_delivery_fee_value[i][1]), ps = parseFloat(range_delivery_fee_value[i][2]), qs = parseFloat(range_delivery_fee_value[i][3]);
		// 			if(sj <= juli && ej >= juli){
		// 				delivery_fee = ps;
		// 				basicprice = qs;
		// 			}
		// 		}
		//
		// 	}else{
		// 		delivery_fee = delivery_fee;
		// 	}
		//
		// }else{
		// 	delivery_fee = 0;
		// }
		if(delivery_fee > 0){
			$("#peisongPrice").html(delivery_fee);
			$("#peisong").show();
		}

		//起送验证
		if(foodTotalPrice < basicprice){
			$("#tj").html("未达到起送价"+basicprice+"元（还差"+(basicprice - foodTotalPrice)+"元）").attr("disabled", true);
		}else{
			$("#tj").html("提交订单").removeAttr("disabled");
		}

		//总费用
		//商品总价 * 打折 - 满减 + 打包费 + 配送费 + 增值服务费 - 首单减免
		var totalPrice = (foodTotalPrice * discount_value / 10 - manjianPrice + dabaoTotalPrice + delivery_fee + addservicePrice - first_discount).toFixed(2);
		totalPrice = totalPrice < 0 ? 0 : totalPrice;
		$(".price b").html("&yen;" + totalPrice);

		$("#cartList").html(list.join(""));

		$(".cart").show();
	}else{
		$(".empty").show();
	}


	// 支付方式选择
	$('.pay_style ul li').click(function(){
		var x = $(this), paytype = x.attr('id');
		x.addClass('pay_bc').siblings('li').removeClass('pay_bc');

		x.parent().siblings(".info").text("");
		// 货到付款
		if(paytype == 'delivery'){
			if(offline_limit && totalPrice > pay_offline_limit){
				x.parent().siblings(".info").html('抱歉，商家设置了货到付款限制金额为：&yen;'+pay_offline_limit+'，<a href="'+buyUrl+'">去筛选</a>');
			}
		}
		else if(paytype == 'money'){
			if(myMoney < totalPrice){
				x.parent().siblings(".info").html("抱歉，您的当前余额为：&yen;"+myMoney+'，不足以支付本次订单。<a href="'+depositUrl+'">立即充值</a>');
			}
		}


	});



	//提交
	$("#tj").bind("click", function(){
		var t = $(this);

		if(!cart_address_id){
			alert("请选择送餐地址！");
			return false;
		}

		var paytype = $(".pay_style .pay_bc").attr("id");
		if(paytype != "alipay" && paytype != "wxpay" && paytype != "delivery" && paytype != "money"){
			alert("请选择支付方式！");
			return false;

		}else{
			// 货到付款
			if(paytype == 'delivery'){
				if(offline_limit && totalPrice > pay_offline_limit){
					alert("抱歉，商家设置了货到付款限制金额为：￥"+pay_offline_limit);
					return false;
				}
			}
			else if(paytype == 'money'){
				if(myMoney < totalPrice){
					alert("抱歉，您的当前余额为：￥"+myMoney+"，不足以支付本次订单。");
					return false;
				}
			}
		}

		if(!order_content){
			alert("购物车是空的，请选择商品后再提交！");
			return false;
		}

		var preset = [];
		$(".preset_item").each(function(){
			var p = $(this), tit = p.find("em").text(), val = p.find(".preset").val();
			preset.push({"title": tit, "value": val});
		});

		var note = $("#note").val();

		t.attr("disabled", true).html("提交中...");


		$.ajax({
            url: '/include/ajax.php?service=waimai&action=deal',
            data: {
                shop: shopid,
                address: cart_address_id,
                paytype: paytype,
                order_content: JSON.stringify(order_content),
                preset: JSON.stringify(preset),
                note: note
            },
            type: 'post',
            dataType: 'json',
            success: function(data){
				if(data && data.state == 100){
					location.href = payUrl.replace("#ordernum", data.info);
				}else{
					alert(data.info);
					t.removeAttr("disabled").html("提交订单");
				}
			},
			error: function(){
				alert("网络错误，提交失败！");
				t.removeAttr("disabled").html("提交订单");
			}
		});


	});



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

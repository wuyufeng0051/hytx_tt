$(function(){

	var totalPrice = 0;

	//加载购物车内容
	var cartHistory = utils.getStorage("wm_cart_"+shopid), food = '[';
	if(cartHistory){

		order_content = cartHistory;

		var list = [];
		for(var i = 0; i < cartHistory.length; i++){

			//商品价格
			var price_ = cartHistory[i].price + cartHistory[i].nprice;
			var price = (cartHistory[i].price + cartHistory[i].nprice) * cartHistory[i].count;
			foodTotalPrice += price;

			//打包费用
			if(cartHistory[i].dabao > 0){
				dabaoTotalPrice += cartHistory[i].dabao * cartHistory[i].count;
			}

			list.push('<div class="car_t1 fn-clear"><p class="car_title fn-clear"><span class="car_h1 fn-left">'+cartHistory[i].title+'</span><span class="car_h2 fn-left">×'+cartHistory[i].count+'</span><em class="fn-left car_h3">'+echoCurrency("symbol")+price_.toFixed(2)+'</em></p><p class="car_info">'+cartHistory[i].ntitle+'</p></div>');

			// food.push({id:cartHistory[i].id, price: cartHistory[i].price * cartHistory[i].count});

			var price_price = cartHistory[i].price + cartHistory[i].nprice;
			food = food + '{"id": "'+cartHistory[i].id+'", "price": '+price_price.toFixed(2) * cartHistory[i].count + '},';

		}

		food = food.substr(0, food.length-1);
		food = food + ']';

		//商品总价 && 打包费
		$("#totalFoodPrice").html(foodTotalPrice.toFixed(2));
		if(dabaoTotalPrice > 0){
			$("#dabaoPrice").html(dabaoTotalPrice);
			$("#dabao").show();
		}

		//满减
		var manjianTxt = "";
		if(promotions.length > 0){
			for(var i = 0; i < promotions.length; i++){
				if(promotions[i][0] > 0 && promotions[i][0] <= foodTotalPrice * discount_value / 10){
					manjianTxt = '<i class="sale">'+langData['waimai'][2][93]+'</i>'+langData['waimai'][2][95]+'<span class="fn-right">'+langData['waimai'][2][10].replace('1', promotions[i][0]).replace('2', promotions[i][1])+'</span>';
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
					addserviceTxt = '<span class="spantit">'+tit+'</span><em class="fn-right">'+echoCurrency("symbol")+pri+'</em>';
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
			$("#tj").html(langData['waimai'][2][96]+basicprice+echoCurrency("short")+"（"+langData['waimai'][2][97]+(basicprice - foodTotalPrice)+echoCurrency("short")).attr("disabled", true);
		}else{
			$("#tj").html(langData['waimai'][2][40]).removeAttr("disabled");
		}

		//总费用
		//商品总价 * 打折 - 满减 + 打包费 + 配送费 + 增值服务费 - 首单减免
		totalPrice = (foodTotalPrice * discount_value / 10 - manjianPrice + dabaoTotalPrice + delivery_fee + addservicePrice - first_discount).toFixed(2);
		totalPrice = totalPrice < 0 ? 0 : totalPrice;

		$(".price b").html(echoCurrency("symbol") + totalPrice);
		var youhuid = (foodTotalPrice - totalPrice) > 0 ? (foodTotalPrice - totalPrice) : 0;
		$(".youhui i").text(youhuid.toFixed(2));

		$("#cartList").html(list.join(""));

		$(".cart").show();
	}else{
		$(".empty").show();
	}


	// 验证优惠券
	function checkQuan(){
		var data = [];
		data.push('shop='+shopid);
		data.push('food='+food);
		$.ajax({
			url: '/include/ajax.php?service=waimai&action=quanList',
			type: 'post',
			data : data.join("&"),
			dataType: 'json',
			success: function(data){
				if(data && data.state == 100){
					var list = data.info.list, len = list.length;
					var txt = '', cls = '';
					if(len == 0){
						quanid = 0;
						txt = langData['waimai'][2][37];
					}else{
						if(quanid > 0){
							for(var i = 0; i < len; i++){
								var obj = list[i];
								if(obj.id == quanid){
									var quanmoney = obj.money;
									txt = quanmoney+echoCurrency("short")+langData['waimai'][2][98];
									totalPrice = totalPrice - quanmoney;
									totalPrice = totalPrice < 0 ? 0 : totalPrice;
									$(".price b").html(echoCurrency("symbol") + totalPrice.toFixed(2));
									var youhuid = (foodTotalPrice - totalPrice) > 0 ? (foodTotalPrice - totalPrice) : 0;
									$(".youhui i").text(youhuid.toFixed(2));
									cls = 'has';
									break;
								}
							}
						}
						if(txt == ''){
							quanid = quanid == -1 ? - 1 : 0;
							if(data.info.yes == 0){
								txt = langData['waimai'][2][37];
							}else{
								txt = langData['waimai'][2][99].replace('1', data.info.yes);
								cls = 'has';
							}
						}
					}

					if(autoSelectQun && cls == 'has' && quanid == 0){
						autoSelectQun = false;
						quanid = data.info.good;
						// checkQuan();
						$('.quan span').text(list[0].money+echoCurrency("short")+langData['waimai'][2][36]).addClass(cls);

						totalPrice = totalPrice - list[0].money;
						totalPrice = totalPrice < 0 ? 0 : totalPrice;
						$(".price b").html(echoCurrency("symbol") + totalPrice.toFixed(2));
						var youhuid = (foodTotalPrice - totalPrice) > 0 ? (foodTotalPrice - totalPrice) : 0;
						$(".youhui i").text(youhuid.toFixed(2));
					}else{
						$('.quan span').text(txt).addClass(cls);
					}
				}else{
					$('.quan span').text(langData['waimai'][2][37]);
				}
			}
		})
	}
	var autoSelectQun = true;
	checkQuan();



	//提交
	$("#tj").bind("click", function(){
		var t = $(this);

		if(!cart_address_id){
			alert(langData['waimai'][3][74]);
			return false;
		}

		if(!order_content){
			alert(langData['siteConfig'][20][450]);
			return false;
		}

		var preset = [];
		$(".preset_item").each(function(){
			var p = $(this), tit = p.find("em").text(), val = p.find(".preset").val();
			preset.push({"title": tit, "value": val});
		});

		var note = $("#note").val();

		t.attr("disabled", true).html(langData['siteConfig'][6][35]+"...");


		if(confirm(langData['waimai'][3][75]+"\n"+$("#selectAddress").text())){
			$.ajax({
	            url: '/include/ajax.php?service=waimai&action=deal',
	            data: {
	                shop: shopid,
	                address: cart_address_id,
	                order_content: JSON.stringify(order_content),
	                preset: JSON.stringify(preset),
	                note: note,
	                quanid: quanid
	            },
	            type: 'post',
	            dataType: 'json',
	            success: function(data){
					if(data && data.state == 100){
						location.href = payUrl.replace("#ordernum", data.info);
					}else{
						alert(data.info);
						t.removeAttr("disabled").html(langData['waimai'][2][40]);
					}
				},
				error: function(){
					alert(langData['siteConfig'][20][181]);
					t.removeAttr("disabled").html(langData['waimai'][2][40]);
				}
			});
		}else{
			t.removeAttr("disabled").html(langData['waimai'][2][40]);
		}

	});

	$(".place a, .quan a").click(function(e){
		// e.preventDefault();
		updateCarInfo();
	})

	function updateCarInfo(){
		var paytype = $(".pay_style .pay_bc").attr("id"), paypwd = $(".paypwd").val();
		var preset = [];
		$(".preset_item").each(function(){
			var p = $(this), tit = p.find("em").text(), val = p.find(".preset").val();
			preset.push({"title": tit, "value": val});
		});
		var note = $("#note").val();


		$.ajax({
			url: '/include/ajax.php?service=waimai&action=updateCart',
			type: 'get',
			data: {
                shop: shopid,
                address: cart_address_id,
                paytype: paytype,
                preset: JSON.stringify(preset),
                note: note,
                quanid: quanid,
                paypwd: paypwd
            },
			dataType: 'json',
			success: function(data){

			}
		})
	}



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

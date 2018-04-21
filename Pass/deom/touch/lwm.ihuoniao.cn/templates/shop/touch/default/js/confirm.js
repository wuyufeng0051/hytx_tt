$(function(){

	// 关闭提示
	$('.add-tip i').click(function(){
		$(this).parent().remove();
	})


	//选择收货地址
  $(".address .t").bind("click", function(){
    $("#p1, .btmCartWrap").hide();
    $("#p2").show();
  });

  //选择收货地址后退
  $("#p2 .goback1").bind("click", function(){
    $("#p2").hide();
    $("#p1, .btmCartWrap").show();
  });

  //确定收货地址
  $(".addresslist").delegate("a", "click", function(){
    var t = $(this), id = t.attr("data-id"), name = t.attr("data-name"), tel = t.attr("data-tel"), addr = t.attr("data-addr");
    $("#address").val(id);
    $(".address-info").html('<span class="name">'+name+'</span><span class="tel">'+tel+'</span><span class="address-txt">'+addr+'</span>').removeClass('empty');
    $("#p2 .goback1").click();
  });

  //添加收货地址
  $(".addAddress").bind("click", function(){
    $("#p2").hide();
    $("#p3").show();
  });

  //新增收货地址后退
  $("#p3 .goback1").bind("click", function(){
    $("#p3").hide();
    $("#p2").show();
  });


  var addrid = 0, addArr = [];

	//区域
	$("#addrlist").delegate("select", "change", function(){
		var sel = $(this), id = sel.val(), index = sel.index(), selLen = sel.siblings().length+1;
		if(id == 0){
			sel.closest("li").addClass("error");
			$("#addrlist select").slice(index+1,selLen).remove();
		} else if(id != 0 && id != ""){
			$.ajax({
				type: "GET",
				url: masterDomain+"/include/ajax.php",
				data: "service=siteConfig&action=addr&son=0&type="+id,
				dataType: "jsonp",
				success: function(data){
					var i = 0, opt = [];
					if(data instanceof Object && data.state == 100){
						for(var key in data.info){
							var selected = addArr.length > 0 && addArr[index+1] == data.info[key]['typename'] ? " selected" : "";
							opt.push('<option value="'+data.info[key]['id']+'"'+selected+'>'+data.info[key]['typename']+'</option>');
						}
						$("#addrlist select").slice(index+1,selLen).remove();
						$("#addrlist").append('\n<select name="addrid[]"><option value="0">请选择区域</option>'+opt.join("")+'</select>');
						sel.closest("li").addClass("error");

						if(addArr.length > 0){
							$("#addrlist select:last").change();
						}
					}else{
						sel.closest("li").removeClass("error");
					}
				},
				error: function(msg){
					alert(msg.status+":"+msg.statusText);
				}
			});
		}
	});

	//新地址表单验证
	var inputVerify = {
		person: function(){
			var t = $("#person"), val = t.val(), par = t.closest("li");
			if(val.length < 2 || val.length > 15){
				alert('请填写收货人')
				return false;
			}
			return true;
		}
		,mobile: function(){
			var t = $("#mobile"), val = t.val(), par = t.closest("li");
			var exp = new RegExp("^(13|14|15|17|18)[0-9]{9}$", "img");
			if(val == ""){
				alert('请填写手机号');
				return false;
			}else{
				if(!/^(13|14|15|17|18)[0-9]{9}$/.test(val) && val != ""){
					alert('请填写正确的手机号码')
					return false;
				}
			}
			return true;
		}
		,addrid: function(){
			if($("#addrlist select:last").val() == 0){
				$("#addrlist").parents("li").addClass("error");
				alert('请选择完整的省市区')
				return false;
			}
			return true;
		}
		,address: function(){
			var t = $("#addr"), val = t.val(), par = t.closest("li");
			if(val.length < 5 || val.length > 60 || /^\d+$/.test(val)){
				alert('请正确填写详细地址');
				return false;
			}
			return true;
		}
	}

	//提交新增/修改
	$("#submit").on("click", function(){

		var t = $(this);

		if(t.hasClass("disabled")) return false;

		//验证表单
		if(inputVerify.person() && inputVerify.mobile() && inputVerify.addrid() && inputVerify.address() ){

			var data = [];
			data.push('id='+0);
			data.push('addrid='+$("#addrlist select:last").val());
			data.push('address='+$("#addr").val());
			data.push('person='+$("#person").val());
			data.push('mobile='+$("#mobile").val());

			t.addClass("disabled").html("提交中...");

      $.ajax({
				url: masterDomain+"/include/ajax.php?service=member&action=addressAdd",
				data: data.join("&"),
				type: "GET",
				dataType: "jsonp",
				success: function (data) {
					if(data && data.state == 100){

						//返回到地址列表
            $("#p3 .goback1").click();

						//异步加载所有地址
						$.ajax({
							url: masterDomain+"/include/ajax.php?service=member&action=address",
							type: "POST",
							dataType: "jsonp",
							success: function (data) {
								if(data && data.state == 100){

                  $(".null").remove();
									var list = [], addList = data.info.list;

									for(var i = 0; i < addList.length; i++){
                    contact = addList[i].mobile != "" && addList[i].tel != "" ? addList[i].mobile : (addList[i].mobile == "" && addList[i].tel != "" ? addList[i].tel : addList[i].mobile);
                    list.push('<div class="item">');
										list.push('<a src="javascript:;" data-id="'+addList[i].id+'" data-name="'+addList[i].person+'" data-tel="'+contact+'" data-tel="'+addList[i].tel+'" data-addr="'+addList[i].addrname+'&nbsp;&nbsp;'+addList[i].address+'">');
                    list.push('<p><span>'+addList[i].person+'</span><span>电话：'+contact+'</span></p>');
                    list.push('<p>'+addList[i].addrname+'&nbsp;&nbsp;'+addList[i].address+'</p>');
                    list.push('<div class="btn_address"><span>选择该收货地址</span></div>');
                    list.push('</a>');
										list.push('</div>');
									}

									$(".addresslist").html(list.join(""));

								}else{
									alert("加载失败，请刷新页面重试！");
								}
							},
							error: function(){
								alert("加载失败，请刷新页面重试！");
							}
						});

            t.removeClass("disabled").html("保存");
            $(".addaddress input").val("");
            $("#addrid option:eq(0)").attr("selected", "selected");
            $("#addrid").siblings("select").remove();

					}else{
						alert(data.info);
						t.removeClass("disabled").html("保存");
					}
				},
				error: function(){
					alert("网络错误，请重试！");
					t.removeClass("disabled").html("保存");
				}
			});

		}

	});










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
					var cartData = $.cookie(cookiePre+"shop_cart"), prosval = $("#pros").val();
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
						$.cookie(cookiePre+"shop_cart", newCartData.join("|"), {expires: 7, domain: cookieDomain, path: '/'});
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

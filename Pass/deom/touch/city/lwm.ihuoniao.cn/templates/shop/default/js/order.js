$(function(){

	var addrid = 0, addArr = [];
	setTimeout(function(){
		$("#usePcount, #useBcount, #paypwd").val("");
	}, 500);

	//设置默认地址
	$(".part1Con").delegate(".setAddress", "click", function(){
		var $address=$(this);
		$address.text("默认地址").parents("dl").siblings("dl").find("a.setAddress").text("设置默认");
		$address.parents("dl").addClass("on").siblings("dl").removeClass("on");
		$("#addressid").val($address.closest("dl").attr("data-id"));
	});

	$(".part1Con").delegate("dt", "click", function(){
		var $dt=$(this);
		$dt.siblings("dd").find("a.setAddress").text("默认地址").parents("dl").siblings("dl").find("a.setAddress").text("设置默认");
		$dt.parents("dl").addClass("on").siblings("dl").removeClass("on");
		$("#addressid").val($dt.closest("dl").attr("data-id"));
	});

	$("#addressid").val($(".part1Con .on").data("id"));

	//添加地址
	$(".part1Con .add").on("click",function(){
		$(".popCon .tip .left").html("新增收货地址");
		$("#bg,.popup").show();
	});

	//修改地址
	$(".part1Con").delegate(".revise", "click", function(){
		var t = $(this), dl = t.closest("dl");
		addrid = dl.attr("data-id");
		$(".popCon .tip .left").html("修改收货地址");
		$("#bg,.popup").show();

		//填充数据
		$("#person").val(dl.attr("data-name"));
		$("#mobile").val(dl.attr("data-mobile"));
		$("#tel").val(dl.attr("data-tel"));
		$("#address").val(dl.attr("data-address"));

		addArr = dl.attr("data-addr").split(" ");
		$("#addrlist select:eq(0) option").each(function(){
			if($(this).text() == addArr[0]){
				$(this).attr("selected", true);
			}
		});
		$("#addrlist select:eq(0)").change();

	});

	//关闭弹出层
	$(".popup .tip i").on("click",function(){
		$("#bg,.popup").hide();

		//清空表单数据
		$(".popCon input").val("");
		$(".popCon .error").removeClass("error");
		$("#addrlist select:eq(0)").nextAll("select").remove();
		$("#addrlist select:eq(0) option:eq(0)").attr("selected", true);
		$("#mobile").next(".input-tips").show().html('<s></s>手机号码和固定电话最少填写一项');
	});


	//新地址表单验证
	var inputVerify = {
		addrid: function(){
			if($("#addrlist select:last").val() == 0){
				$("#addrlist").parents("li").addClass("error");
				return false;
			}
			return true;
		}
		,address: function(){
			var t = $("#address"), val = t.val(), par = t.closest("li");
			if(val.length < 5 || val.length > 60 || /^\d+$/.test(val)){
				par.addClass("error");
				return false;
			}
			return true;
		}
		,person: function(){
			var t = $("#person"), val = t.val(), par = t.closest("li");
			if(val.length < 2 || val.length > 15){
				par.addClass("error");
				return false;
			}
			return true;
		}
		,mobile: function(){
			var t = $("#mobile"), val = t.val(), par = t.closest("li");
			var exp = new RegExp("^(13|14|15|17|18)[0-9]{9}$", "img");
			if(!exp.test(val) && $("#tel").val() == ""){
				par.addClass("error");
				par.find(".input-tips").html("<s></s>请输入正确的手机号码").show();
				return false;
			}else{
				if(!/^(13|14|15|17|18)[0-9]{9}$/.test(val) && val != ""){
					par.addClass("error");
					par.find(".input-tips").html("<s></s>请输入正确的手机号码").show();
					return false;
				}else{
					par.find(".input-tips").html("<s></s>手机号码和固定电话最少填写一项").hide();
				}
			}
			return true;
		}
		,tel: function(){
			var t = $("#tel"), val = t.val(), par = t.closest("li");
			if($("#mobile").val() == "" && val == ""){
				par.addClass("error");
				return false;
			}
			return true;
		}

	}


	//区域
	$("#addrlist").delegate("select", "change", function(){
		var sel = $(this), id = sel.val(), index = sel.index();
		if(id == 0){
			sel.closest("li").addClass("error");
			sel.nextAll("select").remove();
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
						sel.nextAll("select").remove();
						$("#addrlist").append('<select name="addrid[]"><option value="0">请选择区域</option>'+opt.join("")+'</select>');
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

	$(".popCon input").bind("click", function(){
		$(this).closest("li").removeClass("error");
		if($(this).attr("id") == "mobile"){
			$("#tel").closest("li").removeClass("error");
		}
		if($(this).attr("id") == "tel"){
			$("#mobile").closest("li").removeClass("error");
			$("#mobile").closest("li").find(".input-tips").hide();
		}
	});

	$(".popCon input").bind("blur", function(){
		var id = $(this).attr("id");

		if((id == "address" && inputVerify.address()) ||
			 (id == "person" && inputVerify.person()) ||
			 (id == "mobile" && inputVerify.mobile()) ||
			 (id == "tel" && inputVerify.tel()) ){

			$(this).closest("li").removeClass("error");
		}

	});


	//提交新增/修改
	$("#submit").bind("click", function(){

		var t = $(this);

		if(t.hasClass("disabled")) return false;

		//验证表单
		if(inputVerify.addrid() && inputVerify.address() && inputVerify.person() && inputVerify.mobile() && inputVerify.tel() ){

			var data = [];
			data.push('id='+addrid);
			data.push('addrid='+$("#addrlist select:last").val());
			data.push('address='+$("#address").val());
			data.push('person='+$("#person").val());
			data.push('mobile='+$("#mobile").val());
			data.push('tel='+$("#tel").val());

			t.addClass("disabled").html("提交中...");

			$.ajax({
				url: masterDomain+"/include/ajax.php?service=member&action=addressAdd",
				data: data.join("&"),
				type: "POST",
				dataType: "jsonp",
				success: function (data) {
					if(data && data.state == 100){

						//操作成功后关闭浮动层
						$(".popup .tip i").click();

						$(".part1Con dl").remove();
						$(".part1Con").prepend('<div class="loading">加载中...</div>');

						//异步加载所有地址
						$.ajax({
							url: masterDomain+"/include/ajax.php?service=member&action=address",
							type: "POST",
							dataType: "jsonp",
							success: function (data) {
								if(data && data.state == 100){

									$(".part1Con .loading").remove();
									var list = [], addList = data.info.list;

									for(var i = 0; i < addList.length; i++){

										on = (i == 0 && addrid == 0) || (addrid == addList[i].id) ? 1 : 0;

										list.push('<dl'+(on ? " class='on'" : "")+' data-id="'+addList[i].id+'" data-name="'+addList[i].person+'" data-mobile="'+addList[i].mobile+'" data-tel="'+addList[i].tel+'" data-addr="'+addList[i].addrname+'" data-address="'+addList[i].address+'">');
										list.push('<dt><i></i>');

										contact = addList[i].mobile != "" && addList[i].tel != "" ? addList[i].mobile : (addList[i].mobile == "" && addList[i].tel != "" ? addList[i].tel : addList[i].mobile);

										list.push('<p class="name"><span>'+addList[i].person+'</span>  <span>'+contact+'</span></p>');
										list.push('<p class="address"><span>'+addList[i].addrname.replace(/\s+/g, '</span><span>')+'</span></p>');
										list.push('<p class="detail">'+addList[i].address+'</p>');
										list.push('</dt>');
										list.push('<dd><a class="setAddress" href="javascript:;">'+(on ? "默认地址" : "设置默认")+'</a><a class="revise" href="javascript:;">修改</a><a class="delete" href="javascript:;">删除</a></dd>');
										list.push('</dl>');
									}

									$(".part1Con").prepend(list.join(""));
									addrid = 0;
									addArr = [];

									t.removeClass("disabled").html("确认收货信息");
									$("#addressid").val($(".part1Con .on").data("id"));


								}else{
									alert("加载失败，请刷新页面重试！");
									t.removeClass("disabled").html("确认收货信息");
								}
							},
							error: function(){
								alert("加载失败，请刷新页面重试！");
								t.removeClass("disabled").html("确认收货信息");
							}
						});


					}else{
						alert(data.info);
						t.removeClass("disabled").html("确认收货信息");
					}
				},
				error: function(){
					alert("网络错误，请重试！");
					t.removeClass("disabled").html("确认收货信息");
				}
			});

		}

	});


	//删除地址
	$(".part1Con").delegate(".delete", "click", function(){
		var $delete=$(this),$one=$(".part1Con");
		if(confirm("确认要删除选中的地址信息吗？")){

			$.ajax({
				url: "/include/ajax.php?service=member&action=addressDel",
				data: "id="+$delete.closest("dl").attr("data-id"),
				type: "POST",
				dataType: "jsonp",
				success: function (data) {
					if(data && data.state == 100){

						if($delete.parents("dl").hasClass("on")){
							if($delete.parents("dl").index()==0){
								$one.find("dl:eq(1)").addClass("on").siblings("dl").removeClass("on");
								$one.find("dl:eq(1) a.setAddress").text("默认地址");
								$one.find("dl:eq(1)").siblings("dl").find("a.setAddress").text("设置默认");
							}else{
								$one.find("dl:first").addClass("on").siblings("dl").removeClass("on");
								$one.find("dl:first a.setAddress").text("默认地址");
								$one.find("dl:first").siblings("dl").find("a.setAddress").text("设置默认");
							}
						}
						$delete.parents("dl").remove();
						$("#addressid").val($(".part1Con .on").data("id"));

					}else{
						alert(data.info);
					}
				},
				error: function(){
					alert("网络错误，请重试！");
				}
			});

		}
		$(".part1Con dl.on a.setAddress").css("color","#333");

	})



	//支付方式功能区域
	$(".part3Con .pay-style").on("click",function(){
		var $bank=$(this);
		$bank.parents(".payStyle").removeClass("none").siblings(".payStyle").addClass("none");
	});

	$("#paytype").val($(".bank-icon.active:eq(0)").data("type"));

	//选择银行
	$(".part3Con .bank-icon").on("click",function(){
		var $t=$(this);
		$t.addClass("active").siblings("a").removeClass("active");
		$t.parents(".payStyle").siblings(".payStyle").removeClass("active");
		$t.parents(".payStyle").siblings(".payStyle").find(".bank-icon").removeClass("active");
		$("#paytype").val($t.data("type"));
	});



	//积分&余额功能区域

	//计算最多可用多少个积分
	if(totalPoint > 0){

		var pointMoney = totalPoint / pointRatio, cusePoint = totalPoint;
		if(pointMoney > totalAmount){
			cusePoint = totalAmount * pointRatio;
		}

		//填充可使用的最大值
		$("#cusePoint").html(parseInt(cusePoint));
		$("#usePcount").val(parseInt(cusePoint));

	}

	//计算最多可用多少余额
	if(totalBalance > 0){

		var cuseBalance = totalBalance;
		if(totalBalance > totalAmount){
			cuseBalance = totalAmount;
		}
		$("#cuseBalance").html(cuseBalance);

	}

	var anotherPay = {

		//使用积分
		usePoint: function(){
			$("#usePcount").val(parseInt(cusePoint));  //重置为最大值
			$("#disMoney").html(cusePoint / pointRatio);  //计算抵扣值

			//判断是否使用余额
			if($("#useBalance").attr("checked") == "checked"){
				this.useBalance();
			}
		}

		//使用余额
		,useBalance: function(){

			var balanceTotal = totalBalance;

			//判断是否使用积分
			if($("#usePinput").attr("checked") == "checked"){

				var pointSelectMoney = $("#usePcount").val() / pointRatio;
				//如果余额不够支付所有费用，则把所有余额都用上
				if(totalAmount - pointSelectMoney < totalBalance){
					balanceTotal = totalAmount - pointSelectMoney;
				}

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
			$("#balMoney, #cuseBalance").html(balanceTotal);  //计算抵扣值
		}

		//重新计算还需支付的值
		,resetTotalMoney: function(){

			var totalPayMoney = totalAmount, usePcountInput = $("#usePcount").val(), useBcountInput = $("#useBcount").val();

			if($("#usePinput").attr("checked") == "checked" && usePcountInput > 0){
				totalPayMoney -= usePcountInput / pointRatio;
			}
			if($("#useBalance").attr("checked") == "checked" && useBcountInput > 0){
				totalPayMoney -= useBcountInput;
			}

			$("#totalPayMoney").html(totalPayMoney.toFixed(2));
		}

	}


	//使用积分抵扣/余额支付
	$("#usePinput, #useBalance").bind("click", function(){
		var t = $(this), ischeck = t.attr("checked"), parent = t.closest(".account-summary"), type = t.attr("name");
		if(ischeck == "checked"){
			parent.find(".use-input, .use-tip").show();
		}else{
			parent.find(".use-input, .use-tip").hide();
		}

		//积分
		if(type == "usePinput"){
			$("#disMoney").html("0");  //重置抵扣值

			//确定使用
			if(ischeck == "checked"){
				anotherPay.usePoint();

			//如果不使用积分，重新计算余额
			}else{

				$("#usePcount").val("0");

				//判断是否使用余额
				if($("#useBalance").attr("checked") == "checked"){
					anotherPay.useBalance();
				}
			}

		//余额
		}else if(type == "useBalance"){
			$("#balMoney").html("0");

			//确定使用
			if(ischeck == "checked"){
				anotherPay.useBalance();
			}else{
				$("#useBcount").val("0");
			}
		}

		anotherPay.resetTotalMoney();
	});


	//验证积分输入
	var lastInputVal = 0;
	$("#usePcount").bind("blur", function(){
		var t = $(this), val = t.val();

		//判断输入是否有变化
		if(lastInputVal == val) return;

		if(val > cusePoint){
			alert("此单最多可用 "+cusePoint+" 个"+pointName);
			$("#usePcount").val(cusePoint);
			$("#disMoney").html(cusePoint / pointRatio);
			lastInputVal = cusePoint;
		}else{
			lastInputVal = val;
			$("#disMoney").html(val / pointRatio);
		}

		//判断是否使用余额
		if($("#useBalance").attr("checked") == "checked"){
			anotherPay.useBalance();
		}
		anotherPay.resetTotalMoney();

	});


	//验证余额输入
	$("#useBcount").bind("blur", function(){
		var t = $(this), val = Number(t.val()), check = true;

		cuseBalance = Number(cuseBalance);

		var exp = new RegExp("^(?:[1-9]\\d*|0)(?:.\\d{1,2})?$", "img");
		if(!exp.test(val)){
			check = false;
		}

		if(!check){
			alert("请输入正确的数值，最多支持两位小数！");
			$("#useBcount").val("0");
			$("#balMoney").html("0");
		}else if(val > cuseBalance){
			alert("此单最多可用 "+cuseBalance+" 元");
			$("#useBcount").val(cuseBalance);
			$("#balMoney").html(cuseBalance);
		}else{
			$("#balMoney").html(val);
		}
		anotherPay.resetTotalMoney();
	});


	//提交支付
	$(".submitOrder").bind("click", function(event){
		var t = $(this);

		if(t.hasClass("disabled")) return false;

		if($("#pros").val() == ""){
			alert("商品获取失败，请刷新页面重试！");
			return false;
		}
		if($("#addressid").val() == 0 || $("#addressid").val() == ""){
			alert("请选择收货地址！");
			return false;
		}
		if($("#paytype").val() == 0){
			alert("请选择支付方式！");
			return false;
		}

		var pinputCheck  = $("#usePinput").attr("checked"),
				point        = $("#usePcount").val(),
				balanceCheck = $("#useBalance").attr("checked"),
				balance       = $("#useBcount").val(),
				paypwd       = $("#paypwd").val();

		if(balanceCheck == "checked" && balance > 0 && paypwd == ""){
			alert("请输入支付密码！");
			return false;
		}

		t.addClass("disabled").html("提交中...");
		$.ajax({
			url: masterDomain+"/include/ajax.php?service=shop&action=checkPayAmount",
			data: $("#payform").serialize(),
			type: "POST",
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

					$("#payform").submit();
				}else{
					alert(data.info);
					t.removeClass("disabled").html("提交订单并支付");
				}
			},
			error: function(){
				alert("网络错误，请重试！");
				t.removeClass("disabled").html("提交订单并支付");
			}
		});

	});


});

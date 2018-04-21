$(function(){

	var convertPrice = 0;

	//表单验证
	$(".inp").bind("input click focus", function(){
		$(this).removeClass("error").siblings(".tip-inline").removeClass().addClass("tip-inline").show();
	});


	//金额验证
	$("#amount").bind("blur", function(){
		var t = $(this), val = t.val(), tip = t.siblings(".tip-inline");

		var regu = "(^[1-9]([0-9]?)+[\.][0-9]{1,2}?$)|(^[1-9]([0-9]+)?$)|(^[0][\.][0-9]{1,2}?$)";
		var re = new RegExp(regu);
		if (!re.test(val)) {

			tip.removeClass().addClass("tip-inline error").html('<s></s>金额必须为整数或小数，小数点后不超过2位。').show();
			t.addClass("error");
			$("#count").html(0);
			convertPrice = 0;
			
		}else if(val > totalMoney){

			tip.removeClass().addClass("tip-inline error").html('<s></s>余额不足，请充值！').show();
			t.addClass("error");
			$("#count").html(0);
			convertPrice = 0;

		}else{
			t.removeClass("error");
			tip.removeClass().addClass("tip-inline ok").html('<s></s>金额必须为整数或小数，小数点后不超过2位。').show();
			$("#count").html(val * pointRatio);
			convertPrice = val;
		}

	});


	//支付密码
	$("#paypwd").bind("blur", function(){
		var t = $(this), val = t.val(), tip = t.siblings(".tip-inline");
		if(val == ""){
			tip.removeClass().addClass("tip-inline error").show();
			t.addClass("error");
		}else{
			t.removeClass("error");
			tip.removeClass().addClass("tip-inline ok").show();
		}
	});


	//提交支付
	$("#tj").bind("click", function(event){
		var t = $(this);

		if(convertPrice == 0){
			alert("请输入需要兑换的金额！");
			$("#amount").focus();
			return false;
		}
		if(convertPrice > totalMoney){
			alert("您输入的兑换金额大于您的余额，请充值后重试！");
			$("#amount").focus();
			return false;
		}
		if($("#paypwd").val() == ""){
			alert("请输入支付密码！");
			$("#paypwd").focus();
			return false;
		}
		if(!$("#agree").is(":checked")){
			alert("您必须同意并接受《现金与福券兑换服务协议》");
			return false;
		}

		var action = $("#payform").attr("action"), data = $("#payform").serialize();

		t.attr("disabled", true).html("提交中...");
		
		$.ajax({
			url: action,
			data: data,
			type: "POST",
			dataType: "json",
			success: function (data) {
				if(data && data.state == 100){
					
					$.dialog({
						title: '提示消息',
						icon: 'success.png',
						content: '兑换成功！',
						ok: function(){
							location.reload();
						}
					});

				}else{
					$.dialog.alert(data.info);
					t.attr("disabled", false).html("确认兑换");
				}
			},
			error: function(){
				$.dialog.alert("网络错误，请重试！");
				t.attr("disabled", false).html("确认兑换");
			}
		});


	});

});

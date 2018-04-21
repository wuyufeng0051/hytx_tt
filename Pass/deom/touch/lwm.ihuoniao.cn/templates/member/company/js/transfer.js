$(function(){

	var transferCount = 0;

	//表单验证
	$(".inp").bind("input click focus", function(){
		$(this).removeClass("error").siblings(".tip-inline").removeClass().addClass("tip-inline").show();
	});


	//对方用户名
	$("#user").bind("blur", function(){
		var t = $(this), val = t.val(), tip = t.siblings(".tip-inline");
		if(val == ""){
			tip.removeClass().addClass("tip-inline error").show();
			t.addClass("error");
		}else{
			t.removeClass("error");
			tip.removeClass().addClass("tip-inline ok").show();
		}
	});


	//数量验证
	$("#amount").bind("blur", function(){
		var t = $(this), val = t.val(), tip = t.siblings(".tip-inline");
		var fee = val * pointFee / 100;

		var regu = "(^[1-9]([0-9]?)+[\.][0-9]{1,2}?$)|(^[1-9]([0-9]+)?$)|(^[0][\.][0-9]{1,2}?$)";
		var re = new RegExp(regu);
		if (!re.test(val)) {

			tip.removeClass().addClass("tip-inline error").html('<s></s>数量必须为整数或小数，小数点后不超过2位。').show();
			t.addClass("error");
			$("#fee").html(0);
			$("#true").html(0);
			transferCount = 0;
			
		}else if(val > totalPoint){

			tip.removeClass().addClass("tip-inline error").html('<s></s>可用'+pointName+'不足！').show();
			t.addClass("error");
			$("#fee").html(0);
			$("#true").html(0);
			transferCount = 0;

		}else{
			t.removeClass("error");
			tip.removeClass().addClass("tip-inline ok").html('<s></s>数量必须为整数或小数，小数点后不超过2位。').show();
			$("#fee").html(fee);
			$("#true").html(val - fee);
			transferCount = val;
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

		if($("#user").val() == ""){
			alert("请输入对方用户名！");
			$("#user").focus();
			return false;
		}
		if(transferCount == 0){
			alert("请输入需要转赠的数量！");
			$("#amount").focus();
			return false;
		}
		if(transferCount > totalPoint){
			alert("您输入的转赠数量大于您的总数量，请充值后重试！");
			$("#amount").focus();
			return false;
		}
		if($("#paypwd").val() == ""){
			alert("请输入支付密码！");
			$("#paypwd").focus();
			return false;
		}
		if(!$("#agree").is(":checked")){
			alert("您必须同意并接受《现金与福券转赠服务协议》");
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
						content: '转赠成功！',
						ok: function(){
							location.reload();
						}
					});

				}else{
					$.dialog.alert(data.info);
					t.attr("disabled", false).html("确认转赠");
				}
			},
			error: function(){
				$.dialog.alert("网络错误，请重试！");
				t.attr("disabled", false).html("确认转赠");
			}
		});


	});

});

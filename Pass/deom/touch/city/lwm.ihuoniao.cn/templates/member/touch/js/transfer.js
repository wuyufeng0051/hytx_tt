$(function(){

	var transferCount = 0;



	//数量验证
	$("#amount").bind("blur", function(){
		var t = $(this), val = t.val();
		var fee = val * pointFee / 100;

		var regu = "(^[1-9]([0-9]?)+[\.][0-9]{1,2}?$)|(^[1-9]([0-9]+)?$)|(^[0][\.][0-9]{1,2}?$)";
		var re = new RegExp(regu);
		if (!re.test(val)) {

			showMsg('数量必须为整数或小数，小数点后不超过2位。');
			$("#fee").html(0);
			$("#true").html(0);
			transferCount = 0;

		}else if(val > totalPoint){

			showMsg('可用积分不足！');
			$("#fee").html(0);
			$("#true").html(0);
			transferCount = 0;

		}else{
			$("#fee").html(fee);
			$("#true").html(val - fee);
			transferCount = val;
		}

	});



	//提交支付
	$("#tj").bind("click", function(event){
		var t = $(this);

		if($("#user").val() == ""){
			showMsg("请输入对方用户名！");
			return false;
		}
		if(transferCount == 0){
			showMsg("请输入需要转赠的数量！");
			return false;
		}
		if(transferCount > totalPoint){
			showMsg("您输入的转赠数量大于您的总数量，请充值后重试！");
			return false;
		}
		if($("#paypwd").val() == ""){
			showMsg("请输入支付密码！");
			return false;
		}

		var action = $("#payform").attr("action"), data = $("#payform").serialize();

		t.addClass("disabled").html("提交中...");

		$.ajax({
			url: action,
			data: data,
			type: "POST",
			dataType: "json",
			success: function (data) {
				if(data && data.state == 100){

					t.removeClass('disabled').text('转增成功！');
					setTimeout(function(){
						location.reload();
					},500);

				}else{
					t.text(data.info);
					setTimeout(function(){
						t.removeClass('disabled').text("确认转赠");
					},500);
				}
			},
			error: function(){
				alert("网络错误，请重试！");
				t.removeClass('disabled').html("确认转赠");
			}
		});


	});

});



// 错误提示
function showMsg(str){
  var o = $(".error");
  o.html('<p>'+str+'</p>').show();
  setTimeout(function(){o.hide()},1000);
}

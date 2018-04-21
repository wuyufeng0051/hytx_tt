$(function(){

  var convertPrice = 0;

  $("#amount").bind("blur", function(){
		var t = $(this), val = t.val();

    var regu = "(^[1-9]([0-9]?)+[\.][0-9]{1,2}?$)|(^[1-9]([0-9]+)?$)|(^[0][\.][0-9]{1,2}?$)";
		var re = new RegExp(regu);
		if (!re.test(val)) {

			showMsg('金额必须为整数或小数，小数点后不超过2位。');
			$("#count").html(0);
			convertPrice = 0;

		}else if(val > totalMoney){

			showMsg('余额不足，请充值！');
			$("#count").html(0);
			convertPrice = 0;

		}else{
			$("#count").html(val * pointRatio);
			convertPrice = val;
		}

	});

  //提交支付
	$("#tj").bind("click", function(event){
		var t = $(this), val = $('#amount').val();

		if(t.hasClass('disabled')) return;

		if(convertPrice == 0){
			showMsg("请输入需要兑换的金额！");
			return false;
		}
		else if(convertPrice > totalMoney){
			showMsg("您输入的兑换金额大于您的余额，请充值后重试！");
			return false;
		}
		if($("#paypwd").val() == ""){
			showMsg("请输入支付密码！");
			return false;
		}

		var action = $("#payform").attr("action"), data = $("#payform").serialize();

		t.addClass('disabled').html("提交中...");

		$.ajax({
			url: action,
			data: data,
			type: "POST",
			dataType: "json",
			success: function (data) {
				if(data && data.state == 100){
					t.removeClass('disabled').text('兑换成功！');
					setTimeout(function(){
						location.reload();
					},500);

				}else{
					t.text(data.info);
					setTimeout(function(){
						t.removeClass('disabled').text("确认兑换");
					},500);
				}
			},
			error: function(){
				alert("网络错误，请重试！");
				t.removeClass('disabled').html("确认兑换");
			}
		});


	});



})



// 错误提示
function showMsg(str){
  var o = $(".error");
  o.html('<p>'+str+'</p>').show();
  setTimeout(function(){o.hide()},1000);
}

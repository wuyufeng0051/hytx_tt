$(function(){

	//提交
	$("#tj").bind("click", function(){

		//验证登录
		var userid = $.cookie(cookiePre+"login_user");
		if(userid == null || userid == ""){
			location.href = masterDomain+'/login.html';
			return false;
		}

		var t = $(this), payform = t.closest("form"), action = payform.attr("data-action");

		if(t.hasClass("disabled")) return false;

		if($("#ordernum").val() == "" && $("#id") == ""){
			alert("参数传递错误，请重新下单！");
			return false;
		}

		var addressid = $("#addressid").val();
		if(addressid == undefined || addressid == 0 || addressid == null){
			alert("请选择收货地址！");
			return false;
		}

		t.addClass("disabled").html("提交中...");
		$.ajax({
			url: action,
			data: payform.serialize()+"&check=1",
			dataType: "jsonp",
			success: function (data) {
				if(data && data.state == 100){
					payform.submit();
				}else{
					if(data.info == "登录超时"){
						location.href = masterDomain + "/login.html";
						return;
					}else if(data.state == 103){
						location.href = storeUrl;
						return;
					}
					alert(data.info);
					t.removeClass("disabled").html("重新提交订单");
				}
			},
			error: function(){
				alert("网络错误，添加失败！");
				t.removeClass("disabled").html("重新提交订单");
			}
		});

	});


})



//地址选择成功
function chooseAddressOk(addrArr){
	$("#addressid").val(addrArr.id);
	$(".chooseAddress").html('<div class="info-l"><p><span>'+addrArr.people+'</span><span class="info-phone">'+addrArr.contact+'</span></p><p class="info-address">'+addrArr.addrname+' '+addrArr.address+'</p></div><div class="info-r"><i><img src="'+templatePath+'images/right1.png"></i></div>');
}

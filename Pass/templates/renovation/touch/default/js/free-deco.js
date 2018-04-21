$(function(){

	// 表单验证
	$('.submit').click(function(){

		var tel = $('.phone').val(), f = $(this), addrid = $('.gz-addr-seladdr').attr('data-id');

		if(f.hasClass("disabled")) return false;

		if ($('.name').val() == "") {
			$('.name-1').show();
	    	setTimeout(function(){$('.name-1').hide()},1000);
		}
		else if ($('.phone').val() == "") {
			$('.phone-1').show();
	    	setTimeout(function(){$('.phone-1').hide()},1000);
		}
		else if (!(/^1[34578]\d{9}$/.test(tel))){
			$('.phone-1').text('请填写正确的手机号').show();
	    	setTimeout(function(){$('.phone-1').hide()},1000);
		}
		else if ($('.city').text() == '请选择您所在的城市') {
			$('.city-1').show();
	    	setTimeout(function(){$('.city-1').hide()},1000);
		}else {

			f.addClass("disabled").val("申请中...");

			var data = [];
			data.push("people="+$('.name').val());
			data.push("contact="+$('.phone').val());
			data.push("addrid="+addrid);

			$.ajax({
				url: masterDomain+"/include/ajax.php?service=renovation&action=sendEntrust&"+data.join("&"),
				dataType: "jsonp",
				success: function (data) {
					f.removeClass("disabled").val("立即申请");
					if(data && data.state == 100){
						alert("申请成功，工作人员收到您的信息后会第一时间与你联系，请保持您的手机畅通！");
					}else{
						alert(data.info);
					}
				},
				error: function(){
					alert("网络错误，请重试！");
					f.removeClass("disabled").val("申请中...");
				}
			});

		}

	})


})

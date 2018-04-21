$(function(){
	var mySwiper = new Swiper('.swiper-container',{
		autoplay : 5000,//可选选项，自动滑动
		})
	// 免费设计
    $('.sj').click(function(){
    	var  x = $(".sj_list");
    	if (x.css("display")=="none") {
    		x.show();
				$('.free').hide();
    		$('.disk').show();
    		$('body').addClass('by');
    	}else{
    		x.hide();
				$('.free').show();
    		$('.disk').hide();
    		$('body').removeClass('by');
    	}
    })

		// 关闭
    $('.sj_list p, .disk').click(function(){
    	$('.disk, .sj_list').hide();
			$('.free').show();
			$('body').removeClass('by');
    	$('.stylist_lead').removeClass('sc_1');
			$('.screen').removeClass('sc_1');
    })

		// 表单验证
		$('.submit').click(function(){
			var tel = $('.phone').val(), btn = $(this);
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
			else if ($('.city').val() == "") {
			 $('.city-1').show();
			 setTimeout(function(){$('.city-1').hide()},1000);
			 $('.city').text('');
		 }else {

			 btn.addClass("disabled").val("提交中...");

			 var data = [];
			 data.push("company="+company);
			 data.push("userid="+designer);
			 data.push("people="+$('.name').val());
			 data.push("contact="+tel);
			 data.push("community="+$('.city').val());

			 $.ajax({
				 url: masterDomain+"/include/ajax.php?service=renovation&action=sendRese&"+data.join("&"),
				 dataType: "jsonp",
				 success: function (data) {
					 btn.removeClass("disabled").val("提交");
					 if(data && data.state == 100){
						 alert("预约成功，工作人员收到您的信息后会第一时间与你联系，请保持您的手机畅通！");
						 $('.yuyue_list p').click();
					 }else{
						 alert(data.info);
					 }
				 },
				 error: function(){
					 alert("网络错误，请重试！");
					 btn.removeClass("disabled").val("提交中...");
				 }
			 });

			 return false;
		 }

		})


})

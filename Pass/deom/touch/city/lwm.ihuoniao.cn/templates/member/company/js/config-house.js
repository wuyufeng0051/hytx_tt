$(function(){

	getEditor("note");

	//提交发布
	$("#submit").bind("click", function(event){

		event.preventDefault();

		var t       = $(this),
				title   = $("#title"),
				litpic  = $("#litpic"),
				tel     = $("#tel"),
				address = $("#address"),
				vdimgck = $("#vdimgck");

		if(t.hasClass("disabled")) return;

		var offsetTop = 0;

		//公司名称
		if($.trim(title.val()) == "" || title.val() == 0){
			title.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请输入公司名称");
			offsetTop = offsetTop == 0 ? title.position().top : offsetTop;
		}

		//logo
		if($.trim(litpic.val()) == "" && offsetTop == 0){
			$.dialog.alert("请上传公司LOGO");
			offsetTop = offsetTop == 0 ? $("#listSection1").position().top : offsetTop;
		}

		//联系方式
		if($.trim(tel.val()) == "" || tel.val() == 0){
			tel.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请输入联系电话");
			offsetTop = offsetTop == 0 ? tel.position().top : offsetTop;
		}

		//地址
		if($.trim(address.val()) == "" || address.val() == 0){
			address.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请输入联系地址");
			offsetTop = offsetTop == 0 ? address.position().top : offsetTop;
		}

		ue.sync();

		//验证验证码
		if($.trim(vdimgck.val()) == ""){
			vdimgck.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请输入码证码！");
			offsetTop = offsetTop == 0 ? vdimgck.position().top : offsetTop;
		}

		if(offsetTop){
			$('.main').animate({scrollTop: offsetTop + 10}, 300);
			return false;
		}

		var form = $("#fabuForm"), action = form.attr("action");
		t.addClass("disabled").html("提交中...");

		$.ajax({
			url: action,
			data: form.serialize(),
			type: "POST",
			dataType: "json",
			success: function (data) {
				if(data && data.state == 100){

					$.dialog({
						title: '提示消息',
						icon: 'success.png',
						content: data.info,
						ok: function(){}
					});
					t.removeClass("disabled").html("保存设置");

				}else{
					$.dialog.alert(data.info);
					t.removeClass("disabled").html("保存设置");
					$("#verifycode").click();
				}
			},
			error: function(){
				$.dialog.alert("网络错误，请重试！");
				t.removeClass("disabled").html("保存设置");
				$("#verifycode").click();
			}
		});


	});
});

$(function(){

	//提交发布
	$("#submit").bind("click", function(event){

		event.preventDefault();

		var t = $(this),
			title   = $("#title"),
			litpic  = $("#litpic"),
			panor   = $("#panor"),
			vdimgck = $("#vdimgck");

		if(t.hasClass("disabled")) return;

		var offsetTop = 0;

		//验证名称
		if($.trim(title.val()) == ""){
			title.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+title.data("title"));
			offsetTop = title.offset().top;
		}

		//验证缩略图
		if($.trim(litpic.val()) == ""){
			$.dialog.alert("请上传缩略图");
			return false;
		}

		//验证视频地址
		if($.trim(panor.val()) == ""){
			panor.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+panor.data("title"));
			offsetTop = panor.offset().top;
		}

		//验证验证码
		if($.trim(vdimgck.val()) == ""){
			vdimgck.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请输入码证码！");
			offsetTop = offsetTop == 0 ? vdimgck.offset().top : offsetTop;
		}

		if(offsetTop){
			$('.main').animate({scrollTop: offsetTop - 5}, 300);
			return false;
		}

		var form = $("#fabuForm"), action = form.attr("action"), url = form.attr("data-url");
		data = form.serialize();

		t.addClass("disabled").html("提交中...");

		$.ajax({
			url: action,
			data: data,
			type: "POST",
			dataType: "json",
			success: function (data) {
				if(data && data.state == 100){
					var tip = "添加成功！";
					if(id != undefined && id != "" && id != 0){
						tip = "修改成功！";
					}
					$.dialog({
						title: '提示消息',
						icon: 'success.png',
						content: tip,
						ok: function(){
							location.href = url;
						}
					});
				}else{
					$.dialog.alert(data.info);
					t.removeClass("disabled").html("确认提交");
					$("#verifycode").click();
				}
			},
			error: function(){
				$.dialog.alert("网络错误，请重试！");
				t.removeClass("disabled").html("确认提交");
				$("#verifycode").click();
			}
		});


	});


});

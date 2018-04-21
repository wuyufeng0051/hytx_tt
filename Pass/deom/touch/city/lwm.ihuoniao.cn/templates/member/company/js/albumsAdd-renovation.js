$(function(){

	$("#typeObj span").bind("click", function(){
		var t = $(this), id = t.data("id");
		$("#type0, #type1").hide();
		$("#type"+id).show();
	});

	//提交发布
	$("#submit").bind("click", function(event){

		event.preventDefault();

		var t        = $(this),
				designer = $("#designer").val(),
				title    = $("#title"),
				litpic   = $("#litpic").val(),
				vdimgck  = $("#vdimgck");

		if(t.hasClass("disabled")) return;

		var offsetTop = 0;

		if(designer == "" || designer == 0){
			var hline = $("#selTeam").find(".tip-inline"), tips = $("#designer").data("title");
			hline.removeClass().addClass("tip-inline error").html("<s></s>"+tips);
			offsetTop = $("#selTeam").position().top;
		}else{
			$("#selTeam").find(".tip-inline").removeClass().addClass("tip-inline success").html("<s></s>");
		}

		if($.trim(title.val()) == ""){
			var hline = title.next(".tip-inline"), tips = title.data("title");
			hline.removeClass().addClass("tip-inline error").html("<s></s>"+tips);
			offsetTop = $("#selTeam").position().top;
		}else{
			title.next(".tip-inline").removeClass().addClass("tip-inline success").html("<s></s>");
		}

		if(litpic == "" && offsetTop <= 0){
			$.dialog.alert("请上传缩略图");
			offsetTop = $("#license").position().top;
		}

		//图集
		var imgli = $("#listSection2 li");
		if(imgli.length <= 0 && offsetTop <= 0){
			$.dialog.alert("请上传图集");
			offsetTop = $(".list-holder").position().top;
		}

		//验证验证码
		if($.trim(vdimgck.val()) == ""){
			vdimgck.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请输入码证码！");
			offsetTop = offsetTop == 0 ? vdimgck.position().top : offsetTop;
		}

		if(offsetTop){
			$('.main').animate({scrollTop: offsetTop + 10}, 300);
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
					var tip = "发布成功！";
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

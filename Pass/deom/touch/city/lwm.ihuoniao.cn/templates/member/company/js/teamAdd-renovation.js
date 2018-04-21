$(function(){


	//提交发布
	$("#submit").bind("click", function(event){

		event.preventDefault();

		var t          = $(this),
				name       = $("#name"),
				post       = $("#post"),
				photo      = $("#litpic").val(),
				vdimgck     = $("#vdimgck");

		if(t.hasClass("disabled")) return;

		var offsetTop = 0;

		//验证名称
		if($.trim(name.val()) == ""){
			name.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+name.data("title"));
			offsetTop = name.offset().top;
		}

		//验证职位
		if($.trim(post.val()) == ""){
			post.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+post.data("title"));
			offsetTop = post.offset().top;
		}

    //头像
    if(photo == "" && offsetTop == 0){
      $.dialog.alert("请上传头像！");
      offsetTop = $(".thumb").offset().top;
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
					t.removeClass("disabled").html("立即投稿");
					$("#verifycode").click();
				}
			},
			error: function(){
				$.dialog.alert("网络错误，请重试！");
				t.removeClass("disabled").html("立即投稿");
				$("#verifycode").click();
			}
		});


	});


});

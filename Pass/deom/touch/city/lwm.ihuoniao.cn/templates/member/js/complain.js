$(function(){
	//更新验证码
	var verifycode = $("#verifycode").attr("src");
	$("#verifycode").bind("click", function(){
		$(this).attr("src", verifycode+"?v="+Math.random());
	});

	//表单提示
	$(".form").delegate("input[type=text]", "focus", function(){
		var t = $(this), tip = t.data("title"), hline = t.siblings(".tip-inline");
		hline.removeClass().addClass("tip-inline focus").html("<s></s>"+tip);
	});

	$("#type").bind("change", function(){
		var t = $(this), tip = t.data("title"), hline = t.siblings(".tip-inline");
		if(t.val() == ""){
			hline.removeClass().addClass("tip-inline error").html("<s></s>"+tip);
		}else{
			hline.removeClass().addClass("tip-inline success").html("<s></s>"+tip);
		}
	});

	$(".form").delegate("input[type=text]", "blur", function(){
		var t = $(this), dl = t.closest("dl"), name = t.attr("name"), tip = t.data("title"), hline = t.siblings(".tip-inline"), check = true;
		if($.trim(t.val()) != ""){			
			//验证码
			if(name == "vdimgck"){
				$.ajax({
					url: "/include/ajax.php?service=siteConfig&action=checkVdimgck&code="+t.val(),
					type: "GET",
					dataType: "jsonp",
					success: function (data) {
						if(data && data.state == 100){
							if(data.info == "error"){
								hline.removeClass().addClass("tip-inline error").html("<s></s>验证码输入错误！");
							}else{
								hline.removeClass().addClass("tip-inline success").html("<s></s>"+tip);
							}
						}
					}
				});
				return;
			}
			hline.removeClass().addClass("tip-inline success").html("<s></s>"+tip);
		}else{
			hline.removeClass().addClass("tip-inline error").html("<s></s>"+tip);
		}
	});

	//提交
	$("#submit").bind("click", function(event){
		event.preventDefault();

		var t = $(this), check = true;
		var type = $("#type");
		if(type.val() == ""){
			type.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+type.attr("data-title"));
			check = false;
		}
		var vdimgck = $("#vdimgck");
		if(vdimgck.val() == ""){
			vdimgck.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+vdimgck.attr("data-title"));
			check = false;
		}

		if(!check) return false;
		t.attr("disabled", true).html("提交中...");

		$.ajax({
			url: window.location.href,
			data: {
				"type": type.val(),
				"desc": $("#desc").val(),
				"vdimgck": vdimgck.val()
			},
			type: "POST",
			dataType: "jsonp",
			success: function (data) {
				if(data && data.state == 100){
					t.html("举报成功");

					setTimeout(function(){
						frameElement.api.close();
					}, 500);

				}else{
					alert(data.info);
					t.attr("disabled", false).html("提交");

					if(data.state == 101){
						setTimeout(function(){
							frameElement.api.close();
						}, 500);
					}
				}
			},
			error: function(){
				alert("网络错误，请重试！");
				t.attr("disabled", false).html("提交");
			}
		});

	});
});

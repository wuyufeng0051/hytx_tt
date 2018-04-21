$(function(){


	//表单验证
	var regex = {

		regexp: function(t, reg, err){
			var val = $.trim(t.val()), dl = t.closest("dl"), name = t.attr("name"),
					tip = t.data("title"), etip = tip, hline = dl.find(".tip-inline"), check = true;

			if(val != ""){
				var exp = new RegExp("^" + reg + "$", "img");
				if(!exp.test(val)){
					etip = err;
					check = false;
				}
			}else{
				check = false;
			}

			if(dl.attr("data-required") == 1){
				if(val == "" || !check){
					hline.removeClass().addClass("tip-inline error").html("<s></s>"+etip);
				}else{
					hline.removeClass().addClass("tip-inline success").html("<s></s>"+tip);
				}
				return check;
			}
		}

		//价格
		,price: function(){
			return this.regexp($("#price"), "(?!0+(?:.0+)?$)(?:[1-9]\\d*|0)(?:.\\d{1,2})?", "请填写正确的价格，必须为整数，且不能为0，最多支持两位小数点！");
		}


	}

	//提交发布
	$("#submit").bind("click", function(event){

		event.preventDefault();

		var t = $(this),
			title   = $("#title"),
			typeid  = $("#typeid").val(),
			price   = $("#price"),
			litpic   = $("#litpic").val(),
			vdimgck = $("#vdimgck");

		if(t.hasClass("disabled")) return;

		var offsetTop = 0;

		//验证名称
		if($.trim(title.val()) == ""){
			title.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+title.data("title"));
			offsetTop = title.offset().top;
		}

		//验证分类
		if(typeid == "" || typeid == 0){
			var dl = $("#selType");
			dl.find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请选择菜单分类");
			offsetTop = offsetTop == 0 ? dl.position().top : offsetTop;
		}

		//验证价格
		if(!regex.price() && offsetTop <= 0){
			offsetTop = $("#price").position().top;
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

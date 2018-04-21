$(function(){

	getEditor("body");


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

		//分类
		,typeid: function(){
			return this.regexp($("#typeid"), "[1-9]\\d*", "请选择商品分类");
		}

		//品牌
		,brand: function(){
			return this.regexp($("#brand"), "[1-9]\\d*", "请选择品牌");
		}

		//名称
		,title: function(){
			return this.regexp($("#title"), ".{5,100}", "请输入商品名称，5-50个字");
		}

		//市场价
		,mprice: function(){
			return this.regexp($("#mprice"), "(?!0+(?:.0+)?$)(?:[1-9]\\d*|0)(?:.\\d{1,2})?", "请填写正确的价格，必须为整数，且不能为0，最多支持两位小数点！");
		}

		//一口价
		,price: function(){
			return this.regexp($("#price"), "(?!0+(?:.0+)?$)(?:[1-9]\\d*|0)(?:.\\d{1,2})?", "请填写正确的价格，必须为整数，且不能为0，最多支持两位小数点！");
		}

		//物流
		,logistic: function(){
			return this.regexp($("#logistic"), "[1-9]\\d*", "输入错误，请填写正确的数字！");
		}

		//库存
		,inventory: function(){
			return this.regexp($("#inventory"), "[1-9]\\d*", "输入错误，请填写正确的数字！");
		}


	}


	//提交发布
	$("#submit").bind("click", function(event){

		event.preventDefault();

		var t        = $(this),
				litpic   = $("#litpic").val(),
				vdimgck  = $("#vdimgck");

		if(t.hasClass("disabled")) return;

		var offsetTop = 0;

		if(!regex.typeid() && offsetTop <= 0){
			offsetTop = $("#selType").position().top;
		}

		if(!regex.brand() && offsetTop <= 0){
			offsetTop = $("#selBrand").position().top;
		}

		if(!regex.title() && offsetTop <= 0){
			offsetTop = $("#title").position().top;
		}

		if(!regex.mprice() && offsetTop <= 0){
			offsetTop = $("#mprice").position().top;
		}

		if(!regex.price() && offsetTop <= 0){
			offsetTop = $("#price").position().top;
		}

		if(!regex.logistic() && offsetTop <= 0){
			offsetTop = $("#logistic").position().top;
		}

		if(!regex.inventory() && offsetTop <= 0){
			offsetTop = $("#inventory").position().top;
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

		ue.sync();

		if(!ue.hasContents() && offsetTop <= 0){
			$.dialog.alert("请输入商品描述！");
			offsetTop = $("#body").position().top;
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
					var tip = "发布成功";
					if(id != undefined && id != "" && id != 0){
						tip = "修改成功";
					}

					$.dialog({
						title: '提示消息',
						icon: 'success.png',
						content: tip + "，正在审核中，请耐心等待！",
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

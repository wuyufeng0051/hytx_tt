$(function(){

	//类别切换
	$(".type span").bind("click", function(){
		var id = $(this).attr("data-id");
		if(id == 1){
			$("#priceType").html("万元");
		}else{
			$("#priceType").html("元/月");
		}
	});

	//地址联想
	var autocomplete = new BMap.Autocomplete({input: "address"});
	autocomplete.setLocation(map_city);

	$("#loupan, #area, #price").bind("blur", function(){autoTitle();});

	$("#title").bind("input", function(){
		istit = true;
	});

	$("#selZhuangxiu a").bind("click", function(){
		zxtxt = $(this).text();
		autoTitle();
	});

	getEditor("note");


	//提交发布
	$("#submit").bind("click", function(event){

		event.preventDefault();

		var t           = $(this),
				title       = $("#title"),
				loupan      = $("#loupan"),
				addrid      = $("#addrid").val(),
				address     = $("#address"),
				litpic      = $("#litpic").val(),
				price       = $("#price"),
				proprice    = $("#proprice"),
				area        = $("#area"),
				litpic      = $("#litpic"),
				person      = $("#person"),
				tel         = $("#tel"),
				vdimgck     = $("#vdimgck");

		if(t.hasClass("disabled")) return;

		var offsetTop = 0;

		if($.trim(loupan.val()) == ""){
			var dl = loupan.closest("dl");
			dl.find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+loupan.attr("data-title"));
			offsetTop = offsetTop == 0 ? loupan.offset().top : offsetTop;
		}

		if($.trim(address.val()) == ""){
			var dl = address.closest("dl");
			dl.find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+address.attr("data-title"));
			offsetTop = offsetTop == 0 ? address.offset().top : offsetTop;
		}

		if(addrid == 0 || addrid == ""){
			var dl = $("#selAddr");
			dl.find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+$("#selAddr .sel-group:eq(0)").attr("data-title"));
			offsetTop = offsetTop == 0 ? $("#selAddr").offset().top : offsetTop;
		}

		if(price.val() == "" || price.val() == 0){
			var dl = price.closest("dl");
			dl.find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+price.attr("data-title"));
			offsetTop = offsetTop == 0 ? $("#totalPrice").offset().top : offsetTop;
		}

		if(proprice.val() == "" || proprice.val() == 0){
			var dl = proprice.closest("dl");
			dl.find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+proprice.attr("data-title"));
			offsetTop = offsetTop == 0 ? $("#proprice").offset().top : offsetTop;
		}

		if(area.val() == "" || area.val() == 0){
			var dl = area.closest("dl");
			dl.find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+area.attr("data-title"));
			offsetTop = offsetTop == 0 ? $("#area").offset().top : offsetTop;
		}

		var exp = new RegExp("^" + titleRegex + "$", "img");
		if(!exp.test(title.val())){
			title.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+titleErrTip);
			offsetTop = offsetTop == 0 ? title.offset().top : offsetTop;
		}

		if(litpic.val() == "" && offsetTop == 0){
			$.dialog.alert("请上传房源代表图片！");
			$('html, body').animate({scrollTop: $("#license").offset().top - 5}, 300);
			return false;
		}

		ue.sync();

		if(!ue.hasContents() && offsetTop == 0){
			$.dialog.alert("请输入房源描述信息！");
			offsetTop = offsetTop == 0 ? $("#note").offset().top : offsetTop;
		}


		//验证联系人
		var exp = new RegExp("^" + personRegex + "$", "img");
		if(!exp.test(person.val())){
			person.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+personErrTip);
			offsetTop = offsetTop == 0 ? person.offset().top : offsetTop;
		}

		//验证手机号码
		var exp = new RegExp("^" + telRegex + "$", "img");
		if(!exp.test(tel.val())){
			tel.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+telErrTip);
			offsetTop = offsetTop == 0 ? tel.offset().top : offsetTop;
		}

		//验证验证码
		if($.trim(vdimgck.val()) == ""){
			vdimgck.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请输入码证码！");
			offsetTop = offsetTop == 0 ? vdimgck.offset().top : offsetTop;
		}

		if(offsetTop){
			$('html, body').animate({scrollTop: offsetTop - 5}, 300);
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
					t.removeClass("disabled").html("立即发布");
					$("#verifycode").click();
				}
			},
			error: function(){
				$.dialog.alert("网络错误，请重试！");
				t.removeClass("disabled").html("立即发布");
				$("#verifycode").click();
			}
		});


	});

});

function autoTitle(){
	if(!istit){
		var lei    = $("#lei").val(),
				loupan = $("#loupan").val(),
				price  = $("#price").val(),
				area   = $("#area").val(),
				title  = loupan;
		if(area != ""){
			title += " " + area + "㎡";
		}
		if(price != ""){
			title += " " + price + (lei == 0 ? "元/月" : "万元");
		}
		if(zxtxt != "" && zxtxt != "装修情况" && zxtxt != "其它"){
			title += " " + zxtxt;
		}
		loupan != "" && $.trim(loupan) != "" ? $("#title").val(title) : "";
	}
}

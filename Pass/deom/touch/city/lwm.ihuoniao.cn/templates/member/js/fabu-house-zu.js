$(function(){

	//出租方式切换
	$(".rentype span").bind("click", function(){
		var id = $(this).attr("data-id"), par = $(this).closest("dd");
		if(id == 1){
			par.find(".sel-group").show();
		}else{
			par.find(".sel-group").hide();
		}
	});

	//地址联想
	var autocomplete = new BMap.Autocomplete({input: "address"});
	autocomplete.setLocation(map_city);

	$("#room").change(function(){autoTitle();});
	$("#area, #price").bind("blur", function(){autoTitle();});

	$("#selZhuangxiu a").bind("click", function(){
		zxtxt = $(this).text();
		autoTitle();
	});

	$("#title").bind("input", function(){
		istit = true;
	});

	getEditor("note");


	//提交发布
	$("#submit").bind("click", function(event){

		event.preventDefault();

		var t           = $(this),
				title       = $("#title"),
				community   = $("#community"),
				communityid = $("#communityid").val(),
				addrid      = $("#addrid").val(),
				address     = $("#address"),
				rentype     = $("#rentype").val(),
				sharetype   = $("#sharetype"),
				sharesex    = $("#sharesex"),
				litpic      = $("#litpic").val(),
				price       = $("#price"),
				paytype     = $("#paytype"),
				area        = $("#area"),
				litpic      = $("#litpic"),
				person      = $("#person"),
				tel         = $("#tel"),
				vdimgck     = $("#vdimgck");

		if(t.hasClass("disabled")) return;

		var offsetTop = 0;

		if($.trim(community.val()) == ""){
			var dl = community.closest("dl");
			dl.find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+community.attr("data-title"));
			offsetTop = offsetTop == 0 ? community.offset().top : offsetTop;
		}

		if($.trim(community.val()) != "" && (communityid == 0 || communityid == "") && $.trim(address.val()) == ""){
			var dl = address.closest("dl");
			dl.find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+address.attr("data-title"));
			offsetTop = offsetTop == 0 ? address.offset().top : offsetTop;
		}

		if($.trim(community.val()) != "" && (communityid == 0 || communityid == "") && addrid == 0){
			var dl = $("#selAddr");
			dl.find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+$("#selAddr .sel-group:eq(0)").attr("data-title"));
			offsetTop = offsetTop == 0 ? $("#selAddr").offset().top : offsetTop;
		}

		if(rentype == 1 && sharesex.val() == ""){
			var txt = $(".sharesex").attr("data-title"), dd = $(".sharesex").closest("dd");
			dd.find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+txt);
			offsetTop = offsetTop == 0 ? $(".rentype").offset().top : offsetTop;
		}

		if(rentype == 1 && sharetype.val() == ""){
			var txt = $(".sharetype").attr("data-title"), dd = $(".sharetype").closest("dd");
			dd.find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+txt);
			offsetTop = offsetTop == 0 ? $(".rentype").offset().top : offsetTop;
		}

		if(paytype.val() == ""){
			var txt = $(".paytype").attr("data-title"), dd = $(".paytype").closest("dd");
			dd.find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+txt);
			offsetTop = offsetTop == 0 ? $(".paytype").offset().top : offsetTop;
		}

		if(price.val() == "" || price.val() == 0){
			var dl = price.closest("dl");
			dl.find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+price.attr("data-title"));
			offsetTop = offsetTop == 0 ? $("#totalPrice").offset().top : offsetTop;
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
		var community = $("#community").val(),
				price     = $("#price").val(),
				room      = $("#room").val(),
				area      = $("#area").val(),
				title     = community + " " + room + "室";
		if(area != ""){
			title += " " + area + "㎡";
		}
		if(price != ""){
			title += " " + price + "万";
		}
		if(zxtxt != "" && zxtxt != "装修情况" && zxtxt != "其它"){
			title += " " + zxtxt;
		}
		community != "" && $.trim(community) != "" ? $("#title").val(title) : "";
	}

	if(unitPrice != 0 && area != 0 && area != ""){
		$(".tip-price").html("参考价："+ parseInt(unitPrice * area / 10000) + "万");
	}else{
		$(".tip-price").html("");
	}
}

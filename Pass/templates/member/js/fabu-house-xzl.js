$(function(){

	//类别切换
	$(".type span").bind("click", function(){
		var id = $(this).attr("data-id");
		if(id == 1){
			$("#priceType").html(langData['siteConfig'][13][27]+echoCurrency('short'));
		}else{
			$("#priceType").html(echoCurrency('short')+"/"+langData['siteConfig'][13][18]);
		}
	});

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

		$('#addrid').val($('#selAddr .addrBtn').attr('data-id'));

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
				tel         = $("#tel");

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
			$.dialog.alert(langData['siteConfig'][20][520]);
			$('html, body').animate({scrollTop: $("#license").offset().top - 5}, 300);
			return false;
		}

		ue.sync();

		if(!ue.hasContents() && offsetTop == 0){
			$.dialog.alert(langData['siteConfig'][20][521]);
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

		if(offsetTop){
			$('html, body').animate({scrollTop: offsetTop - 5}, 300);
			return false;
		}

		var form = $("#fabuForm"), action = form.attr("action"), url = form.attr("data-url");
		data = form.serialize();

		t.addClass("disabled").html(langData['siteConfig'][6][35]+"...");

		$.ajax({
			url: action,
			data: data,
			type: "POST",
			dataType: "json",
			success: function (data) {
				if(data && data.state == 100){

					fabuPay.check(data, url, t);

				}else{
					$.dialog.alert(data.info);
					t.removeClass("disabled").html(langData['siteConfig'][11][19]);
					$("#verifycode").click();
				}
			},
			error: function(){
				$.dialog.alert(langData['siteConfig'][20][183]);
				t.removeClass("disabled").html(langData['siteConfig'][11][19]);
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
			title += " " + price + (lei == 0 ? (echoCurrency('short')+"/"+langData['siteConfig'][13][18]) : (langData['siteConfig'][13][27]+echoCurrency('short')));
		}
		if(zxtxt != "" && zxtxt != langData['siteConfig'][19][92] && zxtxt != langData['siteConfig'][19][201]){
			title += " " + zxtxt;
		}
		loupan != "" && $.trim(loupan) != "" ? $("#title").val(title) : "";
	}
}

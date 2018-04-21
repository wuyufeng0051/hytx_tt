$(function(){
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

		$('#addrid').val($('#selAddr .addrBtn').attr('data-id'));

		var t           = $(this),
				title       = $("#title"),
				community   = $("#community"),
				communityid = $("#communityid").val(),
				addrid      = $("#addrid").val(),
				address     = $("#address"),
				litpic      = $("#litpic").val(),
				price       = $("#price"),
				area        = $("#area"),
				litpic      = $("#litpic"),
				person      = $("#person"),
				tel         = $("#tel");

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

		if(area.val() == "" || area.val() == 0){
			var dl = area.closest("dl");
			dl.find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+area.attr("data-title"));
			offsetTop = offsetTop == 0 ? $("#area").offset().top : offsetTop;
		}

		if(price.val() == "" || price.val() == 0){
			var dl = price.closest("dl");
			dl.find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+price.attr("data-title"));
			offsetTop = offsetTop == 0 ? $("#totalPrice").offset().top : offsetTop;
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
		var community = $("#community").val(),
				price     = $("#price").val(),
				room      = $("#room").val(),
				area      = $("#area").val(),
				title     = community + " " + room + langData['siteConfig'][13][8];
		if(area != ""){
			title += " " + area + "㎡";
		}
		if(price != ""){
			title += " " + price + langData['siteConfig'][13][27];
		}
		if(zxtxt != "" && zxtxt != langData['siteConfig'][19][92] && zxtxt != langData['siteConfig'][19][201]){
			title += " " + zxtxt;
		}
		community != "" && $.trim(community) != "" ? $("#title").val(title) : "";
	}

	if(unitPrice != 0 && area != 0 && area != ""){
		$(".tip-price").html(langData['siteConfig'][23][106]+"："+ parseInt(unitPrice * area / 10000) + langData['siteConfig'][13][27]);
	}else{
		$(".tip-price").html("");
	}
}

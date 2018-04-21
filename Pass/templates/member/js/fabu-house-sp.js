$(function(){

	//类别切换
	$(".type span").bind("click", function(){
		var id = $(this).attr("data-id");
		$(".industry, .transfer").hide();
		if(id != 0){
			$("#priceType").html(langData['siteConfig'][13][27]+echoCurrency('short'));
		}else{
			$("#priceType").html(echoCurrency('short')+"/"+langData['siteConfig'][13][18]);
		}

		if(id == 2){
			$(".industry, .transfer").show();
		}
		autoTitle();
	});

	//选择现在所经营的行业
	$("#selIndustry").delegate("a", "click", function(){
		if($(this).text() != langData['siteConfig'][22][96] && $(this).attr("data-id") != $("#industry").val()){
			var id = $(this).attr("data-id");
			$(this).closest(".sel-group").nextAll(".sel-group").remove();
			getChildIndustry(id);
		}
	});

	//获取子级行业
	function getChildIndustry(id){
		if(!id) return;
		$.ajax({
			url: "/include/ajax.php?service=house&action=industry&type="+id,
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				if(data && data.state == 100){
					var list = data.info, html = [];

					html.push('<div class="sel-group">');
					html.push('<button class="sel" type="button">'+langData['siteConfig'][22][96]+'<span class="caret"></span></button>');
					html.push('<ul class="sel-menu">');
					html.push('<li><a href="javascript:;" data-id="'+id+'">'+langData['siteConfig'][22][96]+'</a></li>');
					for(var i = 0; i < list.length; i++){
						html.push('<li><a href="javascript:;" data-id="'+list[i].id+'">'+list[i].typename+'</a></li>');
					}
					html.push('</ul>');
					html.push('</div>');

					$("#industry").before(html.join(""));

				}
			}
		});
	}

	$("#area, #price").bind("blur", function(){autoTitle();});

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
				lei         = $("#lei"),
				industry    = $("#industry").val(),
				title       = $("#title"),
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

		if(lei == 2 && (industry == "" || industry == 0)){
			var dl = $("#selIndustry");
			dl.find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+$("#selIndustry .sel-group:eq(0)").attr("data-title"));
			offsetTop = offsetTop == 0 ? $("#selIndustry").offset().top : offsetTop;
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
		setTimeout(function(){
			var lei    = $(".type .curr").text(),
					price  = $("#price").val(),
					area   = $("#area").val(),
					title  = "";
			if(area != ""){
				title += " " + area + "㎡";
			}
			if(price != ""){
				title += " " + price + (lei == 0 ? (echoCurrency('short')+"/"+langData['siteConfig'][13][18]) : (langData['siteConfig'][13][27]+echoCurrency('short')));
			}
			if(zxtxt != "" && zxtxt != langData['siteConfig'][19][92] && zxtxt != langData['siteConfig'][19][201]){
				title += " " + zxtxt;
			}
			title += " " + lei;
			$("#title").val(title);
		}, 200);
	}
}

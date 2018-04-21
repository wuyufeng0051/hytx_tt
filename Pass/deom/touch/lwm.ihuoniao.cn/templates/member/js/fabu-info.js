$(function(){

	if(typeid == 0 && id == 0){
		//大类切换
		$(".seltype .slide li").bind("click", function(){
			var t = $(this), index = t.index();
			if(!t.hasClass("curr")){
				t.addClass("curr").siblings("li").removeClass("curr");
				$(".seltype .stype ul").hide();
				$(".seltype .stype ul:eq("+index+")").show();
			}
		});

		$("#skey").val("");
		$("#skey").autocomplete({
			source: function( request, response ) {
				$.ajax({
					url: "/include/ajax.php?service=info&action=searchType",
					dataType: "jsonp",
					data:{
						key: request.term
					},
					success: function( data ) {
						if(data && data.state == 100){
							response( $.map( data.info, function( item, index ) {
								return {
									id: item.id,
									value: item.typename,
									label: (index+1)+". "+item.typename
								}
							}));
						}else{
							response([])
						}
					}
				});
			},
			minLength: 1,
			select: function( event, ui ) {
				location.href = getUrl(ui.item.id);
			}
		}).autocomplete( "instance" )._renderItem = function( ul, item ) {
			return $("<li>")
				.append(item.label)
				.appendTo( ul );
		};

		function getUrl(id){
			var url = $(".sform").data("url");
			return url.replace("%id%", id);
		}

		//二级分类
		$(".seltype .stype li").hover(function(){
			var sub = $(this).find(".subnav");
			if(sub.find("a").length > 0){
				$(this).addClass("curr");
				sub.show();
			}
		}, function(){
			var sub = $(this).find(".subnav");
			if(sub.find("a").length > 0){
				$(this).removeClass("curr");
				sub.hide();
			}
		});

		return false;

	}

	getEditor("body");

	//自动获取交易地点
	var coords = $().coords();
	var transform = function(e, t) {
		coords.transform(e,	function(e, n) {
			n != null ? $("#address").val(n.street + n.streetNumber) : $.dialog.alert(e.message);
			$("#address").siblings(".tip-inline").removeClass().addClass("tip-inline success");
			var dist = n.district;
			$("#selAddr .sel-group:eq(0) li").each(function(){
				var t = $(this).find("a"), v = t.text(), i = t.attr("data-id");
				if(v.indexOf(dist) > -1){
					$("#addr").val(i);
					$("#selAddr .sel-group:eq(0)").find("button").html(v+'<span class="caret"></span>');
					$("#selAddr .sel-group:eq(0)").siblings(".sel-group").remove();
					getChildAddr(i);
				}
			});
			t.hide();
		}, true);
	};
	$("#getlnglat").bind("click", function() {
		var e = $(this);
		coords.get(function(t, n) {
			transform(n, e);
		}),
		$(this).unbind("click").html("<s></s>获取中...");
	});

	var address = $("#address").val();
	//搜索联想
	var autocomplete = new BMap.Autocomplete({
			input: "address"
	});
	autocomplete.setLocation(map_city);
	if(address != ""){
		setTimeout(function(){
			$("#address").val(address);
		}, 5);
	}

	//选择区域
	$("#selAddr").delegate("a", "click", function(){
		if($(this).text() != "不限" && $(this).attr("data-id") != $("#addr").val()){
			var id = $(this).attr("data-id");
			$(this).closest(".sel-group").nextAll(".sel-group").remove();
			getChildAddr(id);
		}
	});

	//获取子级区域
	function getChildAddr(id){
		if(!id) return;
		$.ajax({
			url: "/include/ajax.php?service=info&action=addr&type="+id,
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				if(data && data.state == 100){
					var list = data.info, html = [];

					html.push('<div class="sel-group">');
					html.push('<button class="sel">不限<span class="caret"></span></button>');
					html.push('<ul class="sel-menu">');
					html.push('<li><a href="javascript:;" data-id="'+id+'">不限</a></li>');
					for(var i = 0; i < list.length; i++){
						html.push('<li><a href="javascript:;" data-id="'+list[i].id+'">'+list[i].typename+'</a></li>');
					}
					html.push('</ul>');
					html.push('</div>');

					$("#addr").before(html.join(""));

				}
			}
		});
	}


	//有效期
	$("#valid").click(function(){
		WdatePicker({
			el: 'valid',
			doubleCalendar: true,
			isShowClear: false,
			isShowOK: false,
			isShowToday: false,
			minDate: '%y-%M-{%d+1}',
			onpicking: function(dp){

			}
		});
	});


	//提交发布
	$("#submit").bind("click", function(event){

		event.preventDefault();

		var t       = $(this),
				typeid  = $("#typeid").val(),
				title   = $("#title"),
				addr    = $("#addr").val(),
				person  = $("#person"),
				tel     = $("#tel"),
				valid   = $("#valid"),
				vdimgck = $("#vdimgck");

		if(t.hasClass("disabled")) return;

		var offsetTop = 0;
		if(!typeid){
			$.dialog.alert("分类ID获取失败，请重新选择类目！");
			return false;
		}

		//验证标题
		var exp = new RegExp("^" + titleRegex + "$", "img");
		if(!exp.test(title.val())){
			title.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+titleErrTip);
			offsetTop = title.offset().top;
		}

		$("#itemList").find("input, .radio, .sel-group").each(function() {
			var t = $(this), dl = t.closest("dl");

			//下拉菜单
			if(t[0].tagName == "DIV" && t[0].className == "sel-group"){
				if(dl.find("input[type=hidden]").val() == "" && dl.data("required") == 1){
					dl.find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+dl.find(".sel-group:eq(0)").attr("data-title"));
					offsetTop = offsetTop == 0 ? dl.offset().top : offsetTop;
				}

			//单选
			}else if(t[0].tagName == "DIV" && t[0].className == "radio"){
				if(dl.find("input[type=hidden]").val() == "" && dl.data("required") == 1){
					dl.find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+dl.find(".radio").attr("data-title"));
					offsetTop = offsetTop == 0 ? dl.offset().top : offsetTop;
				}

			//多选
			}else if(t[0].tagName == "INPUT" && t[0].type == "checkbox"){
				if(dl.find("input:checked").length <= 0 && dl.data("required") == 1){
					dl.find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+dl.find(".checkbox").attr("data-title"));
					offsetTop = offsetTop == 0 ? dl.offset().top : offsetTop;
				}

			//文本
			}else if(t[0].tagName == "INPUT" && t[0].type == "text"){
				if(t.val() == "" && dl.data("required") == 1){

					//价格
					if(t[0].name == "price"){
						t.parent().siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+t.attr("data-title"));
					}else{
						t.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+t.attr("data-title"));
					}
					offsetTop = offsetTop == 0 ? t.offset().top : offsetTop;
				}
			}

		});

		ue.sync();

		//验证区域
		if(addr == "" || addr == 0){
			$("#selAddr .tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+$("#selAddr .sel-group:eq(0)").attr("data-title"));
			offsetTop = offsetTop == 0 ? $("#selAddr").offset().top : offsetTop;
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

		//验证有效期
		if(valid.val() == 0 || valid.val() == ""){
			valid.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请选择有效期！");
			offsetTop = offsetTop == 0 ? valid.offset().top : offsetTop;
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
						content: tip,
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

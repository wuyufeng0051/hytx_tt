$(function(){

	getEditor("body");

	//选择分类
	$("#selType").delegate("a", "click", function(){
		if($(this).text() != langData['siteConfig'][7][2] && $(this).attr("data-id") != $("#stype").val()){
			var id = $(this).attr("data-id");
			$(this).closest(".sel-group").nextAll(".sel-group").remove();
			getChildType(id);
		}
	});

	//获取子级分类
	function getChildType(id){
		if(!id) return;
		$.ajax({
			url: masterDomain+"/include/ajax.php?service=tuan&action=type&type="+id,
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				if(data && data.state == 100){
					var list = data.info, html = [];

					html.push('<div class="sel-group">');
					html.push('<button type="button" class="sel">'+langData['siteConfig'][7][2]+'<span class="caret"></span></button>');
					html.push('<ul class="sel-menu">');
					for(var i = 0; i < list.length; i++){
						html.push('<li><a href="javascript:;" data-id="'+list[i].id+'">'+list[i].typename+'</a></li>');
					}
					html.push('</ul>');
					html.push('</div>');

					$("#stype").before(html.join(""));
					$("#selType").closest("dd").find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+langData['siteConfig'][27][28]);

				}
			}
		});
	}

	//选择区域
	$("#selAddr .sel-group:eq(0) a").bind("click", function(){
		if($(this).attr("data-id") != $("#addrid").val()){
			var id = $(this).attr("data-id");
			$(this).closest(".sel-group").nextAll(".sel-group").remove();
			getChildAddr(id);
		}
	});

	if($("#addrid").val() != ""){
		var cid = 0;
		$("#selAddr .sel-menu li").each(function(){
			if($(this).text() == $("#addrname0").val()){
				cid = $(this).find("a").attr('data-id');
			}
		});
		if(cid != 0){
			getChildAddr(cid, $("#addrname1").val());
		}
	}

	//获取子级区域
	function getChildAddr(id, selected){
		if(!id) return;
		$.ajax({
			url: masterDomain+"/include/ajax.php?service=siteConfig&action=area&type="+id,
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				if(data && data.state == 100){
					var list = data.info, html = [];

					html.push('<div class="sel-group">');
					html.push('<button class="sel">'+(selected ? selected : langData['siteConfig'][7][2])+'<span class="caret"></span></button>');
					html.push('<ul class="sel-menu">');
					for(var i = 0; i < list.length; i++){
						html.push('<li><a href="javascript:;" data-id="'+list[i].id+'">'+list[i].typename+'</a></li>');
					}
					html.push('</ul>');
					html.push('</div>');

					$("#addrid").before(html.join(""));
					if(!selected){
						$("#addrid").val(0);
						$("#addrid").closest("dd").find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+langData['siteConfig'][20][68]);
					}

				}
			}
		});
	}

	//获取商圈
	$("#selAddr").delegate(".sel-group:eq(1) a", "click", function(){
		var id = $(this).attr("data-id");
		if(!id) return;
		$.ajax({
			url: masterDomain+"/include/ajax.php?service=tuan&action=circle&type="+id,
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				if(data && data.state == 100){
					var list = data.info, html = [];
					for(var i = 0; i < list.length; i++){
						html.push('<label><input type="checkbox" name="circle[]" value="'+list[i].id+'">'+list[i].name+'</label>');
					}
					$("#circle .checkbox").html(html.join(""));
					$("#circle").show();

				}else{
					$("#circle .checkbox").html("");
					$("#circle").hide();
				}
			}
		});
	});

	//获取地铁
	$("#selAddr").delegate(".sel-group:eq(0) a", "click", function(){
		var id = $(this).attr("data-id");
		if(!id) return;
		$.ajax({
			url: masterDomain+"/include/ajax.php?service=siteConfig&action=subway&city="+id,
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				$("#subway dd").html("");
				if(data && data.state == 100){
					var list = data.info, html = [];
					for(var i = 0; i < list.length; i++){
						$("#subway dd").append('<label style="display: block;">'+list[i].title+'：</label>');
						$("#subway dd").append('<div class="checkbox fn-hide"><small>'+langData['siteConfig'][20][184]+'...</small></div><br />');
						getSubwayStation(list[i].id, i);
					}
					$("#subway").show();
				}else{
					$("#subway").hide();
				}
			}
		});
	});

	//获取地铁站点
	function getSubwayStation(cid, index){
		$.ajax({
			url: masterDomain+"/include/ajax.php?service=siteConfig&action=subwayStation&type="+cid,
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				if(data && data.state == 100){
					var list = data.info, html = [];
					for(var i = 0; i < list.length; i++){
						html.push('<label><input type="checkbox" name="subway[]" value="'+list[i].id+'" />'+list[i].title+'</label>');
					}
					$("#subway .checkbox:eq("+index+")").html(html.join("")).show();
				}
			}
		});
	}

	//地图标注
	var init = {
		popshow: function() {
			var src = "/api/map/mark.php?mod=tuan",
					address = $("#address").val(),
					lnglat = $("#lnglat").val();
			if(address != ""){
				src = src + "&address="+address;
			}
			if(lnglat != ""){
				src = src + "&lnglat="+lnglat;
			}
			$("#markPopMap").after($('<div id="shadowlayer" style="display:block"></div>'));
			$("#markDitu").attr("src", src);
			$("#markPopMap").show();
		},
		pophide: function() {
			$("#shadowlayer").remove();
			$("#markDitu").attr("src", "");
			$("#markPopMap").hide();
		}
	};

	$(".map-pop .pop-close, #cloPop").bind("click", function(){
		init.pophide();
	});

	$("#mark").bind("click", function(){
		init.popshow();
	});

	$("#okPop").bind("click", function(){
		var doc = $(window.parent.frames["markDitu"].document),
				lng = doc.find("#lng").val(),
				lat = doc.find("#lat").val(),
				address = doc.find("#addr").val();
		$("#lnglat").val(lng+","+lat);
		if($("#address").val() == ""){
			$("#address").val(address).blur();
		}
		init.pophide();
	});


	//时间
	var selectDate = function(el, func){
		WdatePicker({
			el: el,
			isShowClear: false,
			isShowOK: false,
			isShowToday: false,
			qsEnabled: false,
			dateFmt: 'HH:mm',
			onpicked: function(dp){
				$("#openStart").parent().siblings(".tip-inline").removeClass().addClass("tip-inline success").html("<s></s>");
			}
		});
	}
	$("#openStart").focus(function(){
		selectDate("openStart");
	});
	$("#openEnd").focus(function(){
		selectDate("openEnd");
	});

	//提交发布
	$("#submit").bind("click", function(event){

		event.preventDefault();

		var t           = $(this),
				addrid      = $("#addrid"),
				address     = $("#address"),
				phone       = $("#phone"),
				openStart   = $("#openStart"),
				openEnd     = $("#openEnd");
				//note        = $("#note");

		if(t.hasClass("disabled")) return;

		var offsetTop = 0;

		//验证分类
		if($("#selType .sel-group:last").find("button").text() == langData['siteConfig'][7][2]){
			var dl = $("#selType");
			dl.find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+langData['siteConfig'][27][28]);
			offsetTop = offsetTop == 0 ? dl.position().top : offsetTop;
		}

		//区域
		if($.trim(addrid.val()) == "" || addrid.val() == 0){
			addrid.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+langData['siteConfig'][20][68]);
			offsetTop = offsetTop == 0 ? $("#selAddr").position().top : offsetTop;
		}else{

			//商圈
			if($("#circle .checkbox").html() != ""){
				if($("#circle").find("input:checked").val() == "" || $("#circle").find("input:checked").val() == undefined){
					$("#circle").find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+langData['siteConfig'][20][432]);
					offsetTop = $("#circle").position().top;
				}
			}

		}

		//地址
		if($.trim(address.val()) == "" || address.val() == 0){
			address.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+langData['siteConfig'][20][69]);
			offsetTop = offsetTop == 0 ? address.position().top : offsetTop;
		}

		//电话
		if($.trim(phone.val()) == "" || phone.val() == 0){
			phone.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+langData['siteConfig'][20][433]);
			offsetTop = offsetTop == 0 ? phone.position().top : offsetTop;
		}

		//营业时间
		if($.trim(openStart.val()) == "" || openStart.val() == 0 || $.trim(openEnd.val()) == "" || openEnd.val() == 0){
			openStart.parent().siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+langData['siteConfig'][20][434]);
			offsetTop = offsetTop == 0 ? phone.position().top : offsetTop;
		}

		//电话
		// if($.trim(note.val()) == ""){
		// 	note.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请输入简介");
		// 	offsetTop = offsetTop == 0 ? note.position().top : offsetTop;
		// }

		ue.sync();

		if(!ue.hasContents() && offsetTop == 0){
			$.dialog.alert(langData['shop'][4][48]);
			offsetTop = offsetTop == 0 ? $("#body").position().top : offsetTop;
		}

		if(offsetTop){
			$('.main').animate({scrollTop: offsetTop + 10}, 300);
			return false;
		}

		var form = $("#fabuForm"), action = form.attr("action");
		t.addClass("disabled").html(langData['siteConfig'][6][35]+"...");

		$.ajax({
			url: action,
			data: form.serialize(),
			type: "POST",
			dataType: "json",
			success: function (data) {
				if(data && data.state == 100){

					$.dialog({
						title: langData['siteConfig'][19][287],
						icon: 'success.png',
						content: data.info,
						ok: function(){}
					});
					t.removeClass("disabled").html(langData['siteConfig'][6][63]);

				}else{
					$.dialog.alert(data.info);
					t.removeClass("disabled").html(langData['siteConfig'][6][63]);
					$("#verifycode").click();
				}
			},
			error: function(){
				$.dialog.alert(langData['siteConfig'][20][183]);
				t.removeClass("disabled").html(langData['siteConfig'][6][63]);
				$("#verifycode").click();
			}
		});


	});
});

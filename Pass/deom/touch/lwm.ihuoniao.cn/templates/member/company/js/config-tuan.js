$(function(){

	getEditor("body");

	//选择分类
	$("#selType").delegate("a", "click", function(){
		if($(this).text() != "请选择" && $(this).attr("data-id") != $("#stype").val()){
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
					html.push('<button type="button" class="sel">请选择<span class="caret"></span></button>');
					html.push('<ul class="sel-menu">');
					for(var i = 0; i < list.length; i++){
						html.push('<li><a href="javascript:;" data-id="'+list[i].id+'">'+list[i].typename+'</a></li>');
					}
					html.push('</ul>');
					html.push('</div>');

					$("#stype").before(html.join(""));
					$("#selType").closest("dd").find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请选择所属类别");

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
					html.push('<button class="sel">'+(selected ? selected : "请选择")+'<span class="caret"></span></button>');
					html.push('<ul class="sel-menu">');
					for(var i = 0; i < list.length; i++){
						html.push('<li><a href="javascript:;" data-id="'+list[i].id+'">'+list[i].typename+'</a></li>');
					}
					html.push('</ul>');
					html.push('</div>');

					$("#addrid").before(html.join(""));
					if(!selected){
						$("#addrid").val(0);
						$("#addrid").closest("dd").find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请选择所在区域");
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
						$("#subway dd").append('<div class="checkbox fn-hide"><small>加载中...</small></div><br />');
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
				openEnd     = $("#openEnd"),
				//note        = $("#note"),
				vdimgck     = $("#vdimgck");

		if(t.hasClass("disabled")) return;

		var offsetTop = 0;

		//验证分类
		if($("#selType .sel-group:last").find("button").text() == "请选择"){
			var dl = $("#selType");
			dl.find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请选择所属类别");
			offsetTop = offsetTop == 0 ? dl.position().top : offsetTop;
		}

		//区域
		if($.trim(addrid.val()) == "" || addrid.val() == 0){
			addrid.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请选择所在区域");
			offsetTop = offsetTop == 0 ? $("#selAddr").position().top : offsetTop;
		}else{

			//商圈
			if($("#circle .checkbox").html() != ""){
				if($("#circle").find("input:checked").val() == "" || $("#circle").find("input:checked").val() == undefined){
					$("#circle").find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请选择商圈");
					offsetTop = $("#circle").position().top;
				}
			}

		}

		//地址
		if($.trim(address.val()) == "" || address.val() == 0){
			address.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请输入详细地址");
			offsetTop = offsetTop == 0 ? address.position().top : offsetTop;
		}

		//电话
		if($.trim(phone.val()) == "" || phone.val() == 0){
			phone.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请输入联系电话");
			offsetTop = offsetTop == 0 ? phone.position().top : offsetTop;
		}

		//营业时间
		if($.trim(openStart.val()) == "" || openStart.val() == 0 || $.trim(openEnd.val()) == "" || openEnd.val() == 0){
			openStart.parent().siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请选择营业时间");
			offsetTop = offsetTop == 0 ? phone.position().top : offsetTop;
		}

		//电话
		// if($.trim(note.val()) == ""){
		// 	note.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请输入简介");
		// 	offsetTop = offsetTop == 0 ? note.position().top : offsetTop;
		// }

		ue.sync();

		// if(!ue.hasContents() && offsetTop == 0){
		// 	$.dialog.alert("请输入详细介绍！");
		// 	offsetTop = offsetTop == 0 ? $("#body").position().top : offsetTop;
		// }

		//验证验证码
		if($.trim(vdimgck.val()) == ""){
			vdimgck.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请输入码证码！");
			offsetTop = offsetTop == 0 ? vdimgck.position().top : offsetTop;
		}

		if(offsetTop){
			$('.main').animate({scrollTop: offsetTop + 10}, 300);
			return false;
		}

		var form = $("#fabuForm"), action = form.attr("action");
		t.addClass("disabled").html("提交中...");

		$.ajax({
			url: action,
			data: form.serialize(),
			type: "POST",
			dataType: "json",
			success: function (data) {
				if(data && data.state == 100){

					$.dialog({
						title: '提示消息',
						icon: 'success.png',
						content: data.info,
						ok: function(){}
					});
					t.removeClass("disabled").html("保存设置");

				}else{
					$.dialog.alert(data.info);
					t.removeClass("disabled").html("保存设置");
					$("#verifycode").click();
				}
			},
			error: function(){
				$.dialog.alert("网络错误，请重试！");
				t.removeClass("disabled").html("保存设置");
				$("#verifycode").click();
			}
		});


	});
});

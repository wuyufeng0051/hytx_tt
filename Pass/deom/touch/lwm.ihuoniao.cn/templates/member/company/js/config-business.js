$(function(){

	function delFile(b, d, c) {
		var g = {
			mod: "business",
			type: "delLogo",
			picpath: b,
			randoms: Math.random()
		};
		$.ajax({
			type: "POST",
			cache: false,
			async: d,
			url: "/include/upload.inc.php",
			dataType: "json",
			data: $.param(g),
			success: function(a) {
				try {
					c(a)
				} catch(b) {}
			}
		})
	}

	//选择分类
	$("#selType").delegate("a", "click", function(){
		if($(this).text() != "请选择" && $(this).attr("data-id") != $("#typeid").val()){
			var id = $(this).attr("data-id");
			$(this).closest(".sel-group").nextAll(".sel-group").remove();
			getChildType(id);
		}
	});

	//获取子级分类
	function getChildType(id){
		if(!id) return;
		$.ajax({
			url: masterDomain+"/include/ajax.php?service=business&action=type&type="+id,
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

					$("#typeid").before(html.join(""));
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
			url: masterDomain+"/include/ajax.php?service=business&action=addr&type="+id,
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				if(data && data.state == 100){
					var list = data.info, html = [];

					html.push('<div class="sel-group">');
					html.push('<button type="button" class="sel">'+(selected ? selected : "请选择")+'<span class="caret"></span></button>');
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

	//地图标注
	var init = {
		popshow: function() {
			var src = "/api/map/mark.php?mod=business",
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


	function preLoad(){
		return this.support.loading ? void 0 : $("#"+obj).html("加载失败，请检查flash版本！");
	}


	//组合图集html
	function fileQueuedList_1(file) {
		var listSection = $("#listSection1"), t = this;

		var pli = $('<li class="clearfix" id="'+file.id+'"></li>'),
			lir = $('<a class="li-rm" href="javascript:;">&times;</a>'),
			lin = $('<span class="li-name">'+file.name+'</span>'),
			lip = $('<span class="li-progress"><s></s></span>'),
			lit = $('<div class="li-thumb"><div class="r-progress"><s></s></div><span class="ibtn"><a href="javascript:;" class="Lrotate" title="逆时针旋转90度"></a><a href="javascript:;" class="Rrotate" title="顺时针旋转90度"></a><a href="javascript:;" target="_blank" class="enlarge" title="放大"></a></span><span class="ibg"></span><img></div>');

		//关闭
		lir.bind("click", function(){
			t.cancelUpload(file.id, false);

			$("#"+file.id).remove();
			var stats = t.getStats();
			stats.successful_uploads--;
			t.setStats(stats);
		});

		pli.append(lir);
		pli.append(lin);
		pli.append(lip);
		pli.append(lit);

		listSection.append(pli).show();
	}

	//提交发布
	$("#submit").bind("click", function(event){

		event.preventDefault();

		var t         = $(this),
			title     = $("#title"),
			logo      = $("#logo"),
			typeid    = $("#typeid"),
			addrid    = $("#addrid"),
			vdimgck   = $("#vdimgck");

		if(t.hasClass("disabled")) return;

		var offsetTop = 0;

		//店铺名称
		if($.trim(title.val()) == "" || title.val() == 0){
			title.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请输入店铺名称");
			offsetTop = offsetTop == 0 ? title.position().top : offsetTop;
		}

		//LOGO
		if($.trim(logo.val()) == ""){
			$.alert("请上传店铺LOGO");
			offsetTop = offsetTop == 0 ? logo.position().top : offsetTop;
		}

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

		var form = $("#fabuForm"), action = form.attr("action");
		t.addClass("disabled").html("提交中...");

		// //图集
		// var imglist = [], imgli = $("#listSection li");
		// if(imgli.length > 0){
		// 	for(var i = 0; i < imgli.length; i++){
		// 		var imgsrc = $("#listSection li:eq("+i+")").find(".li-thumb img").attr("data-val");
		// 		imglist.push(imgsrc);
		// 	}
		// }
		//
		// //其他证明
		// var imglist1 = [], imgli = $("#listSection1 li");
		// if(imgli.length > 0){
		// 	for(var i = 0; i < imgli.length; i++){
		// 		var imgsrc = $("#listSection1 li:eq("+i+")").find(".li-thumb img").attr("data-val");
		// 		imglist1.push(imgsrc);
		// 	}
		// }
		//
		// //banner
		// var imglist2 = [], imgli = $("#listSection2 li");
		// if(imgli.length > 0){
		// 	for(var i = 0; i < imgli.length; i++){
		// 		var imgsrc = $("#listSection2 li:eq("+i+")").find(".li-thumb img").attr("data-val");
		// 		imglist2.push(imgsrc);
		// 	}
		// }
 // + "&banner="+imglist2.join(",") + "&pics="+imglist.join(",") + "&certify="+imglist1.join(",")
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


//上传成功接收
function uploadSuccess(obj, file, filetype, path){
	$("#"+obj).val(file);
	$("#"+obj).siblings(".spic").find(".sholder").html('<img src="'+path+'" />');
	$("#"+obj).siblings(".spic").find(".reupload").attr("style", "display: inline-block");
	$("#"+obj).siblings(".spic").show();
	$("#"+obj).siblings("iframe").hide();
}

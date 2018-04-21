//上传
var uploadCustom = {
	//上传缩略图
	uploadThumb: function(mod, size, type, obj, width, height, queuedList, successList){
		new SWFUpload({

			//后端上传接口
			upload_url: "/include/upload.inc.php?mod="+mod+"&type=thumb",
			
			//上传表单名【需要与后端统一】
			file_post_name: "Filedata",

			//单张上传限制
			file_size_limit: size,

			//类型限制
			file_types: type,

			//类型提示说明
			file_types_description: "图片文件",

			//最大数量限制
			file_upload_limit: 0,

			//最小数量限制
			file_queue_limit: 0,

			//加载上传组件
			swfupload_preload_handler: function(){
				return this.support.loading ? void 0 : $("#"+obj).html("加载失败，请检查flash版本！");
			},

			//加载失败提示
			swfupload_load_failed_handler: function(){
				$("#"+obj).html("加载失败，请检查flash版本！");
			},

			//拼接文件队列
			file_queued_handler: queuedList,

			//收集上传失败信息
			file_queue_error_handler: function(file, errorCode, message){
				try {
					switch (errorCode) {
						case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
							$.dialog.alert("文件大小超过最大"+this.settings.file_size_limit/1024+"MB上传限制。");
							break;
						case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
							$.dialog.alert("零字节文件无法上传。");
							break;
						case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE:
							$.dialog.alert("无效的文件类型。");
							break;
						case SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED:
							$.dialog.alert("您选择的文件太多。" +  message > 1 ? "最多可以选择 " +  message + " 个文件。" : "");
							break;
						default:
							if (file !== null) {
								$.dialog.alert("未处理的错误");
							}
							break;
					}
				} catch (ex) {
				//this.debug(ex);
				}

				$("#license").attr("class", "uploadinp"),
				$("#licenseFiles, #cancelUploadBt, #licenseProgress, #reupload").hide();
			},

			//上传失败提示
			file_dialog_complete_handler: function(numFilesSelected, numFilesQueued){
				numFilesSelected >= 1 && 0 == numFilesQueued ? $.dialog.alert('文件大小超过最大'+this.settings.file_size_limit/1024+'MB上传限制。') : numFilesSelected > 1 ? ($.dialog.alert("您只需要上传一张缩略图即可"), $("#license").attr("class", "uploadinp"), $("#licenseProgressBar").width(0), $("#licenseFiles, #cancelUploadBt, #licenseProgress, #reupload").hide()) : ($("#licenseProgressBar").width(""), this.startUpload())
			},

			//开始上传
			upload_start_handler: function(){
				return true;
			},

			//上传进度提示
			upload_progress_handler: function(file, bytesLoaded, bytesTotal){
				try {
					var d = $("#licensePercent");
					d.html().replace("%", "");
					var f = Math.ceil(100 * (bytesLoaded / bytesTotal));
					d.attr("class", f > 55 ? "white": ""),
					$("#licenseProgressBar").stop().animate({
						width: f + "%"
					}, 600),
					d.html(f + "%");
				} catch(g) {
					this.debug(g)
				}
			},

			//上传失败
			upload_error_handler: function(file, errorCode, message){
				if(errorCode != SWFUpload.UPLOAD_ERROR.UPLOAD_LIMIT_EXCEEDED){
					$.dialog.alert("上传失败！错误代码："+errorCode);
				}
			},

			//上传成功
			upload_success_handler: successList,

			upload_complete_handler: function(){
				try {
					this.startUpload();
				} catch (ex) {}
			},

			button_action: SWFUpload.BUTTON_ACTION.SELECT_FILE,  //单选

			//上传按钮实例名
			button_placeholder_id: obj,
			flash_url : cfg_staticPath+"js/swfupload/swfupload.swf",
			flash9_url: cfg_staticPath+"js/swfupload/swfupload_fp9.swf",

			//按钮尺寸
			button_width: width,
			button_height: height,
			button_cursor: SWFUpload.CURSOR.HAND,
			button_window_mode: "transparent",
			debug: false
		});
	}

	//上传图集
	,uploadAtlas: function(mod, size, type, max, obj, width, height, queuedList, successList){
		new SWFUpload({

			//后端上传接口
			upload_url: "/include/upload.inc.php?mod="+mod+"&type=atlas",
			
			//上传表单名【需要与后端统一】
			file_post_name: "Filedata",

			//单张上传限制
			file_size_limit: size,

			//类型限制
			file_types: type,

			//类型提示说明
			file_types_description: "图片文件",

			//最大数量限制
			file_upload_limit: max,

			//最小数量限制
			file_queue_limit: 0,

			//加载上传组件
			swfupload_preload_handler: function(){
				return this.support.loading ? void 0 : $("#"+obj).html("加载失败，请检查flash版本！");
			},

			//加载失败提示
			swfupload_load_failed_handler: function(){
				$("#"+obj).html("加载失败，请检查flash版本！");
			},

			//拼接文件队列
			file_queued_handler: queuedList,

			//收集上传失败信息
			file_queue_error_handler: function(file, errorCode, message){
				try {
					if (errorCode === SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED) {

						//拼接文件队列
						var listSection = $("#listSection"), already = listSection.find("li").length, count = atlasMax - already;
						$.dialog.alert(message > 0 && count != 0 ? "您只能再上传" + count + "个文件。" : "您上传的文件数已经达到限额，不能再上传了。");
						return;
					}
					switch (errorCode) {
						case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
							uploadErrorInfo.push("文件：" + file.name + " 大小超过" + this.settings.file_size_limit/1024 + "M");
							break;
						case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
							uploadErrorInfo.push("文件：" + file.name + " 零字节文件无法上传");
							break;
						case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE:
							uploadErrorInfo.push("文件：" + file.name + " 无效的文件类型");
							break;
						case SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED:
							break;
						default:
							if (file !== null) {
								uploadErrorInfo.push("文件：" + file.name + " 未处理的错误");
							}
							break;
					}

					if (errorCode != SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED) {
						delete this.queueData.files[file.id];
					}
					if (this.settings.onSelectError) this.settings.onSelectError.apply(this, arguments);

				} catch (ex) {}
			},

			//上传失败提示
			file_dialog_complete_handler: function(){
				try {
					this.startUpload();
					if(uploadErrorInfo.length > 0){
						var tip = uploadErrorInfo.join("\r");
						$.dialog.alert("以下图片将不会上传：\r\n" + tip );
						uploadErrorInfo = [];
					};
				} catch (ex)  {}
			},

			//开始上传
			upload_start_handler: function(){
				return true;
			},

			//上传进度提示
			upload_progress_handler: function(file, bytesLoaded, bytesTotal){
				try {
					var pro = file.id;
					var f = Math.ceil(100 * (bytesLoaded / bytesTotal));
					$("#"+pro).find(".li-progress s").stop().animate({
						width: f + "%"
					}, 600);
				} catch(g) {}
			},

			//上传失败
			upload_error_handler: function(file, errorCode, message){
				if(errorCode != SWFUpload.UPLOAD_ERROR.UPLOAD_LIMIT_EXCEEDED){
					$.dialog.alert("上传失败！错误代码："+errorCode);
				}
			},

			//上传成功
			upload_success_handler: successList,

			upload_complete_handler: function(){
				try {
					if(atlasUpload == undefined){
						atlasUpload = this;
					}
					this.startUpload();
				} catch (ex) {}
			},

			//上传按钮实例名
			button_placeholder_id: obj,
			flash_url : cfg_staticPath+"js/swfupload/swfupload.swf",
			flash9_url: cfg_staticPath+"js/swfupload/swfupload_fp9.swf",

			//按钮尺寸
			button_width: width,
			button_height: height,
			button_cursor: SWFUpload.CURSOR.HAND,
			button_window_mode: "transparent",
			debug: false
		});
	}

	//旋转图集文件
	,rotateAtlasPic: function(mod, direction, img, c) {
			var g = {
				mod: mod,
				type: "rotateAtlas",
				direction: direction,
				picpath: img,
				randoms: Math.random()
			};
			$.ajax({
				type: "POST",
				cache: false,
				async: false,
				url: "/include/upload.inc.php",
				dataType: "json",
				data: $.param(g),
				success: function(a) {
					try {
						c(a)
					} catch(b) {}
				}
			});
		}

	//删除已上传的图片
	,delAtlasImg: function(mod, obj, path, listSection, delBtn){
		var g = {
			mod: mod,
			type: "delAtlas",
			picpath: path,
			randoms: Math.random()
		};
		$.ajax({
			type: "POST",
			cache: false,
			async: false,
			url: "/include/upload.inc.php",
			dataType: "json",
			data: $.param(g),
			success: function() {}
		});
		$("#"+obj).remove();
		
		if($("#"+listSection).find("li").length < 1){
			$("#"+listSection).hide();
			$("#"+delBtn).hide();
		}
	}
}


$(function(){

	//编辑器配置
	var ue = UE.getEditor('body', {toolbars: [['undo', 'redo', '|', 'fontfamily', 'fontsize', '|', 'forecolor', 'bold', 'italic', 'underline', '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'insertorderedlist', 'insertunorderedlist', '|', 'link', 'unlink']], initialStyle:'p{line-height:1.5em; font-size:13px; font-family:宋体}'});
	ue.on("focus", function() {ue.container.style.borderColor = "#999"});
	ue.on("blur", function() {ue.container.style.borderColor = ""});


	//多选
	$(".w-form").delegate("input[type=checkbox]", "click", function(){
		var t = $(this), dl = t.closest("dl"), name = t.attr("name"), tip = t.closest(".checkbox").data("title"), hline = dl.find(".tip-inline");
		if(dl.data("required") == 1){
			var val = $("input[name='"+name+"']:checked").val();
			if(val == undefined){
				hline.removeClass().addClass("tip-inline error").html("<s></s>"+tip);
			}else{
				hline.removeClass().addClass("tip-inline success").html("<s></s>"+tip);
			}
		}
	});

	//单选按钮组
	$(".w-form").delegate(".radio span", "click", function(){
		var t = $(this), dl = t.closest("dl"), id = t.attr("data-id"), hline = dl.find(".tip-inline");
		if(!t.hasClass("curr")){
			t.siblings("input[type=hidden]").val(id);
			hline.removeClass().addClass("tip-inline success").html("<s></s>");
			t.addClass("curr").siblings("span").removeClass("curr");
		}
	});

	//下拉菜单
	$(".w-form").delegate(".sel-group", "click", function(){
		var t = $(this);
		$(".sel-menu").hide();
		t.hasClass("open") ? (t.removeClass("open"), t.find(".sel-menu").hide()) : (t.addClass("open"), t.find(".sel-menu").show());
		t.siblings(".sel-group").removeClass("open").find(".sel-menu").hide();
		return false;
	});

	//下拉菜单赋值
	$(".w-form").delegate(".sel-menu a", "click", function(){
		var t = $(this), id = t.attr("data-id"), val = t.text(), dl = t.closest("dl"), hline = dl.find(".tip-inline");
		t.closest(".sel-group").find(".sel").html(val+'<span class="caret"></span>');
		t.closest("dd").find("input").val(id);
		hline.removeClass().addClass("tip-inline success").html("<s></s>");
	});

	//点击空白位置隐藏下拉菜单内容
	$(document).click(function (e) {
		$(".sel-group").removeClass("open").find(".sel-menu").hide();
	});

	//上传图集
	uploadCustom.uploadAtlas("info", atlasSize, atlasType, atlasMax, "flasHolder", 85, 85, function(file){

		//拼接文件队列
		var listSection = $("#listSection"), t = this;
		var pli = $('<li class="clearfix" id="'+file.id+'"></li>'),
		lim = $('<a class="li-move" href="javascript:;" title="拖动调整图片顺序">↕</a>'),
		lir = $('<a class="li-rm" href="javascript:;">&times;</a>'),
		lin = $('<span class="li-name">'+file.name+'</span>'),
		lip = $('<span class="li-progress"><s></s></span>'),
		lit = $('<div class="li-thumb"><div class="r-progress"><s></s></div><span class="ibtn"><a href="javascript:;" class="Lrotate" title="逆时针旋转90度"></a><a href="javascript:;" class="Rrotate" title="顺时针旋转90度"></a><a href="javascript:;" target="_blank" class="enlarge" title="放大"></a></span><span class="ibg"></span><img></div>'),
		lid = $('<textarea class="li-desc" placeholder="请输入图片描述"></textarea>');

		//关闭
		lir.bind("click", function(){
		t.cancelUpload(file.id, false);

		$("#"+file.id).remove();
		var stats = t.getStats();
		stats.successful_uploads--;
		t.setStats(stats);
		});

		pli.append(lim);
		pli.append(lir);
		pli.append(lin);
		pli.append(lip);
		pli.append(lit);
		pli.append(lid);

		listSection.append(pli).show();

	//上传完成
	}, function(file, serverData){
		var b = eval('('+serverData+')');
		var pro = file.id;
		if(b.state == "SUCCESS"){
			$("#"+pro).find(".li-name").hide();
			$("#"+pro).find(".li-progress").hide();
			$("#"+pro).find(".li-move").show();
			$("#"+pro).find(".li-thumb").show();
			$("#"+pro).find(".li-thumb img").attr("data-val", b.url);
			$("#"+pro).find(".li-thumb img").attr("data-url", huoniao.changeFileSize(b.turl, "small"));
			$("#"+pro).find(".li-thumb img").attr("src", huoniao.changeFileSize(b.turl, "small"));
			$("#"+pro).find(".li-thumb .enlarge").attr("href", b.turl);
			$("#"+pro).find(".li-desc").show();	
			
			$("#deleteAllAtlas").show();
			
			$("#"+pro).find(".li-rm").bind("click", function(){
				var t = $(this), img = t.siblings(".li-thumb").find("img").attr("data-val");
				huoniao.delAtlasImg("info", pro, img, "listSection", "deleteAllAtlas");
			});
		}else{
			alert(b.state);
			$("#"+pro).remove();
		}
	});

	//逆时针旋转
	$("#listSection").delegate(".Lrotate", "click", function(){
		var t = $(this), img = t.parent().siblings("img").attr("data-val"), url = t.parent().siblings("img").attr("data-url");
		huoniao.rotateAtlasPic("info", "left", img, function(data){
			if(data.state == "SUCCESS"){
				t.parent().siblings("img").attr("src", hideFileUrl == 1 ? url+"&v="+Math.random() : url+"?v="+Math.random());
			}else{
				alert(data.info);
			}
		});
	});
	
	//顺时针旋转
	$("#listSection").delegate(".Rrotate", "click", function(){
		var t = $(this), img = t.parent().siblings("img").attr("data-val"), url = t.parent().siblings("img").attr("data-url");
		huoniao.rotateAtlasPic("info", "right", img, function(data){
			if(data.state == "SUCCESS"){
				t.parent().siblings("img").attr("src", hideFileUrl == 1 ? url+"&v="+Math.random() : url+"?v="+Math.random());
			}else{
				alert(data.info);
			}
		});
	});

	//删除所有图集
	$("#deleteAllAtlas").bind("click", function(){
		var li = $("#listSection li"), picList = [];
		for(var i = 0; i < li.length; i++){
			picList.push($("#listSection li:eq("+i+")").find("img").attr("data-val"));
		}
		huoniao.delAtlasImg("info", "", picList.join(","), "listSection", "deleteAllAtlas");
		$("#deleteAllAtlas").hide();
		$("#listSection").html("").hide();
	});

	//图集排序
	$(".list-holder ul").dragsort({ dragSelector: "li", placeHolderTemplate: '<li class="holder"></li>' });

	//自动获取交易地点
	var coords = $().coords();
	var transform = function(e, t) {
		coords.transform(e,	function(e, n) {
			n != null ? $("#address").val(n.street + n.streetNumber) : alert(e.message);
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

	//搜索联想
	var autocomplete = new BMap.Autocomplete({
			input: "address"
	});
	autocomplete.setLocation(map_city);

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

	//表单提示
	$(".w-form").delegate("input[type=text]", "focus", function(){
		var t = $(this), dl = t.closest("dl"), name = t.attr("name"), tip = t.data("title"), hline = t.siblings(".tip-inline");
		if(name == "price"){
			hline = t.parent().siblings(".tip-inline");
		}
		hline.removeClass().addClass("tip-inline focus").html("<s></s>"+tip);
	});


	var titleRegex  = '.{6,50}', titleErrTip = '输入错误，请正确填写，5-50个字！';
	var priceRegex  = '[1-9][0-9]{0,6}';
	var personRegex = '[\u4E00-\u9FA5\uF900-\uFA2Da-zA-Z]{2,6}', personErrTip = '格式错误，2~6个汉字或字母';
	var telRegex    = '(13|14|15|17|18)[0-9]{9}', telErrTip = '输入错误，请正确填写手机号码';


	$(".w-form").delegate("input[type=text]", "blur", function(){
		var t = $(this), dl = t.closest("dl"), name = t.attr("name"), tip = t.data("title"), etip = tip, hline = t.siblings(".tip-inline"), check = true;
		if(name == "price"){
			hline = t.parent().siblings(".tip-inline");
		}

		if($.trim(t.val()) != ""){
			var regex = "";
			//判断标题
			if(name == "title"){
				regex = titleRegex;
				etip = titleErrTip;

			//判断价格
			}else if(name == "price"){
				regex = priceRegex;

			//联系人
			}else if(name == "person"){
				regex = personRegex;
				etip = personErrTip;

			//判断电话
			}else if(name == "tel"){
				regex = telRegex;
				etip = telErrTip;
			
			//验证码
			}else if(name == "vdimgck"){

				$.ajax({
					url: "/include/ajax.php?service=siteConfig&action=checkVdimgck&code="+t.val(),
					type: "GET",
					dataType: "jsonp",
					success: function (data) {
						if(data && data.state == 100){
							if(data.info == "error"){
								hline.removeClass().addClass("tip-inline error").html("<s></s>验证码输入错误！");
							}else{
								hline.removeClass().addClass("tip-inline success").html("<s></s>"+tip);
							}
						}
					}
				});

				return;

			}

			if(regex != ""){
				var exp = new RegExp("^" + regex + "$", "img");
				if(!exp.test($.trim(t.val()))){
					check = false;
				}
			}
		}

		if(dl.attr("data-required") == 1){
			if($.trim(t.val()) == "" || !check){
				hline.removeClass().addClass("tip-inline error").html("<s></s>"+etip);
			}else{
				hline.removeClass().addClass("tip-inline success").html("<s></s>"+tip);
			}
		}
	});

	//更新验证码
	var verifycode = $("#verifycode").attr("src");
	$("#verifycode").bind("click", function(){
		$(this).attr("src", verifycode+"?v="+Math.random());
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
				vdimgck = $("#vdimgck");

		if(t.hasClass("disabled")) return;

		var offsetTop = 0;
		if(!typeid){
			alert("分类ID获取失败，请重新选择类目！");
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

		//验证验证码
		if($.trim(vdimgck.val()) == ""){
			vdimgck.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请输入码证码！");
			offsetTop = offsetTop == 0 ? vdimgck.offset().top : offsetTop;
		}

		if(offsetTop){
			$('html, body').animate({scrollTop: offsetTop - 5}, 300);
			return false;
		}

		var imglist = [], imgli = $("#listSection li");
		if(imgli.length > 0){
			for(var i = 0; i < imgli.length; i++){
				var imgsrc = $("#listSection li:eq("+i+")").find(".li-thumb img").attr("data-val"), imgdes = $("#listSection li:eq("+i+")").find(".li-desc").val();
				imglist.push(imgsrc+"|"+imgdes);
			}
		}

		var form = $("#infoWriteForm"), action = form.attr("action"), url = form.attr("data-url");
		data = form.serialize() + "&imglist="+imglist.join(",");

		t.addClass("disabled").html("提交中...");
		
		$.ajax({
			url: action,
			data: data,
			type: "POST",
			dataType: "json",
			success: function (data) {
				if(data && data.state == 100){
					location.href = url.replace("$id$", data.info);
				}else{
					alert(data.info);
					t.removeClass("disabled").html("立即发布");
				}
			},
			error: function(){
				alert("网络错误，请重试！");
				t.removeClass("disabled").html("立即发布");
			}
		});


	});

});
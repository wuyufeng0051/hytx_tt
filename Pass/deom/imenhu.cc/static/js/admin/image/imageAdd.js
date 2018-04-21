$(function () {

	huoniao.parentHideTip();

	var thisURL   = window.location.pathname;
		tmpUPage  = thisURL.split( "/" );
		thisUPage = tmpUPage[ tmpUPage.length-1 ];
		thisPath  = thisURL.split(thisUPage)[0];

	var init = {
		//菜单递归分类
		selectTypeList: function(){
			var typeList = [];
			typeList.push('<ul class="dropdown-menu">');
			typeList.push('<li><a href="javascript:;" data-id="0">选择分类</a></li>');

			var l=typeListArr.length;
			for(var i = 0; i < l; i++){
				(function(){
					var jsonArray =arguments[0], jArray = jsonArray.lower, cl = "";
					if(jArray.length > 0){
						cl = ' class="dropdown-submenu"';
					}
					typeList.push('<li'+cl+'><a href="javascript:;" data-id="'+jsonArray["id"]+'">'+jsonArray["typename"]+'</a>');
					if(jArray.length > 0){
						typeList.push('<ul class="dropdown-menu">');
					}
					for(var k = 0; k < jArray.length; k++){
						if(jArray[k]['lower'] != null){
							arguments.callee(jArray[k]);
						}else{
							typeList.push('<li><a href="javascript:;" data-id="'+jArray[k]["id"]+'">'+jArray[k]["typename"]+'</a></li>');
						}
					}
					if(jArray.length > 0){
						typeList.push('</ul></li>');
					}else{
						typeList.push('</li>');
					}
				})(typeListArr[i]);
			}

			typeList.push('</ul>');
			return typeList.join("");
		}
	};

	//平台切换
	$('.nav-tabs a').click(function (e) {
		e.preventDefault();
		var obj = $(this).attr("href").replace("#", "");
		if(!$(this).parent().hasClass("active")){
			$(".nav-tabs li").removeClass("active");
			$(this).parent().addClass("active");

			$(".nav-tabs").parent().find(">div").hide();
			cfg_term = obj;
			$("#"+obj).show();
		}
	});

	//填充栏目分类
	$("#typeBtn").append(init.selectTypeList());

	//二级菜单点击事件
	$("#typeBtn a").bind("click", function(){
		var id = $(this).attr("data-id"), title = $(this).text();
		$("#typeid").val(id);
		$("#typeBtn button").html(title+'<span class="caret"></span>');

		if(id != 0){
			$("#typeid").siblings(".input-tips").removeClass().addClass("input-tips input-ok").attr("style", "display:inline-block");
		}else{
			$("#typeid").siblings(".input-tips").removeClass().addClass("input-tips input-error").attr("style", "display:inline-block");
		}
	});

	//填充图集
	if(imglist != ""){
		var picList = [];
		for(var i = 0; i < imglist.length; i++){
			picList.push('<li class="clearfix" id="SWFUpload_1_0'+i+'">');
			picList.push('  <a class="li-move" href="javascript:;" title="拖动调整图片顺序">移动</a>');
			picList.push('  <a class="li-rm" href="javascript:;">×</a>');
			picList.push('  <div class="li-thumb" style="display:block;">');
			picList.push('    <div class="r-progress"><s></s></div>');
			picList.push('    <span class="ibtn">');
			picList.push('      <a href="javascript:;" class="Lrotate" title="逆时针旋转90度"></a>');
			picList.push('      <a href="javascript:;" class="Rrotate" title="顺时针旋转90度"></a>');
			picList.push('      <a href="'+cfg_attachment+imglist[i].path+'&type=large" target="_blank" class="enlarge" title="放大"></a>');
			picList.push('    </span>');
			picList.push('    <span class="ibg"></span>');
			picList.push('    <img data-val="'+imglist[i].path+'" src="'+cfg_attachment+imglist[i].path+'" />');
			picList.push('  </div>');
			picList.push('  <textarea class="li-desc" placeholder="请输入图片描述" style="display:inline-block;">'+imglist[i].info+'</textarea>');
			picList.push('</li>');
		}
		$("#listSection").html(picList.join(""));
		$("#deleteAllAtlas").show();
	}

	//单张删除图集
	$("#listSection").delegate(".li-rm","click", function(){
		var t = $(this), img = t.siblings(".li-thumb").find("img").attr("data-val");
		delAtlasImg(t.parent().attr("id"), img);
	});

	//删除所有图集
	$("#deleteAllAtlas").bind("click", function(){
		var li = $("#listSection li"), picList = [];
		for(var i = 0; i < li.length; i++){
			picList.push($("#listSection li:eq("+i+")").find("img").attr("data-val"));
		}
		delAtlasImg("", picList.join(","));
		$("#deleteAllAtlas").hide();
		$("#listSection").html("");
	});

	//表单验证
	$("#editform").delegate("input,textarea", "focus", function(){
		var tip = $(this).siblings(".input-tips");
		if(tip.html() != undefined){
			tip.removeClass().addClass("input-tips input-focus").attr("style", "display:inline-block");
		}
	});

	$("#editform").delegate("input,textarea", "blur", function(){
		var obj = $(this);
		huoniao.regex(obj);
	});

	$("#editform").delegate("select", "change", function(){
		if($(this).parent().siblings(".input-tips").html() != undefined){
			if($(this).val() == 0){
				$(this).parent().siblings(".input-tips").removeClass().addClass("input-tips input-error").attr("style", "display:inline-block");
			}else{
				$(this).parent().siblings(".input-tips").removeClass().addClass("input-tips input-ok").attr("style", "display:inline-block");
			}
		}
	});

	//来源、作者选择
	var editDiv;
	$(".chooseData").bind("click", function(){
		var type = $(this).attr("data-type"), title = "";
		if(type == "source"){
			title = "来源";
		}else if(type == "writer"){
			title = "作者";
		}
		$.ajax({
			url: "imageJson.php?action=chooseData",
			data: "type="+type,
			type: "POST",
			dataType: "json",
			success: function(data){
				var content = [], edit = [];
				for(var i = 0; i < data.length; i++){
					content.push('<a href="javascript:;">'+data[i]+'</a>');
					edit.push(data[i]);
				};
				editDiv = $.dialog({
					id: "chooseData"+type,
					fixed: false,
					lock: false,
					title: "选择"+title,
					content: '<div class="choose-data" data-type="'+type+'">'+content.join("")+'</div>',
					width: 360,
					button:[
						{
							name: '设置',
							callback: function(){
								$.dialog({
									id: "changeData"+type,
									title: "设置"+title,
									content: '<textarea id="changeData" style="width:95%; height:100px; padding:2%;">'+edit.join(",")+'</textarea>',
									width: 360,
									ok: function(){
										var val = self.parent.$("#changeData").val();
										$.ajax({
											url: "imageJson.php?action=saveChooseData",
											data: "type="+type+"&val="+val,
											type: "POST",
											dataType: "json",
											success: function(){}
										});
									},
									cancel: true
								});
							}
						}
					]
				});
			}
		});
	});

	//选择来源、作者
	self.parent.$(".choose-data a").live("click", function(){
		var type = $(this).parent().attr("data-type"), txt = $(this).text();
		$("#"+type).val(txt);
		try{
			$.dialog.list["chooseData"+type].close();
		}catch(ex){

		}
	});

	//配置站内链接
	$("#allowurl").bind("click", function(){
		$.ajax({
			url: "imageJson.php?action=allowurl",
			type: "POST",
			dataType: "html",
			success: function(data){
				$.dialog({
					id: "allowurlData",
					title: "配置站内链接",
					content: '<textarea id="allowurl" style="width:95%; height:100px; padding:2%;">'+data+'</textarea>',
					width: 360,
					ok: function(){
						var val = self.parent.$("#allowurl").val();
						$.ajax({
							url: "imageJson.php?action=saveAllowurl",
							data: "val="+val,
							type: "POST",
							dataType: "json",
							success: function(){}
						});
					},
					cancel: true
				});
			}
		});
	});

	$("#pubdate").bind("blur", function(){
		huoniao.resetDate($(this));
		return false;
	});

	//发布时间
	$(".form_datetime .add-on").datetimepicker({
		format: 'yyyy-mm-dd hh:ii:ss',
		autoclose: true,
		language: 'ch',
		todayBtn: true,
		minuteStep: 5,
		linkField: "pubdate"
	});

	$(".color_pick").colorPicker({
		callback: function(color) {
			var color = color.length === 7 ? color : '';
			$("#color").val(color);
			$(this).find("em").css({"background": color});
		}
	});

	//swfupload s
	var thumbnail, picList;

	//上传单张缩略图
	thumbnail = function() {
		new SWFUpload({
			upload_url: "/include/upload.inc.php?mod="+action+"&type=thumb",
			file_post_name: "Filedata",
			file_size_limit: thumbSize,
			file_types: thumbType,
			file_types_description: "图片文件",
			file_upload_limit: 0,
			file_queue_limit: 0,
			swfupload_preload_handler: preLoad,
			swfupload_load_failed_handler: loadFailed,
			file_queued_handler: fileQueuedThumb,
			file_queue_error_handler: fileQueueErrorThumb,
			file_dialog_complete_handler: fileDialogCompleteThumb,
			upload_start_handler: uploadStart,
			upload_progress_handler: uploadProgressThumb,
			upload_error_handler: uploadError,
			upload_success_handler: uploadSuccessThumb,
			upload_complete_handler: uploadComplete,
			button_action:SWFUpload.BUTTON_ACTION.SELECT_FILE,
			//button_image_url: "/static/images/ui/swfupload/uploadbutton.png",
			button_placeholder_id: "uploadBt",
			flash_url : adminPath+"../static/js/swfupload/swfupload.swf",
			flash9_url: adminPath+"../static/js/swfupload/swfupload_fp9.swf",
			button_width: 100,
			button_height: 25,
			button_cursor: SWFUpload.CURSOR.HAND,
			button_window_mode: "transparent",
			debug: false
		});

		var delThumbPic = function(b, d, c) {
				var g = {
					mod: modelType,
					type: "delThumb",
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
            },
			e = $("#license"),
			j = $("#litpic"),
			k = $("#licenseFiles,#cancelUploadBt,#licenseProgress,#reupload");

		$("#reupload").click(function() {
			//删除已经上传的文件
			delThumbPic(j.val(), true, function(){
				k.eq(0).find("img").attr({
					style: "margin-top:10px; width:16px;",
					src: adminPath+"../static/images/ui/loading.gif"
				});
				j.val(""),
				e.attr("class", "uploadinp");
				k.hide();
			});
		});

	};
	thumbnail();

	//上传图集
	picList = function() {
		new SWFUpload({
			upload_url: "/include/upload.inc.php?mod="+action+"&type=atlas",
			file_post_name: "Filedata",
			file_size_limit: atlasSize,
			file_types: atlasType,
			file_types_description: "图片文件",
			file_upload_limit: atlasMax,
			file_queue_limit: 0,
			swfupload_preload_handler: preLoad,
			swfupload_load_failed_handler: loadFailed,
			file_queued_handler: fileQueuedList,
			file_queue_error_handler: fileQueueErrorList,
			file_dialog_complete_handler: fileDialogCompleteList,
			upload_start_handler: uploadStart,
			upload_progress_handler: uploadProgressList,
			upload_error_handler: uploadError,
			upload_success_handler: uploadSuccessList,
			upload_complete_handler: uploadComplete,
			//button_image_url: "/static/images/ui/swfupload/uploadbutton.png",
			button_placeholder_id: "flasHolder",
			flash_url : adminPath+"../static/js/swfupload/swfupload.swf",
			flash9_url: adminPath+"../static/js/swfupload/swfupload_fp9.swf",
			button_width: 100,
			button_height: 25,
			button_cursor: SWFUpload.CURSOR.HAND,
			button_window_mode: "transparent",
			debug: false
		});
	};
	picList();

	//旋转图集文件
	var rotateAtlasPic = function(direction, img, c) {
			var g = {
				mod: modelType,
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

	//逆时针旋转
	$("#listSection").delegate(".Lrotate", "click", function(){
		var t = $(this), img = t.parent().siblings("img").attr("data-val");
		rotateAtlasPic("left", img, function(data){
			if(data.state == "SUCCESS"){
				t.parent().siblings("img").attr("src", cfg_attachment+img+"&type=small&v="+Math.random());
			}else{
				$.dialog.alert(data.info);
			}
		});
	});

	//顺时针旋转
	$("#listSection").delegate(".Rrotate", "click", function(){
		var t = $(this), img = t.parent().siblings("img").attr("data-val");
		rotateAtlasPic("right", img, function(data){
			if(data.state == "SUCCESS"){
				t.parent().siblings("img").attr("src", cfg_attachment+img+"&type=small&v="+Math.random());
			}else{
				$.dialog.alert(data.info);
			}
		});
	});

	//跳转表单交互
	$("input[name='flags[]']").bind("click", function(){
		if($(this).val() == "t"){
			if(!$(this).is(":checked")){
				$("#rDiv").hide();
			}else{
				$("#rDiv").show();
			}
		}
	});

	//下级分类
	//$("#typeList").delegate("select", "change", function(){
//		var sel = $(this), id = sel.val(), index = sel.index();
//		if(id == 0){
//			sel.nextAll("select").remove();
//		} else if(id != 0 && id != ""){
//			$.ajax({
//				type: "GET",
//				url: "imageAdd.php",
//				data: "dopost=getTree&pid="+id,
//				dataType: "json",
//				success: function(data){
//					var i = 0, opt = [];
//					if(data instanceof Object && data.length > 0){
//						for(var key in data){
//							opt.push('<option value="'+data[key]['id']+'">'+data[key]['typename']+'</option>');
//						}
//						sel.nextAll("select").remove();
//						$("#typeList").append('<select name="typeid[]" class="input-medium"><option value="0">请选择分类</option>'+opt.join("")+'</select>');
//						sel.parent().next(".input-tips").removeClass().addClass("input-tips input-error");
//					};
//				},
//				error: function(msg){
//					alert(msg.status+":"+msg.statusText);
//				}
//			});
//		}
//	});

	//提交表单
	$("#btnSubmit").bind("click", function(event){
		event.preventDefault();
		var t            = $(this),
			id           = $("#id").val(),
			title        = $("#title"),
			subtitle     = $("#subtitle"),
			creturn      = $("input[type=checkbox][value=t]"),
			redirecturl  = $("#redirecturl"),
			weight       = $("#weight"),
			keywords     = $("#keywords"),
			description  = $("#description"),
			typeid       = $("#typeid"),
			tj           = true;

		//标题
		if(!huoniao.regex(title)){
			tj = false;
			huoniao.goTop();
			return false;
		};

		//简略标题
		if($.trim(subtitle.val()) != ""){
			if(!huoniao.regex(subtitle)){
				tj = false;
				huoniao.goTop();
				return false;
			};
		}else{
			subtitle.siblings(".input-tips").removeClass().addClass("input-tips input-ok");
		}

		//分类
		if(typeid.val() == "" || typeid.val() == 0){
			typeid.siblings(".input-tips").removeClass().addClass("input-tips input-error").attr("style", "display:inline-block");
			tj = false;
			huoniao.goTop();
			return false;
		}else{
			typeid.siblings(".input-tips").removeClass().addClass("input-tips input-ok").attr("style", "display:inline-block");
		}

		//跳转
		if(creturn.is(":checked")){
			if(!huoniao.regex(redirecturl)){
				tj = false;
				huoniao.goTop();
				return false;
			};
		}

		//排序
		if(!huoniao.regex(weight)){
			tj = false;
			huoniao.goTop();
			return false;
		}

		//关键词
		if(keywords.val() != ""){
			if(!huoniao.regex(keywords)){
				tj = false;
				huoniao.goTop();
				return false;
			};
		}

		//描述
		if(description.val() != ""){
			if(!huoniao.regex(description)){
				tj = false;
				huoniao.goTop();
				return false;
			};
		}

		var imglist = [], imgli = $("#listSection li");
		if(imgli.length > 0){
			for(var i = 0; i < imgli.length; i++){
				var imgsrc = $("#listSection li:eq("+i+")").find(".li-thumb img").attr("data-val"), imgdes = $("#listSection li:eq("+i+")").find(".li-desc").val();
				imglist.push(imgsrc+"|"+imgdes);
			}
		}

		t.attr("disabled", true);

		if(tj){
			$.ajax({
				type: "POST",
				url: "imageAdd.php?action="+action,
				data: $(this).parents("form").serialize() + "&imglist="+imglist.join(",")+"&submit=" + encodeURI("提交"),
				dataType: "json",
				success: function(data){
					if(data.state == 100){
						if($("#dopost").val() == "save"){

							huoniao.parentTip("success", "信息发布成功！<a href='"+data.url+"' target='_blank'>"+data.url+"</a>");
							huoniao.goTop();
							location.href = "imageAdd.php?action=image&typeid="+typeid.val()+"&typename="+$("#typeBtn button").text();

						}else{

							huoniao.parentTip("success", "信息修改成功！<a href='"+data.url+"' target='_blank'>"+data.url+"</a>");
							t.attr("disabled", false);

							// try{
							// 	$("body",parent.document).find("#nav-imageListphpaction"+action).click();
							// 	$("body",parent.document).find("#nav-edit"+action+id+" s").click();
							// }catch(e){
							// 	location.href = thisPath + "imageList.php?action="+action;
							// }

						}
					}else{
						$.dialog.alert(data.info);
						t.attr("disabled", false);
					};
				},
				error: function(msg){
					$.dialog.alert(msg.status+":"+msg.statusText);
					t.attr("disabled", false);
				}
			});
		}
	});

	//图集排序
	$(".list-holder ul").dragsort({ dragSelector: "li", placeHolderTemplate: '<li class="holder"></li>' });

});

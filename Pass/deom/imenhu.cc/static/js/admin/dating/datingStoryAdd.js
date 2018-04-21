$(function(){

	huoniao.parentHideTip();
	
	var thisURL   = window.location.pathname;
		tmpUPage  = thisURL.split( "/" );
		thisUPage = tmpUPage[ tmpUPage.length-1 ];
		thisPath  = thisURL.split(thisUPage)[0];

	//填充图集
	if(imglist != ""){
		var picList = [];
		for(var i = 0; i < imglist.length; i++){
			picList.push('<li class="clearfix" id="SWFUpload_1_0'+i+'">');
			picList.push('  <a class="li-rm" href="javascript:;">×</a>');
			picList.push('  <div class="li-thumb" style="display:block;">');
			picList.push('    <div class="r-progress"><s></s></div>');
			picList.push('    <span class="ibtn">');
			picList.push('      <a href="javascript:;" class="Lrotate" title="逆时针旋转90度"></a>');
			picList.push('      <a href="javascript:;" class="Rrotate" title="顺时针旋转90度"></a>');
			picList.push('      <a href="'+cfg_attachment+imglist[i]+'&type=large" target="_blank" class="enlarge" title="放大"></a>');
			picList.push('    </span>');
			picList.push('    <span class="ibg"></span>');
			picList.push('    <img data-val="'+imglist[i]+'" src="'+cfg_attachment+imglist[i]+'&type=small" />');
			picList.push('  </div>');
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

	//swfupload s
	var thumbnail, picList;

	//上传缩略图
	thumbnail = function() {
		new SWFUpload({
			upload_url: "/include/upload.inc.php?mod="+modelType+"&type=thumb&filetype=image",
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
			upload_url: "/include/upload.inc.php?mod="+modelType+"&type=atlas",
			file_post_name: "Filedata",
			file_size_limit: atlasSize,
			file_types: atlasType,
			file_types_description: "图片文件",
			file_upload_limit: atlasMax,
			file_queue_limit: 0,
			swfupload_preload_handler: preLoad,
			swfupload_load_failed_handler: loadFailed,
			file_queued_handler: fileQueuedList_,
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

	//组合图集html
	function fileQueuedList_(file) {
		var listSection = $("#listSection"), t = this;

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

		listSection.append(pli);
	}

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

	//图集排序
	$(".list-holder ul").dragsort({ dragSelector: "li", placeHolderTemplate: '<li class="holder"></li>' });

	$("#kdate").datetimepicker({format: 'yyyy-mm-dd', minView: 3, autoclose: true, language: 'ch'});

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

	//模糊匹配会员
	$("#fidname").bind("input", function(){
		$("#fid").val("0");
		var t = $(this), val = t.val();
		if(val != ""){
			t.addClass("input-loading");
			huoniao.operaJson("../inc/json.php?action=checkUser", "key="+val, function(data){
				t.removeClass("input-loading");
				if(!data) {
					t.siblings(".input-tips").removeClass().addClass("input-tips input-error").html('<s></s>请从列表中选择设会员');
					$("#fidList").html("").hide();
					return false;
				}
				var list = [];
				for(var i = 0; i < data.length; i++){
					list.push('<li data-id="'+data[i].id+'" data-name="'+data[i].username+'">'+data[i].username+"--"+data[i].nickname+'</li>');
				}
				if(list.length > 0){
					var pos = t.position();
					$("#fidList")
						.css({"left": pos.left, "top": pos.top + 36})
						.html('<ul>'+list.join("")+'</ul>')
						.show();
				}else{
					$("#fidList").html("").hide();
				}
			});

		}else{
			$("#fidList").html("").hide();
		}
    });

	$("#fidList").delegate("li", "click", function(){
		var name = $(this).text(), id = $(this).attr("data-id"), name = $(this).attr("data-name");
		$("#fidname").val(name);
		$("#fid").val(id);
		$("#fidList").html("").hide();
		checkUser($("#fidname"), name, $("#id").val());
		return false;
	});

	$(document).click(function (e) {
        var s = e.target;
        if (!jQuery.contains($("#fidList").get(0), s)) {
            if (jQuery.inArray(s.id, "fidname") < 0) {
                $("#fidList").hide();
            }
        }
    });

	$("#fidname").bind("blur", function(){
		var t = $(this), val = t.val(), id = $("#id").val();
		if(val != ""){
			checkUser(t, val, id);
		}else{
			t.siblings(".input-tips").removeClass().addClass("input-tips input-ok").html('<s></s>&nbsp;');
		}
	});

	$("#tidname").bind("input", function(){
		$("#tid").val("0");
		var t = $(this), val = t.val();
		if(val != ""){
			t.addClass("input-loading");
			huoniao.operaJson("../inc/json.php?action=checkUser", "key="+val, function(data){
				t.removeClass("input-loading");
				if(!data) {
					t.siblings(".input-tips").removeClass().addClass("input-tips input-error").html('<s></s>请从列表中选择设会员');
					$("#tidList").html("").hide();
					return false;
				}
				var list = [];
				for(var i = 0; i < data.length; i++){
					list.push('<li data-id="'+data[i].id+'" data-name="'+data[i].username+'">'+data[i].username+"--"+data[i].nickname+'</li>');
				}
				if(list.length > 0){
					var pos = t.position();
					$("#tidList")
						.css({"left": pos.left, "top": pos.top + 36})
						.html('<ul>'+list.join("")+'</ul>')
						.show();
				}else{
					$("#tidList").html("").hide();
				}
			});

		}else{
			$("#tidList").html("").hide();
		}
    });

	$("#tidList").delegate("li", "click", function(){
		var name = $(this).text(), id = $(this).attr("data-id"), name = $(this).attr("data-name");
		$("#tidname").val(name);
		$("#tid").val(id);
		$("#tidList").html("").hide();
		checkUser($("#tidname"), name, $("#id").val());
		return false;
	});

	$(document).click(function (e) {
        var s = e.target;
        if (!jQuery.contains($("#tidList").get(0), s)) {
            if (jQuery.inArray(s.id, "tidname") < 0) {
                $("#tidList").hide();
            }
        }
    });

	$("#tidname").bind("blur", function(){
		var t = $(this), val = t.val(), id = $("#id").val();
		if(val != ""){
			checkUser(t, val, id);
		}else{
			t.siblings(".input-tips").removeClass().addClass("input-tips input-ok").html('<s></s>&nbsp;');
		}
	});

	function checkUser(t, val, id){
		var flag = false;
		t.addClass("input-loading");
		huoniao.operaJson("../inc/json.php?action=checkDatingStory&type=dating", "key="+val, function(data){
			t.removeClass("input-loading");
			if(data == 200){
				t.siblings(".input-tips").removeClass().addClass("input-tips input-error").html('<s></s>会员已开通成功故事！');
			}else{
				if(data) {
					for(var i = 0; i < data.length; i++){
						if(data[i].username == val){
							flag = true;
							t.val(data[i].username);
						}
					}
				}
				if(flag){
					t.siblings(".input-tips").removeClass().addClass("input-tips input-ok").html('<s></s>请输入用户名');
				}else{
					t.siblings(".input-tips").removeClass().addClass("input-tips input-error").html('<s></s>请从列表中选择设会员');
				}
			}
		});
	}

	//搜索回车提交
    $("#editform input").keyup(function (e) {
        if (!e) {
            var e = window.event;
        }
        if (e.keyCode) {
            code = e.keyCode;
        }
        else if (e.which) {
            code = e.which;
        }
        if (code === 13) {
            $("#btnSubmit").click();
        }
    });

	//表单提交
	$("#btnSubmit").bind("click", function(event){
		event.preventDefault();
		var t            = $(this),
			id           = $("#id").val(),
			fid          = $("#fid").val(),
			fidname      = $("#fidname").val(),
			tid          = $("#tid").val(),
			tidname      = $("#tidname").val(),
			litpic       = $("#litpic").val(),
			kdate        = $("#kdate").val(),
			title        = $("#title"),
			content      = $("#content");

		if(fid == "" || fidname == 0){
			huoniao.goInput($("#fidname"));
			$("#fidname").siblings(".input-tips").removeClass().addClass("input-tips input-error").html('<s></s>请输入申请人用户名');
			return false;
		}

		if(tid == "" || tidname == 0){
			//huoniao.goInput($("#tidname"));
			//$("#tidname").siblings(".input-tips").removeClass().addClass("input-tips input-error").html('<s></s>请输入爱人用户名');
			//return false;
		}

		if(litpic == ""){
			huoniao.goInput($("#litpic"));
			$.dialog.alert("请上传合影照片！");
			return false;
		};

		if(kdate == ""){
			huoniao.goInput($("#kdate"));
			$.dialog.alert("请选择两个确定关系时间！");
			return false;
		};

		if(!huoniao.regex(title)){
			huoniao.goInput(title);
			return false;
		};

		if(!huoniao.regex(content)){
			return false;
		}

		//图集
		var imglist = [], imgli = $("#listSection li");
		if(imgli.length > 0){
			for(var i = 0; i < imgli.length; i++){
				var imgsrc = $("#listSection li:eq("+i+")").find(".li-thumb img").attr("data-val");
				imglist.push(imgsrc);
			}
		}

		t.attr("disabled", true);

		//异步提交
		huoniao.operaJson("datingStoryAdd.php", $("#editform").serialize() + "&imglist="+imglist.join(",")+"&submit="+encodeURI("提交"), function(data){
			if(data.state == 100){
				if($("#dopost").val() == "save"){

					huoniao.parentTip("success", "添加成功！<a href='"+data.url+"' target='_blank'>"+data.url+"</a>");
					huoniao.goTop();
					location.reload();

					// $.dialog({
					// 	fixed: true,
					// 	title: "添加成功",
					// 	icon: 'success.png',
					// 	content: "查看链接：<br /><a href=/datingStory.php?id="+data.id+"' target='_blank'>/datingStory.php?id="+data.id+"</a>",
					// 	ok: function(){
					// 		huoniao.goTop();
					// 		window.location.reload();
					// 	},
					// 	cancel: false
					// });

				}else{

					huoniao.parentTip("success", "修改成功！<a href='"+data.url+"' target='_blank'>"+data.url+"</a>");
					t.attr("disabled", false);

					// $.dialog({
					// 	fixed: true,
					// 	title: "修改成功",
					// 	icon: 'success.png',
					// 	content: "查看链接：<br /><a href='/datingStory.php?id="+id+"' target='_blank'>/datingStory.php?id="+id+"</a>",
					// 	ok: function(){
					// 		try{
					// 			$("body",parent.document).find("#nav-datingStoryphp").click();
					// 			parent.reloadPage($("body",parent.document).find("#body-datingStoryphp"));
					// 			$("body",parent.document).find("#nav-datingStoryEdit"+id+" s").click();
					// 		}catch(e){
					// 			location.href = thisPath + "datingStory.php";
					// 		}
					// 	},
					// 	cancel: false
					// });

				}
			}else{
				$.dialog.alert(data.info);
				t.attr("disabled", false);
			};
		});
	});

});

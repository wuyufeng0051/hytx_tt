//实例化编辑器
var ue = UE.getEditor('content');

$(function(){

	huoniao.parentHideTip();

	var thisURL   = window.location.pathname;
		tmpUPage  = thisURL.split( "/" );
		thisUPage = tmpUPage[ tmpUPage.length-1 ];
		thisPath  = thisURL.split(thisUPage)[0];

	//swfupload s
	var thumbnail;

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

	$("#deadline").datetimepicker({format: 'yyyy-mm-dd hh:ii:ss', autoclose: true, language: 'ch'});

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

	//回车提交
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

	//标注地图
	$("#mark").bind("click", function(){
		$.dialog({
			id: "markDitu",
			title: "标注地图位置<small>（请点击/拖动图标到正确的位置，再点击底部确定按钮。）</small>",
			content: 'url:'+adminPath+'../api/map/mark.php?mod=dating&lnglat='+$("#lnglat").val()+"&city="+mapCity+"&addr="+$("#address").val(),
			width: 800,
			height: 500,
			max: true,
			ok: function(){
				var doc = $(window.parent.frames["markDitu"].document),
					lng = doc.find("#lng").val(),
					lat = doc.find("#lat").val(),
					addr = doc.find("#addr").val();
				$("#lnglat").val(lng+","+lat);
				if($("#address").val() == ""){
					$("#address").val(addr);
				}
				huoniao.regex($("#address"));
			},
			cancel: true
		});
	});

	//表单提交
	$("#btnSubmit").bind("click", function(event){
		event.preventDefault();
		var t            = $(this),
			id           = $("#id").val(),
			title        = $("#title"),
			litpic       = $("#litpic").val(),
			deadline     = $("#deadline").val();

		if(!huoniao.regex(title)){
			huoniao.goInput(title);
			return false;
		};

		if(litpic == ""){
			huoniao.goInput($("#litpic"));
			$.dialog.alert("请上传缩略图！");
			return false;
		};

		if(deadline == ""){
			huoniao.goInput($("#deadline"));
			$.dialog.alert("请选择报名截止时间！");
			return false;
		};

		ue.sync();

		t.attr("disabled", true);

		//异步提交
		huoniao.operaJson("datingActivity.php", $("#editform").serialize() + "&submit="+encodeURI("提交"), function(data){
			if(data.state == 100){
				if($("#dopost").val() == "add"){

					huoniao.parentTip("success", "添加成功！<a href='"+data.url+"' target='_blank'>"+data.url+"</a>");
					huoniao.goTop();
					location.reload();

					// $.dialog({
					// 	fixed: true,
					// 	title: "添加成功",
					// 	icon: 'success.png',
					// 	content: "查看链接：<br /><a href='/datingActivity.php?id="+data.id+"' target='_blank'>/datingActivity.php?id="+data.id+"</a>",
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
					// 	content: "查看链接：<br /><a href='/datingActivity.php?id="+id+"' target='_blank'>/datingActivity.php?id="+id+"</a>",
					// 	ok: function(){
					// 		try{
					// 			$("body",parent.document).find("#nav-datingActivityphp").click();
					// 			parent.reloadPage($("body",parent.document).find("#body-datingActivityphp"));
					// 			$("body",parent.document).find("#nav-datingActivityEdit"+id+" s").click();
					// 		}catch(e){
					// 			location.href = thisPath + "datingActivity.php";
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

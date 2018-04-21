//实例化编辑器
var ue = UE.getEditor('note', {"term": "small"});

$(function(){

	huoniao.parentHideTip();

	var thisURL   = window.location.pathname;
		tmpUPage  = thisURL.split( "/" );
		thisUPage = tmpUPage[ tmpUPage.length-1 ];
		thisPath  = thisURL.split(thisUPage)[0];

	var init = {
		//树形递归分类
		treeTypeList: function(){
			var typeList = [], cl = "";
			var l = addrListArr;
			var s = addrid;
			typeList.push('<option value="0">请选择</option>');
			for(var i = 0; i < l.length; i++){
				(function(){
					var jsonArray =arguments[0], jArray = jsonArray.lower, selected = "";
					if(s == jsonArray["id"]){
						selected = " selected";
					}
					typeList.push('<option value="'+jsonArray["id"]+'"'+selected+'>'+cl+"|--"+jsonArray["typename"]+'</option>');
					if(jArray != undefined){
						for(var k = 0; k < jArray.length; k++){
							cl += '    ';
							var selected = "";
							if(s == jArray[k]["id"]){
								selected = " selected";
							}
							if(jArray[k]['lower'] != ""){
								arguments.callee(jArray[k]);
							}else{
								typeList.push('<option value="'+jArray[k]["id"]+'"'+selected+'>'+cl+"|--"+jArray[k]["typename"]+'</option>');
							}
							if(jsonArray["lower"] == null){
								cl = "";
							}else{
								cl = cl.replace("    ", "");
							}
						}
					}
				})(l[i]);
			}
			return typeList.join("");
		}

		//重新上传时删除已上传的文件
		,delFile: function(b, d, c) {
			var g = {
				mod: modelType,
				type: "delCard",
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
	};

	if($("#supfapiao").is(":checked")){
		$("#fapiaoObj").show();
	}

	if($("#online").is(":checked")){
		$("#onlineObj").show();
	}

	$("#supfapiao").bind("click", function(){
		if($(this).is(":checked")){
			$("#fapiaoObj").show();
		}else{
			$("#fapiaoObj").hide();
		}
	});

	$("#online").bind("click", function(){
		if($(this).is(":checked")){
			$("#onlineObj").show();
		}else{
			$("#onlineObj").hide();
		}
	});

	//新增一条优惠
	$(".addJian").bind("click", function(){
		var html = '<div class="input-prepend input-append" style="display: block;"><span class="add-on">满</span><input class="input-mini j1" type="text"><span class="add-on">减</span><input class="input-mini j2" type="text"><span class="add-on"><a href="javascript:;" class="del"><i class="icon-trash"></i></a></span></div>';
		$(this).before(html);
	});

	//删除一条优惠
	$("#onlineObj").delegate(".del", "click", function(){
		$(this).closest(".input-append").remove();
	});

	$("#fapiaoNoteItem span").bind("click", function(){
		var txt = $(this).text();
		$("#fapiaonote").val($("#fapiaonote").val() + " " + txt);
	});

	var yingyezhizhao = $("#yingyezhizhao").val();
	if(yingyezhizhao != ""){
		$("#yingyezhizhao").siblings("iframe").hide();
		var media = '<img src="'+cfg_attachment+yingyezhizhao+'" />';
		$("#yingyezhizhao").siblings(".spic").find(".sholder").html(media);
		$("#yingyezhizhao").siblings(".spic").find(".reupload").attr("style", "display:inline-block;");
		$("#yingyezhizhao").siblings(".spic").show();
	}
	var weishengxuke = $("#weishengxuke").val();
	if(weishengxuke != ""){
		$("#weishengxuke").siblings("iframe").hide();
		var media = '<img src="'+cfg_attachment+weishengxuke+'" />';
		$("#weishengxuke").siblings(".spic").find(".sholder").html(media);
		$("#weishengxuke").siblings(".spic").find(".reupload").attr("style", "display:inline-block;");
		$("#weishengxuke").siblings(".spic").show();
	}


	//填充区域
	$("#addr").html(init.treeTypeList());

	//模糊匹配会员
	$("#user").bind("input", function(){
		$("#userid").val("0");
		var t = $(this), val = t.val();
		if(val != ""){
			t.addClass("input-loading");
			huoniao.operaJson("../inc/json.php?action=checkUser", "key="+val, function(data){
				t.removeClass("input-loading");
				if(!data) {
					$("#userList").html("").hide();
					return false;
				}
				var list = [];
				for(var i = 0; i < data.length; i++){
					list.push('<li data-id="'+data[i].id+'" data-nickname="'+data[i].nickname+'" data-phone="'+data[i].phone+'">'+data[i].username+'</li>');
				}
				if(list.length > 0){
					var pos = t.position();
					$("#userList")
						.css({"left": pos.left, "top": pos.top + 36, "width": t.width() + 12})
						.html('<ul>'+list.join("")+'</ul>')
						.show();
				}else{
					$("#userList").html("").hide();
				}
			});

		}else{
			$("#userList").html("").hide();
		}
    });

	$("#userList").delegate("li", "click", function(){
		var name = $(this).text(), id = $(this).attr("data-id"), nickname = $(this).attr("data-nickname"), phone = $(this).attr("data-phone");
		$("#user").val(name);
		$("#userid").val(id);
		$("#userList").html("").hide();
		checkGw($("#user"), name, $("#id").val());
		return false;
	});

	$(document).click(function (e) {
        var s = e.target;
        if (!jQuery.contains($("#userList").get(0), s)) {
            if (jQuery.inArray(s.id, "user") < 0) {
                $("#userList").hide();
            }
        }
    });

	$("#user").bind("blur", function(){
		var t = $(this), val = t.val(), id = $("#id").val();
		if(val != ""){
			checkGw(t, val, id);
		}else{
			t.siblings(".input-tips").removeClass().addClass("input-tips input-error").html('<s></s>请输入会员信息');
		}
	});

	function checkGw(t, val, id){
		var flag = false;
		t.addClass("input-loading");
		huoniao.operaJson("../inc/json.php?action=checkUser_waimai", "key="+val+"&id="+id, function(data){
			t.removeClass("input-loading");
			if(data == 200){
				t.siblings(".input-tips").removeClass().addClass("input-tips input-error").html('<s></s>此会员已授权管理其它餐厅，一个会员不可以管理多个餐厅！');
			}else{
				if(data) {
					for(var i = 0; i < data.length; i++){
						if(data[i].username == val){
							flag = true;
							$("#userid").val(data[i].id);
							//$("#people").val(data[i].nickname);
							//$("#contact").val(data[i].phone);
						}
					}
				}
				if(flag){
					t.siblings(".input-tips").removeClass().addClass("input-tips input-ok").html('<s></s>如果填写了，则此会员可以管理餐厅信息');
				}else{
					t.siblings(".input-tips").removeClass().addClass("input-tips input-error").html('<s></s>请从列表中选择会员');
				}
			}
		});
	}

	//swfupload s
	var thumbnail;

	//上传缩略图
	thumbnail = function() {
		new SWFUpload({
			upload_url: "/include/upload.inc.php?mod="+modelType+"&type=logo&filetype=image",
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

	//营业时间
	$("#start1, #end1, #start2, #end2").datetimepicker({format: 'hh:ii', startView: 1, minView: 0, autoclose: true, language: 'ch'});

	//标注地图
	$("#mark").bind("click", function(){
		$.dialog({
			id: "markDitu",
			title: "标注地图位置<small>（请点击/拖动图标到正确的位置，再点击底部确定按钮。）</small>",
			content: 'url:'+adminPath+'../api/map/mark.php?mod=waimai&lnglat='+$("#lnglat").val()+"&city="+mapCity+"&addr="+$("#address").val(),
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

	//选择配送区域
	$(".chooseRange").bind("click", function(){
		var lnglat = $("#lnglat").val();
		if($.trim(lnglat) == ""){
			$.dialog.alert("请先选择餐厅地图坐标！");
			return false;
		}else{
			$.dialog({
				id: "rangeDitu",
				title: "标注配送区域",
				content: 'url:'+adminPath+'../api/map/shape.php?mod=waimai&lnglat='+lnglat+"&range="+encodeURIComponent($("#range").val()),
				width: 800,
				height: 500,
				max: true,
				ok: function(){
					var doc = $(window.parent.frames["rangeDitu"].document),
						overlays = doc.find("#overlays").val();
					$("#range").val(overlays);

					$("#shapeMap").attr("src", "../../api/map/shape.php?type=1&mod=waimai&lnglat="+lnglat+"&range="+encodeURIComponent(overlays)).show();
				},
				cancel: true
			});
		}
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

    //删除文件
	$(".spic .reupload").bind("click", function(){
		var t = $(this), parent = t.parent(), input = parent.prev("input"), iframe = parent.next("iframe"), src = iframe.attr("src");
		init.delFile(input.val(), false, function(){
			input.val("");
			t.prev(".sholder").html('');
			parent.hide();
			iframe.attr("src", src).show();
		});
	});

	//表单提交
	$("#btnSubmit").bind("click", function(event){
		event.preventDefault();
		var t            = $(this),
			id           = $("#id").val(),
			user         = $("#user").val(),
			userid       = $("#userid").val(),
			title        = $("#title"),
			litpic       = $("#litpic").val(),
			start        = $("#start").val(),
			end          = $("#end").val(),
			times        = $("#times").val(),
			addr         = $("#addr").val(),
			address      = $("#address"),
			lnglat       = $("#lnglat").val(),
			tel          = $("#tel"),
			range        = $("#range").val();

		if(user == "" || userid == 0){
			huoniao.goInput($("#user"));
			return false;
		}

		if(!huoniao.regex(title)){
			huoniao.goInput(title);
			return false;
		}

		if(litpic == ""){
			huoniao.goInput($("#litpic"));
			$.dialog.alert("请上传餐厅LOGO！");
			return false;
		}

		if(start == "" || end == ""){
			huoniao.goTop();
			$.dialog.alert("请选择营业时间！");
			return false;
		}

		if(times == ""){
			huoniao.goInput($("#times"));
			$.dialog.alert("请输入平均送达时间！");
			return false;
		}

		if(addr == "" || addr == 0){
			huoniao.goInput($("#addr"));
			$("#addrList").siblings(".input-tips").removeClass().addClass("input-tips input-error").attr("style", "display:inline-block");
			return false;
		}else{
			$("#addrList").siblings(".input-tips").removeClass().addClass("input-tips input-ok").attr("style", "display:inline-block");
		}

		if(!huoniao.regex(address)){
			huoniao.goInput(address);
			return false;
		}

		if(lnglat == ""){
			huoniao.goTop();
			$.dialog.alert("请选择餐厅地图坐标！");
			return false;
		}

		if(!huoniao.regex(tel)){
			huoniao.goInput(tel);
			return false;
		}

		if(range == ""){
			huoniao.goTop();
			$.dialog.alert("请选择餐厅配送区域！");
			return false;
		}

		var sale = [], list = $("#onlineObj").find(".input-prepend");
		if(list.length > 0){
			for(var i = 0; i < list.length; i++){
				var obj = list[i], j1 = $(obj).find(".j1").val(), j2 = $(obj).find(".j2").val();
				if($.trim(j1) != "" && j1 != 0 && $.trim(j2) != "" && j2 != 0){
					sale.push(j1+","+j2);
				}
			}
		}

		ue.sync();
		t.attr("disabled", true);

		//异步提交
		huoniao.operaJson("waimaiStore.php", $("#editform").serialize() + "&sale="+sale.join("$$")+"&submit="+encodeURI("提交"), function(data){
			if(data.state == 100){
				ue.execCommand('cleardoc');
				if($("#dopost").val() == "Add"){

					huoniao.parentTip("success", "信息发布成功！<a href='"+data.url+"' target='_blank'>"+data.url+"</a>");
					huoniao.goTop();
					location.reload();

					// $.dialog({
					// 	fixed: true,
					// 	title: "添加成功",
					// 	icon: 'success.png',
					// 	content: "查看链接：<br /><a href='/waimaiStore.php?id="+data.id+"' target='_blank'>/waimaiStore.php?id="+data.id+"</a>",
					// 	ok: function(){
					// 		huoniao.goTop();
					// 		window.location.reload();
					// 	},
					// 	cancel: false
					// });

				}else{

					huoniao.parentTip("success", "信息修改成功！<a href='"+data.url+"' target='_blank'>"+data.url+"</a>");
					t.attr("disabled", false);

					// $.dialog({
					// 	fixed: true,
					// 	title: "修改成功",
					// 	icon: 'success.png',
					// 	content: "查看链接：<br /><a href='/waimaiStore.php?id="+id+"' target='_blank'>/waimaiStore.php?id="+id+"</a>",
					// 	ok: function(){
					// 		try{
					// 			$("body",parent.document).find("#nav-waimaiStorephp").click();
					// 			parent.reloadPage($("body",parent.document).find("#body-waimaiStorephp"));
					// 			$("body",parent.document).find("#nav-waimaiStoreEdit"+id+" s").click();
					// 		}catch(e){
					// 			location.href = thisPath + "waimaiStore.php";
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

//上传成功接收
function uploadSuccess(obj, file, filetype){
	$("#"+obj).val(file);
	var media = '<img src="'+cfg_attachment+file+'" />';
	$("#"+obj).siblings(".spic").find(".sholder").html(media);
	$("#"+obj).siblings(".spic").find(".reupload").attr("style", "display: inline-block");
	$("#"+obj).siblings(".spic").show();
	$("#"+obj).siblings("iframe").hide();
}

$(function(){
	var thisURL   = window.location.pathname;
		tmpUPage  = thisURL.split( "/" ); 
		thisUPage = tmpUPage[ tmpUPage.length-1 ]; 
		thisPath  = thisURL.split(thisUPage)[0];

	if($("#dopost").val() == "edit"){
		getMenuType($("#store").val());
	}
		
	//模糊匹配餐厅
	$("#storeName").bind("input", function(){
		var t = $(this), val = t.val();

		$("#store").val(0);
		$("#typeid")
			.attr("disabled", true)
			.html('<option value="0">请输入餐厅名称</option>');

		if(val != ""){
			t.addClass("input-loading");
			huoniao.operaJson("waimaiStore.php?dopost=checkWaimaiStore", "key="+val, function(data){
				t.removeClass("input-loading");
				if(!data) {
					$("#storeList").html("").hide();
					return false;
				}
				var list = [];
				for(var i = 0; i < data.length; i++){
					list.push('<li data-id="'+data[i].id+'">'+data[i].title+'</li>');
				}
				if(list.length > 0){
					var pos = t.position();
					$("#storeList")
						.css({"left": pos.left, "top": pos.top + 36, "width": t.width() + 12})
						.html('<ul>'+list.join("")+'</ul>')
						.show();
				}else{
					$("#storeList").html("").hide();
				}
			});
			
		}else{
			$("#storeList").html("").hide();
		}
    });
	
	$("#storeList").delegate("li", "click", function(){
		var id = $(this).attr("data-id"), name = $(this).text();
		$("#storeName").val(name);
		$("#store").val(id);
		$("#storeList").html("").hide();
		$("#storeName").siblings(".input-tips").removeClass().addClass("input-tips input-ok").html('<s></s>请输入餐厅名称');

		getMenuType(id);

		return false;
	});	

	$("#storeName").bind("blur", function(){
		var t = $(this), val = t.val();
		if(val != ""){
			
			var flag = false;
			t.addClass("input-loading");
			huoniao.operaJson("waimaiStore.php?dopost=checkWaimaiStore", "key="+val, function(data){
				t.removeClass("input-loading");
				if(data) {
					for(var i = 0; i < data.length; i++){
						if(data[i].title == val){
							flag = true;
							$("#store").val(data[i].id);
						}
					}
				}
				if(flag){
					getMenuType($("#store").val());
					t.siblings(".input-tips").removeClass().addClass("input-tips input-ok").html('<s></s>请输入餐厅名称');
				}else{
					t.siblings(".input-tips").removeClass().addClass("input-tips input-error").html('<s></s>请从列表中选择餐厅名称');
				}
			});

		}else{
			t.siblings(".input-tips").removeClass().addClass("input-tips input-error").html('<s></s>请输入餐厅名称');
		}
	});
	
	$(document).click(function (e) {
        var s = e.target;
        if (!jQuery.contains($("#storeList").get(0), s)) {
            if (jQuery.inArray(s.id, "storeName") < 0) {
                $("#storeList").hide();
            }
        }
    });

    function getMenuType(id){
    	$.ajax({
			url: "waimaiStore.php?dopost=getType&action=menu",
			data: "store="+id,
			type: "POST",
			dataType: "json",
			success: function(data){
				huoniao.hideTip();
				var content = [];
				content.push('<option value="0">请选择分类</option>');
				if(data){
					for(var i = 0; i < data.length; i++){
						var selected = "";
						if(data[i].id == typeid){
							selected = " selected='selected'";
						}
						content.push('<option value="'+data[i].id+'"'+selected+'>'+data[i].val+'</option>');
					}

					$("#typeid")
						.removeAttr("disabled")
						.html(content.join(""));

				}
				
			}
		});
    }

	//swfupload s
	var picList;
	
	//上传图集
	picList = function() {
		new SWFUpload({
			upload_url: "/include/upload.inc.php?mod="+modelType+"&type=atlas",
			file_post_name: "Filedata",
			file_size_limit: atlasSize,
			file_types: atlasType,
			file_types_description: "图片文件",
			file_upload_limit: 0,
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
	
	//填充图片
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
	$("#listSection").dragsort({ dragSelector: "li", placeHolderTemplate: '<li class="holder"></li>' });

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
	
	//表单提交
	$("#btnSubmit").bind("click", function(event){
		event.preventDefault();
		var t          = $(this),
			id         = $("#id").val(),
			storeName  = $("#storeName").val(),
			store      = $("#store").val(),
			typeid     = $("#typeid").val(),
			title      = $("#title"),
			price      = $("#price").val();
		
		if(storeName == "" || store == 0){
			huoniao.goInput($("#storeName"));
			return false;
		}
		
		if(typeid == 0){
			huoniao.goInput($("#typeid"));
			$.dialog.alert("请选择菜单分类");
			return false;
		}
		
		if(!huoniao.regex(title)){
			huoniao.goInput(title);
			return false;
		}
		
		if(price == ""){
			huoniao.goInput($("#price"));
			$.dialog.alert("请输入菜单价格！");
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
		huoniao.operaJson("waimaiMenu.php", $("#editform").serialize() + "&pics="+encodeURIComponent(imglist.join(","))+"&submit="+encodeURI("提交"), function(data){
			if(data.state == 100){
				if($("#dopost").val() == "Add"){
					$.dialog({
						fixed: true,
						title: "添加成功",
						icon: 'success.png',
						content: "添加成功！",
						ok: function(){
							huoniao.goTop();
							window.location.reload();
						},
						cancel: false
					});
					
				}else{
					$.dialog({
						fixed: true,
						title: "修改成功",
						icon: 'success.png',
						content: "修改成功！",
						ok: function(){
							try{
								$("body",parent.document).find("#nav-waimaiMenuphp").click();
								parent.reloadPage($("body",parent.document).find("#body-waimaiMenuphp"));
								$("body",parent.document).find("#nav-waimaiMenuEdit"+id+" s").click();
							}catch(e){
								location.href = thisPath + "waimaiMenu.php";
							}
						},
						cancel: false
					});
				}
			}else{
				$.dialog.alert(data.info);
				t.attr("disabled", false);
			};
		});
	});
	
});
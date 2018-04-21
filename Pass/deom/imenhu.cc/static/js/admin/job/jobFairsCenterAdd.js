//实例化编辑器
var ue = UE.getEditor('note');

$(function(){

	huoniao.parentHideTip();
	
	var thisURL   = window.location.pathname;
		tmpUPage  = thisURL.split( "/" );
		thisUPage = tmpUPage[ tmpUPage.length-1 ];
		thisPath  = thisURL.split(thisUPage)[0];

	var init = {
		//树形递归分类
		treeTypeList: function(type){
			var typeList = [], cl = "";
			var l = type == "addr" ? addrListArr : industryListArr;
			var s = type == "addr" ? addrid : industry;
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
	};

	//填充区域
	$("#addr").html(init.treeTypeList("addr"));

	//填充图集
	if(picslist != ""){
		var picList = [];
		for(var i = 0; i < picslist.length; i++){
			picList.push('<li class="clearfix" id="SWFUpload_1_0'+i+'">');
			picList.push('  <i class="li-move" href="javascript:;" title="拖动调整图片顺序">移动</i>');
			picList.push('  <a class="li-rm" href="javascript:;">×</a>');
			picList.push('  <div class="li-thumb" style="display:block;">');
			picList.push('    <div class="r-progress"><s></s></div>');
			picList.push('    <span class="ibtn">');
			picList.push('      <a href="javascript:;" class="Lrotate" title="逆时针旋转90度"></a>');
			picList.push('      <a href="javascript:;" class="Rrotate" title="顺时针旋转90度"></a>');
			picList.push('      <a href="'+cfg_attachment+picslist[i][0]+'&type=large" target="_blank" class="enlarge" title="放大"></a>');
			picList.push('    </span>');
			picList.push('    <span class="ibg"></span>');
			picList.push('    <img data-val="'+picslist[i][0]+'" src="'+cfg_attachment+picslist[i][0]+'&type=small" />');
			picList.push('  </div>');
			picList.push('  <div class="li-info" style="display:block;"><input class="li-title" placeholder="请输入图片名称" style="width:225px; display:inline-block;" value="'+picslist[i][1]+'"></div>');
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
	var picList;

	//上传图集
	picList = function() {
		new SWFUpload({
			upload_url: "/include/upload.inc.php?mod="+modelType+"&type=atlas&filetype=image",
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
			upload_success_handler: uploadSuccessList_,
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
			lim = $('<i class="li-move" href="javascript:;" title="拖动调整图片顺序">移动</i>'),
			lir = $('<a class="li-rm" href="javascript:;">&times;</a>'),
			lin = $('<span class="li-name">'+file.name+'</span>'),
			lip = $('<span class="li-progress"><s></s></span>'),
			lit = $('<div class="li-thumb"><div class="r-progress"><s></s></div><span class="ibtn"><a href="javascript:;" class="Lrotate" title="逆时针旋转90度"></a><a href="javascript:;" class="Rrotate" title="顺时针旋转90度"></a><a href="javascript:;" target="_blank" class="enlarge" title="放大"></a></span><span class="ibg"></span><img></div>'),
			lii = $('<div class="li-info"><input class="li-title" placeholder="请输入图片名称" style="width:225px;" value=""></div>');

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
		pli.append(lii);

		listSection.append(pli);
	}

	//上传成功
	function uploadSuccessList_(file, serverData) {
		var b = eval('('+serverData+')');
		var pro = file.id;
		if(b.state == "SUCCESS"){
			$("#"+pro).find(".li-name").hide();
			$("#"+pro).find(".li-progress").hide();
			$("#"+pro).find(".li-move").show();
			$("#"+pro).find(".li-thumb").show();
			$("#"+pro).find(".li-thumb img").attr("data-val", b.url);
			$("#"+pro).find(".li-thumb img").attr("src", cfg_attachment+b.url+"&type=small");
			$("#"+pro).find(".li-thumb .enlarge").attr("href", cfg_attachment+b.url);
			$("#"+pro).find(".li-info").show();

			$("#deleteAllAtlas").show();

			$("#"+pro).find(".li-rm").bind("click", function(){
				var t = $(this), img = t.siblings(".li-thumb").find("img").attr("data-val");
				delAtlasImg(pro, img);
			});
		}else{
			$.dialog.alert(b.state);
			$("#"+pro).remove();
		}
	}

	//旋转图集文件
	var rotateAtlasPic = function(direction, img, c) {
			var g = {
				mod: modelType,
				type: "rotateAtlas",
				direction: direction,
				picpath: img,
				action: "atlas",
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

	//标注地图
	$("#mark").bind("click", function(){
		$.dialog({
			id: "markDitu",
			title: "标注地图位置<small>（请点击/拖动图标到正确的位置，再点击底部确定按钮。）</small>",
			content: 'url:'+adminPath+'../api/map/mark.php?mod=job&lnglat='+$("#lnglat").val()+"&city="+mapCity+"&addr="+$("#address").val(),
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
		var t     = $(this),
			id      = $("#id").val(),
			title   = $("#title"),
			addr    = $("#addr").val(),
			address = $("#address");

		if(!huoniao.regex(title)){
			huoniao.goInput(title);
			return false;
		};

		if(addr == "" || addr == 0){
			huoniao.goTop();
			$(".config-nav button:eq(0)").click();
			$("#addrList").siblings(".input-tips").removeClass().addClass("input-tips input-error").attr("style", "display:inline-block");
			return false;
		}else{
			$("#addrList").siblings(".input-tips").removeClass().addClass("input-tips input-ok").attr("style", "display:inline-block");
		}

		if(!huoniao.regex(address)){
			huoniao.goInput(address);
			return false;
		}

		//图集
		var picslist = [], picli = $("#listSection li");
		if(picli.length > 0){
			for(var i = 0; i < picli.length; i++){
				var imgval = $("#listSection li:eq("+i+")").find(".li-thumb img").attr("data-val"),
					imginfo = $("#listSection li:eq("+i+")").find(".li-info"),
					imgtitle = imginfo.find(".li-title").val();
				picslist.push(imgval+"||"+imgtitle);
			}
		}

		t.attr("disabled", true);

		//异步提交
		huoniao.operaJson("jobFairsCenter.php", $("#editform").serialize() + "&pics="+picslist.join("###")+"&submit="+encodeURI("提交"), function(data){
			if(data.state == 100){
				if($("#dopost").val() == "Add"){

					huoniao.parentTip("success", "发布成功！<a href='"+data.url+"' target='_blank'>"+data.url+"</a>");
					huoniao.goTop();
					window.location.reload();

				}else{

					huoniao.parentTip("success", "修改成功！<a href='"+data.url+"' target='_blank'>"+data.url+"</a>");
					t.attr("disabled", false);

				}
			}else{
				$.dialog.alert(data.info);
				t.attr("disabled", false);
			};
		});
	});

});

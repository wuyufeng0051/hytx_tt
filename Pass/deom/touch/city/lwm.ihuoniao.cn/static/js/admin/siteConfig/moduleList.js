$(function(){
	var init = {

		//拼接分类
		printTypeTree: function(){
			var typeList = [], l=moduleList.length, cl = -45, level = 0;
			for(var i = 0; i < l; i++){
				(function(){
					var jsonArray =arguments[0], jArray = jsonArray.lower;
					typeList.push('<li class="li'+level+'">');

					typeList.push('<div class="tr clearfix tr_'+jsonArray["id"]+'" data-id="'+jsonArray["id"]+'">');
					if(jsonArray["parentid"] == 0){
						typeList.push('  <div class="row3"><a href="javascript:;" class="fold">折叠</a></div>');
						typeList.push('  <div class="row60 left"><input type="text" data-id="'+jsonArray["id"]+'" value="'+jsonArray["title"]+'"></div>');
					}else{
						typeList.push('  <div class="row3"></div>');
						typeList.push('  <div class="row40 left"><span class="plus-icon" style="margin-left:'+cl+'px;"></span><img src="../../static/images/admin/nav/'+jsonArray["icon"]+'" /> <strong>'+jsonArray["title"]+'</strong><sup>'+jsonArray["version"]+'</sup> ('+jsonArray["name"]+')&nbsp;&nbsp;<a href="javascript:;" class="explain">说明</a></div>');
						if(jsonArray['name'] == defaultindex){
							typeList.push('  <div class="row20"><a href="javascript:;" class="index curr">取消首页</a></div>');
						}else{
							typeList.push('  <div class="row20"><a href="javascript:;" class="index">设为首页</a></div>');
						}
					}
					typeList.push('  <div class="row20"><a href="javascript:;" class="up">向上</a><a href="javascript:;" class="down">向下</a></div>');

					if(jsonArray["parentid"] == 0){
						typeList.push('  <div class="row17 left"><a href="javascript:;" class="del" title="删除">删除编辑</a></div>');
					}else{
						typeList.push('  <div class="row17 left"><a href="javascript:;" title="修改" class="modify">修改</a>');
						if(jsonArray["state"] == 0){
							typeList.push('&nbsp;<a href="javascript:;" title="停用" class="disable">停用</a>');
						}else{
							typeList.push('&nbsp;<a href="javascript:;" title="启用" class="enable" style="color:#f00">启用</a>');
						}
						typeList.push('&nbsp;<a href="moduleList.php?dopost=uninstall&id='+jsonArray["id"]+'" title="卸载" class="uninstall">卸载</a></div>');
					}

					typeList.push('</div>');

					if(jArray.length > 0){
						typeList.push('<ul class="subnav ul'+level+'">');
					}
					for(var k = 0; k < jArray.length; k++){

						cl = cl + 45, level = level + 1;

						if(jArray[k]['lower'] != null){
							arguments.callee(jArray[k]);
						}
					}
					if(jsonArray["parentid"] == 0){
						cl = -45, level = 0;
					}else{
						cl = cl - 45, level = level - 1;
					}
					if(jArray.length > 0){
						typeList.push('</ul></li>');
					}else{
						typeList.push('</li>');
					}
				})(moduleList[i]);
			}
			$(".root").html(typeList.join(""));
			init.dragsort();
		}

		//树形递归分类
		,treeTypeList: function(id, parentid){
			var l=moduleList.length, typeList = [], cl = "", level = 0;
			for(var i = 0; i < l; i++){
				(function(){
					var jsonArray =arguments[0], selected = "";
					//选中
					if(parentid == jsonArray["id"]){
						selected = " selected";
					}
					typeList.push('<option value="'+jsonArray["id"]+'"'+selected+'>'+cl+"|--"+jsonArray["title"]+'</option>');
				})(moduleList[i]);
			}
			return typeList.join("");
		}

		//快速编辑
		,quickEdit: function(id){
			if(id == ""){
				huoniao.showTip("warning", "请选择要修改的模块！", "auto");
			}else{
				huoniao.showTip("loading", "正在获取信息，请稍候...");

				huoniao.operaJson("moduleList.php?dopost=getDetail", "id="+id, function(data){
					if(data != null){
						data = data[0];
						huoniao.hideTip();

						$.dialog({
							fixed: true,
							title: '修改模块信息',
							content: $("#editForm").html(),
							width: 460,
							ok: function(){
								//提交
								var title     = self.parent.$("#title").val(),
									icon      = self.parent.$("#icon").val(),
									parentid  = self.parent.$("#parentid").val(),
									weight    = self.parent.$("#weight").val(),
									serialize = self.parent.$(".quick-editForm").serialize();

								if($.trim(title) == ""){
									alert("请输入模块名称");
									return false;
								}

								if($.trim(icon) == ""){
									alert("请输入模块图标");
									return false;
								}

								if($.trim(parentid) == ""){
									alert("请选择模块属性目录");
									return false;
								}

								if($.trim(weight) == ""){
									weight = 0;
								}

								huoniao.operaJson("moduleList.php?dopost=updateModule", "id="+id+"&"+serialize, function(data){
									if(data.state == 100){
										huoniao.showTip("success", data.info, "auto");
										setTimeout(function() {
											//location.reload();
											top.location.href = "../index.php?gotopage=siteConfig/moduleList.php";
										}, 800);
									}else if(data.state == 101){
										alert(data.info);
										return false;
									}else{
										huoniao.showTip("error", data.info, "auto");
									}
								});

							},
							cancel: true
						});

						//填充信息
						self.parent.$("#title").val(data.title);
						self.parent.$("#name").html(data.name);
						self.parent.$("#icon").val(data.icon);

						self.parent.$("#parentid").html(init.treeTypeList(data.id, data.parentid));
						if(data.parentid != 0){
							self.parent.$("#parentid").parent().parent().show();
						}
						self.parent.$("input[name=state]:eq("+data.state+")").attr("checked", true);
						self.parent.$("#weight").val(data.weight);

					}else{
						huoniao.showTip("error", "信息获取失败！", "auto");
					}
				});
			}

		}

		//拖动排序
		,dragsort: function(){
			//一级
			$('.root').sortable({
	            items: '>li.li0',
				placeholder: 'placeholder',
	            orientation: 'vertical',
	            axis: 'y',
				handle:'>div.tr',
	            opacity: .5,
	            revert: 0,
				stop:function(){
					saveOpera(1);
				}
	        });
			for(var i = 0; i <= 1; i++){
				$('.root .li'+i).sortable({
					items: '.li'+(i+1),
					placeholder: 'placeholder',
					orientation: 'vertical',
					axis: 'y',
					handle:'>div.tr',
					opacity: .5,
					revert: 0,
					stop:function(){
						saveOpera(1);
					}
				});
			}
		}
	};

	//拼接现有分类
	if(moduleList != ""){
		init.printTypeTree();
	};

	//底部添加新分类
	$("#addNew").bind("click", function(){
		var html = [];

		html.push('<li class="li0">');
		html.push('  <div class="tr clearfix">');
		html.push('    <div class="row3"><a href="javascript:;" class="fold">折叠</a></div>');
		html.push('    <div class="row60 left"><input data-id="0" type="text" value=""></div>');
		html.push('    <div class="row20"><a href="javascript:;" class="up">向上</a><a href="javascript:;" class="down">向下</a></div>');
		html.push('    <div class="row17 left"><a href="javascript:;" class="del">删除</a></div>');
		html.push('  </div>');
		html.push('</li>');

		$(this).parent().parent().prev(".root").append(html.join(""));
	});

	//安装新模块
	$("#installNew").bind("click", function(){
		if($("#list ul").html() != ""){
			try {
				event.preventDefault();
				parent.addPage("store", "store", "商店", "siteConfig/store.php");
			} catch(e) {}
		}else{
			alert("请先添加分类目录！");
		}
	});

	//折叠、展开
	$(".root").delegate(".fold", "click", function(){
		if($(this).hasClass("unfold")){
			$(this).removeClass("unfold");
			$(this).parent().parent().parent().find("ul").show();
		}else{
			$(this).addClass("unfold");
			$(this).parent().parent().parent().find("ul").hide();
		}
	});

	//鼠标经过li
	$("#list").delegate(".tr", "mouseover", function(){
		$(this).parent().addClass("hover");
	});
	$("#list").delegate(".tr", "mouseout", function(){
		$(this).parent().removeClass("hover");
	});

	//排序向上
	$(".root").delegate(".up", "click", function(){
		var t = $(this), parent = t.parent().parent().parent(), index = parent.index(), length = parent.siblings("li").length;
		if(index != 0){
			parent.after(parent.prev("li"));
			saveOpera(1);
		}
	});

	//排序向下
	$(".root").delegate(".down", "click", function(){
		var t = $(this), parent = t.parent().parent().parent(), index = parent.index(), length = parent.siblings("li").length;
		if(index != length){
			parent.before(parent.next("li"));
			saveOpera(1);
		}
	});

	//说明
	$(".root").delegate(".explain", "click", function(){
		var t = $(this), id = t.parent().parent().attr("data-id");
		huoniao.showTip("loading", "正在查询，请稍候...");
		huoniao.operaJson("moduleList.php?dopost=getNote", "id="+id, function(data){
			huoniao.hideTip();
			if(data[0].note != ""){
				$.dialog({
					fixed: true,
					title: '模块说明',
					content: data[0].note,
					width: 800,
					ok: true
				});

			}else{
				alert("Error!");
				return false;
			}
		});
	});


	//设为首页
	$(".list").delegate(".index", "click", function(){
		var t = $(this), id = t.closest(".tr").attr("data-id"), type = 'set';
		if(!t.hasClass("curr")){
			//t.closest(".list").find(".index").removeClass("curr").html("设为首页");
			// t.addClass("curr").html("取消首页");
		}else{
			// t.removeClass("curr").html("设为首页");
			type = 'clear';
		}


		huoniao.operaJson("siteConfig.php?action=setSystemIndex", "&type="+type+"&module="+id+"&token="+token, function(data){
			location.reload();
		});

	});


	//删除
	$(".root").delegate(".del", "click", function(event){
		event.preventDefault();
		var t = $(this), id = t.parent().parent().find("input").attr("data-id"), type = t.parent().text();

		if(t.parent().parent().next("ul").html() != undefined && t.parent().parent().next("ul").html() != ""){
			$.dialog.alert("该目录下含有已安装模块<br />请先卸载(或转移至其它目录下)！");
		}else{
			//从数据库删除
			if(type.indexOf("编辑") > -1){
				huoniao.operaJson("moduleList.php?dopost=del", "id="+id, function(data){
					if(data.state == 100){
						huoniao.showTip("success", data.info, "auto");
						setTimeout(function() {
							//location.reload();
							top.location.href = "../index.php?gotopage=siteConfig/moduleList.php";
						}, 800);
					}else{
						alert(data.info);
						return false;
					}
				});
				//跳转到对应删除页面
			}else{
				t.parent().parent().parent().remove();
			}
		}
	});

	//修改
	$(".root").delegate(".modify", "click", function(){
		var id = $(this).parent().parent().attr("data-id");
		init.quickEdit(id);
	});

	//停用
	$(".root").delegate(".disable", "click", function(){
		var t = $(this), id = t.parent().parent().attr("data-id");
		huoniao.showTip("loading", "正在操作，请稍候...");
		huoniao.operaJson("moduleList.php?dopost=disable", "id="+id, function(data){
			huoniao.hideTip();
			if(data.state == 100){
				huoniao.showTip("success", data.info, "auto");
				setTimeout(function() {
					//location.reload();
					top.location.href = "../index.php?gotopage=siteConfig/moduleList.php";
				}, 800);
			}else{
				alert(data.info);
				return false;
			}
		});
	});

	//启用
	$(".root").delegate(".enable", "click", function(){
		var t = $(this), id = t.parent().parent().attr("data-id");
		huoniao.showTip("loading", "正在操作，请稍候...");
		huoniao.operaJson("moduleList.php?dopost=enable", "id="+id, function(data){
			huoniao.hideTip();
			if(data.state == 100){
				huoniao.showTip("success", data.info, "auto");
				setTimeout(function() {
					//location.reload();
					top.location.href = "../index.php?gotopage=siteConfig/moduleList.php";
				}, 800);
			}else{
				alert(data.info);
				return false;
			}
		});
	});

	//卸载
	$(".root").delegate(".uninstall", "click", function(event){
		event.preventDefault();
		var url = $(this).attr("href");
		$.dialog.confirm('此操作不可恢复，您确定要卸载吗？', function(){
			location.href = "siteConfig/"+url;
		});
	});

	//表单回车提交
	$("#list").delegate("input", "keyup", function(e){
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
            $("#saveBtn").click();
        }
    });

	//保存
	$("#saveBtn").bind("click", function(){
		saveOpera("");
	});

});

//保存
function saveOpera(type){
	var first = $("ul.root>li"), json = '[';
	for(var i = 0; i < first.length; i++){
		(function(){
			var html =arguments[0], count = 0, jArray = $(html).find(">ul>li"), tr = $(html).find(".tr input"), id = $(html).find(".tr").attr("data-id"), val = tr.val();

			if(jArray.length > 0 && val != ""){
				json = json + '{"id": "'+id+'", "name": "'+encodeURIComponent(val)+'", "lower": [';
				for(var k = 0; k < jArray.length; k++){
					if($(jArray[k]).find(">ul>li").length > 0){
						arguments.callee(jArray[k]);
					}else{
						var tr = $(jArray[k]).find(".tr input"), id = $(jArray[k]).find(".tr").attr("data-id"), val = tr.val();
						if(val != ""){
							json = json + '{"id": "'+id+'"},';
						}else{
							count++;
						}
					}
				}
				json = json.substr(0, json.length-1);
				if(count == jArray.length){
					json = json + 'null},';
				}else{
					json = json + ']},';
				}
			}else{
				if(val != ""){
					json = json + '{"id": "'+id+'", "name": "'+encodeURIComponent(val)+'", "lower": null},';
				}
			}
		})(first[i]);
	}
	json = json.substr(0, json.length-1);
	json = json + ']';

	if(json == "]") return false;

	huoniao.operaJson("moduleList.php?dopost=typeAjax", "data="+json, function(data){
		if(data.state == 100){
			huoniao.showTip("success", data.info, "auto");
			if(type == ""){
				window.scroll(0, 0);
				setTimeout(function() {
					location.reload();
				}, 800);
			}
		}else{
			huoniao.showTip("error", data.info, "auto");
		}
	});
}

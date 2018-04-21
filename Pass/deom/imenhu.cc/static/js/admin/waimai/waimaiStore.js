$(function(){

	var defaultBtn = $("#delBtn, #batchAudit"),
		checkedBtn = $("#stateBtn"),
		init = {

			//选中样式切换
			funTrStyle: function(){
				var trLength = $("#list tbody tr").length, checkLength = $("#list tbody tr.selected").length;
				if(trLength == checkLength){
					$("#selectBtn .check").removeClass("checked").addClass("checked");
				}else{
					$("#selectBtn .check").removeClass("checked");
				}

				if(checkLength > 0){
					defaultBtn.css('display', 'inline-block');
					checkedBtn.hide();
				}else{
					defaultBtn.hide();
					checkedBtn.css('display', 'inline-block');
				}
			}

			//菜单递归分类
			,selectTypeList: function(type){
				var typeList = [], title = type == "addr" ? "全部区域" : "全部类型";
				typeList.push('<ul class="dropdown-menu">');
				typeList.push('<li><a href="javascript:;" data-id="">'+title+'</a></li>');

				var l = type == "addr" ? addrListArr : typeListArr;
				for(var i = 0; i < l.length; i++){
					(function(){
						var jsonArray =arguments[0], jArray = jsonArray.lower, cl = "";
						if(jArray != undefined && jArray.length > 0){
							cl = ' class="dropdown-submenu"';
						}
						typeList.push('<li'+cl+'><a href="javascript:;" data-id="'+jsonArray["id"]+'">'+jsonArray["typename"]+'</a>');
						if(jArray != undefined){
							if(jArray.length > 0){
								typeList.push('<ul class="dropdown-menu">');
							}

							for(var k = 0; k < jArray.length; k++){
								if(jArray[k]['lower'] != ""){
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
						}

					})(l[i]);
				}

				typeList.push('</ul>');
				return typeList.join("");
			}

			//删除
			,del: function(){
				var checked = $("#list tbody tr.selected");
				if(checked.length < 1){
					huoniao.showTip("warning", "未选中任何信息！", "auto");
				}else{
					huoniao.showTip("loading", "正在操作，请稍候...");
					var id = [];
					for(var i = 0; i < checked.length; i++){
						id.push($("#list tbody tr.selected:eq("+i+")").attr("data-id"));
					}

					huoniao.operaJson("waimaiStore.php?dopost=del", "id="+id, function(data){
						if(data.state == 100){
							huoniao.showTip("success", data.info, "auto");
							$("#selectBtn a:eq(1)").click();
							setTimeout(function() {
								getList();
							}, 800);
						}else{
							var info = [];
							for(var i = 0; i < $("#list tbody tr").length; i++){
								var tr = $("#list tbody tr:eq("+i+")");
								for(var k = 0; k < data.info.length; k++){
									if(data.info[k] == tr.attr("data-id")){
										info.push("▪ "+tr.find("td:eq(1) a").text());
									}
								}
							}
							$.dialog.alert("<div class='errInfo'><strong>以下信息删除失败：</strong><br />" + info.join("<br />") + '</div>', function(){
								getList();
							});
						}
					});
					$("#selectBtn a:eq(1)").click();
				}
			}

			//更新信息状态
			,updateState: function(type){
				huoniao.showTip("loading", "正在操作，请稍候...");
				$("#smartMenu_state").remove();

				var checked = $("#list tbody tr.selected");
				if(checked.length < 1){
					huoniao.showTip("warning", "未选中任何信息！", "auto");
				}else{
					var state = "";
					if(type == "待审核"){
						state = 0;
					}else if(type == "已审核"){
						state = 1;
					}else if(type == "拒绝审核"){
						state = 2;
					}

					huoniao.showTip("loading", "正在操作，请稍候...");
					var id = [];
					for(var i = 0; i < checked.length; i++){
						id.push($("#list tbody tr.selected:eq("+i+")").attr("data-id"));
					}
					huoniao.operaJson("waimaiStore.php?dopost=updateState", "id="+id+"&state="+state, function(data){
						if(data.state == 100){
							huoniao.showTip("success", data.info, "auto");
							setTimeout(function() {
								getList();
							}, 800);
						}else{
							var info = [];
							for(var i = 0; i < $("#list tbody tr").length; i++){
								var tr = $("#list tbody tr:eq("+i+")");
								for(var k = 0; k < data.info.length; k++){
									if(data.info[k] == tr.attr("data-id")){
										info.push("▪ "+tr.find("td:eq(1) a").text());
									}
								}
							}
							$.dialog.alert("<div class='errInfo'><strong>以下信息修改失败：</strong><br />" + info.join("<br />") + '</div>', function(){
								getList();
							});
						}
					});
					$("#selectBtn a:eq(1)").click();
				}
			}

		};

	//菜系分类
	$("#typeBtn").append(init.selectTypeList("type"));

	//地区递归分类
	$("#addrBtn").append(init.selectTypeList("addr"));

	//初始加载
	getList();

	//搜索
	$("#searchBtn").bind("click", function(){
		$("#sKeyword").html($("#keyword").val());
		$("#sAddr").html($("#addrBtn").attr("data-id"));
		$("#sType").html($("#typeBtn").attr("data-id"));
		$("#list").attr("data-atpage", 1);
		getList();
	});

	//搜索回车提交
    $("#keyword").keyup(function (e) {
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
            $("#searchBtn").click();
        }
    });

	//新增信息
	$("#addNew").bind("click", function(event){
		event.preventDefault();
		var href = $(this).attr("href");
		try {
			event.preventDefault();
			parent.addPage("waimaiStoreAdd", "waimai", "添加新餐厅", "waimai/"+href);
		} catch(e) {}
	});

	//二级菜单点击事件
	$("#typeBtn a").bind("click", function(){
		var id = $(this).attr("data-id"), title = $(this).text();
		$("#typeBtn").attr("data-id", id);
		$("#typeBtn button").html(title+'<span class="caret"></span>');
	});

	$("#addrBtn a").bind("click", function(){
		var id = $(this).attr("data-id"), title = $(this).text();
		$("#addrBtn").attr("data-id", id);
		$("#addrBtn button").html(title+'<span class="caret"></span>');
	});

	$("#stateBtn, #pageBtn, #paginationBtn").delegate("a", "click", function(){
		var id = $(this).attr("data-id"), title = $(this).html(), obj = $(this).parent().parent().parent();
		obj.attr("data-id", id);
		if(obj.attr("id") == "paginationBtn"){
			var totalPage = $("#list").attr("data-totalpage");
			$("#list").attr("data-atpage", id);
			obj.find("button").html(id+"/"+totalPage+'页<span class="caret"></span>');
			$("#list").attr("data-atpage", id);
		}else{

			$("#typeBtn")
				.attr("data-id", "")
				.find("button").html('全部分类<span class="caret"></span>');

			$("#sType").html("");

			$("#addrBtn")
				.attr("data-id", "")
				.find("button").html('全部区域<span class="caret"></span>');

			$("#sAddr").html("");

			if(obj.attr("id") != "propertyBtn"){
				obj.find("button").html(title+'<span class="caret"></span>');
			}
			$("#list").attr("data-atpage", 1);
		}
		getList();
	});

	//下拉菜单过长设置滚动条
	$(".dropdown-toggle").bind("click", function(){
		if($(this).parent().attr("id") != "typeBtn" && $(this).parent().attr("id") != "addrBtn"){
			var height = document.documentElement.clientHeight - $(this).offset().top - $(this).height() - 30;
			$(this).next(".dropdown-menu").css({"max-height": height, "overflow-y": "auto"});
		}
	});

	//全选、不选
	$("#selectBtn a").bind("click", function(){
		var id = $(this).attr("data-id");
		if(id == 1){
			$("#selectBtn .check").addClass("checked");
			$("#list tr").removeClass("selected").addClass("selected");

			defaultBtn.css('display', 'inline-block');
			checkedBtn.hide();
		}else{
			$("#selectBtn .check").removeClass("checked");
			$("#list tr").removeClass("selected");

			checkedBtn.css('display', 'inline-block');
			defaultBtn.hide();
		}
	});

	//菜单分类
	$("#list").delegate(".type", "click", function(event){
		var store = $(this).closest("tr").attr("data-id"),
			type  = $(this).attr("data-type");
		huoniao.showTip("loading", "正在操作，请稍候");
		$.ajax({
			url: "waimaiStore.php?dopost=getType&action="+type,
			data: "store="+store,
			type: "POST",
			dataType: "json",
			success: function(data){
				huoniao.hideTip();
				var content = [];
				if(data){
					for(var i = 0; i < data.length; i++){
						content.push('<li data-id="'+data[i].id+'"><i data-toggle="tooltip" data-placement="top" data-original-title="拖动以排序" class="icon-move"></i><input type="text" name="name[]" value="'+data[i].val+'" /><a data-toggle="tooltip" data-placement="top" data-original-title="删除" href="javascript:;" class="icon-trash"></a></li>');
					}
					content = '<ul class="menu-itemlist">'+content.join("")+'</ul>';
					content += '<a href="javascript:;" id="addNewManageType"><i class="icon-plus"></i>新增分类</a>';
				}

				$.dialog({
					id: "ManageType",
					title: "管理菜单分类",
					content: content,
					width: 360,
					ok: function(){
						var data = [], itemList = self.parent.$(".menu-itemlist li");
						for(var i = 0; i < itemList.length; i++){
							var obj = itemList.eq(i), id = obj.attr("data-id"), weight = obj.index(), val = obj.find("input").val();
							data.push('{"id": "'+id+'", "weight": "'+weight+'", "val": "'+val+'"}');
						}

						$.ajax({
							url: "waimaiStore.php?dopost=updateType&action="+type,
							data: "store="+store+"&data=["+data.join(",")+"]",
							type: "POST",
							dataType: "json",
							success: function(data){
								if(data){
									var option = [];
									for(var i = 0; i < data.length; i++){
										option.push('<option value="'+data[i].id+'">'+data[i].name+'</option>')
									}
									huoniao.showTip("success", "修改成功！", "auto");
								}
							}
						});
					},
					cancel: true
				});

				//提示
				parent.$('.menu-itemlist i, .menu-itemlist a').tooltip();
				parent.$('.menu-itemlist i').bind("mousedown", function(){
					parent.$('.menu-itemlist i').tooltip("hide");
				});
				//拖动排序
				parent.$(".menu-itemlist").dragsort({ dragSelector: "li>i", placeHolderTemplate: '<li class="holder"></li>' });

				//删除
				parent.$('.menu-itemlist').delegate("a", "click", function(){
					var parent = $(this).parent(), id = parent.attr("data-id");
					if(id != ""){
						$.dialog.confirm("确定要删除吗？<br />此操作将同时删除分类下的数据，请谨慎操作！", function(){
							parent.remove();
							huoniao.showTip("loading", "正在删除分类数据...");
							$.ajax({
								url: "waimaiStore.php?dopost=delType&action="+type,
								data: "store="+store+"&id="+id,
								type: "POST",
								success: function(){
									huoniao.showTip("success", "删除成功！", "auto");
								}
							});

						})
					}else{
						parent.remove();
					}
				});

				//新增
				parent.$("#addNewManageType").bind("click", function(){
					var html = '<li data-id=""><i data-toggle="tooltip" data-placement="top" data-original-title="拖动以排序" class="icon-move"></i><input type="text" name="name[]" value="" placeholder="请输入分类名" /><a data-toggle="tooltip" data-placement="top" data-original-title="删除" href="javascript:;" class="icon-trash"></a></li>';
					parent.$(".menu-itemlist").append(html);
				});
			}
		});
	});

	//修改
	$("#list").delegate(".modify", "click", function(event){
		var id = $(this).attr("data-id"),
			title = $(this).attr("data-title"),
			href = $(this).attr("href");

		try {
			event.preventDefault();
			parent.addPage("waimaiStoreEdit"+id, "waimai", title, "waimai/"+href);
		} catch(e) {}
	});

	//删除
	$("#delBtn").bind("click", function(){
		$.dialog.confirm('确定后将删除此餐厅的所有信息<br />此操作不可恢复，您确定要删除吗？', function(){
			init.del();
		});
	});

	//单条删除
	$("#list").delegate(".delete", "click", function(){
		$.dialog.confirm('确定后将删除此餐厅的所有信息<br />此操作不可恢复，您确定要删除吗？', function(){
			init.del();
		});
	});

	//批量审核
	$("#batchAudit a").bind("click", function(){
		init.updateState($(this).text());
	});

	//单选
	$("#list tbody").delegate("tr", "click", function(event){
		var isCheck = $(this), checkLength = $("#list tbody tr.selected").length;
		if(event.target.className.indexOf("check") > -1) {
			if(isCheck.hasClass("selected")){
				isCheck.removeClass("selected");
			}else{
				isCheck.addClass("selected");
			}
		}else if(event.target.className.indexOf("edit") > -1 || event.target.className.indexOf("del") > -1) {
			$("#list tr").removeClass("selected");
			isCheck.addClass("selected");
		}else{
			if(checkLength > 1){
				$("#list tr").removeClass("selected");
				isCheck.addClass("selected");
			}else{
				if(isCheck.hasClass("selected")){
					isCheck.removeClass("selected");
				}else{
					$("#list tr").removeClass("selected");
					isCheck.addClass("selected");
				}
			}
		}

		init.funTrStyle();
	});

	//拖选功能
	$("#list tbody").selectable({
		distance: 3,
		cancel: '.check, a',
		start: function(){
			$("#smartMenu_state").remove();
		},
		stop: function() {
			init.funTrStyle();
		}
	});

	//审核状态更新
	$("#list").delegate(".more", "click", function(event){
		event.preventDefault();

		var t = $(this), top = t.offset().top - 5, left = t.offset().left + 15, obj = "smartMenu_state";
		if($("#"+obj).html() != undefined){
			$("#"+obj).remove();
		}

		t.parent().parent().removeClass("selected").addClass("selected");

		var htmlCreateStateMenu = function(){
			var htmlMenu = [];
			htmlMenu.push('<div id="'+obj+'" class="smart_menu_box">');
			htmlMenu.push('  <div class="smart_menu_body">');
			htmlMenu.push('    <ul class="smart_menu_ul">');
			htmlMenu.push('      <li class="smart_menu_li"><a href="javascript:" class="smart_menu_a">待审核</a></li>');
			htmlMenu.push('      <li class="smart_menu_li"><a href="javascript:" class="smart_menu_a">已审核</a></li>');
			htmlMenu.push('      <li class="smart_menu_li"><a href="javascript:" class="smart_menu_a">拒绝审核</a></li>');
			htmlMenu.push('    </ul>');
			htmlMenu.push('  </div>');
			htmlMenu.push('</div>');

			return htmlMenu.join("");
		}

		$("body").append(htmlCreateStateMenu());

		$("#"+obj).find("a").bind("click", function(event){
			event.preventDefault();
			init.updateState($(this).text());
		});

		$("#"+obj).css({
			top: top,
			left: left - $("#"+obj).width()/2
		}).show();

		return false;
	});

	$(document).click(function (e) {
		var s = e.target;
		if ($("#smartMenu_state").html() != undefined) {
			if (!jQuery.contains($("#smartMenu_state").get(0), s)) {
				if (jQuery.inArray(s, $(".smart_menu_body")) < 0) {
					$("#smartMenu_state").remove();
				}
			}
		}
	});

});

//获取列表
function getList(){
	huoniao.showTip("loading", "正在操作，请稍候...");
	$("#list table, #pageInfo").hide();
	$("#selectBtn a:eq(1)").click();
	$("#loading").html("加载中，请稍候...").show();
	var sKeyword = encodeURIComponent($("#sKeyword").html()),
		sAddr    = $("#sAddr").html(),
		sType    = $("#sType").html(),
		state    = $("#stateBtn").attr("data-id") ? $("#stateBtn").attr("data-id") : "",
		pagestep = $("#pageBtn").attr("data-id") ? $("#pageBtn").attr("data-id") : "10",
		page     = $("#list").attr("data-atpage") ? $("#list").attr("data-atpage") : "1";

	var data = [];
		data.push("sKeyword="+sKeyword);
		data.push("sAddr="+sAddr);
		data.push("sType="+sType);
		data.push("state="+state);
		data.push("pagestep="+pagestep);
		data.push("page="+page);

	huoniao.operaJson("waimaiStore.php?dopost=getList", data.join("&"), function(val){
		var obj = $("#list"), list = [], i = 0, waimaiStore = val.waimaiStore;
		obj.attr("data-totalpage", val.pageInfo.totalPage);

		$(".totalCount").html(val.pageInfo.totalCount);
		$(".totalGray").html(val.pageInfo.totalGray);
		$(".totalAudit").html(val.pageInfo.totalAudit);
		$(".totalRefuse").html(val.pageInfo.totalRefuse);

		if(val.state == "100"){
			//huoniao.showTip("success", "获取成功！", "auto");
			huoniao.hideTip();

			for(i; i < waimaiStore.length; i++){
				list.push('<tr data-id="'+waimaiStore[i].id+'">');
				list.push('  <td class="row3"><span class="check"></span></td>');

				var online = "";
				if(waimaiStore[i].online == 1){
					online = '<span class="label label-info" style="margin-right:5px;">在线支付</span>';
				}

				var supfapiao = "";
				if(waimaiStore[i].supfapiao == 1){
					supfapiao = '<span class="label label-info" style="margin-right:5px;">可开发票</span>';
				}

				list.push('  <td class="row20 left"><img src="'+cfg_attachment+waimaiStore[i].logo+'" width="100" class="litpic" /><a href="'+waimaiStore[i].url+'" target="_blank">'+waimaiStore[i].title+'</a><br />'+online+supfapiao+'</td>');
				list.push('  <td class="row10 left"><a href="javascript:;" data-id="'+waimaiStore[i].userid+'" class="userinfo">'+waimaiStore[i].username+'</a></td>');
				list.push('  <td class="row10 left">'+waimaiStore[i].yingyeshijian+'</td>');
				list.push('  <td class="row10 left">'+waimaiStore[i].addrName+'</td>');

				var renzheng = [];
				if(waimaiStore[i].yingye == 0){
					renzheng.push('<span class="cert_icon yingyezhizhao0" title="等待[营业执照]认证">营业执照</span>');
				}else if(waimaiStore[i].yingye == 1){
					renzheng.push('<span class="cert_icon yingyezhizhao1" title="已通过[营业执照]认证">营业执照</span>');
				}else if(waimaiStore[i].yingye == 2){
					renzheng.push('<span class="cert_icon yingyezhizhao2" title="未通过[营业执照]认证">营业执照</span>');
				}
				if(waimaiStore[i].weisheng == 0){
					renzheng.push('<span class="cert_icon weishengxuke0" title="等待[卫生许可证]认证">卫生许可证</span>');
				}else if(waimaiStore[i].weisheng == 1){
					renzheng.push('<span class="cert_icon weishengxuke1" title="已通过[卫生许可证]认证">卫生许可证</span>');
				}else if(waimaiStore[i].weisheng == 2){
					renzheng.push('<span class="cert_icon weishengxuke2" title="未通过[卫生许可证]认证">卫生许可证</span>');
				}

				list.push('  <td class="row7 left">'+renzheng.join("")+'</td>');
				list.push('  <td class="row13 left">'+waimaiStore[i].pubdate+'</td>');
				var state = "";
				switch (waimaiStore[i].state) {
					case "0":
						state = '<span class="gray">待审核</span>';
						break;
					case "1":
						state = '<span class="audit">已审核</span>';
						break;
					case "2":
						state = '<span class="refuse">审核拒绝</span>';
						break;
				}
				list.push('  <td class="row10 state">'+state+'<span class="more"><s></s></span></td>');
				list.push('  <td class="row17">');
				list.push('<a href="javascript:;" title="管理菜单分类" class="link type" data-type="menu">菜单分类</a>&nbsp;|&nbsp;');
				list.push('<a href="javascript:;" title="管理相册分类" class="link type" data-type="album">相册分类</a>&nbsp;|&nbsp;');
				list.push('<a data-id="'+waimaiStore[i].id+'" data-title="'+waimaiStore[i].title+'" href="waimaiStore.php?dopost=edit&id='+waimaiStore[i].id+'" title="修改" class="link modify">修改</a>&nbsp;|&nbsp;');
				list.push('<a href="javascript:;" title="删除" class="link delete">删除</a>');
				list.push('</td>');
				list.push('</tr>');
			}

			obj.find("tbody").html(list.join(""));
			$("#loading").hide();
			$("#list table").show();
			huoniao.showPageInfo();
		}else{

			obj.find("tbody").html("");
			huoniao.showTip("warning", val.info, "auto");
			$("#loading").html(val.info).show();
		}
	});

};

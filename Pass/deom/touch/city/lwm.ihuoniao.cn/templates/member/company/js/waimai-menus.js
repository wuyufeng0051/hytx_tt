/**
 * 会员中心外卖菜单列表
 * by guozi at: 20160419
 */

var objId = $("#list");
$(function(){

	getList();

	//删除
	objId.delegate(".del", "click", function(){
		var t = $(this), par = t.closest(".item"), id = par.attr("data-id");
		if(id){
			$.dialog.confirm("确认要删除吗？", function(){
				t.siblings("a").hide();
				t.addClass("load");

				$.ajax({
					url: masterDomain+"/include/ajax.php?service=waimai&action=delMenu&id="+id,
					type: "GET",
					dataType: "jsonp",
					success: function (data) {
						if(data && data.state == 100){
							setTimeout(function(){getList();}, 500);
						}else{
							$.dialog.alert(data.info);
							t.siblings("a").show();
							t.removeClass("load");
						}
					},
					error: function(){
						$.dialog.alert("网络错误，请稍候重试！");
						t.siblings("a").show();
						t.removeClass("load");
					}
				});
			});

		}
	});


	//菜单分类
	$(".menuType").bind("click", function(){
		$.ajax({
			url: "/include/ajax.php?service=waimai&action=menuType",
			data: "store="+storeid,
			type: "POST",
			dataType: "json",
			success: function(data){
				var content = [];
				if(data.state == 100){
					var info = data.info;
					for(var i = 0; i < info.length; i++){
						content.push('<li data-id="'+info[i].id+'"><i class="icon-move" title="拖拽排序"></i><input type="text" name="name[]" value="'+info[i].typename+'" /><a href="javascript:;" class="icon-trash" title="删除"></a></li>');
					}
				}
				content = '<ul class="menu-itemlist">'+content.join("")+'</ul>';
				content += '<a href="javascript:;" id="addNewManageType"><i class="icon-plus"></i>新增分类</a>';

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
							url: "/include/ajax.php?service=waimai&action=updateMenuType",
							data: "store="+storeid+"&data=["+data.join(",")+"]",
							type: "POST",
							dataType: "json",
							success: function(data){
								if(data && data.state == 100){
									location.reload();
								}else{
									alert(data.info);
								}
							}
						});
						return false;
					},
					cancel: true
				});


				//拖动排序
				$(".menu-itemlist").dragsort({ dragSelector: "li>i", placeHolderTemplate: '<li class="holder"></li>' });

				//删除
				$('.menu-itemlist').delegate("a", "click", function(){
					var parent = $(this).parent(), id = parent.attr("data-id");
					if(id != ""){
						$.dialog.confirm("确定要删除吗？<br />此操作将同时删除分类下的数据，请谨慎操作！", function(){
							parent.remove();
							$.ajax({
								url: masterDomain+"/include/ajax.php?service=waimai&action=delMenuType&id="+id,
								dataType: "jsonp",
								success: function(data){
									if(data && data.state == 100){
										alert("删除成功！");
									}else{
										alert(data.info);
									}
								}
							});
						});
					}else{
						parent.remove();
					}
				});

				//新增
				$("#addNewManageType").bind("click", function(){
					var html = '<li data-id=""><i class="icon-move" title="拖拽排序"></i><input type="text" name="name[]" value="" placeholder="请输入分类名" /><a title="删除" href="javascript:;" class="icon-trash"></a></li>';
					$(".menu-itemlist").append(html);
				});
			}
		});
	});

});

function getList(is){

	$('.main').animate({scrollTop: 0}, 300);

	objId.html('<p class="loading"><img src="'+staticPath+'images/ajax-loader.gif" />加载中，请稍候...</p>');
	$(".pagination").hide();

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=waimai&action=menu&store="+storeid+"&u=1&page="+atpage+"&pageSize="+pageSize,
		type: "GET",
		dataType: "jsonp",
		success: function (data) {
			if(data && data.state != 200){
				if(data.state == 101){
					objId.html("<p class='loading'>暂无相关信息！</p>");
				}else{
					var list = data.info, html = [];

					//拼接列表
					if(list.length > 0){

						var t = window.location.href.indexOf(".html") > -1 ? "?" : "&";
						var param = t + "id=";
						var urlString = editUrl + param;

						for(var i = 0; i < list.length; i++){
							var item   = [],
								id     = list[i].id,
								title  = list[i].title,
								price  = list[i].price,
								typeid = list[i].typeid,
								typeName = list[i].typeName,
								price  = list[i].price,
								note   = list[i].note,
								sale   = list[i].sale,
								pics   = list[i].pics[0];
								pubdate = huoniao.transTimes(list[i].pubdate, 1),

							html.push('<div class="item fn-clear" data-id="'+id+'">');
							if(pics != ""){
								html.push('<div class="p"><a href="javascript:;" style="cursor:default;"><i></i><img src="'+huoniao.changeFileSize(pics, "small")+'" /></a></div>');
							}
							html.push('<div class="o"><a href="'+urlString+id+'" class="edit"><s></s>编辑</a>');
							html.push('<a href="javascript:;" class="del"><s></s>删除</a>');
							html.push('</div>');
							html.push('<div class="i">');

							html.push('<h5>'+title+'</h5>');

							html.push('<p>分类：'+typeName+'&nbsp;&nbsp;·&nbsp;&nbsp;价格：'+price+'&nbsp;&nbsp;·&nbsp;&nbsp;销量：'+sale+'&nbsp;&nbsp;·&nbsp;&nbsp;添加时间：'+pubdate+'</p>');
							html.push('</div>');
							html.push('</div>');

						}

						objId.html(html.join(""));

					}else{
						objId.html("<p class='loading'>暂无相关信息！</p>");
					}

				}
			}else{
				objId.html("<p class='loading'>暂无相关信息！</p>");
			}
		}
	});
}

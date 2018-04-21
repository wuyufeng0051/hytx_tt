/**
 * 会员中心招聘收藏职位列表
 * by guozi at: 20160526
 */

var objId = $("#list");
$(function(){

	getList(1);

	//全选
	$("#selectAll").bind("click", function(){
		$(this).is(":checked") ? $("#list input").attr("checked", true) : $("#list input").attr("checked", false);
	});


	//删除
	objId.delegate(".del", "click", function(){
		var t = $(this), par = t.closest("tr"), id = par.attr("data-id");
		if(id){
			$.dialog.confirm('您确定要删除选中的信息吗？', function(){
				t.siblings("a").hide();
				t.addClass("load");

				$.ajax({
					url: masterDomain+"/include/ajax.php?service=member&action=collect&module=job&temp=job&type=del&id="+id,
					type: "GET",
					dataType: "jsonp",
					success: function (data) {
						if(data && data.state == 100){

							//删除成功后移除信息层并异步获取最新列表
							par.slideUp(300, function(){
								par.remove();
								setTimeout(function(){getList(1);}, 200);
							});

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


	//删除
	$(".delSelect").bind("click", function(){
		var id = [];
		$("#list input").each(function(){
			$(this).is(":checked") ? id.push($(this).val()) : "";
		});

		if(id){
			$.dialog.confirm('您确定要删除选中的信息吗？', function(){

				$.ajax({
					url: masterDomain+"/include/ajax.php?service=member&action=collect&module=job&temp=job&type=del&id="+id.join(","),
					type: "GET",
					dataType: "jsonp",
					success: function (data) {
						if(data && data.state == 100){
							getList(1);
						}else{
							$.dialog.alert(data.info);
						}
					},
					error: function(){
						$.dialog.alert("网络错误，请稍候重试！");
					}
				});
			});
		}
	});

});

function getList(is){

	if(is != 1){
		$('html, body').animate({scrollTop: $(".main-tab").offset().top}, 300);
	}

	objId.html('<p class="loading"><img src="'+staticPath+'images/ajax-loader.gif" />加载中，请稍候...</p>');
	$(".pagination").hide();
	$(".opera").hide();

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=member&action=collectList&module=job&temp=job&page="+atpage+"&pageSize="+pageSize,
		type: "GET",
		dataType: "jsonp",
		success: function (data) {
			if(data && data.state != 200){
				if(data.state == 101){
					objId.html("<p class='loading'>暂无相关信息！</p>");
				}else{
					var list = data.info.list, pageInfo = data.info.pageInfo, html = [];

					//拼接列表
					if(list.length > 0){
						for(var i = 0; i < list.length; i++){
							var item    = [],
									id      = list[i].aid,
									detail  = list[i].detail,
									pubdate = list[i].pubdate;


							html.push('<tr data-id="'+id+'"><td class="fir"></td>');
							html.push('<td><input class="checkbox" type="checkbox" value="'+id+'" />&nbsp;<a href="'+detail['url']+'" target="_blank" title="'+detail['title']+'">'+detail['title']+'</a></td>');
							html.push('<td><a href="'+detail['company']['domain']+'" target="_blank">'+detail['company']['title']+'</a></td>');
							html.push('<td>'+pubdate+'</td>');
							html.push('<td><a href="javascript:;" class="link del" target="_blank">删除</a></td>');
							html.push('</tr>');

						}

						objId.html('<table><thead class="thead"><tr><th class="fir"></th><th>职位名称</th><th>公司名称</th><th>收藏时间</th><th>操作</th></tr></thead><tbody>'+html.join("")+'</tbody></table>');
						$(".opera").show();

					}else{
						objId.html("<p class='loading'>暂无相关信息！</p>");
					}

					totalCount = pageInfo.totalCount;
					$("#total").html(pageInfo.totalCount);
					showPageInfo();
				}
			}else{
				objId.html("<p class='loading'>暂无相关信息！</p>");
			}
		}
	});
}

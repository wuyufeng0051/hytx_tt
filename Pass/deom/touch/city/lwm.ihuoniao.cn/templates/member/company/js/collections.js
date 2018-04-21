/**
 * 会员中心收藏管理
 * by guozi at: 20160530
 */

var objId = $("#list");
$(function(){

	getList(1);

	//全选
	$("#selectAll").bind("click", function(){
		$(this).is(":checked") ? $("#list input").attr("checked", true) : $("#list input").attr("checked", false);
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
					url: masterDomain+"/include/ajax.php?service=member&action=collect&module=job&temp=resume&type=del&id="+id.join(","),
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

	$('.main').animate({scrollTop: 0}, 300);

	objId.html('<p class="loading"><img src="'+staticPath+'images/ajax-loader.gif" />加载中，请稍候...</p>');
	$(".pagination").hide();
	$(".opera").hide();

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=member&action=collectList&module=job&temp=resume&page="+atpage+"&pageSize="+pageSize,
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
							var item  = [],
									id    = list[i].aid,
									detail = list[i].detail,
									date  = list[i].date;

							html.push('<tr><td class="fir"><input type="checkbox" value="'+id+'" /></td>');
							html.push('<td><a href="'+detail['url']+'" target="_blank"><img src="'+detail['photo']+'" width="50" />'+detail['name']+'</a></td>');
							html.push('<td>'+(detail['sex'] == 0 ? "男" : "女")+'</td>');
							html.push('<td>'+detail['age']+'</td>');
							html.push('<td>'+detail['home']+'</td>');
							html.push('<td>'+detail['workyear']+'年</td>');
							html.push('<td>'+detail['educationalname']+'</td>');
							html.push('<td>'+detail['college']+'</td>');
							html.push('<td>'+list[i].pubdate+'</td>');
							html.push('</tr>');

						}

						objId.html('<table><thead class="thead"><tr><th class="fir">&nbsp;</th><th>姓名</th><th>性别</th><th>年龄</th><th>籍贯</th><th>工作</th><th>学历</th><th>毕业学院</th><th>收藏时间</th></tr></thead><tbody>'+html.join("")+'</tbody></table>');
						$(".opera").show();

					}else{
						objId.html("<p class='loading'>暂无相关信息！</p>");
					}

					totalCount = pageInfo.totalCount;
					$("#totalCount").html(totalCount);
					showPageInfo();
				}
			}else{
				objId.html("<p class='loading'>暂无相关信息！</p>");
			}
		}
	});
}

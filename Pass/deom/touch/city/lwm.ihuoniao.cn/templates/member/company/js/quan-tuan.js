/**
 * 已消费团购券列表
 * by guozi at: 20151008
 */

var objId = $("#list");
$(function(){

	getList(1);

	//撤消
	objId.delegate(".cancel", "click", function(){
		var t = $(this), par = t.closest("tr"), id = par.attr("data-id");
		if(id && t.attr("disabled") != "disabled"){
			$.dialog.confirm('确定要撤消该券的验证吗？', function(){
				t.addClass("load").html("操作中...").attr("disabled", true);

				$.ajax({
					url: masterDomain+"/include/ajax.php?service=tuan&action=cancelQuan&ids="+id,
					type: "GET",
					dataType: "jsonp",
					success: function (data) {
						if(data && data.state != 200){

							//删除成功后移除信息层并异步获取最新列表
							par.slideUp(300, function(){
								par.remove();

								setTimeout(function(){getList(1);}, 200);
							});

						}else{
							$.dialog.alert("操作失败，请稍候重试！");
							t.removeClass("load").html("撤消验证").attr("disabled", false);
						}
					},
					error: function(){
						$.dialog.alert("网络错误，请稍候重试！");
						t.removeClass("load").html("撤消验证").attr("disabled", false);
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

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=tuan&action=quanList&page="+atpage+"&pageSize="+pageSize,
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
							var item     = [],
									id       = list[i].id,
									cardnum  = list[i].cardnum,
									usedate  = huoniao.transTimes(list[i].usedate, 1),
									pro      = list[i].pro,
									title    = pro.title,
									url      = pro.url,
									price    = list[i].price,
									product  = title != "" ? '<a href="'+url+'" target="_blank">'+title+'</a>' : "";

							html.push('<tr data-id="'+id+'"><td class="fir"></td>');
							html.push('<td>'+cardnum+'</td>');
							html.push('<td>'+usedate+'</td>');
							html.push('<td>'+product+'</td>');
							html.push('<td>'+price+'</td>');
							html.push('<td><a href="javascript:;" class="cancel">撤消验证</a></td>');
							html.push('</tr>');

						}

						objId.html('<table><thead class="thead"><tr><th class="fir"></th><th width="180">团购券密码</th><th width="200">消费时间</th><th>消费项目</th><th width="150">价格</th><th width="150">操作</th></tr></thead><tbody>'+html.join("")+'</tbody></table>');

					}else{
						objId.html("<p class='loading'>暂无相关信息！</p>");
					}

					totalCount = pageInfo.totalCount;
					$("#total").html(totalCount);
					showPageInfo();
				}
			}else{
				$("#total").html(0);
				objId.html("<p class='loading'>暂无相关信息！</p>");
			}
		}
	});
}
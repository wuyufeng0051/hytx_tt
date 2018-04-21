/**
 * 会员中心装修案例
 * by guozi at: 20160516
 */

var objId = $("#list");
$(function(){

	getList(1);

	//操作
	objId.delegate(".lx", "click", function(){
		var t = $(this), par = t.closest("tr"), id = par.attr("data-id");
		if(id){
			$.dialog.confirm('确定已经联系了吗？', function(){
				t.addClass("load");

				$.ajax({
					url: masterDomain+"/include/ajax.php?service=renovation&action=updateRese&id="+id,
					type: "GET",
					dataType: "jsonp",
					success: function (data) {
						if(data && data.state != 200){

							t.parent().html("已联系");

						}else{
							$.dialog.alert("删除失败，请稍候重试！");
							t.removeClass("load");
						}
					},
					error: function(){
						$.dialog.alert("网络错误，请稍候重试！");
						t.removeClass("load");
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
		url: masterDomain+"/include/ajax.php?service=renovation&action=rese&u=1&orderby=1&state="+state+"&page="+atpage+"&pageSize="+pageSize,
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

						html.push('<table><thead><tr><td class="fir"></td>');
						html.push('<td>联系人</td>');
						html.push('<td>联系电话</td>');
						html.push('<td>所在小区</td>');
						html.push('<td>预约设计师</td>');
						html.push('<td>状态</td>');
						html.push('</tr></thead>');

						for(var i = 0; i < list.length; i++){
							var item      = [],
									id        = list[i].id,
									people    = list[i].people,
									contact   = list[i].contact,
									community = list[i].community,
									designer  = list[i].designer,
									state     = list[i].state;

							html.push('<tr data-id="'+id+'"><td class="fir"></td>');
							html.push('<td>'+people+'</td>');
							html.push('<td>'+contact+'</td>');
							html.push('<td>'+community+'</td>');
							html.push('<td>'+designer+'</td>');
							if(state == 0){
								html.push('<td><button class="lx" type="button">&nbsp;&nbsp;确认&nbsp;&nbsp;</button></td>');
							}else{
								html.push('<td>已联系</td>');
							}
							html.push('</tr>');


						}

						objId.html(html.join("")+"</table>");

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

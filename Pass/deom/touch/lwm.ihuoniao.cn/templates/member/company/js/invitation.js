/**
 * 会员中心邀请记录管理
 * by guozi at: 20160530
 */

var objId = $("#list");
$(function(){

	getList(1);

});

function getList(is){

	$('.main').animate({scrollTop: 0}, 300);

	objId.html('<p class="loading"><img src="'+staticPath+'images/ajax-loader.gif" />加载中，请稍候...</p>');
	$(".pagination").hide();

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=job&action=invitationList&type=company&page="+atpage+"&pageSize="+pageSize,
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
									detail = list[i].resume,
									date  = list[i].date;

							html.push('<tr><td class="fir">&nbsp;</td>');
							html.push('<td><a href="'+detail['url']+'" target="_blank"><img src="'+detail['photo']+'" width="50" />'+detail['name']+'</a></td>');
							html.push('<td><a href="'+list[i]['post'].url+'" target="_blank">'+list[i]['post'].title+'</a></td>');
							html.push('<td>'+(detail['sex'] == 0 ? "男" : "女")+'</td>');
							html.push('<td>'+detail['age']+'</td>');
							html.push('<td>'+detail['home']+'</td>');
							html.push('<td>'+detail['workyear']+'年</td>');
							html.push('<td>'+detail['educationalname']+'</td>');
							html.push('<td>'+detail['college']+'</td>');
							html.push('<td>'+list[i].date+'</td>');
							html.push('</tr>');

						}

						objId.html('<table><thead class="thead"><tr><th class="fir">&nbsp;</th><th>姓名</th><th>邀请职位</th><th>性别</th><th>年龄</th><th>籍贯</th><th>工作</th><th>学历</th><th>毕业学院</th><th>邀请时间</th></tr></thead><tbody>'+html.join("")+'</tbody></table>');

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

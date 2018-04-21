/**
 * 会员中心登录记录
 * by guozi at: 20150627
 */

var objId = $("#list");
$(function(){

	getList(1);

});

function getList(is){

	if(is != 1){
		$('html, body').animate({scrollTop: $(".main-tab").offset().top}, 300);
	}

	objId.html('<p class="loading"><img src="'+staticPath+'images/ajax-loader.gif" />加载中，请稍候...</p>');
	$(".pagination").hide();

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=member&action=loginrecord&page="+atpage+"&pageSize="+pageSize,
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
							var item = [],
									time = list[i].time,
									ip   = list[i].ip,
									addr = list[i].addr;

							if(i == 0){
								html.push('<thead><tr><td class="fir"></td>');
								html.push('<td colspan="3"><strong>'+addDateInV1_2(time.split(' ')[0])+'</strong></td>');
								html.push('</tr></thead>');
							}else{
								if(time.split(' ')[0]  != list[i-1].time.split(' ')[0]){
									html.push('<thead><tr><td class="fir"></td>');
									html.push('<td colspan="3"><strong>'+addDateInV1_2(time.split(' ')[0])+'</strong></td>');
									html.push('</tr></thead>');
								}
							}

							html.push('<tbody><tr><td class="fir"></td>');
							html.push('<td>'+time.split(' ')[1]+'</td>');
							html.push('<td>'+ip+'</td>');
							html.push('<td>'+addr+'</td>');
							html.push('</tr></tbody>');

						}

						objId.html('<table><thead class="thead"><tr><th class="fir"></th><th>登录时间</th><th>IP地址</th><th>参考地点</th></tr></thead>'+html.join("")+'</table>');

					}else{
						objId.html("<p class='loading'>暂无相关信息！</p>");
					}

					totalCount = pageInfo.totalCount;
					$("#totalTip").html("&nbsp;&nbsp;(共"+pageInfo.totalCount+"条记录)");
					showPageInfo();
				}
			}else{
				objId.html("<p class='loading'>暂无相关信息！</p>");
			}
		}
	});
}

function addDateInV1_2(strDate){
	var d = new Date();
	var day = d.getDate();
	var month = d.getMonth() + 1;
	var year = d.getFullYear();
	var dateArr = strDate.split('-');
	var tmp;
	var monthTmp;
	if(dateArr[2].charAt(0) == '0'){
		tmp = dateArr[2].substr(1);
	}else{
		tmp = dateArr[2];
	}
	if(dateArr[1].charAt(0) == '0'){
		monthTmp = dateArr[1].substr(1);
	}else{
		monthTmp = dateArr[1];
	}
	if(day == tmp && month == monthTmp && year == dateArr[0]){
		return "今天";
	}else{
		return dateArr[0] + "年" + monthTmp + "月" + tmp + "日";
	}
}
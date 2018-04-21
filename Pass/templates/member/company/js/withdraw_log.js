/**
 * 提现记录
 * by guozi at: 20151110
 */

var objId = $("#list");
$(function(){

	//类型切换
	$(".sel label").bind("click", function(){
		var t = $(this), id = t.attr("data-id");
		if(!t.hasClass("curr")){
			lei = id;
			state = "";
			atpage = 1;

			$(".main-sub-tab li:eq(1)").addClass("curr").siblings("li").removeClass("curr");
			t.addClass("curr").siblings("label").removeClass("curr");

			getList();
		}
	});

	getList(1);

});

function getList(is){

	if(is != 1){
		$('html, body').animate({scrollTop: $(".nav-tabs").offset().top}, 300);
	}

	objId.html('<p class="loading"><img src="'+staticPath+'images/ajax-loader.gif" />'+langData['siteConfig'][20][184]+'...</p>');

	var type = $(".main-sub-tab .curr").attr("data-id");

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=member&action=withdraw_log&state="+type+"&page="+atpage+"&pageSize="+pageSize,
		type: "GET",
		dataType: "jsonp",
		success: function (data) {
			if(data && data.state != 200){
				if(data.state == 101){
					objId.html("<p class='loading'>"+langData['siteConfig'][20][126]+"</p>");
				}else{
					var list = data.info.list, pageInfo = data.info.pageInfo, html = [];

					//拼接列表
					if(list.length > 0){
						for(var i = 0; i < list.length; i++){
							var item     = [],
									bank     = list[i].bank,
									cardnum  = list[i].cardnum,
									cardnum  = bank == "alipay" ? cardnum.substr(0, 4) + "..." : "..."+cardnum.substr(cardnum.length-4),
									cardname = list[i].cardname,
									cardname = "*"+cardname.substr(1),
									amount   = list[i].amount,
									tdate    = huoniao.transTimes(list[i].tdate, 1),
									state    = list[i].state,
									url      = list[i].url.replace(udomain, bdomain);

							var stateTxt = "";
							switch(state){
								case "0":
									stateTxt = "<font color='#999999'>"+langData['siteConfig'][9][14]+"</font>";
									break;
								case "1":
									stateTxt = "<font color='#53a000'>"+langData['siteConfig'][9][5]+"</font>";
									break;
								case "2":
									stateTxt = "<font color='#f37800'>"+langData['siteConfig'][9][6]+"</font>";
									break;
							}

							html.push('<tr><td class="fir"></td>');
							html.push('<td>'+tdate+'</td>');
							html.push('<td>'+cardnum+" | "+cardname+'</td>');
							html.push('<td>'+amount+'</td>');
							html.push('<td>'+stateTxt+'</td>');
							html.push('<td><a href="'+url+'" class="link" target="_blank">'+langData['siteConfig'][2][210]+'</a></td>');
							html.push('</tr>');

						}

						objId.html('<table><thead class="thead"><tr><th class="fir"></th><th>'+langData['siteConfig'][19][46]+'</th><th>'+langData['siteConfig'][19][305]+'</th><th>'+langData['siteConfig'][19][306]+'</th><th>'+langData['siteConfig'][19][307]+'</th><th>'+langData['siteConfig'][6][11]+'</th></tr></thead><tbody>'+html.join("")+'</tbody></table>');

					}else{
						objId.html("<p class='loading'>"+langData['siteConfig'][20][126]+"</p>");
					}

					totalCount = pageInfo.totalCount;
					showPageInfo();
				}
			}else{
				objId.html("<p class='loading'>"+langData['siteConfig'][20][126]+"</p>");
			}
		}
	});
}

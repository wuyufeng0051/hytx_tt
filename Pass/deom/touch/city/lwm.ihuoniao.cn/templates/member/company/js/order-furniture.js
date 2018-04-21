/**
 * 会员中心家具订单
 * by guozi at: 20150928
 */

var objId = $("#list");
$(function(){

	state = state == "" ? 1 : state;
	$(".nav-tabs li[data-id='"+state+"']").addClass("active");

	$(".nav-tabs li").bind("click", function(){
		var t = $(this), id = t.attr("data-id");
		if(!t.hasClass("active") && !t.hasClass("add")){
			state = id;
			atpage = 1;
			t.addClass("active").siblings("li").removeClass("active");
			getList();
		}
	});

	getList(1);

});


function getList(is){

	$('.main').animate({scrollTop: 0}, 300);

	objId.html('<p class="loading"><img src="'+staticPath+'images/ajax-loader.gif" />加载中，请稍候...</p>');
	$(".pagination").hide();

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=furniture&action=orderList&store=1&state="+state+"&page="+atpage+"&pageSize="+pageSize,
		type: "GET",
		dataType: "jsonp",
		success: function (data) {
			if(data && data.state != 200){
				if(data.state == 101){
					objId.html("<p class='loading'>暂无相关信息！</p>");
				}else{
					var list = data.info.list, pageInfo = data.info.pageInfo, html = [];

					var t = window.location.href.indexOf(".html") > -1 ? "?" : "&";

					//拼接列表
					if(list.length > 0){
						for(var i = 0; i < list.length; i++){
							var item       = [],
									id         = list[i].id,
									ordernum   = list[i].ordernum,
									orderstate = list[i].orderstate,
									retState   = list[i].retState,
									orderdate  = huoniao.transTimes(list[i].orderdate, 1),
									expDate    = list[i].expDate,
									payurl     = list[i].payurl,
									common     = list[i].common,
									commonUrl  = list[i].commonUrl,
									paytype    = list[i].paytype,
									totalPayPrice  = list[i].totalPayPrice,
									member     = list[i].member,
									product    = list[i].product;

							var detailUrl = editUrl.replace("%id%", id);
							var fhUrl = detailUrl.indexOf("?") > -1 ? detailUrl + "&rates=1" : detailUrl + "?rates=1";
							var stateInfo = btn = "";

							switch(orderstate){
								case "1":
									stateInfo = "<span class='state1'>待发货</span>";
									btn = '<div><a href="'+fhUrl+'">发货</a></div>';
									break;
								case "3":
									stateInfo = "<span class='state3'>交易成功</span>";
									break;
								case "4":
									stateInfo = "<span class='state4'>退款中</span>";
									break;
								case "6":

									//申请退款
									if(retState == 1){

										//还未发货
										if(expDate == 0){
											stateInfo = "<span class='state61'>未发货，申请退款中</span>";

										//已经发货
										}else{
											stateInfo = "<span class='state61'>已发货，申请退款中</span>";
										}
										btn = '<a href="'+detailUrl+'" class="tk">确认退款</a>';

									//未申请退款
									}else{
										stateInfo = "<span class='state6'>待收货</span>";
										//btn = '<a href="javascript:;" class="sh">确认收货</a>';
									}
									break;
								case "7":
									stateInfo = "<span class='state7'>退款成功</span>";
									// btn = '<a href="javascript:;" class="edit">退款去向</a>';
									break;
							}

							html.push('<table data-id="'+id+'"><colgroup><col style="width:38%;"><col style="width:10%;"><col style="width:7%;"><col style="width:17%;"><col style="width:16%;"><col style="width:12%;"></colgroup>');
							html.push('<thead><tr class="placeh"><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr><td colspan="5">');
							html.push('<span class="dealtime" title="'+orderdate+'">'+orderdate+'</span>');
							html.push('<span class="number">订单号：<a href="'+detailUrl+'">'+ordernum+'</a></span>');
							var memberHtml = member.nickname + (member.qq != "" ? ' <a href="http://wpa.qq.com/msgrd?v=3&uin='+member.qq+'&Menu=yes" title="QQ在线交谈" target="_blank"><img src="http://wpa.qq.com/pa?p=2:'+member.qq+':4" /></a>' : '');
							html.push('<span class="store">'+memberHtml+'</span>');
							html.push('</td>');
							html.push('<td colspan="1"></td></tr></thead>');
							html.push('<tbody>');

							for(var p = 0; p < product.length; p++){
								cla = p == product.length - 1 ? ' class="lt"' : "";
								html.push('<tr'+cla+'>');
								html.push('<td class="nb"><div class="info"><a href="'+product[p].url+'" title="'+product[p].title+'" target="_blank" class="pic"><img src="'+huoniao.changeFileSize(product[p].litpic, "small")+'" /></a><div class="txt"><a href="'+product[p].url+'" title="'+product[p].title+'" target="_blank">'+product[p].title+'</a></div></div></td>');
								html.push('<td class="nb">'+product[p].price+'</td>');
								html.push('<td>'+product[p].count+'</td>');

								if(p == 0){
									html.push('<td class="bf" rowspan="'+product.length+'"><strong>'+totalPayPrice+'</strong>'+(paytype ? '<div class="paytype">'+paytype+'</div>' : '')+'</td>');
									html.push('<td class="bf" rowspan="'+product.length+'"><div><a href="'+detailUrl+'">'+stateInfo+'</a></div><a href="'+detailUrl+'">订单详情</a></td>');
									html.push('<td class="bf nb" rowspan="'+product.length+'">'+btn+'</td>');
								}
								html.push('</tr>');
							}

							html.push('</tbody>');

						}

						objId.html(html.join(""));

					}else{
						objId.html("<p class='loading'>暂无相关信息！</p>");
					}

					switch(state){
						case "":
							totalCount = pageInfo.totalCount;
							break;
						case "0":
							totalCount = pageInfo.unpaid;
							break;
						case "1":
							totalCount = pageInfo.ongoing;
							break;
						case "2":
							totalCount = pageInfo.expired;
							break;
						case "3":
							totalCount = pageInfo.success;
							break;
						case "4":
							totalCount = pageInfo.refunded;
							break;
						case "5":
							totalCount = pageInfo.rates;
							break;
						case "6":
							totalCount = pageInfo.recei;
							break;
						case "7":
							totalCount = pageInfo.closed;
							break;
					}


					$("#unused").html(pageInfo.ongoing);
					$("#used").html(pageInfo.success);
					$("#refund").html(pageInfo.refunded);
					$("#recei").html(pageInfo.recei);
					$("#closed").html(pageInfo.closed);
					showPageInfo();
				}
			}else{
				objId.html("<p class='loading'>暂无相关信息！</p>");
			}
		}
	});
}

/**
 * 会员中心团购订单
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
		url: masterDomain+"/include/ajax.php?service=tuan&action=orderList&store=1&state="+state+"&page="+atpage+"&pageSize="+pageSize,
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
									proid      = list[i].proid,
									procount   = list[i].procount,
									orderprice = list[i].orderprice,
									orderstate = list[i].orderstate,
									retState   = list[i].retState,
									expDate    = list[i].expDate,
									orderdate  = huoniao.transTimes(list[i].orderdate, 1),
									title      = list[i].product.title,
									enddate    = huoniao.transTimes(list[i].product.enddate, 2),
									litpic     = list[i].product.litpic,
									url        = list[i].product.url;

							var stateInfo = btn = "";
							var urlString = editUrl.replace("%id%", id);

							switch(orderstate){
								case "0":
									stateInfo = "未付款";
									break;
								case "1":
									stateInfo = "待发货";
									btn = '<a href="'+urlString+t+"rates=1"+'">发货</a>';
									break;
								case "2":
									stateInfo = "已过期";
									break;
								case "3":
									stateInfo = "交易成功";
									break;
								case "6":
									//申请退款
									if(retState == 1){

										//还未发货
										if(expDate == 0){
											stateInfo = "未发货，买家申请退款";

										//已经发货
										}else{
											stateInfo = "已发货，买家申请退款";
										}

									//未申请退款
									}else{
										stateInfo = "已发货";
									}
									break;
								case "7":
									stateInfo = "退款成功";
									break;
							}

							html.push('<div class="item fn-clear" data-id="'+id+'">');
							html.push('<div class="p"><a href="'+url+'" target="_blank"><i></i><img src="'+litpic+'"></a></div>');
							html.push('<div class="o">'+btn+'</div>');
							html.push('<div class="i">');
							html.push('<p>订单号：'+ordernum+'&nbsp;&nbsp;·&nbsp;&nbsp;下单时间：'+orderdate+'</p>');
							html.push('<h5><a href="'+url+'" target="_blank" title="'+title+'">'+title+'</a></h5>');
							html.push('<p>结束时间：'+enddate+'&nbsp;&nbsp;·&nbsp;&nbsp;数量：'+procount+'份&nbsp;&nbsp;·&nbsp;&nbsp;总价：'+orderprice+'元&nbsp;&nbsp;·&nbsp;&nbsp;状态：'+stateInfo+'&nbsp;&nbsp;·&nbsp;&nbsp;<a href="'+urlString+'">订单详情</a></p>');
							html.push('</div></div>');

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

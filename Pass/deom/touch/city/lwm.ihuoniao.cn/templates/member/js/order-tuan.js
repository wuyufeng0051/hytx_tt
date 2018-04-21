/**
 * 会员中心团购订单列表
 * by guozi at: 20150903
 */

var objId = $("#list");
$(function(){

	$(".main-sub-tab li[data-id='"+state+"']").addClass("curr");

	//状态切换
	$(".main-sub-tab li").bind("click", function(){
		var t = $(this), id = t.attr("data-id");
		if(!t.hasClass("curr") && !t.hasClass("sel")){
			state = id;
			atpage = 1;
			t.addClass("curr").siblings("li").removeClass("curr");
			getList();
		}
	});

	//发布房源子级菜单
	$(".main-tab .add").hover(function(){
		var t = $(this), dl = t.find("dl");
		if(dl.size() > 0){
			dl.show();
		};
	}, function(){
		var t = $(this), dl = t.find("dl");
		if(dl.size() > 0){
			dl.hide();
		};
	});

	getList(1);

	objId.delegate(".del", "click", function(){
		var t = $(this), par = t.closest(".item"), id = par.attr("data-id");
		if(id){
			$.dialog.confirm('确定删除订单？<br />删除后本订单将从订单列表消失，且不能恢复。', function(){
				t.siblings("a").hide();
				t.addClass("load");

				$.ajax({
					url: masterDomain+"/include/ajax.php?service=tuan&action=delOrder&id="+id,
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

});

function getList(is){

	if(is != 1){
		$('html, body').animate({scrollTop: $(".main-tab").offset().top}, 300);
	}

	objId.html('<p class="loading"><img src="'+staticPath+'images/ajax-loader.gif" />加载中，请稍候...</p>');
	$(".pagination").hide();

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=tuan&action=orderList&state="+state+"&page="+atpage+"&pageSize="+pageSize,
		type: "GET",
		dataType: "jsonp",
		success: function (data) {
			if(data && data.state != 200){
				if(data.state == 101){
					$('.main-sub-tab').hide();
					objId.html("<p class='loading'>暂无相关信息！</p>");
				}else{
					var list = data.info.list, pageInfo = data.info.pageInfo, html = [], durl = $(".main-sub-tab").data("url");

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
									paydate    = list[i].paydate,
									retState   = list[i].retState,
									expDate    = list[i].expDate,
									orderdate  = huoniao.transTimes(list[i].orderdate, 1),
									title      = list[i].product.title,
									enddate    = huoniao.transTimes(list[i].product.enddate, 2),
									litpic     = list[i].product.litpic,
									url        = list[i].product.url,
									payurl     = list[i].payurl,
									common     = list[i].common,
									commonUrl  = list[i].commonUrl;

							var stateInfo = btn = "";
							switch(orderstate){
								case "0":
									stateInfo = "未付款";
									btn = '<a href="'+payurl+'" class="edit" target="_blank">付款</a><a href="javascript:;" class="del"><s></s>删除</a>';
									break;
								case "1":
									stateInfo = "已付款";
									break;
								case "2":
									if(paydate != 0){
										stateInfo = "已过期";
									}else{
										stateInfo = "未付款，已过期";
										btn = '<a href="javascript:;" class="del"><s></s>删除</a>';
									}
									break;
								case "3":
									stateInfo = "交易成功";
									if(common == 1){
										btn = '<a href="'+commonUrl+'" class="edit" target="_blank">修改评价</a>';
									}else{
										btn = '<a href="'+commonUrl+'" class="edit" target="_blank">评价</a>';
									}

									break;
								case "4":
									stateInfo = "退款中";
									// btn = '<a href="javascript:;" class="edit">退款去向</a>';
									break;
								case "6":

									//申请退款
									if(retState == 1){

										//还未发货
										if(expDate == 0){
											stateInfo = "已付款，申请退款中";

										//已经发货
										}else{
											stateInfo = "已发货，申请退款中";
										}

									//未申请退款
									}else{
										stateInfo = "待收货";
										// btn = '<a href="javascript:;" class="edit" target="_blank">确认收货</a>';
									}
									break;
								case "7":
									stateInfo = "退款成功";
									// btn = '<a href="javascript:;" class="edit">退款去向</a>';
									break;
							}

							var detailUrl = durl.replace("%id%", id);

							html.push('<div class="item fn-clear" data-id="'+id+'">');
							html.push('<div class="p"><a href="'+url+'" target="_blank"><i></i><img src="'+litpic+'"></a></div>');
							html.push('<div class="o">'+btn+'</div>');
							html.push('<div class="i">');
							html.push('<p>订单号：'+ordernum+'&nbsp;&nbsp;·&nbsp;&nbsp;下单时间：'+orderdate+'</p>');
							html.push('<h5><a href="'+url+'" target="_blank" title="'+title+'">'+title+'</a></h5>');
							html.push('<p>结束时间：'+enddate+'&nbsp;&nbsp;·&nbsp;&nbsp;数量：'+procount+'份&nbsp;&nbsp;·&nbsp;&nbsp;总价：'+orderprice+'元&nbsp;&nbsp;·&nbsp;&nbsp;状态：'+stateInfo+'&nbsp;&nbsp;·&nbsp;&nbsp;<a href="'+detailUrl+'" target="_blank">订单详情</a></p>');
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


					$("#total").html(pageInfo.totalCount);

					if(pageInfo.unpaid == 0){
						$("#unpaid").parent().parent().hide();
					}else{
						$("#unpaid").parent().parent().show();
						$("#unpaid").html(pageInfo.unpaid);
					}

					if(pageInfo.ongoing == 0){
						$("#unused").parent().parent().hide();
					}else{
						$("#unused").parent().parent().show();
						$("#unused").html(pageInfo.ongoing);
					}

					if(pageInfo.success == 0){
						$("#used").parent().parent().hide();
					}else{
						$("#used").parent().parent().show();
						$("#used").html(pageInfo.success);
					}

					if(pageInfo.expired == 0){
						$("#expired").parent().parent().hide();
					}else{
						$("#expired").parent().parent().show();
						$("#expired").html(pageInfo.expired);
					}

					if(pageInfo.refunded == 0){
						$("#refund").parent().parent().hide();
					}else{
						$("#refund").parent().parent().show();
						$("#refund").html(pageInfo.refunded);
					}

					if(pageInfo.rates == 0){
						$("#rates").parent().parent().hide();
					}else{
						$("#rates").parent().parent().show();
						$("#rates").html(pageInfo.rates);
					}

					if(pageInfo.recei == 0){
						$("#recei").parent().parent().hide();
					}else{
						$("#recei").parent().parent().show();
						$("#recei").html(pageInfo.recei);
					}

					if(pageInfo.closed == 0){
						$("#closed").parent().parent().hide();
					}else{
						$("#closed").parent().parent().show();
						$("#closed").html(pageInfo.closed);
					}

					showPageInfo();
				}
			}else{
				$('.main-sub-tab').hide();
				objId.html("<p class='loading'>暂无相关信息！</p>");
			}
		}
	});
}

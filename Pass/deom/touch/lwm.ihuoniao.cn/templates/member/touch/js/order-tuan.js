/**
 * 会员中心商城订单列表
 * by guozi at: 20151130
 */

var objId = $("#list");
$(function(){



	//状态切换
	$(".tab ul li").bind("click", function(){
		var t = $(this), id = t.attr("data-id");
		if(!t.hasClass("curr") && !t.hasClass("sel")){
			state = id;
			atpage = 1;
			t.addClass("curr").siblings("li").removeClass("curr");
      objId.html('');
			getList();
		}
	});

  // 下拉加载
  $(window).scroll(function() {
    var h = $('.item').height();
    var allh = $('body').height();
    var w = $(window).height();
    var scroll = allh - w - h;
    if ($(window).scrollTop() > scroll && !isload) {
      atpage++;
      getList();
    };
  });

	getList(1);

	// 删除
	objId.delegate(".del", "click", function(){
		var t = $(this), par = t.closest(".item"), id = par.attr("data-id");
		if(id){
			if(confirm('确定删除订单？删除后本订单将从订单列表消失，且不能恢复。')){
				t.siblings("a").hide();
				t.addClass("load");

				$.ajax({
					url: masterDomain+"/include/ajax.php?service=tuan&action=delOrder&id="+id,
					type: "GET",
					dataType: "jsonp",
					success: function (data) {
						if(data && data.state == 100){

							//删除成功后移除信息层并异步获取最新列表
							objId.html('');
							getList();

						}else{
							alert(data.info);
							t.siblings("a").show();
							t.removeClass("load");
						}
					},
					error: function(){
						alert("网络错误，请稍候重试！");
						t.siblings("a").show();
						t.removeClass("load");
					}
				});
			};
		}
	});



});

function getList(is){

  isload = true;

	if(is != 1){
		// $('html, body').animate({scrollTop: $(".main-tab").offset().top}, 300);
	}

	objId.append('<p class="loading">加载中，请稍候...</p>');
	$(".pagination").hide();


	$.ajax({
		url: masterDomain+"/include/ajax.php?service=tuan&action=orderList&state="+state+"&page="+atpage+"&pageSize="+pageSize,
		type: "GET",
		dataType: "jsonp",
		success: function (data) {
			if(data && data.state != 200){
				if(data.state == 101){
					objId.html("<p class='loading'>暂无相关信息！</p>");
				}else{
					var list = data.info.list, pageInfo = data.info.pageInfo, html = [], durl = $(".tab ul").data("url"), rUrl = $(".tab ul").data("refund"), cUrl = $(".tab ul").data("comment");

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

					var msg = totalCount == 0 ? '暂无相关信息！' : '已加载完全部信息！';

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
		                      stateInfo = '<em class="state fn-right">未付款</em>';
		                      btn = '<a href="javascript:;" class="gray del">删除</a><a href="'+payurl+'" class="yellow">立即付款</a>';
		                      break;
		                    case "1":
		                      stateInfo = '<em class="state fn-right">已付款</em>';
		                      break;
		                    case "2":
		                      if(paydate != 0){
		                        stateInfo = '<em class="state fn-right">已过期</em>';
		                      }else{
		                        stateInfo = '<em class="state fn-right">未付款，已过期</em>';
		                        btn = '<a href="javascript:;" class="gray del">删除</a>';
		                      }
		                      break;
		                    case "3":
		                      stateInfo = '<em class="state fn-right">交易成功</em>';
		                      if(common == 1){
		                        btn = '<a href="'+commonUrl+'" class="yellow">修改评价</a>';
		                      }else{
		                        btn = '<a href="'+commonUrl+'" class="yellow">评价</a>';
		                      }

		                      break;
		                    case "4":
		                      stateInfo = '<em class="state fn-right">退款中</em>';
		                      // btn = '<a href="javascript:;" class="edit">退款去向</a>';
		                      break;
		                    case "6":

		                      //申请退款
		                      if(retState == 1){

		                        //还未发货
		                        if(expDate == 0){
		                          stateInfo = '<em class="state fn-right">已付款，申请退款中</em>';

		                        //已经发货
		                        }else{
		                          stateInfo = '<em class="state fn-right">已发货，申请退款中</em>';
		                        }

		                      //未申请退款
		                      }else{
		                        stateInfo = '<em class="state fn-right">待收货</em>';
		                        // btn = '<a href="javascript:;" class="edit" target="_blank">确认收货</a>';
		                      }
		                      break;
		                    case "7":
		                      stateInfo = '<em class="state fn-right">退款成功</em>';
		                      // btn = '<a href="javascript:;" class="edit">退款去向</a>';
		                      break;
                  }

                  			var detailUrl = durl.replace("%id%", id);



  							html.push('<div class="item" data-id="'+id+'">');
                			html.push('<div class="domain fn-clear">订单号：'+ordernum+stateInfo+'</div>');

  							html.push('<div class="info fn-clear">');
  							html.push('<div class="imgbox fn-left">');
  							html.push('<a href="'+url+'"><img src="'+litpic+'" alt=""></a>');
  							html.push('</div>');



  							html.push('<div class="txtbox">');

  							html.push('<div class="title">');
  							html.push('<p>'+title+'</p>');
  							html.push('<span>￥'+orderprice+'</span>');
  							html.push('</div>');

  							html.push('<div class="number fn-clear">');
  							html.push('<p class="fn-left">下单时间：'+orderdate+'</p>');
  							html.push('<span class="fn-right">×'+procount+'</span>');
  							html.push('</div>');

  							html.push('<div class="date">结束时间：'+enddate+'</div>');

  							html.push('</div>');
  							html.push('</div>');
  							html.push('<div class="opbtn">');
  							html.push('<a href="'+detailUrl+'" class="gray">订单详情</a>'+btn+'');
  							html.push('</div>');
  							html.push('</div>');



						}

						objId.append(html.join(""));
		            $('.loading').remove();
		            isload = false;

							}else{
		            $('.loading').remove();
						objId.append("<p class='loading'>"+msg+"</p>");
					}

					$("#total").html(pageInfo.totalCount);
					$("#unpaid").html(pageInfo.unpaid);
					$("#unused").html(pageInfo.ongoing);
					$("#expired").html(pageInfo.expired);
					$("#used").html(pageInfo.success);
					$("#refund").html(pageInfo.refunded);
					$("#rates").html(pageInfo.rates);
					$("#closed").html(pageInfo.closed);
					$("#cancel").html(pageInfo.cancel);

				}
			}else{
				objId.html("<p class='loading'>暂无相关信息！</p>");
			}
		}
	});
}

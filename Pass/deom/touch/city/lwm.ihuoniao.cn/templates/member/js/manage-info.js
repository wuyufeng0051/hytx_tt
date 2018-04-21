/**
 * 会员中心分类信息列表
 * by guozi at: 20150627
 */

var objId = $("#list");
$(function(){

	$(".main-tab li[data-id='"+state+"']").addClass("curr");

	$(".main-tab li").bind("click", function(){
		var t = $(this), id = t.attr("data-id");
		if(!t.hasClass("curr") && !t.hasClass("add")){
			state = id;
			atpage = 1;
			t.addClass("curr").siblings("li").removeClass("curr");
			getList();
		}
	});

	getList(1);

	objId.delegate(".del", "click", function(){
		var t = $(this), par = t.closest(".item"), id = par.attr("data-id");
		if(id){
			$.dialog.confirm('你确定要删除这条信息吗？', function(){
				t.siblings("a").hide();
				t.addClass("load");

				$.ajax({
					url: masterDomain+"/include/ajax.php?service=info&action=del&id="+id,
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




	// 竞价
    // 选择支付方式
  	$('.bidJ-pay-way ul li').click(function(){
		$(this).addClass('on').siblings('li').removeClass('on');
  	});

	var bidDefaultDay = parseInt($(".bidJ-pay-select .on").text()),   //默认时长为选中的天数
		bidPriceObj   = $('.state1 .bid-budget .bid-price .bid-inp'), //每日预算input
		bidAmountObj  = $('.state1 .bidJ-total .total-price em'),     //总价格
		bidDayObj     = $('.state1 .bidJ-pay-select .inp input'),     //自定义天数input
		bidPopObj     = $('.bidJ-pay, .bidJ-mask'),                   //浮动层和背景层
		bidCloseObj   = $('.bidJ-pay-tit .close'),                    //关闭按钮
		bidCurrObj    = $("#currPrice"),                              //当前每日预算
		bidEnd        = $("#bidEnd"),                                 //竞价结束时间
		bidPriceObj1  = $('.state2 .bid-budget .bid-price .bid-inp'), //每日增加预算input
		bidAmountObj1 = $('.state2 .bidJ-total .total-price em'),     //需要支付费用
		isIncrease    = false,  //是否加价操作
		bidID         = 0,      //要竞价的信息
		bidCurrPrice  = 0,      //当前每日预算，异步获取
		bidCurrDay    = 0;      //剩余竞价天数

		//计算总价
		computeBidAmount = function(){
			var bidDayPrice = bidPriceObj.val();
			var bidAmount = bidDayPrice * bidDefaultDay;
			bidAmount = isNaN(bidAmount) || bidAmount < 0 ? 0 : bidAmount;
			bidAmountObj.html(bidAmount.toFixed(2));
		};

    // 选择天数
    $('.bidJ-pay-select li:not(:last)').click(function(){
		var t = $(this), val = t.text();
		t.addClass('on').siblings('li').removeClass('on').removeClass('cur');
		bidDefaultDay = parseInt(val);
		computeBidAmount();
  	});

    // 自定义天数
    bidDayObj.focus(function(){
		$(this).closest('li').addClass('cur').siblings("li").removeClass('on');
		bidDefaultDay = 0;
		computeBidAmount();
  	});

	// 输入自定义天数
    bidDayObj.keyup(function(){
		bidDefaultDay = $(this).val();
		computeBidAmount();
	});

    // 自定义预算
    bidPriceObj.keyup(function(){
		var t = $(this), val = t.val();
		if(isNaN(val) || val < 0){
			t.val(0);
		}
		computeBidAmount();
    });

    // 每日增加预算
    bidPriceObj1.keyup(function(){
		var t = $(this), val = t.val();
		if(isNaN(val) || val < 0){
			t.val(0);
			val = 0;
		}
		bidAmountObj1.html((val * bidCurrDay).toFixed(2));
    });

    // 马上竞价
    $('.bidJ-sumbit a').click(function(event){
		var t = $(this);
		var inpPrice = bidPriceObj.val();
		var inpPrice1 = bidPriceObj1.val();

		//加价
		if(isIncrease){

			if (inpPrice1 == "" || isNaN(inpPrice1) || inpPrice1 == 0){
				event.preventDefault();
				alert('请输入正确的每日预算');
				return false;
			}

			var paytype = $(".bidJ-pay-way .on").data("type");
			if(paytype == "" || paytype == undefined || paytype == null){
				event.preventDefault();
				alert("请选择支付方式！");
				return false;
			}

			var url = t.data("url1").replace("$aid", bidID).replace("$price", inpPrice1).replace("$paytype", paytype);
			t.attr("href", url);


		//正常竞价
		}else{
			if(!bidID){
				event.preventDefault();
				alert('请选择要竞价的信息！');
				bidCloseObj.click();
				return false;
			}

			if (bidDefaultDay == "" || isNaN(bidDefaultDay) || bidDefaultDay == 0) {
				event.preventDefault();
				alert('请选择正确的竞价天数');
				return false;
			}

			if (inpPrice == "" || isNaN(inpPrice) || inpPrice == 0){
				event.preventDefault();
				alert('请输入正确的每日预算');
				return false;
			}

			var paytype = $(".bidJ-pay-way .on").data("type");
			if(paytype == "" || paytype == undefined || paytype == null){
				event.preventDefault();
				alert("请选择支付方式！");
				return false;
			}

			var url = t.data("url").replace("$aid", bidID).replace("$price", inpPrice).replace("$day", bidDefaultDay).replace("$paytype", paytype);
			t.attr("href", url);
		}

		setTimeout(function(){
			bidCloseObj.click();
		}, 500);

	});

	//打开竞价
	$("#list").delegate(".bid", "click", function(){
		var t = $(this), id = t.closest(".item").attr("data-id");
		if(t.hasClass("load")) return false;

		t.addClass("load");
		bidID = id;

		//验证信息状态
		$.ajax({
			"url": masterDomain + "/include/ajax.php?service=info&action=checkBidState",
			"data": {"aid": id},
			"dataType": "jsonp",
			success: function(data){
				t.removeClass("load");
				if(data && data.state == 100){
					bidPopObj.show();

					//加价
					if(data.info.isbid){
						isIncrease = true;
						$(".bidJ-pay .state1").hide();
						$(".bidJ-pay .state2").show();

						bidCurrPrice = parseFloat(data.info.bid_price);
						bidCurrDay   = (data.info.bid_end - data.info.now) / 24 / 3600;
						bidCurrDay   = bidCurrDay <= 0 ? 1 : bidCurrDay;
						bidCurrDay   = Math.ceil(bidCurrDay);
						bidCurrObj.html(bidCurrPrice);
						bidEnd.html(huoniao.transTimes(data.info.bid_end, 1));
						bidPriceObj1.val(bidDefaultAdd).focus();
						bidAmountObj1.html((bidDefaultAdd * bidCurrDay).toFixed(2));

					}else{
						isIncrease = false;
						$(".bidJ-pay .state1").show();
						$(".bidJ-pay .state2").hide();
						bidPriceObj.val(bidDefault).focus();
						computeBidAmount();
					}

				}else{
					alert(data.info);
				}

				//登录超时
				if(data.state == 101){
					location.reload();
				}
			},
			error: function(){
				t.removeClass("load");
				alert("网络错误，操作失败，请稍候重试！");
			}
		});


	});

    //关闭
	bidCloseObj.click(function(){
		bidPopObj.hide();
		$('.bidJ-sumbit a').attr("href", "javascript:;");
	});




});

function getList(is){

	if(is != 1){
		$('html, body').animate({scrollTop: $(".main-tab").offset().top}, 300);
	}

	objId.html('<p class="loading"><img src="'+staticPath+'images/ajax-loader.gif" />加载中，请稍候...</p>');
	$(".pagination").hide();

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=info&action=ilist&u=1&orderby=1&state="+state+"&page="+atpage+"&pageSize="+pageSize,
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

						var t = window.location.href.indexOf(".html") > -1 ? "?" : "&";
						var param = t + "do=edit&id=";
						var urlString = editUrl + param;

						for(var i = 0; i < list.length; i++){
							var item        = [],
									id          = list[i].id,
									title       = list[i].title,
									color       = list[i].color,
									address     = list[i].address,
									typename    = list[i].typename,
									url         = list[i].url,
									litpic      = list[i].litpic,
									click       = list[i].click,
									common      = list[i].common,
									isbid       = list[i].isbid,
									isvalid     = list[i].isvalid,
									bid_price   = list[i].bid_price,
									bid_end     = huoniao.transTimes(list[i].bid_end, 1),
									pubdate     = huoniao.transTimes(list[i].pubdate, 1);

							html.push('<div class="item fn-clear" data-id="'+id+'">');
							if(litpic != "" && litpic != undefined){
								html.push('<div class="p"><a href="'+url+'" target="_blank"><i></i><img src="'+huoniao.changeFileSize(litpic, "small")+'" /></a></div>');
							}
							html.push('<div class="o">');
							if(list[i].arcrank == "1" && !isvalid){
								if(isbid == 1){
									html.push('<a href="javascript:;" class="bid has"><s></s>预算：'+bid_price+'，加价</a>');
								}else{
									html.push('<a href="javascript:;" class="bid"><s></s>竞价</a>');
								}
							}
							html.push('<a href="'+urlString+id+'" class="edit"><s></s>编辑</a>');
							if(isbid == "0"){
								html.push('<a href="javascript:;" class="del"><s></s>删除</a>');
							}
							html.push('</div>');
							html.push('<div class="i">');

							var arcrank = "";
							if(list[i].arcrank == "0"){
								arcrank = '&nbsp;&nbsp;·&nbsp;&nbsp;<span class="gray">未审核</span>';
							}else if(list[i].arcrank == "2"){
								arcrank = '&nbsp;&nbsp;·&nbsp;&nbsp;<span class="red">审核拒绝</span>';
							}else if(list[i].arcrank == "3"){
								arcrank = '&nbsp;&nbsp;·&nbsp;&nbsp;<span class="red">取消显示</span>';
							}else if(list[i].arcrank == "4"){
								arcrank = '&nbsp;&nbsp;·&nbsp;&nbsp;<span class="red">已过期</span>';
							}

							html.push('<p>分类：'+typename+'&nbsp;&nbsp;·&nbsp;&nbsp;发布时间：'+pubdate+arcrank+'</p>');
							html.push('<h5><a href="'+url+'" target="_blank" title="'+title+'" style="color:'+color+';">'+title+'</a></h5>');

							html.push('<p>区域：'+address+'&nbsp;&nbsp;·&nbsp;&nbsp;浏览：'+click+'次&nbsp;&nbsp;·&nbsp;&nbsp;评论：'+common+'条');
							if(isbid == 1){
								html.push('&nbsp;&nbsp;·&nbsp;&nbsp;<font color="#ff6600">竞价结束：'+bid_end+'</font>');
							}
							if(isvalid){
								html.push('&nbsp;&nbsp;·&nbsp;&nbsp;<font color="#f00">已过期</font>');
							}
							html.push('</p>');
							html.push('</div>');
							html.push('</div>');

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
							totalCount = pageInfo.gray;
							break;
						case "1":
							totalCount = pageInfo.audit;
							break;
						case "2":
							totalCount = pageInfo.refuse;
							break;
						case "4":
							totalCount = pageInfo.expire;
							break;
					}


					$("#total").html(pageInfo.totalCount);
					$("#audit").html(pageInfo.audit);
					$("#gray").html(pageInfo.gray);
					$("#refuse").html(pageInfo.refuse);
					$("#expire").html(pageInfo.expire);
					showPageInfo();
				}
			}else{
				objId.html("<p class='loading'>暂无相关信息！</p>");
			}
		}
	});
}

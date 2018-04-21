/**
 * 会员中心房产列表
 * by guozi at: 20150627
 */

var objId = $("#list"), lei = 0;
$(function(){

	if(type != ""){
		$(".main-tab li[data-id='"+type+"']").addClass("curr");
	}else{
		var fir = $(".main-tab li:eq(0)");
		fir.addClass("curr");
		type = fir.attr("data-id");
	}

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

	//项目
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
			$.dialog.confirm('你确定要删除这条信息吗？', function(){
				t.siblings("a").hide();
				t.addClass("load");

				$.ajax({
					url: masterDomain+"/include/ajax.php?service=house&type="+type+"&action=del&id="+id,
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
			"url": masterDomain + "/include/ajax.php?service=house&action=checkBidState",
			"data": {"aid": id, "type": type},
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

	var t = "type="+lei;
	if(type == "zu") t = "rentype="+lei;
	var action = type+"List";
	if(type == "qzu" || type == "qgou"){
		action = "demand";
		t = type == "qzu" ? "typeid=0" : "typeid=1";
	}

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=house&action="+action+"&"+t+"&u=1&orderby=1&state="+state+"&page="+atpage+"&pageSize="+pageSize,
		type: "GET",
		dataType: "jsonp",
		success: function (data) {
			if(data && data.state != 200){
				if(data.state == 101){
					$("#total").html(0);
					$("#audit").html(0);
					$("#gray").html(0);
					$("#refuse").html(0);
					$("#expire").html(0);
					objId.html("<p class='loading'>暂无相关信息！</p>");
				}else{
					var list = data.info.list, pageInfo = data.info.pageInfo, html = [];

					//拼接列表
					if(list.length > 0){

						var t = window.location.href.indexOf(".html") > -1 ? "?" : "&";
						var param = t + "do=edit&type="+type+"&id=";
						var urlString = editUrl + param;

						for(var i = 0; i < list.length; i++){
							var item        = [],
									id          = list[i].id,
									title       = list[i].title,
									community   = list[i].community,
									addr        = list[i].addr,
									price       = list[i].price,
									url         = list[i].url,
									litpic      = list[i].litpic,
									protype     = list[i].protype,
									room        = list[i].room,
									bno         = list[i].bno,
									floor       = list[i].floor,
									area        = list[i].area,
									isbid       = list[i].isbid,
									bid_price   = list[i].bid_price,
									bid_end     = huoniao.transTimes(list[i].bid_end, 1),
									pubdate     = list[i].pubdate;

							//求租
							if(type == "qzu" || type == "qgou"){

								var action = list[i].action;

								html.push('<div class="item qiu fn-clear" data-id="'+id+'">');

								html.push('<div class="o">');
								if(list[i].state == "1"){
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

								// html.push('<div class="o"><a href="'+urlString+id+'" class="edit"><s></s>编辑</a><a href="javascript:;" class="del"><s></s>删除</a></div>');
								html.push('<div class="i">');

								var state = "";
								if(list[i].state == "0"){
									state = '&nbsp;&nbsp;·&nbsp;&nbsp;<span class="gray">未审核</span>';
								}else if(list[i].state == "2"){
									state = '&nbsp;&nbsp;·&nbsp;&nbsp;<span class="red">审核拒绝</span>';
								}

								var protype = "";
								switch(action){
									case "1":
										protype = "新房";
										break;
									case "2":
										protype = "二手房";
										break;
									case "3":
										protype = "出租房";
										break;
									case "4":
										protype = "写字楼";
										break;
									case "5":
										protype = "商铺";
										break;
									case "6":
										protype = "厂房/仓库";
										break;
								}

								html.push('<p>类型：'+protype+'&nbsp;&nbsp;·&nbsp;&nbsp;区域：'+addr+'&nbsp;&nbsp;·&nbsp;&nbsp;发布时间：'+huoniao.transTimes(pubdate, 1)+state);
								if(isbid == 1){
									html.push('&nbsp;&nbsp;·&nbsp;&nbsp;<font color="#ff6600">竞价结束：'+bid_end+'</font>');
								}
								html.push('</p>');
								html.push('<h5><a href="'+url+'" target="_blank" title="'+title+'">'+title+'</a></h5>');
								html.push('</div>');
								html.push('</div>');

							//二手房
							}else if(type == "sale"){

								var unitprice   = list[i].unitprice;

								html.push('<div class="item fn-clear" data-id="'+id+'">');
								if(litpic != "" && litpic != undefined){
									html.push('<div class="p"><a href="'+url+'" target="_blank"><i></i><img src="'+huoniao.changeFileSize(litpic, "small")+'" /></a></div>');
								}

								html.push('<div class="o">');
								if(list[i].state == "1"){
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

								// html.push('<div class="o"><a href="'+urlString+id+'" class="edit"><s></s>编辑</a><a href="javascript:;" class="del"><s></s>删除</a></div>');
								html.push('<div class="i">');

								var state = "";
								if(list[i].state == "0"){
									state = '&nbsp;&nbsp;·&nbsp;&nbsp;<span class="gray">未审核</span>';
								}else if(list[i].state == "2"){
									state = '&nbsp;&nbsp;·&nbsp;&nbsp;<span class="red">审核拒绝</span>';
								}

								html.push('<p>类型：'+protype+'&nbsp;&nbsp;·&nbsp;&nbsp;总价：'+price+'万&nbsp;&nbsp;·&nbsp;&nbsp;单价：'+unitprice+'元/㎡&nbsp;&nbsp;·&nbsp;&nbsp;面积：'+area+' ㎡'+state+'</p>');
								html.push('<h5><a href="'+url+'" target="_blank" title="'+title+'">'+title+'</a></h5>');

								html.push('<p>'+community+'&nbsp;&nbsp;·&nbsp;&nbsp;'+addr+'&nbsp;&nbsp;·&nbsp;&nbsp;房型：'+room+'&nbsp;&nbsp;·&nbsp;&nbsp;楼层：'+bno+'/'+floor+'&nbsp;&nbsp;·&nbsp;&nbsp;发布时间：'+huoniao.transTimes(pubdate, 1));
								if(isbid == 1){
									html.push('&nbsp;&nbsp;·&nbsp;&nbsp;<font color="#ff6600">竞价结束：'+bid_end+'</font>');
								}
								html.push('</p>');
								html.push('</div>');
								html.push('</div>');

							//出租房
							}else if(type == "zu"){

								var zhuangxiu = list[i].zhuangxiu,
										rentype   = list[i].rentype;

								html.push('<div class="item fn-clear" data-id="'+id+'">');
								if(litpic != "" && litpic != undefined){
									html.push('<div class="p"><a href="'+url+'" target="_blank"><i></i><img src="'+huoniao.changeFileSize(litpic, "small")+'" /></a></div>');
								}

								html.push('<div class="o">');
								if(list[i].state == "1"){
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

								// html.push('<div class="o"><a href="'+urlString+id+'" class="edit"><s></s>编辑</a><a href="javascript:;" class="del"><s></s>删除</a></div>');
								html.push('<div class="i">');

								var state = "";
								if(list[i].state == "0"){
									state = '&nbsp;&nbsp;·&nbsp;&nbsp;<span class="gray">未审核</span>';
								}else if(list[i].state == "2"){
									state = '&nbsp;&nbsp;·&nbsp;&nbsp;<span class="red">审核拒绝</span>';
								}

								html.push('<p>类型：'+protype+'&nbsp;&nbsp;·&nbsp;&nbsp;'+zhuangxiu+'&nbsp;&nbsp;·&nbsp;&nbsp;'+rentype+'&nbsp;&nbsp;·&nbsp;&nbsp;租金：'+price+'元/月&nbsp;&nbsp;·&nbsp;&nbsp;面积：'+area+' ㎡'+state+'</p>');
								html.push('<h5><a href="'+url+'" target="_blank" title="'+title+'">'+title+'</a></h5>');

								html.push('<p>'+community+'&nbsp;&nbsp;·&nbsp;&nbsp;'+addr+'&nbsp;&nbsp;·&nbsp;&nbsp;房型：'+room+'&nbsp;&nbsp;·&nbsp;&nbsp;楼层：'+bno+'/'+floor+'&nbsp;&nbsp;·&nbsp;&nbsp;发布时间：'+huoniao.transTimes(pubdate, 1));
								if(isbid == 1){
									html.push('&nbsp;&nbsp;·&nbsp;&nbsp;<font color="#ff6600">竞价结束：'+bid_end+'</font>');
								}
								html.push('</p>');
								html.push('</div>');
								html.push('</div>');

							//写字楼
							}else if(type == "xzl"){

								var loupan = list[i].loupan;

								html.push('<div class="item fn-clear" data-id="'+id+'">');
								if(litpic != "" && litpic != undefined){
									html.push('<div class="p"><a href="'+url+'" target="_blank"><i></i><img src="'+huoniao.changeFileSize(litpic, "small")+'" /></a></div>');
								}

								html.push('<div class="o">');
								if(list[i].state == "1"){
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

								// html.push('<div class="o"><a href="'+urlString+id+'" class="edit"><s></s>编辑</a><a href="javascript:;" class="del"><s></s>删除</a></div>');
								html.push('<div class="i">');

								var state = "";
								if(list[i].state == "0"){
									state = '&nbsp;&nbsp;·&nbsp;&nbsp;<span class="gray">未审核</span>';
								}else if(list[i].state == "2"){
									state = '&nbsp;&nbsp;·&nbsp;&nbsp;<span class="red">审核拒绝</span>';
								}

								var p = lei == 0 ? "元/月" : "万元";
								html.push('<p>类型：'+protype+'&nbsp;&nbsp;·&nbsp;&nbsp;价格：'+price+p+'&nbsp;&nbsp;·&nbsp;&nbsp;发布时间：'+huoniao.transTimes(pubdate, 1)+state+'</p>');
								html.push('<h5><a href="'+url+'" target="_blank" title="'+title+'">'+title+'</a></h5>');

								html.push('<p>楼盘：'+loupan+'&nbsp;&nbsp;·&nbsp;&nbsp;'+addr+'&nbsp;&nbsp;·&nbsp;&nbsp;面积：'+area+' ㎡');
								if(isbid == 1){
									html.push('&nbsp;&nbsp;·&nbsp;&nbsp;<font color="#ff6600">竞价结束：'+bid_end+'</font>');
								}
								html.push('</p>');
								html.push('</div>');
								html.push('</div>');

							//商铺
							}else if(type == "sp"){

								var transfer = list[i].transfer,
										address  = list[i].address;

								html.push('<div class="item fn-clear" data-id="'+id+'">');
								if(litpic != "" && litpic != undefined){
									html.push('<div class="p"><a href="'+url+'" target="_blank"><i></i><img src="'+huoniao.changeFileSize(litpic, "small")+'" /></a></div>');
								}

								html.push('<div class="o">');
								if(list[i].state == "1"){
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

								// html.push('<div class="o"><a href="'+urlString+id+'" class="edit"><s></s>编辑</a><a href="javascript:;" class="del"><s></s>删除</a></div>');
								html.push('<div class="i">');

								var state = "";
								if(list[i].state == "0"){
									state = '&nbsp;&nbsp;·&nbsp;&nbsp;<span class="gray">未审核</span>';
								}else if(list[i].state == "2"){
									state = '&nbsp;&nbsp;·&nbsp;&nbsp;<span class="red">审核拒绝</span>';
								}

								var p = lei == 0 ? "元/月" : "万元";

								var tran = lei == 2 ? "&nbsp;&nbsp;·&nbsp;&nbsp;转让费："+transfer+"万元" : "";

								html.push('<p>类型：'+protype+'&nbsp;&nbsp;·&nbsp;&nbsp;价格：'+price+p+tran+'&nbsp;&nbsp;·&nbsp;&nbsp;发布时间：'+huoniao.transTimes(pubdate, 1)+state+'</p>');
								html.push('<h5><a href="'+url+'" target="_blank" title="'+title+'">'+title+'</a></h5>');

								html.push('<p>区域：'+addr+'&nbsp;&nbsp;·&nbsp;&nbsp;地址：'+address+'&nbsp;&nbsp;·&nbsp;&nbsp;面积：'+area+' ㎡');
								if(isbid == 1){
									html.push('&nbsp;&nbsp;·&nbsp;&nbsp;<font color="#ff6600">竞价结束：'+bid_end+'</font>');
								}
								html.push('</p>');
								html.push('</div>');
								html.push('</div>');

							//厂房、仓库
							}else if(type == "cf"){

								var transfer = list[i].transfer,
										address  = list[i].address;

								html.push('<div class="item fn-clear" data-id="'+id+'">');
								if(litpic != "" && litpic != undefined){
									html.push('<div class="p"><a href="'+url+'" target="_blank"><i></i><img src="'+huoniao.changeFileSize(litpic, "small")+'" /></a></div>');
								}

								html.push('<div class="o">');
								if(list[i].state == "1"){
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

								// html.push('<div class="o"><a href="'+urlString+id+'" class="edit"><s></s>编辑</a><a href="javascript:;" class="del"><s></s>删除</a></div>');
								html.push('<div class="i">');

								var state = "";
								if(list[i].state == "0"){
									state = '&nbsp;&nbsp;·&nbsp;&nbsp;<span class="gray">未审核</span>';
								}else if(list[i].state == "2"){
									state = '&nbsp;&nbsp;·&nbsp;&nbsp;<span class="red">审核拒绝</span>';
								}

								var p = lei == 0 ? "元/月" : "万元";

								var tran = lei == 1 ? "&nbsp;&nbsp;·&nbsp;&nbsp;转让费："+transfer+"万元" : "";

								html.push('<p>类型：'+protype+'&nbsp;&nbsp;·&nbsp;&nbsp;价格：'+price+p+tran+'&nbsp;&nbsp;·&nbsp;&nbsp;发布时间：'+huoniao.transTimes(pubdate, 1)+state+'</p>');
								html.push('<h5><a href="'+url+'" target="_blank" title="'+title+'">'+title+'</a></h5>');

								html.push('<p>区域：'+addr+'&nbsp;&nbsp;·&nbsp;&nbsp;地址：'+address+'&nbsp;&nbsp;·&nbsp;&nbsp;面积：'+area+' ㎡');
								if(isbid == 1){
									html.push('&nbsp;&nbsp;·&nbsp;&nbsp;<font color="#ff6600">竞价结束：'+bid_end+'</font>');
								}
								html.push('</p>');
								html.push('</div>');
								html.push('</div>');

							}

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
					}


					$("#total").html(pageInfo.totalCount);
					$("#audit").html(pageInfo.audit);
					$("#gray").html(pageInfo.gray);
					$("#refuse").html(pageInfo.refuse);
					$("#expire").html(pageInfo.expire);
					showPageInfo();
				}
			}else{
				$("#total").html(0);
				$("#audit").html(0);
				$("#gray").html(0);
				$("#refuse").html(0);
				$("#expire").html(0);
				objId.html("<p class='loading'>暂无相关信息！</p>");
			}
		}
	});
}
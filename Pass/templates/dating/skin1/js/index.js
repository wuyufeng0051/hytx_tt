$(function(){
	//转换PHP时间戳
	function transTimes(timestamp, n){
		update = new Date(timestamp*1000);//时间戳要乘1000
		year   = update.getFullYear();
		month  = (update.getMonth()+1<10)?('0'+(update.getMonth()+1)):(update.getMonth()+1);
		day    = (update.getDate()<10)?('0'+update.getDate()):(update.getDate());
		hour   = (update.getHours()<10)?('0'+update.getHours()):(update.getHours());
		minute = (update.getMinutes()<10)?('0'+update.getMinutes()):(update.getMinutes());
		second = (update.getSeconds()<10)?('0'+update.getSeconds()):(update.getSeconds());
		if(n == 1){
			return (year+'-'+month+'-'+day+' '+hour+':'+minute+':'+second);
		}else if(n == 2){
			return (year+'-'+month+'-'+day);
		}else if(n == 3){
			return (month+'-'+day);
		}else if(n == 4){
			return (hour+':'+minute+':'+second);
		}else{
			return 0;
		}
	}
	//获取服务器当前时间
	var nowStamp = 0;
	$.ajax({
		"url": masterDomain+"/include/ajax.php?service=system&action=getSysTime",
		"dataType": "jsonp",
		"success": function(data){
			if(data){
				nowStamp = data.now;
			}
		}
	});
	//获取附件不同尺寸
	function changeFileSize(url, to, from){
		if(url == "" || url == undefined) return "";
		if(to == "") return url;
		var from = (from == "" || from == undefined) ? "large" : from;
		if(hideFileUrl == 1){
			return url + "&type=" + to;
		}else{
			return url.replace(from, to);
		}
	}
		//获取时间段
	function time_tran(time) {
	    var dur = nowStamp - time;
	    if (dur < 0) {
	        return transTimes(time, 2);
	    } else {
	        if (dur < 60) {
	            return dur+'秒前';
	        } else {
	            if (dur < 3600) {
	                return parseInt(dur / 60)+'分钟前';
	            } else {
	                if (dur < 86400) {
	                    return parseInt(dur / 3600)+'小时前';
	                } else {
	                    if (dur < 259200) {//3天内
	                        return parseInt(dur / 86400)+'天前';
	                    } else {
	                        return transTimes(time, 2);
	                    }
	                }
	            }
	        }
	    }
	}


	//异步加载新闻列表
	var page = 1, isload;
	var ajaxNews = function() {
		var id = $(".NewsNav .on a:eq(0)").attr("data-id"),
			href = $(".NewsNav .on a:eq(0)").attr("href");
		var objId = "NewList" + id;
		if ($("#" + objId).html() == undefined) {
			$("#NewList").append('<div id="' + objId + '" class="slide-box"></div>');
			// if (isload && $('.pane').hasClass('fixed')) {
			// 	$(window).scrollTop(paneHeight);
			// }
		}
		isload = true;

		$("#" + objId).find(".loading").remove();

		$("#" + objId)
			.append("<p class='loading'><img src='"+templatePath+"images/loading.gif'>加载中...</p>")
			.show()
			.siblings(".slide-box").hide();

		$.ajax({
			url: masterDomain+"/include/ajax.php?service=article&action=alist&typeid=" + id + "&group_img=1&pageSize=40&page="+page,
			type: "GET",
			dataType: "jsonp",
			success: function(data) {
				if (data && data.state != 200) {
					if (data.state == 101) {
						$("#" + objId).html("<p class='loading'>" + data.info + "</p>");
					} else {
						var list = data.info.list,
							pageInfo = data.info.pageInfo,
							html = [];
						for (var i = 0; i < list.length; i++) {
							var item = [],
								id = list[i].id,
								title = list[i].title,
								typeName = list[i].typeName,
								url = list[i].url,
								common = list[i].common,
								litpic = list[i].litpic,
								keywords = list[i].keywords,
								description = list[i].description;

							if (list[i].group_img != "" && list[i].group_img != null) {
								item.push('<div class="content">');

								if (list[i].writer != undefined) {
								item.push('<div class="infor fn-clear"> ');
								item.push('<div class="infor_left">');
								item.push('<div class="infor_img"><a href="#"><img src="{#changeFileSize url="'+list[i].photo+'"#}"></a></div>');
								item.push('<div class="name"><a href="#">'+list[i].writer+'</a><i class="VIP fn-hide"></i><i class="diamond"></i></div>');
								item.push('<div class="inofor_tips">');
								item.push('<em>包吃</em>');
								item.push('</div>');
								item.push('</div>');
								item.push('<div class="infor_right">');
								item.push('<i></i>TB娱乐');
								item.push('</div>');
								item.push('</div>');
								}

								item.push('<div class="con_title"><a href="'+list[i].url+'">'+list[i].title+'</a></div>');
								item.push('<div class="con_pic fn-clear">');
								item.push('<ul class="fn-clear">');
								for (var g = 0; g < list[i].group_img.length; g++) {
									if(g < 3 && list[i].group_img[g].path != null){
										item.push('<li><a href="#"><img src="' + changeFileSize(list[i].group_img[g].path, "small") + '" alt=""></a></li>');
									}
								};
								item.push('</ul>');
								item.push('</div>');
								item.push('<div class="link"><i></i>'+list[i].source+'</div>');
								item.push('<div class="con_footer fn-clear">');
								item.push('<div class="timer">'+list[i].pubdate+'</div>');
								item.push('<div class="con_btn fn-clear">');
								item.push('<ul><li class="ju"><i></i>举报</li><li class="shang"><i></i>打赏</li><li class="zan"><i></i>100</li><li class="ping"><i></i>'+list[i].common+'</li>');
								item.push('</ul>');
								item.push('</div>');
								item.push('</div>');
								item.push('</div>');
							} else {
								item.push('<div class="content">');

								if (list[i].writer != undefined) {
								item.push('<div class="infor fn-clear"> ');
								item.push('<div class="infor_left">');
								item.push('<div class="infor_img"><a href="#"><img src="{#changeFileSize url="'+list[i].photo+'"#}"></a></div>');
								item.push('<div class="name"><a href="#">'+list[i].writer+'</a><i class="VIP fn-hide"></i><i class="diamond"></i></div>');
								item.push('<div class="inofor_tips">');
								item.push('<em>包吃</em>');
								item.push('</div>');
								item.push('</div>');
								item.push('<div class="infor_right">');
								item.push('<i></i>TB娱乐');
								item.push('</div>');
								item.push('</div>');
								}

								item.push('<div class="con_title"><a href="'+list[i].url+'">'+list[i].title+'</a></div>');
								item.push('<div class="present fn-clear"><a href="'+list[i].url+'">');
								item.push('<div class="pre_pic"><img src="'+list[i].litpic+'" alt=""></div>');
								item.push('<h1>进店免费送面膜</h1>');
								item.push('<p>23人已领取，还剩59个</p>');
								item.push('</a></div>');
								item.push('<div class="link"><i></i>'+list[i].source+'</div>');
								item.push('<div class="con_footer fn-clear">');
								item.push('<div class="timer">'+list[i].pubdate+'</div>');
								item.push('<div class="con_btn fn-clear">');
								item.push('<ul><li class="ju"><i></i>举报</li><li class="shang"><i></i>打赏</li><li class="zan"><i></i>100</li><li class="ping"><i></i>'+list[i].common+'</li>');
								item.push('</ul>');
								item.push('</div>');
								item.push('</div>');
								item.push('</div>');
							}
							html.push(item.join(""));
						}

						$("#" + objId).find(".loading").remove();
						$("#" + objId).append(html.join(""));
						if (page < pageInfo.totalPage) {
							$("#" + objId).append('<div class="load-more"><div class="load-add"><i></i><span>加载更多</span></div></div>');
						} else {
							$("#" + objId).append('<span class="mnbtn">:-)已经到最后啦~</span>');
						}

					}
				} else {
					$("#" + objId).html("<p class='loading'>数据获取失败，请稍候访问！</p>");
				}
			},
			error: function() {
				$("#" + objId).html("<p class='loading'>数据获取失败，请稍候访问！</p>");
			}
		});

	};
	ajaxNews();


	// 切换信息tab
	var isOnImg;
	$(".NewsNav ul li").bind("click", function(event){
		event.preventDefault();
		var t = $(this), id = t.find("a").attr("data-id");
		isOnImg = setTimeout(function() {
			if(!t.hasClass("on")){
				t.siblings("li").removeClass("on").removeClass('NewsNav_bc');
				$('.slide-2 .hd .more').removeClass('on');
				t.addClass("on").addClass('NewsNav_bc');
				if ($("#NewList" + id).html() == undefined) {
					page = 1;
					ajaxNews();
				}else{
					$("#NewList" + id).show().siblings(".slide-box").hide();
				}

			}
        }, 500);

	});
	$(".NewsNav ul li").bind("mouseleave", function(event){
		clearTimeout(isOnImg);
	});

	// 切换信息 更多列表
	$(".more_list ul li a").bind("click", function(event){
		event.preventDefault();
		var t = $(this), id = t.attr("data-id"), url = t.attr("href"), txt = t.text(), parent = t.closest("span");
		$('.pane .hd li:first').addClass('cur').siblings('li').removeClass('cur').removeClass('on');
		parent.siblings("ul").find("li").removeClass("on").removeClass('NewsNav_bc');
		parent
			.addClass("on")
			.find("a:eq(0)")
				.attr("data-id", id)
				.attr("href", url);

		page = 1;
		ajaxNews();
	});



		// 打赏金额
	$('.rewardS-pay-select li').click(function(){
		var t = $(this), li = t.text(), num = parseInt(li);
		$('.rewardS-pay-box .rewardS-pay-money .inp').focus().val(num);
	})

	// 打赏金额验证
	var rewardInput = $('.rewardS-pay-box .rewardS-pay-money .inp');
	rewardInput.blur(function(){
		var t = $(this), val = t.val();

		var regu = "(^[1-9]([0-9]?)+[\.][0-9]{1,2}?$)|(^[1-9]([0-9]+)?$)|(^[0][\.][0-9]{1,2}?$)";
		var re = new RegExp(regu);
		if (!re.test(val)) {
			t.val(0);
		}
	})

	// 支付方式
	$('.rewardS-pay-way ul li').click(function(){
		$(this).addClass('on').siblings('li').removeClass('on');
	})

	//打开
	$("#NewList32").delegate('.shang','click',function(){


					$('.rewardS-pay').show(); $('.rewardS-mask').show();

	})

	//关闭
	$('.rewardS-pay-tit .close').click(function(){
		$('.rewardS-pay').hide(); $('.rewardS-mask').hide();
	})

	//立即支付
	$('.rewardS-pay .rewardS-sumbit a').bind("click", function(event){
		var t = $(this);
		var amount = rewardInput.val();
		var regu = "(^[1-9]([0-9]?)+[\.][0-9]{1,2}?$)|(^[1-9]([0-9]+)?$)|(^[0][\.][0-9]{1,2}?$)";
		var re = new RegExp(regu);
		if (!re.test(amount)) {
			event.preventDefault();
			alert("打赏金额格式错误，最少0.01元！");
		}

		var paytype = $(".rewardS-pay-way .on").data("type");
		if(paytype == "" || paytype == undefined || paytype == null){
			event.preventDefault();
			alert("请选择支付方式！");
		}

		var url = t.data("url").replace("$amount", amount).replace("$paytype", paytype);
		t.attr("href", url);
		$('.rewardS-pay-tit .close').click();

	})

});

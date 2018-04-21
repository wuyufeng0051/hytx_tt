$(function(){

	//登录成功向客户端发送passport
	setTimeout(function(){
		setupWebViewJavascriptBridge(function(bridge) {
			bridge.callHandler('appLoginFinish', {'passport': userid}, function(){});

			//退出
			$(".logout").bind("click", function(){
				bridge.callHandler('appLogout', {}, function(){});
			});
		});
	}, 500);


	//开工
	$(".kaiGuan").bind("click", function(){
		var t = $(this), state = 1, title = "开工啦";
		if(t.hasClass("kaiGuan01")){
			state = 0;
			title = "收工啦";
			t.removeClass("kaiGuan01");
		}else{
			t.addClass("kaiGuan01");
		}

		$('.youqingTixing').html('<i>'+title+'</i>').show();
		setTimeout(function(){
			$(".youqingTixing").hide();
		}, 1000);

		$.ajax({
            url: '/include/ajax.php?service=waimai&action=updateCourierState',
            data: {
				state: state
            },
            type: 'get',
            dataType: 'json',
            success: function(data){
				location.reload();
			}
		});

	});


	// 外卖→配送→点击取货
	$('.lianxiFangs .bG04').click(function(){
		$(this).hide();
		$(this).siblings('.bG05').show();
		$(this).closest('.lianxiFangs').siblings('.dingNum').find('.bfColor').hide();
		$(this).closest('.lianxiFangs').siblings('.dingNum').find('.bfColor01').show();
		// 提示1秒后消失 setTimeout用法
		$('.youqingTixing .youqingTixing01').show();
		setTimeout("$('.youqingTixing .youqingTixing01').hide()",1000);
	})

	//更新状态
	$(".reTry").delegate(".bG04, .bG05", "click", function(){
		var t = $(this), id = t.closest(".successFul").attr("data-id"), state = t.attr("data-state");
		if(t.hasClass("disabled") || !id) return false;

		t.addClass("disabled");
		$('.youqingTixing').html('<i>操作中...</i>').show();

		$.ajax({
            url: '/include/ajax.php?service=waimai&action=peisong',
            data: {
                id: id,
				state: state
            },
            type: 'get',
            dataType: 'json',
            success: function(data){
				if(data && data.state == 100){
					$('.youqingTixing').html('<i>操作成功！</i>').show();
					setTimeout(function(){
						location.reload();
					}, 1000);
				}else{
					t.removeClass("disabled");
					$('.youqingTixing').html('<i>'+data.info+'</i>').show();
					setTimeout(function(){
						$(".youqingTixing").hide();
					}, 2000);
				}
			},
			error: function(){
				t.removeClass("disabled");
				$('.youqingTixing').html('<i>网络错误，操作失败！</i>').show();
				setTimeout(function(){
					$(".youqingTixing").hide();
				}, 2000);
			}
		});
	});

	//点击抢单
	$(".reTry").delegate(".qiangDan", "click", function(){
		var t = $(this), id = t.closest(".successFul").attr("data-id");
		if(t.hasClass("disabled") || !id) return false;

		t.addClass("disabled");
		$('.youqingTixing').html('<i>抢单中...</i>').show();

		$.ajax({
            url: '/include/ajax.php?service=waimai&action=qiangdan',
            data: {
                id: id
            },
            type: 'get',
            dataType: 'json',
            success: function(data){
				if(data && data.state == 100){
					$('.youqingTixing').html('<i>抢单成功！</i>').show();
					setTimeout(function(){
						location.reload();
					}, 1000);
				}else{
					t.removeClass("disabled");
					$('.youqingTixing').html('<i>'+data.info+'</i>').show();
					setTimeout(function(){
						$(".youqingTixing").hide();
					}, 2000);
				}
			},
			error: function(){
				t.removeClass("disabled");
				$('.youqingTixing').html('<i>网络错误，抢单失败！</i>').show();
				setTimeout(function(){
					$(".youqingTixing").hide();
				}, 2000);
			}
		});
	});

	// 下拉加载回调方法
	new DragLoading($('.loading'), {
		onReload: function () {
			var self = this;
			setTimeout(function () {
				var index = $('.stateNow .daiQiang').index();
				$('.swiper-wrapper .swiper-slide').eq(index).html("");
				// location.reload();
				getData();
				self.origin();
			}, 2000 * Math.random());
		}
	});



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
			return (hour+":"+minute);
		}else{
			return 0;
		}
	}
	var navbar = $('.stateNow ');
	var navHeight = navbar.offset().top;
	// 左右滑动切换
	var tabsSwiper = new Swiper('#tabs-container',{
	    speed:350,
	    preventClicks : false,
	    autoHeight: true,
			touchAngle : 35,
	    onSlideChangeStart: function(){
			loadMoreLock = false;
		  $(".stateNow .daiQiang").removeClass('daiQiang');
	      $(".stateNow a").eq(tabsSwiper.activeIndex).addClass('daiQiang');
	        	$(window).scrollTop(navHeight);

	        	$("#tabs-container .swiper-slide").eq(tabsSwiper.activeIndex).css('height', 'auto').siblings('.swiper-slide').height($(window).height());

				// 当模块的数据为空的时候加载数据
				if($.trim($("#tabs-container .swiper-slide").eq(tabsSwiper.activeIndex).html()) == ""){

					getData();
					
				}

	    },
	    onSliderMove: function(){
	      // isload = true;
	    },
	    onSlideChangeEnd: function(swiper){
	      // isload = false;
	      	// var x = $('.stateNow a').index();
	      	// if (x == 0) {
	      	// 	location.href = "/?service=waimai&do=courier&state=3"
	      	// }else if(x == 1){
	      	// 	location.href = "/?service=waimai&do=courier&state=4,5"
	      	// };
	        
	    }
	})
	$(".stateNow a").on('touchstart mousedown',function(e){
	    e.preventDefault();
	    $(".stateNow .active").removeClass('daiQiang');
	    $(this).addClass('daiQiang');
	    tabsSwiper.slideTo( $(this).index() );

	})
	$(".stateNow a").click(function(e){
		e.preventDefault();
	})
  // 导航吸顶
	$(window).on("scroll", function(){
		var sct = $(window).scrollTop();

		if(sct + $(window).height() + 50 > $(document).height() && !loadMoreLock) {
        var page = parseInt($('.stateNow .daiQiang').attr('data-page')),
            totalPage = parseInt($('.stateNow .daiQiang').attr('data-totalPage'));
        if(page < totalPage) {
			++page;
			$('.stateNow .daiQiang').attr('data-page', page);
			getList();
        }
    }

	});

	//加载数据
	var isload, page = 1, pageSize = 4;
	function getData(){
	    var active = $('.stateNow .daiQiang'), action = active.attr('data-action') ,url;
	    var page = active.attr('data-page');
		//未开工不可以抢单
		if(state == 3 && courier_state == 0){
			return false;
		}


		// //暂时不显示待抢订单
		// if(state == 3){
		// 	return false;
		// }
		
		if (action == "robbed") {
	      url = "/include/ajax.php?service=waimai&action=courierOrderList&page="+page+"&pageSize="+pageSize+"&state="+3;
	    }else if (action == "distribution") {
	      url = "/include/ajax.php?service=waimai&action=courierOrderList&page="+page+"&pageSize="+pageSize+"&state="+4;
	    }else if (action == "succeed") {
	      url = "/include/ajax.php?service=waimai&action=courierOrderList&page="+page+"&pageSize="+pageSize+"&state="+1;
	    }else if (action == "Failure") {
	      url = "/include/ajax.php?service=waimai&action=courierOrderList&page="+page+"&pageSize="+pageSize+"&state="+7;
	    }

		isload = true;

		$(".load").remove();
		$(".show01").append('<div class="load">加载中...</div>');

		//异步提交
		$.ajax({
			url: url,
			type: "GET",
			dataType: "json",
			success: function (data) {
				if(data){
					if(data.state == 100){

						$(".load").remove();
						$(".youqingTixing").hide();

						var pageInfo = data.info.pageInfo, list = data.info.list;
						var robbed = [] , distribution = [] , succeed = [] , Failure = [];
						var totalPage = data.info.pageInfo.totalPage;
						active.attr('data-totalPage', totalPage);

						for (var i = 0; i < list.length; i++) {
							var d = list[i];

							//待抢
							if(action == "robbed"){
								robbed.push('<div class="successFul yaowuli successFul01" data-id="'+d.id+'">');
				        		robbed.push('<div class="layOut fn-clear layOut02">');
			        			robbed.push('<p>'+(d.juliShop > 1000 ? (d.juliShop/1000).toFixed(2) + "千米" : d.juliShop + "米")+'</p>');
			        			robbed.push('<p>118米</p>');
			        			robbed.push('<p class="lastOne">'+transTimes(d.pubdate, 4)+'</p>');
				        		robbed.push('</div>');
				        		robbed.push('<div class="layOut fn-clear layOut01">');
			        			robbed.push('<p>距离店铺</p>');
			        			robbed.push('<p>店铺距离顾客</p>');
			        			robbed.push('<p>配送时间</p>');
				        		robbed.push('</div>');
				        		robbed.push('<div class="dingNum03 fn-clear">');
			        			robbed.push('<p class="dingNum04 dingNum05"><a href="javascript:;"><img src="/static/images/store.png"></a></p>');
			        			robbed.push('<div class="dingNum04"><p><a href="javascript:;">'+d.shopname+'</a></p><span><a href="javascript:;">'+d.address1+'</a></span></div>');
								robbed.push('<div class="dingNum06"><a href="javascript:;" class="showmap" data-lng="'+d.coordY+'" data-lat="'+d.coordX+'" data-title="'+d.shopname+'" data-address="'+d.address1+'"><img src="/static/images/location.png"></a></div>');
				        		robbed.push('</div>');
				        		robbed.push('<div class="dingNum03 fn-clear">');
			        			robbed.push('<p class="dingNum04 dingNum05"><a href="javascript:;"><img src="/static/images/itsme.png"></a></p>');
			        			robbed.push('<div class="dingNum04"><p><a href="javascript:;">'+d.person+'&nbsp;&nbsp;'+d.tel+'</a></p><span><a href="javascript:;">送至：'+d.address+'</a></span></div>');
								robbed.push('<div class="dingNum06"><a href="javascript:;" class="showmap" data-lng="'+d.lng+'" data-lat="'+d.lat+'" data-title="'+d.person+'" data-address="'+d.address+'"><img src="/static/images/nav.png"></a></div>');
				        		robbed.push('</div>');
				        		robbed.push('<div class="qiangDan">');
			        			robbed.push('<a href="javascript:;">抢单</a>');
				        		robbed.push('</div>');
					        	robbed.push('</div>');
							}

							//配送
							if(action == "distribution"){
								distribution.push('<div class="successFul zhengti01 successFul01" data-id="'+d.id+'">');
								distribution.push('<ul class="fn-clear dingNum">');
								distribution.push('<li class="dingNum01"><a href="/index.php?service=waimai&do=courier&template=detail&id='+d.id+'">订单号：'+d.ordernum+'</a></li>');
								distribution.push('<li class="dingNum02'+(d.state == 4 ? " bfColor" : " bfColor01")+'"><a href="/index.php?service=waimai&do=courier&template=detail&id='+d.id+'">'+(d.state == 4 ? "未取货" : "配送中")+'</a></li>');
								distribution.push('</ul>');
								distribution.push('<div class="dingNum03 fn-clear">');
								distribution.push('<p class="dingNum04 dingNum05"><a href="/index.php?service=waimai&do=courier&template=detail&id='+d.id+'"><img src="/static/images/store.png"></a></p>');
								distribution.push('<div class="dingNum04">');
								distribution.push('<p><a href="/index.php?service=waimai&do=courier&template=detail&id='+d.id+'">'+d.shopname+'</a></p>');
								distribution.push('<span><a href="/index.php?service=waimai&do=courier&template=detail&id='+d.id+'">'+d.address1+'</a></span>');
								distribution.push('</div>');
								distribution.push('<div class="dingNum06"><a href="javascript:;" class="showmap" data-lng="'+d.coordY+'" data-lat="'+d.coordX+'" data-title="'+d.shopname+'" data-address="'+d.address1+'"><img src="/static/images/location.png"></a></div>');
								distribution.push('</div>');
								distribution.push('<div class="dingNum03 fn-clear">');
								distribution.push('<p class="dingNum04 dingNum05"><a href="/index.php?service=waimai&do=courier&template=detail&id='+d.id+'"><img src="/static/images/itsme.png"></a></p>');
								distribution.push('<div class="dingNum04">');
								distribution.push('<p><a href="/index.php?service=waimai&do=courier&template=detail&id='+d.id+'">'+d.person+'&nbsp;&nbsp;'+d.tel+'</a></p>');
								distribution.push('<span><a href="/index.php?service=waimai&do=courier&template=detail&id='+d.id+'">送至：'+d.address+'</a></span>');
								distribution.push('</div>');
								distribution.push('<div class="dingNum06"><a href="javascript:;" class="showmap" data-lng="'+d.lng+'" data-lat="'+d.lat+'" data-title="'+d.person+'" data-address="'+d.address+'"><img src="/static/images/nav.png"></a></div>');
								distribution.push('</div>');
								distribution.push('<div class="lianxiFangs fn-clear">');

								if(d.state == 5){
									distribution.push('<a href="javascript:;" class="bG03 bG05 left" style="margin-right: 0.3rem;" data-state="1">确认成功</a>');
								}

								distribution.push('<a href="tel:'+d.phone+'" class="bG01"><i></i> <span>店铺</span></a>');
								distribution.push('<a href="tel:'+d.tel+'" class="bG01 bG02"'+(d.state == 5 ? 'style="margin-right: 0"' : "")+'><i></i> <span>顾客</span></a>');

								if(d.state == 4){
									distribution.push('<a href="javascript:;" class="bG03 bG04" data-state="5">取货</a>');
								}

								distribution.push('</div></div>');
							}

							//成功
							if(action == "succeed"){
								succeed.push('<div class="successFul successFul01">');
								succeed.push('<ul class="fn-clear dingNum">');
								succeed.push('<li class="dingNum01"><a href="/index.php?service=waimai&do=courier&template=detail&id='+d.id+'">订单号：'+d.ordernum+'</a></li>');
								succeed.push('<li class="dingNum02"><a href="javascript:;">成功</a></li>');
								succeed.push('</ul>');
								succeed.push('<div class="dingNum03 fn-clear">');
								succeed.push('<p class="dingNum04 dingNum05"><a href="/index.php?service=waimai&do=courier&template=detail&id='+d.id+'"><img src="/static/images/store.png"></a></p>');
								succeed.push('<div class="dingNum04">');
								succeed.push('<p><a href="/index.php?service=waimai&do=courier&template=detail&id='+d.id+'">'+d.shopname+'</a></p>');
								succeed.push('<span><a href="/index.php?service=waimai&do=courier&template=detail&id='+d.id+'">'+d.address1+'</a></span>');
								succeed.push('</div>');
								succeed.push('<div class="dingNum06"><a href="javascript:;" class="showmap" data-lng="'+d.coordY+'" data-lat="'+d.coordX+'" data-title="'+d.shopname+'" data-address="'+d.address1+'"><img src="/static/images/location.png"></a></div>');
								succeed.push('</div>');
								succeed.push('<div class="dingNum03 fn-clear xiangJun">');
								succeed.push('<p class="dingNum04 dingNum05"><a href="/index.php?service=waimai&do=courier&template=detail&id='+d.id+'"><img src="/static/images/itsme.png"></a></p>');
								succeed.push('<div class="dingNum04">');
								succeed.push('<p><a href="/index.php?service=waimai&do=courier&template=detail&id='+d.id+'">'+d.person+'&nbsp;&nbsp;'+d.tel+'</a></p>');
								succeed.push('<span><a href="/index.php?service=waimai&do=courier&template=detail&id='+d.id+'">送至：'+d.address+'</a></span>');
								succeed.push('</div>');
								succeed.push('<div class="dingNum06"><a href="javascript:;" class="showmap" data-lng="'+d.lng+'" data-lat="'+d.lat+'" data-title="'+d.person+'" data-address="'+d.address+'"><img src="/static/images/nav.png"></a></div>');
								succeed.push('</div>');
								succeed.push('</div>');
							}

							//失败
							if(action == "Failure"){
								Failure.push('<div class="successFul successFul01">');
								Failure.push('<ul class="fn-clear dingNum">');
								Failure.push('<li class="dingNum01"><a href="/index.php?service=waimai&do=courier&template=detail&id='+d.id+'">订单号：'+d.ordernum+'</a></li>');
								Failure.push('<li class="dingNum02 fail"><a href="javascript:;">失败</a></li>');
								Failure.push('</ul>');
								Failure.push('<div class="dingNum03 fn-clear">');
								Failure.push('<p class="dingNum04 dingNum05"><a href="/index.php?service=waimai&do=courier&template=detail&id='+d.id+'"><img src="/static/images/store.png"></a></p>');
								Failure.push('<div class="dingNum04">');
								Failure.push('<p><a href="/index.php?service=waimai&do=courier&template=detail&id='+d.id+'">'+d.shopname+'</a></p>');
								Failure.push('<span><a href="/index.php?service=waimai&do=courier&template=detail&id='+d.id+'">'+d.address1+'</a></span>');
								Failure.push('</div>');
								Failure.push('<div class="dingNum06"><a href="javascript:;" class="showmap" data-lng="'+d.coordY+'" data-lat="'+d.coordX+'" data-title="'+d.shopname+'" data-address="'+d.address1+'"><img src="/static/images/location.png"></a></div>');
								Failure.push('</div>');
								Failure.push('<div class="dingNum03 fn-clear xiangJun">');
								Failure.push('<p class="dingNum04 dingNum05"><a href="/index.php?service=waimai&do=courier&template=detail&id='+d.id+'"><img src="/static/images/itsme.png"></a></p>');
								Failure.push('<div class="dingNum04">');
								Failure.push('<p><a href="/index.php?service=waimai&do=courier&template=detail&id='+d.id+'">'+d.person+'&nbsp;&nbsp;'+d.tel+'</a></p>');
								Failure.push('<span><a href="/index.php?service=waimai&do=courier&template=detail&id='+d.id+'">送至：'+d.address+'</a></span>');
								Failure.push('</div>');
								Failure.push('<div class="dingNum06"><a href="javascript:;" class="showmap" data-lng="'+d.lng+'" data-lat="'+d.lat+'" data-title="'+d.person+'" data-address="'+d.address+'"><img src="/static/images/nav.png"></a></div>');
								Failure.push('</div>');
								Failure.push('</div>');
							}
						}

						$('.xuanXiang .reTry .robbed').append(robbed.join(""));
						$('.xuanXiang .reTry .distribution').append(distribution.join(""));
						$('.xuanXiang .reTry .succeed').append(succeed.join(""));
						$('.xuanXiang .reTry .Failure').append(Failure.join(""));

						if(pageInfo.totalPage > page){
							isload = 0;
							++page;
						}

					}else{
						isload = 0;
						$(".youqingTixing").html('<i>'+data.info+'</i>').show();
						$(".load").remove();
						setTimeout(function(){
							$(".youqingTixing").hide();
						}, 2000);

						$('.xuanXiang .reTry').html('<button class="reload">点击刷新</button>');
					}
				}else{
					isload = 0;
					$(".youqingTixing").html('<i>获取失败！</i>').show();
					$(".load").remove();
					setTimeout(function(){
						$(".youqingTixing").hide();
					}, 2000);

					$('.xuanXiang .reTry').html('<button class="reload">点击刷新</button>');
				}
			},
			error: function(){
				isload = 0;
				$(".youqingTixing").html('<i>网络错误，登录失败！</i>').show();
				$(".load").remove();
				setTimeout(function(){
					$(".youqingTixing").hide();
				}, 2000);

				$('.xuanXiang .reTry').html('<button class="reload">点击刷新</button>');
			}

		});
	}

	//页面加载获取数据
	getData();

	// 滚动到底部加载
	$(window).scroll(function(){
	  	var totalHeight = $(document).height();
	  	var windowHeight = $(window).height();
	  	var topHeight = $(window).scrollTop();
	  	if(topHeight >= totalHeight - windowHeight - 50 && !isload){
			getData();
	  	}
	});


	//注册客户端webview
    function setupWebViewJavascriptBridge(callback){
      if(window.WebViewJavascriptBridge){
        return callback(WebViewJavascriptBridge);
      }else{
        document.addEventListener("WebViewJavascriptBridgeReady", function() {
          return callback(WebViewJavascriptBridge);
        }, false);
      }

      if(window.WVJBCallbacks){return window.WVJBCallbacks.push(callback);}
      window.WVJBCallbacks = [callback];
      var WVJBIframe = document.createElement("iframe");
      WVJBIframe.style.display = "none";
      WVJBIframe.src = "wvjbscheme://__BRIDGE_LOADED__";
      document.documentElement.appendChild(WVJBIframe);
      setTimeout(function(){document.documentElement.removeChild(WVJBIframe) }, 0);
    }

	setupWebViewJavascriptBridge(function(bridge) {
    	$(".xuanXiang .reTry").delegate(".showmap", "click", function(){
			var t = $(this), lng = t.attr("data-lng"), lat = t.attr("data-lat"), title = t.attr("data-title"), address = t.attr("data-address");
    		if (lat != "" && lng != "") {
		        bridge.callHandler("skipAppMap", {
		            "lat": lat,
		            "lng": lng,
		            "addrTitle": title,
		            "addrDetail": address
		        }, function(responseData) {});
	        }
    	})
    });

	//小地图
	// $(".xuanXiang .reTry").delegate(".showmap", "click", function(){
	// 	var t = $(this), lng = t.attr("data-lng"), lat = t.attr("data-lat");
	// 	if(lng && lat){
	// 		$(".mapPath").show();
	// 		var map = new BMap.Map("mapPath");
	// 		var mPoint = new BMap.Point(lng, lat);
	// 		var marker = new BMap.Marker(mPoint);
	// 		map.centerAndZoom(mPoint, 16);
	// 		map.addOverlay(marker);
	// 	}
	// });
	//
	// //关闭大地图
	// $("#closeMap").bind("click", function(){
	// 	$(".mapPath").hide();
	// });

	//点击刷新
	// $(".xuanXiang .reTry").delegate(".reload", "click", function(){
	// 	location.reload();
	// });

})

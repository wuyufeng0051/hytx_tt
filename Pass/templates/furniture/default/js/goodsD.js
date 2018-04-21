$(function(){

	var loadComm = 0;

	 //商品列表--商品放大镜
	$(".jqzoom").imagezoom();

	$("#thumblist li a").click(function(){
		$(this).parents("li").addClass("tb-selected").siblings().removeClass("tb-selected");
		$(".jqzoom").attr('src',$(this).find("img").attr("mid"));
		$(".jqzoom").attr('rel',$(this).find("img").attr("big"));
	});
	//商品列表--商品详情页--商品评价的好评中评差评的选择
	$(".detailComment .left a").on("click",function(){
		var $a=$(this), i=$a.index();
		$a.addClass("on").siblings("a").removeClass("on");
		$(".allCon .con").eq(i).show().siblings(".con").hide();
		if(i == 1 && !loadComm){
			getComments();
		}
	});

	//---------------------------异步加载评价列表------------------------------------------

	var atpage = 1, totalCount = 0, pageSize = 20;
	var ratelist = $(".all-comment"), loading = $(".loading"), ul = $("#comment-list");

	$(".all-comment .commentSel a").on("click",function(){
		$(this).addClass("on").siblings("a").removeClass("on");
		atpage = 1;
		getComments();
	})

	//初始点击定位当前位置
	$("html").delegate(".carousel .thumb li", "click", function(){
		var t = $(this), carousel = t.closest(".carousel"), album = carousel.find(".album");
		if(album.is(":hidden")){
			t.addClass("on");
			$('html, body').animate({scrollTop: carousel.offset().top - 45}, 300);
			album.show();
		}
	});

	//收起图集
	$("html").delegate(".carousel .close", "click", function(){
		var t = $(this), carousel = t.closest(".carousel"), thumb = carousel.find(".thumb"), album = carousel.find(".album");
		album.hide();
		thumb.find(".on").removeClass("on");
	});

	//获取评价
	function getComments(){

		loading.show();
		ul.html("");
		loadComm = 1;

		var data = [];
		data.push('id='+detailID);
		data.push('page='+atpage);
		data.push('pageSize='+pageSize);
		data.push('filter='+$(".all-comment .commentSel .on").data("filter"));

		$.ajax({
			url: masterDomain+"/include/ajax.php?service=furniture&action=common",
			data: data.join("&"),
			type: "POST",
			dataType: "jsonp",
			success: function (data) {

				loading.hide();
				if(data && data.state == 100){

					var list = data.info.list,
							pageinfo = data.info.pageInfo,
							html = [];

					totalCount = pageinfo.totalCount;
					for(var i = 0; i < list.length; i++){
						html.push('<li class="rate-item clearfix">');
						html.push('<div class="user-info">');

						var photo = list[i].user.photo == "" ? staticPath+'images/noPhoto_40.jpg' : list[i].user.photo;

						html.push('<img class="avatar" src="'+photo+'" />');
						html.push('<p>'+list[i].user.nickname+'</p>');
						html.push('</div>');
						html.push('<div class="review">');
						html.push('<div class="info">');

						rat = parseInt(list[i].rating);
						rating = "";
						switch (rat) {
							case 1:
								rating = "好评";
								break;
							case 2:
								rating = "中评";
								break;
							case 3:
								rating = "差评";
								break;
						}
						html.push('<span class="rating rating'+rat+'">'+rating+'</span>');
						html.push('<span class="time">'+huoniao.transTimes(list[i].dtime, 2)+'</span>');
						html.push('</div>');
						html.push('<div class="view">');
						html.push('<p>'+list[i].content+'</p>');

						//图集
						var pics = list[i].pics;
						if(pics.length > 0){
							var thumbArr = [], albumArr = [];
							for(var p = 0; p < pics.length; p++){
								thumbArr.push('<li><a href="javascript:;"><img src="'+huoniao.changeFileSize(pics[p], "small")+'" /></a></li>');
								albumArr.push('<div class="aitem"><i></i><img src="'+pics[p]+'" /></div>');
							}

							html.push('<div class="carousel">');
							html.push('<div class="thumb">');
							html.push('<div class="plist">');
							html.push('<ul>'+thumbArr.join("")+'<ul>');
							html.push('</div>');

							if(pics.length > 7){
								html.push('<a href="javascript:;" class="sprev"><i></i></a>');
								html.push('<a href="javascript:;" class="snext"><i></i></a>');
							}
							html.push('</div>');
							html.push('<div class="album">');
							html.push('<a href="javascript:;" hidefocus="true" class="prev"></a>');
							html.push('<a href="javascript:;" hidefocus="true" class="close"></a>');
							html.push('<a href="javascript:;" hidefocus="true" class="next"></a>');
							html.push('<div class="albumlist">'+albumArr.join("")+'</div>');
							html.push('</div>');
							html.push('</div>');
						}

						html.push('</div>');
						html.push('</div>');
						html.push('</li>');
					}

					ul.html(html.join(""));
					showPageInfo();

					//切换效果
					ul.find(".carousel").each(function(){
						var t = $(this), album = t.find(".album");
						//大图切换
						t.slide({
							titCell: ".plist li",
							mainCell: ".albumlist",
							trigger:"click",
							autoPlay: false,
							delayTime: 0,
							startFun: function(i, p) {
								if (i == 0) {
									t.find(".sprev").click()
								} else if (i % 8 == 0) {
									t.find(".snext").click()
								}
							}
						});
						//小图左滚动切换
						t.find(".thumb").slide({
							mainCell: "ul",
							delayTime: 300,
							vis: 10,
							scroll: 8,
							effect: "left",
							autoPage: true,
							prevCell: ".sprev",
							nextCell: ".snext",
							pnLoop: false
						});
					});
					$(".carousel .thumb li.on").removeClass("on");

				}else{
					ul.html('<li class="empty">'+data.info+'</li>');
				}
			},
			error: function(){
				loading.hide();
				ul.html('<li class="empty">网络错误，加载失败！</li>');
			}
		});
	}



	//分页
	function showPageInfo() {
		var info = $(".comment-list .pagination");
		var nowPageNum = atpage;
		var allPageNum = Math.ceil(totalCount/pageSize);
		var pageArr = [];

		info.html("").hide();

		var pages = document.createElement("div");
		pages.className = "pagination-pages fn-clear";
		info.append(pages);

		//拼接所有分页
		if (allPageNum > 1) {

			//上一页
			if (nowPageNum > 1) {
				var prev = document.createElement("a");
				prev.className = "prev";
				prev.innerHTML = '上一页';
				prev.onclick = function () {
					atpage = nowPageNum - 1;
					getComments();
				}
				info.find(".pagination-pages").append(prev);
			}

			//分页列表
			if (allPageNum - 2 < 1) {
				for (var i = 1; i <= allPageNum; i++) {
					if (nowPageNum == i) {
						var page = document.createElement("span");
						page.className = "curr";
						page.innerHTML = i;
					} else {
						var page = document.createElement("a");
						page.innerHTML = i;
						page.onclick = function () {
							atpage = Number($(this).text());
							getComments();
						}
					}
					info.find(".pagination-pages").append(page);
				}
			} else {
				for (var i = 1; i <= 2; i++) {
					if (nowPageNum == i) {
						var page = document.createElement("span");
						page.className = "curr";
						page.innerHTML = i;
					}
					else {
						var page = document.createElement("a");
						page.innerHTML = i;
						page.onclick = function () {
							atpage = Number($(this).text());
							getComments();
						}
					}
					info.find(".pagination-pages").append(page);
				}
				var addNum = nowPageNum - 4;
				if (addNum > 0) {
					var em = document.createElement("span");
					em.className = "interim";
					em.innerHTML = "...";
					info.find(".pagination-pages").append(em);
				}
				for (var i = nowPageNum - 1; i <= nowPageNum + 1; i++) {
					if (i > allPageNum) {
						break;
					}
					else {
						if (i <= 2) {
							continue;
						}
						else {
							if (nowPageNum == i) {
								var page = document.createElement("span");
								page.className = "curr";
								page.innerHTML = i;
							}
							else {
								var page = document.createElement("a");
								page.innerHTML = i;
								page.onclick = function () {
									atpage = Number($(this).text());
									getComments();
								}
							}
							info.find(".pagination-pages").append(page);
						}
					}
				}
				var addNum = nowPageNum + 2;
				if (addNum < allPageNum - 1) {
					var em = document.createElement("span");
					em.className = "interim";
					em.innerHTML = "...";
					info.find(".pagination-pages").append(em);
				}
				for (var i = allPageNum - 1; i <= allPageNum; i++) {
					if (i <= nowPageNum + 1) {
						continue;
					}
					else {
						var page = document.createElement("a");
						page.innerHTML = i;
						page.onclick = function () {
							atpage = Number($(this).text());
							getComments();
						}
						info.find(".pagination-pages").append(page);
					}
				}
			}

			//下一页
			if (nowPageNum < allPageNum) {
				var next = document.createElement("a");
				next.className = "next";
				next.innerHTML = '下一页';
				next.onclick = function () {
					atpage = nowPageNum + 1;
					getComments();
				}
				info.find(".pagination-pages").append(next);
			}

			//输入跳转
			var insertNum = Number(nowPageNum + 1);
			if (insertNum >= Number(allPageNum)) {
				insertNum = Number(allPageNum);
			}

			var redirect = document.createElement("div");
			redirect.className = "redirect";
			redirect.innerHTML = '<i>到</i><input id="prependedInput" type="number" placeholder="页码" min="1" max="'+allPageNum+'" maxlength="4"><i>页</i><button type="button" id="pageSubmit">确定</button>';
			info.find(".pagination-pages").append(redirect);

			//分页跳转
			info.find("#pageSubmit").bind("click", function(){
				var pageNum = $("#prependedInput").val();
				if (pageNum != "" && pageNum >= 1 && pageNum <= Number(allPageNum)) {
					atpage = Number(pageNum);
					getComments();
				} else {
					$("#prependedInput").focus();
				}
			});

			info.show();

		}else{
			info.hide();
		}
	}




		//倒计时
		var now = date[0], stime = date[1], etime = date[2], state = 1, summary = $(".singleGoods"), btns = summary.find(".cartBuy"), expiry = summary.find(".expiry");
		//还未开始
		if(now < stime){
			state = 2;
			btns.find(".buyNow").html("还未开始");

		//已结束
		}else if(now > etime){
			state = 3;
			btns.find(".buyNow").html("已结束");
		}
		if(state > 1)	btns.find("a").addClass("disabled"),btns.find(".cart").hide();

		var timeCompute = function (a, b) {
			if (this.time = a, !(0 >= a)) {
				for (var c = [86400 / b, 3600 / b, 60 / b, 1 / b], d = .1 === b ? 1 : .01 === b ? 2 : .001 === b ? 3 : 0, e = 0; d > e; e++) c.push(b * Math.pow(10, d - e));
				for (var f, g = [], e = 0; e < c.length; e++) f = Math.floor(a / c[e]),
				g.push(f),
				a -= f * c[e];
				return g
			}
		}
		,CountDown =	function(a) {
			this.time = a,
			this.countTimer = null,
			this.run = function(a) {
				var b, c = this;
				this.countTimer = setInterval(function() {
					b = timeCompute.call(c, c.time - 1, 1);
					b || (clearInterval(c.countTimer), c.countTimer = null);
					"function" == typeof a && a(b || [0, 0, 0, 0, 0], !c.countTimer)
				}, 1000);
			}
		};

		var begin = stime - now;
		var end   = etime - now;
		var time  = begin > 0 ? begin : end > 0 ? end : 0;

		var timeTypeText = '距开始';
		if(begin < 0 && end < 0 ){
			timeTypeText = '剩余';
		}else if (begin > 0 && end > 0) {
			timeTypeText = '距开始';
		} else if(begin < 0 && end > 0) {
			timeTypeText = '剩余';
		}
		var countDown = new CountDown(time);
		if(date.length > 0){
			countDownRun();
		}

		function countDownRun(time) {
			time && (countDown.time = time);
			countDown.run(function(times, complete) {
				var html = ''+timeTypeText + ' ' + times[0] +	' 天 ' + times[1] + ' 小时 ' + times[2] + ' 分 ' + times[3] + ' 秒';
				expiry.html(html);
				if (complete) {
					if(begin < 0 && end < 0 ){
						btns.find("a").addClass("disabled"),btns.find(".cart").hide();
						btns.find(".buyNow").html("已结束");
					}else if (begin > 0) {
						btns.find("a").removeClass("disabled"),btns.find(".cart").show();
						btns.find(".buyNow").html("立即抢购");
						timeTypeText = '剩余';
						countDownRun(etime - stime);
						begin = null;
					} else {
						btns.find("a").addClass("disabled"),btns.find(".cart").hide();
						if( begin === null || begin <= 0 ){
							btns.find(".buyNow").html("已结束");
						}else{
							btns.find(".buyNow").html("还未开始");
						}
					}
				}
			});
		}



		//商品详情页--数量的加减

		//加
		$(".singleGoods li .num i.up").on("click",function(){
			var $c=$(this),value=parseInt($c.siblings("input").val());
			if(value<maxCount && maxCount != 0){
				value=value+1;
				$c.siblings("input").val(value);
				if(value>maxCount){ //如果数量大于库存，则提示超过当前库存
					$(".singleGoods .count cite").show();
				}
			}
		})

		//减
		$(".singleGoods li .num i.down").on("click",function(){
			var $c=$(this),value=parseInt($c.siblings("input").val());
			if(value>1){
				value=value-1;
				$c.siblings("input").val(value);
				if(value<maxCount){ //如果数量小于库存，则关闭提示
					$(".singleGoods .count cite").hide();
				}
			}
		})


		//加入购物车及加入购物车判断
		$(".singleGoods dd.cartBuy a.cart").on("click",function(event){
			var $buy=$(this);
			if($buy.hasClass("disabled")) return false;
			var inputValue = parseInt($(".singleGoods .num input").val());     //需要购买商品的数量
			if(inputValue < maxCount  && inputValue > 0){       //如果属性全选上，且数量小于库存，则执行购物车动作，加入对应的商品

				//加入购物车动画
	 			$(".singleGoods dd.info ul").removeClass("on");
   			var offset = $(".topcart .cart-btn .icon").offset();
	      var img = detailThumb; //获取当前点击图片链接
	      var flyer = $('<img class="flyer-img" src="' + img + '">'); //抛物体对象
	      var t = $(this).offset(), scH = $(window).scrollTop();
        flyer.fly({
            start: {
                left: t.left+50,//抛物体起点横坐标
                top: t.top-scH-20 //抛物体起点纵坐标
            },
            end: {
                left: offset.left + 12,//抛物体终点横坐标
                top: offset.top-scH, //抛物体终点纵坐标
                width:20,
                height:20,
                borderRadius:10
            },
            onEnd: function() {
            	var $i = $("<b class='flyend'>").text("+1");
							var x =22, y = 0;
							setTimeout(function(){
								$(".topcart").append($i);
								$i.animate({top: y - 50, opacity: 0}, 500, function(){
									$i.remove();
								});
							}, 300);

              this.destroy(); //销毁抛物体
            }
        });

		    //操作购物车
				var goodsdata   = [];
				goodsdata.id    = detailID;       //商品编码
				goodsdata.title = detailTitle;	  //商品标题
				goodsdata.thumb = detailThumb;    //缩略图
				goodsdata.price = detailPrice;    //商品价格
				goodsdata.count = inputValue;     //商品数量
				goodsdata.url   = detailUrl;      //商品链接
				furnitureInit.add(goodsdata);

			}
		});

		//立即购买判断
		$(".singleGoods dd.cartBuy a.buyNow").on("click",function(event){
			var $buy=$(this);
			if($buy.hasClass("disabled")) return false;
			inputValue=parseInt($(".singleGoods .num input").val());

			//验证登录
			var userid = $.cookie(cookiePre+"login_user");
			if(userid == null || userid == ""){
				huoniao.login();
				return false;
			}

			if(inputValue<maxCount){
				$("#pros").val(detailID+","+inputValue);
				$("#buyForm").submit();
			}
		})


});

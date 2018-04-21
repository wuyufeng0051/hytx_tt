$(function() {
	$('.choose-tab li').click(function() {
		var thisli = $(this)
		var index = $(this).index();
		if ($('.choose-slide').eq(index).css("display") == "none") {
			$(this).addClass('active').siblings().removeClass('active');
			$('.mask,.white').show();
			$('.choose-slide').eq(index).show().siblings().hide();
		} else {
			$('.mask,.choose-slide,.white').hide();
			$('.choose-tab li').removeClass('active');
		}
	})

	$('.mask').on('touchstart', function() {
		$(this).hide();
		$('.mask,.choose-slide,.white').hide();
		$('.choose-tab li').removeClass('active');
	})

	$('#choose-classify li').click(function(){
		$(this).addClass('active').siblings().removeClass('active');
		var val = $(this).find('a').html();
		$('.tab-area span').html(val);
		$('#choose-classify,.mask,.white').hide();
		$('.choose-tab li').removeClass('active');

		atpage = 1;
		getList();
	})

	$('#choose-sort li').click(function(){
		$(this).addClass('active').siblings().removeClass('active');
		var val = $(this).find('a').html();
		$('.tab-price span').html(val);
		$('#choose-sort,.mask,.white').hide();
		$('.choose-tab li').removeClass('active');

		atpage = 1;
		getList();
	})


	$('.clear-a').click(function() {
		$('#choose-screen li').removeClass('active')
	})
	$('.confirm').click(function() {
		$('.choose-slide').hide();
		$('.white,.mask').hide();
		$('.choose-tab li').removeClass('active')

		atpage = 1;
		getList();

	})
	$('#choose-screen li').click(function(){
		if ($(this).hasClass('active')) {
			$(this).removeClass('active')
		}
		else{
			$(this).addClass('active')
		}
	})

	var myscroll1 = myscroll2 = myscroll3 = null;
	$('.tab-area').click(function() {
		if(myscroll1 == null){
			myscroll1 = new iScroll("choose-classify", {vScrollbar: false});
		}
	})
	$('.tab-price').click(function(){
		if(myscroll2 == null){
			myscroll2 = new iScroll("choose-sort", {vScrollbar: false});
		}
	})
	$('.tab-type').click(function(){
		if(myscroll3 == null){
			myscroll3 = new iScroll("choose-screen", {vScrollbar: false});
		}
	})





	//加载商家列表
	var hallList = $(".near-box"), atpage = 1, pageSize = 20, listArr = [], totalPage = 0, isload = false;
	function getList(){
		isload = true;
		if(atpage == 1){
			hallList.html('');
			totalPage = 0;
		}
		hallList.find(".loading, .empty").remove();
		hallList.append('<div class="loading"><i></i>加载中...</div>');

		$.ajax({
			url: "/include/ajax.php?service=waimai&action=store",
			data: {
				"typeid": $("#choose-classify .active").data("id"),
				"orderby": $("#choose-sort .active").data("id"),
				"peisong": $("#peisong").hasClass("active") ? "1" : "",
				"supfapiao": $("#supfapiao").hasClass("active") ? "1" : "",
				"online": $("#online").hasClass("active") ? "1" : "",
				"page": atpage,
				"pageSize": pageSize
			},
			dataType: "jsonp",
			success: function (data) {
				hallList.find(".loading").remove();
				if(data){
					if(data.state == 100){
						var list = data.info.list, pageInfo = data.info.pageInfo, li = [];
						for (var i = 0, lr, cla; i < list.length; i++) {
							lr = list[i];
							li.push('<div class="near-list"><a href="'+lr.url+'">');
							li.push('<div class="near-list-img"><img src="'+lr.logo+'" alt="'+lr.title+'"></div>');
							li.push('<div class="near-list-txt"><h1><span>'+lr.title+'</span><em class="dist"></em></h1>');
							li.push('<div class="judge-box fn-clear">')

							if(lr.yy == "1"){
								li.push('<span class="sale-num l">'+lr.address+'</span>');
								li.push('<span class="sale-time r">'+lr.times+'分钟</span>');
							}else{
								li.push('<span class="xiuxi l">休息中</span>');
							}

							li.push('</div>');

							if(lr.yy == "1"){
								li.push('<div class="starting-price">');
								li.push('<span>起送价￥'+lr.price+'</span><em>|</em>');
								li.push('<span>配送费￥'+lr.peisong+'</span>');
								li.push('</div>');


								if(lr.sale != ""){
									var saleArr = lr.sale.split("$$"), sale = [];
									for (var s = 0; s < saleArr.length; s++) {
										var saleLi = saleArr[s].split(",");
										sale.push('<span>满'+saleLi[0]+'减'+saleLi[1]+'元</span>');
									}
									li.push('<p class="gray"><i class="sale">减</i>'+sale.join("；")+'</p>');
								}

								if(lr.supfapiao == "1"){
									li.push('<p class="gray"><i class="piao">票</i>'+lr.fapiaonote+'，'+lr.fapiao+'元起开'+'</p>');
								}
								if(lr.online == "1"){
									li.push('<p class="gray"><i class="online">付</i>该店铺支持在线支付</p>');
								}

							}
							li.push('</div>');

							li.push('</a></div>');
						}

						hallList.append(li.join(""));
					}else{

						if(atpage == 1){
							hallList.append('<div class="empty">抱歉，没有找到相关商户！</div>');
						}

					}

					if(atpage >= pageInfo.totalPage){
						isload = true;
					}else{
						isload = false;
					}
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				isload = false;
				hallList.find(".loading").remove();
				console.log(XMLHttpRequest.status);
				console.log(XMLHttpRequest.readyState);
				console.log(textStatus);
			}
		});

	}
	getList();



	//滚动加载
	$(window).on("touchmove", function(){
		var allh = $('body').height();
		var w = $(window).height();
		var scroll = allh - w - 300;
		if ($(window).scrollTop() > scroll && !isload) {
			atpage++;
			getList();
		};
	});







})

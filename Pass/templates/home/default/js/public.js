var isgoing,homeInit,glocart,cartbtn,carcountObj,cartwrap,cartlist,cartul,onClass,ishow;
$(function(){

	$("img").scrollLoading();

	//搜索分类切换
	$(".stype").hover(function(){
		$(this).find("ul").show();
	}, function(){
		$(this).find("ul").hide();
	});

	$(".stype a").bind("click", function(){
		var t = $(this), id = t.attr("data-type"), val = t.text();
		t.closest(".stype").find("label").html(val+"<s><i></i></s>");
		t.closest(".stype").attr("data-type", id);
		t.closest("ul").hide();

		if(id == 1){
			$("#search_keyword").attr("placeholder", "请输入商品名称或相关词语");
		}else{
			$("#search_keyword").attr("placeholder", "请输入店铺名称或相关词语");
		}

		$("#search_keyword").focus();
	});

	//购物车列表的显示与隐藏
	$(".topcart").hover(function(){
		$(this).find(".cart-con").show();
		$(this).addClass("hover");
		if(!ishow){
			homeInit.list();
		}
	}, function(){
		$(this).find(".cart-con").hide();
		$(this).removeClass("hover");
		ishow = false;
	});

	// 购物车
	glocart     = $(".topcart"),
	cartbtn     = glocart.find(".cart-btn"),
	carcountObj = cartbtn.find("i"),
	cartwrap    = glocart.find(".cart-con"),
	cartlist    = glocart.find(".cartlist"),
	cartul      = cartlist.find("ul"),
	cartft      = cartlist.find(".cartft");

	//初始计算购物车数量
	if(glocart.length > 0){
		homeInit.list();
	}

	//鼠标经过显示删除按钮
	cartwrap.delegate("li", "mouseover", function(){
		$(this).find(".del").show();
	});
	cartwrap.delegate("li", "mouseout", function(){
		$(this).find(".del").hide();
	});

	//删除购物车内容
	cartwrap.delegate(".del", "click", function(){
		homeInit.del($(this));
	});

});






//操作购物车
homeInit = {

	//购物车新增
	add: function(data){

		//homeInit.list();  //新增前先更新，避免其他页面删除之后，当前页面直接新增还会保留删除前的数据

		var ishas = 0;
		cartul.find(".loading").remove();

		cartwrap.find("li").each(function(){
			var t = $(this), id = t.attr("data-id"), count = t.attr("data-count");
			//验证是否已经存在，如果有则更新数量
			if(id == data.id){
				ishas = 1;
				var ncount = Number(data.count) + Number(count);
				t.find(".c").html(ncount);
				t.attr("data-count", ncount);
			}
		});

		glocart.find(".empty").hide();

		if(!ishas){
			var li = $('<li data-id="'+data.id+'" data-count="'+data.count+'" class="fn-hide">'+
						'<a href="'+data.url+'" target="_blank" class="pic"></a>'+
						'<div class="info">'+
							'<h5><a href="'+data.url+'" target="_blank">'+data.title+'</a></h5>'+
							'<p><span><strong>'+(echoCurrency('symbol'))+'</strong> × <strong class="c">'+data.count+'</strong></span><a href="javascript:;" class="del">删除</a></p>'+
						'</div>'+
					'</li>');
			cartul.append(li);
			li.slideDown();
		}

		cartlist.show();
		this.update();
	}

	//更新购物车
	,update: function(){

		var totalCount = 0, totalPrice = 0, data = [];
		cartwrap.find("li").each(function(){
			var t = $(this), id = t.attr("data-id"), count = t.attr("data-count"), price = t.attr("data-price");
			if(count != undefined){
				totalCount += Number(count);
				totalPrice += parseFloat(count * price);
			}
			data.push(id+","+count);
		});

		carcountObj.html(totalCount);

		if(totalCount == 0){
			glocart.find(".empty").show();
			cartlist.hide();
		}else{
			cartft.find("em").html(totalCount);
			cartft.find("strong").html(totalPrice.toFixed(2));
		}

		$.cookie(cookiePre+"home_cart", data.join("|"), {expires: 7, domain: masterDomain.replace("http://", ""), path: '/'});

	}

	//删除购物车内容
	,del: function(t){
		var thi = this,
				t = t.closest("li");

		t.slideUp(300, function(){
			t.remove();
			ishow = true;
			thi.update();
		});
	}

	//删除全部
	,deleteAll: function(){
		$.cookie(cookiePre+"home_cart", null);
		cartul.html("");
		this.update();
	}

	//加载列表
	,list: function(){

		var thi = this;
		var cartData = $.cookie(cookiePre+"home_cart");
		if(cartData == null || cartData == ""){
			glocart.find(".empty").show();
			cartlist.hide();
			carcountObj.html(0);
		}else{

			glocart.find(".empty").hide();
			cartlist.show();
			cartul.html('<div class="loading">加载中...</div>');

			//异步获取信息详细
			$.ajax({
				url: masterDomain+'/include/ajax.php?service=home&action=getCartList',
				type: "GET",
				dataType: "jsonp",
				success: function (data) {
					if(data && data.state == 100){

						cartul.html("");
						cartlist.show();

						var info = data.info;
						for(var i = 0; i < info.length; i++){
							var li = $('<li data-id="'+info[i].id+'" data-count="'+info[i].count+'" data-price="'+info[i].price+'">'+
										'<a href="'+info[i].url+'" target="_blank" class="pic" title="'+info[i].title+'"><img src="'+info[i].thumb+'" /></a>'+
										'<div class="info">'+
											'<h5><a href="'+info[i].url+'" target="_blank" title="'+info[i].title+'">'+info[i].title+'</a></h5>'+
											'<p><span><strong>'+(echoCurrency('symbol'))+info[i].price+'</strong> × <strong class="c">'+info[i].count+'</strong></span><a href="javascript:;" class="del">删除</a></p>'+
										'</div>'+
									'</li>');
							cartul.append(li);
						}
						thi.update();

					}else{
						cartul.html('<div class="loading"><font color="ff0000">获取失败，请稍候重试！</font></div>');
					}
				},
				error: function(){
					cartul.html('<div class="loading"><font color="ff0000">获取失败，请稍候重试！</font></div>');
				}
			});

		}
	}


};

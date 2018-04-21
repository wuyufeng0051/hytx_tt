$(function(){
	var list=$(".cart-box"),
		cart=$(".menu-select-bottom"),
		food=$(".bottom-box"),
		account=$(".account"),
		n=$(".null"),
		em=$(".account em"),
		ul=$(".menu-select-right ul");

	//从cookie中获取购物车内容
	var cartData = $.cookie(cookiePre+"waimai_store"+id);
	if(cartData != null && cartData != ""){
		cartData = cartData.split("^O^");
		var totalPrice = 0, totalCount = 0;
		for (var i = 0; i < cartData.length; i++) {
			var cartArr = cartData[i].split("^^");
			list.append('<li class="cart-list" data-id="'+cartArr[0]+'" data-name="'+cartArr[3]+'" data-price="'+cartArr[1]+'"><span>' + cartArr[3] + '</span><span class="sale-price">&yen;' + cartArr[1] + '</span><span class="r"><em class="num-rec">－</em><em class="num-account">' + cartArr[2] + '</em><em class="num-add">＋</em></span></span></li>');

			totalPrice += cartArr[1] * cartArr[2];
			totalCount += Number(cartArr[2]);
		}
		totalPrice = totalPrice.toFixed(2);
		em.html("&yen;"+totalPrice);
		var diffPrice=(startMon-totalPrice).toFixed(2);
		if(diffPrice>0){
			account.find(".starting a").html("差<em>&yen;"+diffPrice+"</em>起送").removeAttr("href");;
			account.find(".starting a").addClass("grey");
		}else{
			account.find(".starting a").html("选好了").attr("href",account.find(".starting a").attr("data-href"));
			account.find(".starting a").removeClass("grey");
		}
		$('.cart').addClass('active');
		$('.menu-select-bottom .cart i').html(totalCount).show();
	}


	//更新购物车cookie
	var updateCartData = function(){

		var data = [], totalPrice = 0;
		list.find("li").each(function(){
			var t = $(this), mid = t.attr("data-id"), count = Number(t.find(".num-account").text()), price = t.attr("data-price"), name = t.attr("data-name");
			if(mid != undefined && count != undefined && price != undefined && name != undefined){
				totalPrice += price * count;
				data.push(mid+"^^"+price+"^^"+count+"^^"+name);
			}
		});

		var diffPrice=(startMon-totalPrice).toFixed(2);
		if(diffPrice>0){
			account.find(".starting a").html("差<em>&yen;"+diffPrice+"</em>起送").removeAttr("href");;
			account.find(".starting").addClass("grey");
		}else{
			account.find(".starting a").html("选好了").attr("href",account.find(".starting a").attr("data-href"));
			account.find(".starting").removeClass("grey");
		}

		$.cookie(cookiePre+"waimai_store"+id, data.join("^O^"), {expires: 7, domain: cookieDomain, path: '/'});

	};



	//页面加
	$(".menu-select-txt .num-add").on("touchend", function(callback) {
		var num = Number($('.menu-select-bottom .cart i').html());
		$('.menu-select-bottom .cart i').html(num+1);
		$('.cart').addClass('active');

		$('.menu-select-bottom .cart i').show();
		var $t = $(this),
			li = $t.closest("li"),
			v = $t.siblings(".dn").find('.num-account'),
			value = Number(v.html());
		value = value + 1,
			v.text(value);
		$t.siblings('.dn').show();
		var name = li.find("h3").text(),
			id = li.attr("data-id"),
			uprice = parseFloat(li.find(".sale-price").text().substr(1))
		allPrice = parseFloat(em.text().substr(1));
		var mon = (allPrice + uprice).toFixed(2);
		uprice = uprice.toFixed(2);
		em.html("&yen;" + mon);
		var diffPrice = (startMon - parseFloat(mon)).toFixed(2);
		if (diffPrice > 0) {
			account.find(".starting a").html("差<em>&yen;" + diffPrice + "</em>起送").removeAttr("href");;
			account.find(".starting a").addClass("grey");
		} else {
			account.find(".starting a").html("选好了").attr("href", account.find(".starting a").attr("data-href"));
			account.find(".starting a").removeClass("grey");
		}

		var lid = list.find('li[data-id="' + id + '"]');
		if (lid.length > 0) {
			lid.find('.num-account').html(value);
		} else {
			list.append('<li class="cart-list" data-id="' + id + '" data-name="'+ name +'" data-price="'+uprice+'"><span>' + name + '</span><span class="sale-price">&yen;' + uprice + '</span><span class="r"><em class="num-rec">－</em><em class="num-account">' + value + '</em><em class="num-add">＋</em></span></span></li>');
		}

		updateCartData();

		// 购物车效果
		var offset = $(".cart").offset();
		var t = $(this).offset();
		var scH = $(window).scrollTop();
		var img = $(this).closest("li").find('img').attr('src'); //获取当前点击图片链接
		var flyer = $('<img class="flyer-img" src="' + img + '">'); //抛物体对象
		flyer.fly({
			start: {
				left: t.left - 50, //抛物体起点横坐标
				top: t.top - scH - 30 //抛物体起点纵坐标
			},
			end: {
				left: offset.left + 15, //抛物体终点横坐标
				top: offset.top - scH, //抛物体终点纵坐标
				width: 15,
				height: 15

			},
			onEnd: function() {
				this.destroy(); //销毁抛物体
				$('.cart').addClass('swing');

				setTimeout(function(){$('.cart').removeClass('swing')},300);
			}
		});
	})

	//页面减
	$(".menu-select-txt .num-rec").on("touchend" , function(){
		var num = Number($('.menu-select-bottom .cart i').html());
		$('.menu-select-bottom .cart i').html(num-1);
		var $t=$(this),
			li=$t.closest("li"),
			v=$t.siblings('.num-account'),
			value = Number(v.html()),
			id=li.attr("data-id");
		value-=1;
		v.text(value);
		var lid=list.find('li[data-id="'+id+'"]'),
			uprice=parseFloat(li.find(".sale-price").text().substr(1)),
			allPrice=parseFloat(em.text().substr(1));
		var mon=(allPrice-uprice).toFixed(2);
		em.html("&yen;"+mon);
		var diffPrice=(startMon-parseFloat(mon)).toFixed(2);
		if(diffPrice>0){
			account.find(".starting a").html("差<em>&yen;"+diffPrice+"</em>起送").removeAttr("href");
			account.find(".starting a").addClass("grey");
		}else{
			account.find(".starting a").html("选好了").attr("href",account.find(".starting a").attr("data-href"));
			account.find(".starting a").removeClass("grey");
		}

		lid.find(".num-account").html(value);
		if(value == 0){
			$t.parent('.dn').hide();
			lid.remove();
		}
		if(list.find("li").length<1){
			$('.cart').removeClass('active');
			$('.menu-select-bottom .cart i').hide();
		}

		updateCartData();
	})

	//购物车加
	$(document).on("click",".cart-box .num-add",function(){
		var num = Number($('.menu-select-bottom .cart i').html());
		$('.menu-select-bottom .cart i').html(num+1);
		var $t=$(this),
			v=$t.siblings('.num-account')
			value=parseInt(v.text()),
			li=$t.closest("li"),
			id=li.attr("data-id");
		value=value+1;
		v.text(value);
		var lid=ul.find('li[data-id="'+id+'"]'),
			uprice=parseFloat(li.find(".sale-price").text().substr(1)),
			allPrice=parseFloat(em.text().substr(1));
		mon=(allPrice+uprice).toFixed(2);
		em.html("&yen;"+mon);
		lid.find(".num-account").text(value);
		var diffPrice=(startMon-parseFloat(mon)).toFixed(2);
		if(diffPrice>0){
			account.find(".starting a").html("差<em>&yen;"+diffPrice+"</em>起送").removeAttr("href");;
			account.find(".starting a").addClass("grey");
		}else{
			account.find(".starting a").html("选好了").attr("href",account.find(".starting a").attr("data-href"));
			account.find(".starting a").removeClass("grey");
		}

		updateCartData();
	})
	//购物车减
	$(document).on("click",".cart-box .num-rec",function(){
		var num = Number($('.menu-select-bottom .cart i').html());
		$('.menu-select-bottom .cart i').html(num-1);
		var $t=$(this),
			v=$t.siblings(".num-account"),
			value=parseInt(v.text()),
			li=$t.closest("li"),
			id=li.attr("data-id");
 			value= value-1;
		v.text(value);
		var lid=ul.find('li[data-id="'+id+'"]'),
			uprice=parseFloat(li.find(".sale-price").text().substr(1)),
			allPrice=parseFloat(em.text().substr(1));
		mon=(allPrice-uprice).toFixed(2);
		em.html("&yen;"+mon);
		lid.find(".num-account").text(value);
		var diffPrice=(startMon-parseFloat(mon)).toFixed(2);
		if(diffPrice>0){
			account.find(".starting a").html("差<em>&yen;"+diffPrice+"</em>起送").removeAttr("href");;
			account.find(".starting a").addClass("grey");
		}else{
			account.find(".starting a").html("选好了").attr("href",account.find(".starting a").attr("data-href"));
			account.find(".starting a").removeClass("grey");
		}
		if(value == 0){
			li.remove();
			lid.find('.dn').hide();
		}
		if(list.find("li").length<1){
			$('.cart').removeClass('active');
			$('.menu-select-bottom .cart i').hide();
			$('.mask,.cart-box').hide();
		}

		updateCartData();
	})

	//清空购物车
	$(".cart-box .title a").on("click",function(){
		li=$(this).closest(".cart-box").find('li'),
		ul.find(".dn").hide();
		$(".num-account").text(0);
		em.html("&yen"+0);
		account.find(".starting a").html("差<em>&yen;"+startMon+"</em>起送").removeAttr("href");;
		account.find(".starting a").addClass("grey");
		li.remove();
		$('.mask,.cart-box').hide();
		$('.cart').removeClass('active');
		$('.menu-select-bottom .cart i').text(0);
		$('.menu-select-bottom .cart i').hide();

		updateCartData();
	})

	//显示/隐藏购物车
	$(".shoppingCart .account .left").on("tap",function(){
		food.stop().slideToggle();
	})

	function add(){

	}
})

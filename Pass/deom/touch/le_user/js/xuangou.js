$(function(){
	$('.main_left ul li').click(function(){
		var  u = $(this);
		var index = u.index();
		$('.main_list .main_right').eq(index).show();
		$('.main_list .main_right').eq(index).siblings().hide();
		u.addClass('ml_bac');
    	u.siblings('li').removeClass('ml_bac');
	})
	$('.kind ul li').click(function(){
		var  u = $(this);
		var index = u.index();
		$('.lind_list .lind_txt').eq(index).show();
		$('.lind_list .lind_txt').eq(index).siblings().hide();
		u.addClass('kind_bc');
    	u.siblings('li').removeClass('kind_bc');
	})






	var list=$(".cart-box"),
		cart=$(".menu-select-bottom"),
		food=$(".price"),
		account=$(".account"),
		n=$(".null"),
		em=$(".zong_p em"),
		ul=$(".main_right .car_t1 ");



	//页面加
	$(".main_right .car_t1 span p b").on("touchend", function(callback) {
		var num = Number($('.price .gou b').html());
		$('.price .gou b').html(num+1);
		$('.cart').addClass('active');

		var $t = $(this),
			li = $t.closest(".car_t1 "),
			v = $t.closest('p').find('.num-account'),
			value = Number(v.html());
		value = value + 1,
			v.text(value);
		$t.closest('p').find('i,input').show();
		var name = li.find("h1").text(),
			id = li.attr("data-id"),
			uprice = parseFloat(li.find(".sale-price").text().substr(1))
		allPrice = parseFloat(em.text().substr(1));
		var mon = (allPrice + uprice).toFixed(2);
		uprice = uprice.toFixed(2);
		em.html("&yen;" + mon);

		var lid = list.find('.cart-list[data-id="' + id + '"]');
		if (lid.length > 0) {
			lid.find('.num-account').html(value);
		} else {
			list.append('<div class="cart-list" data-id="' + id + '" data-name="'+ name +'" data-price="'+uprice+'"><span>' + name + '</span><span class="sale-price">&yen;' + uprice + '</span><span class="r"><em class="num-rec">－</em><em class="num-account">' + value + '</em><em class="num-add">＋</em></span></span></div>');
		}

	})


	//页面减
	$(".main_right .car_t1 span p i").on("touchend" , function(){
		var num = Number($('.price .gou b').html());
		$('.price .gou b').html(num-0);
		var $t=$(this),
			li=$t.closest(".car_t1"),
			v=$t.siblings('.num-account'),
			value = Number(v.html()),
			id=li.attr("data-id");
		if (value != 0) {
			value-=1;
		};
		v.text(value);
		var lid=list.find('.cart-list[data-id="'+id+'"]'),
			uprice=parseFloat(li.find(".sale-price").text().substr(1)),
			allPrice=parseFloat(em.text().substr(1));
		var mon=(allPrice-uprice).toFixed(2);
		if (value != 0) {
			em.html("&yen;"+mon);
		};
			lid.find(".num-account").html(value);

		if(value == 0){
			$t.parent('.dn').hide();
			lid.remove();
		}
		

	})

	//购物车加
	$(document).on("click",".num-add",function(){
		var num = Number($('.price .gou b').html());
		$('.price .gou b').html(num+1);
		var $t=$(this),
			v=$t.siblings('.num-account'),
			value=parseInt(v.text()),
			li=$t.closest(".cart-list"),
			id=li.attr("data-id"),
			ul=$('.car_t1[data-id="'+id+'"]');
		value=value+1;
		v.text(value);
		var lid=ul.find('.num-account[data-id="'+id+'"]'),
			uprice=parseFloat(li.find(".sale-price").text().substr(1)),
			allPrice=parseFloat(em.text().substr(1));
		mon=(allPrice+uprice).toFixed(2);
		em.html("&yen;"+mon);
		lid.text(value);
	})

	//购物车减
	$(document).on("click",".num-rec",function(){
		var num = Number($('.price .gou b').html());
		if (num != 0) {
			$('.price .gou b').html(num-1);
		};
		var $t=$(this),
			v=$t.siblings(".num-account"),
			value=parseInt(v.text()),
			li=$t.closest(".cart-list"),
			id=li.attr("data-id"),
			ul=$('.car_t1[data-id="'+id+'"]');
 			value=value-1;
			v.text(value);
		var lid=ul.find('.num-account[data-id="'+id+'"]'),
			uprice=parseFloat(li.find(".sale-price").text().substr(1)),
			allPrice=parseFloat(em.text().substr(1));
		mon=(allPrice-uprice).toFixed(2);
		em.html("&yen;"+mon);
		lid.text(value);
		if(value == 0){
			li.remove();
			lid.find('.dn').hide();
		}
		if(list.find(".cart-list").length<1){
			$('.cart').removeClass('active');
			$('.mask,.cart-box').hide();
		}
	})

	//清空购物车
	$(".cart-box .title a").on("click",function(){
		li=$(this).closest(".cart-box").find('.cart-list'),
		ul.find(".dn").hide();
		$(".num-account").text(0);
		em.html("&yen"+0);
		li.remove();
		$('.mask,.cart-box').hide();
		$('.cart').removeClass('active');
		$('.price .gou b').text(0);
	})
	// 购物车隐藏显示
	$('.price .gou em i').click(function(){
		if ($('.price .gou b').text() == 0) {
			
		}else{
			if ($('.cart-box').css('display') == "none") {
				$('.cart-box,.mask').show();
			}else{
				$('.cart-box,.mask').hide();
			};
		};
		
	})
	// 搜索
	$('.main .main_left  .search i').click(function(){
		if ($('.search_1').css('display') == "none") {
			$('.search_1,.mask').show();
		}else{
			$('.search_1,.mask').hide();
		};
	})
	$('.mask').click(function(){
		$('.mask').hide();
		$('.cart-box').hide();
		$('.search_1').hide();
	})
})
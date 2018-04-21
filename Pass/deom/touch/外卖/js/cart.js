$(function(){
	// 页面加载计算购物车总个数
	var length = $('.cart_list .car_t1').length;
	$('.header-address em').text(length);

	// 就餐人数弹出层打开关闭
	$(".per_num").click(function(){
		if ($('.choice_num').css('display') == "block") {
			$('.choice_num').slideUp(300);
			$('.disk').hide();
		}else{
			$('.choice_num').slideDown(300);
			$('.disk').show();
			$('.choice_num').show();
		}
	})
	$(".choice_num .cn_lead em").click(function(){
		$('.choice_num').slideUp(300);
		$('.disk').hide();
	})
	// 就餐人数选择后关闭弹出层
	$('.choice_num .choice_box ul li').click(function(){
		var x = $(this);
		x.addClass('cb_bc').siblings().removeClass('cb_bc');
		$('.choice_num').slideUp(300);
		$('.disk').hide();
	})

	function allprice(){
		var sum2 = 0;
		$(".cart_list .car_t1").each(function(){
			var number =Number($(this).find('.num-account').text()),
				price = Number($(this).attr('data-price'));
			sum1 = number * price;
		    sum2+=+sum1;
		    $('.all_price .price_num').text(sum2);
		});
	}
	allprice();

	// 增加或减少计算价格
	$('.plus').click(function(){
		var x = $(this),
			price = x.closest('.car_t1').attr('data-price'),
			find = x.closest('.car_t1').find('.num-account').text();
			cont = Number(find);
		number = cont + 1;
		x.closest('.car_t1').find('.num-account').text(number);
		allprice();
	})
	$('.reduce').click(function(){
		var x = $(this),
			price = x.closest('.car_t1').attr('data-price'),
			find = x.closest('.car_t1').find('.num-account').text();
			cont = Number(find);
		number = cont - 1;
		if (number <= 0 ) {
			x.closest('.car_t1').find('.num-account').text(number);
			allprice();
			x.closest('.car_t1').remove();
			var length = $('.cart_list .car_t1').length;
			$('.header-address em').text(length);
		}else{
			x.closest('.car_t1').find('.num-account').text(number);
			allprice();
		}
	})
	// 购物车清空
	$('.dropnav').click(function(){
		$(".sure_box").show();
		$(".disk2").show();
	})
	$('.cancel_btn').click(function(){
		$(".sure_box").hide();
		$(".disk2").hide();
	})
	$('.sure_btn').click(function(){
		$('.cart_list').html("");
		$('.all_price .price_num').text('0');
		$(".sure_box").hide();
		$(".disk2").hide();
		$('.header-address em').text('0');
	})
})
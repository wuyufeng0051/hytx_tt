$(function(){
	// 支付方式选择
	$('.pay_style ul li').click(function(){
		var x = $(this);
		x.addClass('pay_bc').siblings('li').removeClass('pay_bc');
	})
	// 加减数量
	total();
	$('.car_list .car_t1 span p i').click(function(){
		var account = Number($('.car_list .car_t1 span p input').val());
		if (account>1) {
			account --;
			$('.car_list .car_t1 span p input').val(account);
			total();
		}
	});
	$('.car_list .car_t1 span p b').click(function(){
		var account = Number($('.car_list .car_t1 span p input').val());
		if (account < max) {
			account++;
			$('.car_list .car_t1 span p input').val(account);
			total();
		}else{
			$('.car_list .car_t1 span p input').val(max);
			alert('最多可以购买'+max+"份");
		}
	});
	function total(){
		var num = Number($('.car_list .car_t1 span p input').val()), frei = 0;

		if(tuantype == 2){
			if(num <= freeshi){
				frei = freight;
				$(".order-fare .name-r").html(""+freight);
			}else{
				frei = 0;
				$(".order-fare .name-r").html("");
			}
		}

		var total = Number(num*price+frei).toFixed(2);
		$('.price b').html(total);
	}
})
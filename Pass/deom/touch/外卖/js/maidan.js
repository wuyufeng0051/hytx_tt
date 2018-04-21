$(function(){

	// 是否输入不参与优惠金额
	$('.Drop_out').click(function(){
		var x = $(this);
		if (x.hasClass('check')) {
			x.removeClass('check');
			$('.Drop_out_pay ').hide();
		}else{
			x.addClass('check');
			$('.Drop_out_pay ').show();
		}
	})

	$('#all_money').keyup(function(){
		var all_money = Number($('#all_money').val()),
			out_money = Number($('#out_money').val());
		if ($('.Drop_out').hasClass('check')) {
			var fanial = all_money + out_money;
			$(".fanial i").text(fanial);
			$(".pay_btn").html('<em>'+fanial+'元</em>确认买单');
			$(".pay_btn").addClass('keyup');
		}else{
			$(".fanial i").text(all_money);
			$(".pay_btn").html('<em>'+all_money+'元</em>确认买单');
			$(".pay_btn").addClass('keyup');
		}
		if (all_money == "") {
			$(".fanial i").text(0);
			$(".pay_btn").html('确认买单');
			$(".pay_btn").removeClass('keyup');
		}
	})

	$('#out_money').keyup(function(){
		var all_money = Number($('#all_money').val()),
			out_money = Number($('#out_money').val());
		if ($('.Drop_out').hasClass('check')) {
			var fanial = all_money + out_money;
			$(".fanial i").text(fanial);
			$(".pay_btn").html('<em>'+fanial+'元</em>确认买单');
			$(".pay_btn").addClass('keyup');
		}else{
			$(".fanial i").text(all_money);
			$(".pay_btn").html('<em>'+all_money+'元</em>确认买单');
			$(".pay_btn").addClass('keyup');
		}
		if (all_money == "") {
			$(".fanial i").text(0);
			$(".pay_btn").html('确认买单');
			$(".pay_btn").removeClass('keyup');
		}
	})

	$('.warning_btn').click(function(){
		$('.disk').hide();
		$('.warning').hide();
	})
})
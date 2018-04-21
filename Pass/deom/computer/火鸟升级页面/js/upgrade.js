$(function(){
	new WOW().init();
	$(".zan").click(function(){
		var x = $(this),
			num = Number(x.text());
		nem_number = num + 1;
		nem_number1 = num - 1;
		if (x.hasClass("zan_bc")) {
			x.removeClass('zan_bc');
			x.text(nem_number1);
		}else{
			x.addClass('zan_bc');
			x.text(nem_number);
		}
	})
})
$(function(){
	$('.S1name').click(function(){
		var x = $(this),
			box = x.closest('.screen1').find('.screen2'),
			box2 = x.closest('.screen1').find('ul');
		if (x.closest('.screen1').find('.S2name').text() != "") {
			if (box.css("display") == "none") {
				box.show();
				x.find('em').text("-");
			}else{
				box.hide();
				x.find('em').text("+");
			}
		}else{
			if (box2.css("display") == "none") {
				box.show();
				box2.show();
				$('.load_more').show();
				x.find('em').text("-");
			}else{
				box.show();
				box2.hide();
				$('.load_more').hide();
				x.find('em').text("+");
			}
			
		}
		
	})
	$('.S2name').click(function(){
		var x = $(this),
			box = x.closest('.screen2').find('ul');
		if (box.css("display") == "none") {
			box.show();
			x.find('em').text("-");
		}else{
			box.hide();
			x.find('em').text("+");
		}
	})
	$('.ScreenChoice li').click(function(){
		var x = $(this);
		if (x.hasClass('SC_bc')) {
			x.removeClass('SC_bc');
		}else{
			x.addClass('SC_bc');
		}
	})


	$('.BankNav .nav  span').click(function(){
		var x = $(this);
		x.siblings('span').removeClass('choice_down choice');
		if (x.hasClass('choice')) {
			x.removeClass('choice').addClass('choice_down');
		}else{
			x.addClass('choice').removeClass('choice_down');
		}
	})
})
$(function(){
	$('.lead b a').click(function(){
		if ($('.edit').css('display') == 'none') {
			$('.edit').show();
			$('.dui').hide();
		}else{
			$('.edit').hide();
			$('.dui').show();
		};
	})
	$('.Address_list .add_txt').click(function(){
		var x = $(this);
		x.addClass('addbc').siblings('.add_txt').removeClass('addbc');
	})
	$('.Address_list .add_txt .edit b').click(function(){
		var x = $(this);
		x.closest('.add_txt').hide();
	})
})
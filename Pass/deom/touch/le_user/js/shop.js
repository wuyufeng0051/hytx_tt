$(function(){
	$('.lead b').click(function(){
		if ($('.lead b').hasClass('lead_bc')) {
			$('.lead b').removeClass('lead_bc');
		}else{
			$('.lead b').addClass('lead_bc');
		};
	})
})
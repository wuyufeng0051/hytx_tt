$(function(){
	$('body').click(function(){
		$('.sea_left ul').hide();
	})
	$('.sea_left p').click(function(){
		$('.sea_left ul').show();
		return false;
	})
	$('.sea_left ul li').click(function(){
		var x = $(this),
			txt = x.text();
		$('.sea_left p i').text(txt);
		$('.sea_left ul').hide();
		return false;
	})
})
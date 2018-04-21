$(function(){
	$(".open").click(function(){
		var x   = $(this),
			box = x.closest(".ScreenBox");
		box.css("height","auto"); 
		x.hide();
	})
	$(".ScreenType span").click(function(){
		var x   = $(this),
			box = x.closest(".ScreenBox");
		box.css("height","35px"); 
		box.find('.open').show();
	})
})
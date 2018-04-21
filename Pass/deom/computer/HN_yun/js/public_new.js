$(function(){

	$('.TL_linkbox ul li').hover(function(){
		var x = $(this),
			index = x.index();
		$('.TL_linkbox .top_line span').stop().animate({
			left: 0 + index * 80 + "px",opacity:1
		}, 100);
	},function(){
		$('.TL_linkbox .top_line span').stop().animate({
			opacity:0
		}, 100);
	})
	$('.TR_linkbox  ul li').hover(function(){
		var x = $(this),
			index = x.index();
		$('.TR_linkbox  .top_line span').stop().animate({
			left: 0 + index * 80 + "px",opacity:1
		}, 100);
	},function(){
		$('.TR_linkbox  .top_line span').stop().animate({
			opacity:0
		}, 100);
	})
})
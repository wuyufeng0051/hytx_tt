$(function(){
	// 微信分享
	$('.HN_wx').hover(function(){
		var x = $(this);
		$('.HN_pop_wx').show();
	}, function(){
		$('.HN_pop_wx').hide();
	})
	$('.HN_wxq').hover(function(){
		var x = $(this);
		$('.HN_pop_wxq').show();
	}, function(){
		$('.HN_pop_wxq').hide();
	})
});
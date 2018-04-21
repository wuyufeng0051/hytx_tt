$(function(){
	jQuery(".p_lead").slide({mainCell:".gg_list",autoPlay:true,effect:"topMarquee",vis:1,interTime:100,trigger:"click"});

	// 装修流程
	$('.formlist li').hover(function(){
		var x = $(this),index = x.index(),close = x.closest('.tdform ').find('.formcon ul li');
		close.eq(index).show().siblings().hide();
		x.addClass(' act');
		x.siblings().removeClass(' act');
	})
})
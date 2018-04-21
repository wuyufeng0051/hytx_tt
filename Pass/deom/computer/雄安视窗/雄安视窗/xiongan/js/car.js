$(function(){
	// 热门推荐tab切换
	$('.p2_lead ul li').hover(function(){
		var x = $(this),index = x.index();
		$('.p2_list .p2_t').eq(index).show().siblings().hide();
		x.addClass(' p2l_bc');
		x.siblings().removeClass(' p2l_bc');
	})

	// 最新汽车报价tab切换
	$('.part_4 .p4_lead ul li').hover(function(){
		var x = $(this),index = x.index();
		$('.p4_t ').eq(index).show().siblings().hide();
		x.addClass(' p4l_bc');
		x.siblings().removeClass(' p4l_bc');
	})
	// QQ群选项卡
	$('.part_8 .part_txt4 .pt_txt .ptt_lead ul li').hover(function(){
		var x = $(this),index = x.index(),close = x.closest('.pt_txt ').find('.ptt_list ul');
		close.eq(index).show().siblings().hide();
		x.addClass('ptt_bc');
		x.siblings().removeClass('ptt_bc');
	})
})
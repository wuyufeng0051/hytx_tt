$(function(){
	// 出租选项卡
	$('.p5_mid .p5_lead ul li').hover(function(){
		var x = $(this),index = x.index(),close = x.closest('.p5_mid ').find('.p5_ll .p5_list');
		close.eq(index).show().siblings().hide();
		x.addClass('pl_bc');
		x.siblings().removeClass('pl_bc');
	})
	$('.p2_right .p2r_lead ul li').hover(function(){
		var x = $(this),index = x.index(),close = x.closest('.p2_right ').find('.p2r_list ul');
		close.eq(index).show().siblings().hide();
		x.addClass('p2rl_bc');
		x.siblings().removeClass('p2rl_bc');
	})
	// QQ群选项卡
	$('.part_3 .part_txt4 .pt_txt .ptt_lead ul li').hover(function(){
		var x = $(this),index = x.index(),close = x.closest('.pt_txt ').find('.ptt_list ul');
		close.eq(index).show().siblings().hide();
		x.addClass('ptt_bc');
		x.siblings().removeClass('ptt_bc');
	})
	
	$('#house-tab li').hover(function(){

		var index = $(this).index();

		$(this).addClass('active').siblings().removeClass('active');

		$('#house-list ul').eq(index).show().siblings().hide();

	})
})
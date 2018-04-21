$(function(){
	$('.now_btn').click(function(){
		$(".Choice_Num").show();
		$(".disk").show();
	})
	$('.cancle').click(function(){
		$(".Choice_Num").hide();
		$(".disk").hide();
	})
	// $('.sure').click(function(){
	// 	$(".Choice_Num").hide();
	// 	$(".disk").hide();
	// })
	$(".Choice_Num .num_box ul li").click(function(){
		var x = $(this);
		x.addClass('nb_bc').siblings().removeClass('nb_bc');
	})
})
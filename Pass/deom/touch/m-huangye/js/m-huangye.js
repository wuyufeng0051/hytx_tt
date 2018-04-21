$(function(){
	// 栏目滑动
	var mySwiper = new Swiper('.swiper-container', {
		pagination: '.swiper-pagination',
	})

	// 下部列表
	$('.content-lead ul li').click(function(){
		var  u = $(this);
		var index = u.index();
		$('.content .content-list').eq(index).show();
		$('.content .content-list').eq(index).siblings().hide();
		u.addClass('ll');
		u.siblings('li').removeClass('ll');
	})

})

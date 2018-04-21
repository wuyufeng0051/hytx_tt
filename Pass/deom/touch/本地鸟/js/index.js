$(function(){

	// 便携工具列表 左右滑动
	var mySwiper = new Swiper('.swiper-container', {
		pagination: '.swiper-pagination',
	})

	// 广告位幻灯片
	var mySwiper = new Swiper('.picscroll .swiper-container2',{
	    pagination: '.swiper-pagination',
	    loop:true,
	    paginationClickable: true,
	    autoplayDisableOnInteraction : false,
	    autoHeight: true,
	    autoplay: 3000
	});

	// 联系方式弹出层
	$('.mer_detail .tel').click(function(){
		$('.phone').show();
		$('.disk').show();
	})
	$('.close').click(function(){
		$('.phone').hide();
		$('.disk').hide();
	})
	$('.disk').click(function(){
		$('.phone').hide();
		$('.disk').hide();
	})
})
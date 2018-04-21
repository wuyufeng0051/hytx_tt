$(function(){

	// 便携工具列表 左右滑动
	var mySwiper = new Swiper('.swiper-container', {
		pagination: '.swiper-pagination',
	})

	// 广告位幻灯片
	// $('#picscroll').slider({changedFun:function(n){
	// 	var li = $('#picscroll ul li'), active = li.eq(n);
	// 	if(n < li.length - 1) {
	// 			 if(!active.hasClass('showed')) {
	// 				active.addClass('showed');
	// 			 }
	// 			 var next = li.eq(n+1);
	// 			 next.addClass('showed');
	// 	}
	// }})
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
	    var x = $(this),
            phone = x.closest('.mer_detail').data('phone');
	    var tel = "tel:"+phone;
        $('.phone ul li a').attr('href',tel);
        $('.phone ul li a em').text(phone);
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

    window.onload=function(){

        $('body').css('overflow','auto');
        $('.loading').bind("touchmove",function(e){
            e.preventDefault();
        });

        $(".loading").fadeOut();
    }
})
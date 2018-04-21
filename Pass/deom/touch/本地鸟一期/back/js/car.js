$(function(){
	// $('.intor_lead ul li').click(function(){
	// 	var x = $(this),
	// 		index = x.index();
	// 	x.addClass('il_bc').siblings().removeClass('il_bc');
	// 	$('.car_list .car_tab').eq(index).show().siblings().hide();
	// })
	
	// $('#picscroll').slider({changedFun:function(n){
	// 	var li = $('#picscroll ul li'), active = li.eq(n);
	// 	if(n < li.length - 1) {
	// 		 if(!active.hasClass('showed')) {
	// 			active.addClass('showed');
	// 		 }
	// 		 var next = li.eq(n+1);
	// 		 next.addClass('showed');
	// 	}
	// }})
    window.onload = function() {
        $('body').css('overflow','auto');
        $('.loading').bind("touchmove",function(e){
            e.preventDefault();
        });
        $(".loading").fadeOut();

    };
    var mySwiper = new Swiper('.picscroll .swiper-container2',{
        pagination: '.swiper-pagination',
        loop:true,
        paginationClickable: true,
        autoplayDisableOnInteraction : false,
        autoHeight: true,
        autoplay: 3000
    });
})
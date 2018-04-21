$(function(){
    var mySwiper = new Swiper('.picscroll .swiper-container2',{
        pagination: '.swiper-pagination',
        loop:true,
        paginationClickable: true,
        autoplayDisableOnInteraction : false,
        autoHeight: true,
        autoplay: 3000
    });
	$('.nav ul li').click(function(){
        var $t = $(this),
         index = $t.index(),
           box = $('.nav_list .nav_de').eq(index);
         if (box.css("display")=="none") {
            $t.addClass('nav_bac').siblings().removeClass('nav_bac');
            box.show().siblings().hide();
            $('.disk').show();
            // $('body').addClass('by');
         }else{
            $t.removeClass('nav_bac');
            box.hide();
            $('.disk').hide();
            // $('body').removeClass('by');
         }
    })

    $('.disk').on('click',function(){
        $('.disk').hide();
        $('.nav_list .nav_de').hide();  
        // $('body').removeClass('by');
        $('.nav ul li').removeClass('nav_bac');
    })
    window.onload=function(){

        $('body').css('overflow','auto');
        $('.loading').bind("touchmove",function(e){
            e.preventDefault();
        });

        $(".loading").fadeOut();
    }

})
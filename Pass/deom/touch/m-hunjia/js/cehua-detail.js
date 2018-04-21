$(function(){
	// 领取优惠券
	$('.lead-3').click(function(){  
        $('.youhui').slideDown(300);
        $('.youhui,.disk').show();
    })
    $('.disk').click(function(){
        $('.youhui').slideUp(300);
        $('.disk').hide();
    })

    // 全部套系
    $('.tao-more').click(function(){
        var dom = $('.tao ul')
            if (dom.hasClass('nic')) {
            $('.tao ul').removeClass('nic');
        }else{
            $('.tao ul').addClass('nic');
        }
    })
    $('.tao-more').click(function(){
        var dom = $('.tao-more')
            if (dom.hasClass('nn')) {
            $('.tao-more').removeClass('nn');
        }else{
            $('.tao-more').addClass('nn');
        }
    })
    // 预约
    $('.yuyue span').click(function(){
    var t = $(this);
      $('.jkl').animate({"left":"0"},200);
    })
    $('.jkl span').click(function(){
    var t = $(this);
      $('.jkl').animate({"left":"100%"},200);
    })
})
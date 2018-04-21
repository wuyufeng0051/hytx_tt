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
      // 列表body置顶
    $('.lead-3').click(function(){
        var dom = $('.lead-3')
        if (dom.css('display') == 'none'){
            $('body').removeClass('by')
        }else{
            $('body').addClass('by')
        }
    })
    $('.disk').click(function(){
        var dom = $('.disk')
        if (dom.css('display') == 'none'){
            $('body').removeClass('by')
        }else{
            $('body').addClass('by')
        }
    })
    // 顶部收藏
	$('.yuyue i').click(function(){
		var dom = $('.yuyue i')
		    if (dom.hasClass('sc')) {
            $('.yuyue i').removeClass('sc');
        }else{
            $('.yuyue i').addClass('sc');
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
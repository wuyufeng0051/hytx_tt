$(function(){
	// 顶部收藏
	$('.de-img b').click(function(){
		var dom = $('.de-img b')
		    if (dom.hasClass('showcang')) {
            $('.de-img b').removeClass('showcang');
        }else{
            $('.de-img b').addClass('showcang');
        }
    })
	// 酒店简介
	$('.jieshao').click(function(){
		var t = $(this);
	    $('.jianjie').animate({"left":"0"},200);
  	})
  	$('.jianjie-lead span').click(function(){
		var t = $(this);
	    $('.jianjie').animate({"left":"100%"},200);
  	})
  	$('.jj-1').click(function(){
        	var dom = $('.jj-1')
        if (dom.hasClass('arrow')) {
        	$('.jj-txt').removeClass('hei');
            $('.jj-1').removeClass('arrow');
        }else{
        	$('.jj-txt').addClass('hei');
            $('.jj-1').addClass('arrow');
        }
    })
  	// 婚宴菜单
	  $('.menu-more,.menu ul li').click(function(){
		var t = $(this);
	    $('.caidan').animate({"left":"0"},200);
  	})
  	$('.caidan-lead span').click(function(){
		var t = $(this);
	    $('.caidan').animate({"left":"100%"},200);
  	})
    $('.cai-l').click(function(){
            var t = $(this);
            var box = t.closest("li");
            var list = box.find('.cai-list');
        if (list.css('display') == 'none') {
            $('.cai-list').hide();
            box.find('.cai-list').show();
            var num = list.find('.plan').length;
            if (num == 1) {
            	list.find('.plan').css('width','100%')
            }else{

	            var width = list.find('.plan').width();
	            var maxWidth = width*num;
	            list.width(maxWidth);
            }
        }else {
            box.find('.cai-list').hide();
        }
    })
  	// 查询当期
    $('.yanhui ul li .check,.chaxun').click(function(){
		var t = $(this);
	    $('.dangqi').animate({"left":"0"},200);
  	})
  	$('.dangqi-lead span').click(function(){
		var t = $(this);
	    $('.dangqi').animate({"left":"100%"},200);
  	})
    // 预约
    $('.yuyue').click(function(){
    var t = $(this);
      $('.jkl').animate({"left":"0"},200);
    })
    $('.jkl span').click(function(){
    var t = $(this);
      $('.jkl').animate({"left":"100%"},200);
    })

})
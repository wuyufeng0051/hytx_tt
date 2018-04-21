$(function(){
    var xiding = $(".screen");
    var chtop = parseInt(xiding.offset().top);
	// 筛选
	$('.screen ul li').click(function(){
        var $t = $(this),
         index = $t.index(),
           box = $('.screen_list ul').eq(index);
         if (box.css("display")=="none") {
            $t.addClass('cur').siblings().removeClass('cur');
            box.show().siblings().hide();
            $('.disk').show();
            $('body').scrollTop(chtop);
         }else{
            $t.removeClass('cur');
            box.hide();
            $('.disk').hide();
         }
    })
	$('.screen_list ul li ').click(function(){
			var  x = $(this);
			var  index = x.closest("ul").index();
			var  lead = $('.screen  ul li').eq(index);
			x.addClass('leib');
	      	x.siblings('li').removeClass('leib');
			$('.disk').hide();
	      	$('.screen_list  ul').hide(); 
			$('.screen  ul li').removeClass('cur');
		})
     // 遮罩层
    $('.disk').on('touchstart',function(){
        $('.disk').hide();
        $('.screen_list  ul').hide();  
        $('.screen ul li').removeClass('cur');
    	$('.yuyue_list').hide();
        $('.stylist_lead').removeClass('sc_1');
		$('.screen').removeClass('sc_1');
    })
     // 吸顶
    
    $(window).on("scroll", function() {
        var thisa = $(this);
        var st = thisa.scrollTop();
        if (st >= chtop) {
            $(".screen ").addClass('deco_pic_lead-top1');
            $('.stylist-list').css('margin-top', '1.1rem');
        } else {
            $(".screen ").removeClass('deco_pic_lead-top1');
            $('.stylist-list').css('margin-top', '0');

        }
    });
    // 免费预约
    $('.sty_dao .yuyue').click(function(){
    	var  x = $(".yuyue_list");
    	if (x.css("display")=="none") {
    		x.show();
    		$('.disk').show();
    		$('body').addClass('by');
    		$('.screen').addClass('sc_1');
    		$('.stylist_lead').addClass('sc_1');
    	}else{
    		x.hide();
    		$('.disk').hide();
    		$('body').removeClass('by');
    		$('.screen').removeClass('sc_1');
    		$('.stylist_lead').removeClass('sc_1');
    	}
    })
    $('.yuyue_list p').click(function(){
    	$('.disk').hide();
		$('body').removeClass('by');
    	$('.yuyue_list').hide();
    	$('.stylist_lead').removeClass('sc_1');
		$('.screen').removeClass('sc_1');
    })
        // 表单验证
    $('.submit').click(function(){
        var tel = $('.phone').val();
        if ($('.name').val() == "") {
            $('.name-1').show();
            setTimeout(function(){$('.name-1').hide()},1000);
        }
        else if ($('.phone').val() == "") {
            $('.phone-1').show();
            setTimeout(function(){$('.phone-1').hide()},1000);
        }
        else if (!(/^1[34578]\d{9}$/.test(tel))){
            $('.phone-1').text('请填写正确的手机号').show();
            setTimeout(function(){$('.phone-1').hide()},1000);
        }
        else if ($('.city').text('请选择您所在的城市')) {
         $('.city-1').show();
         setTimeout(function(){$('.city-1').hide()},1000);
         $('.city').text('');
        }

    })
})
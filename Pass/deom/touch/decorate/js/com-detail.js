$(function(){
	var mySwiper = new Swiper('.swiper-container',{  
		autoplay : 5000,//可选选项，自动滑动  
		})
	// 免费设计
    $('.sj').click(function(){
    	var  x = $(".sj_list");
    	if (x.css("display")=="none") {
    		x.show();
    		$('.disk').show();
    		$('body').addClass('by');
    	}else{
    		x.hide();
    		$('.disk').hide();
    		$('body').removeClass('by');
    	}
    })
    $('.sj_list p').click(function(){
    	$('.disk').hide();
		$('body').removeClass('by');
    	$('.sj_list').hide();
    	$('.stylist_lead').removeClass('sc_1');
		$('.screen').removeClass('sc_1');
    })
    //免费设计区域选择
    $('.sj_list .yu_place').click(function(){
		    var t = $(this);
		    $('.sj_pl').addClass('show').animate({"left":"22%"},200);
		    $('.disk').show();
		    // $('body').addClass('by')
  	})
  	$('.disk,.sj_pl .pl-1 ul li').click(function(){
  			var t = $(this);
		    $('.sj_pl').removeClass('show').animate({"left":"100%"},200);
		    // $('body').removeClass('by')
  	})
  	$('.province ul li').click(function(){
		var x = $(this);
		var index = x.index();
		$('.sj_pl .pl-1 ul').eq(index).show();
      	$('.sj_pl .pl-1 ul').eq(index).siblings().hide();
      	x.addClass('pr-bc');
      	x.siblings('li').removeClass('pr-bc');
	})
		// 免费报价
    $('.cj').click(function(){
    	var  x = $(".bj_list");
    	if (x.css("display")=="none") {
    		x.show();
    		$('.disk').show();
    		$('body').addClass('by');
    	}else{
    		x.hide();
    		$('.disk').hide();
    		$('body').removeClass('by');
    	}
    })
    $('.bj_list p').click(function(){
    	$('.disk').hide();
		$('body').removeClass('by');
    	$('.bj_list').hide();
    	$('.stylist_lead').removeClass('sc_1');
		$('.screen').removeClass('sc_1');
    })
    //免费设计区域选择
    $('.bj_list .yu_place').click(function(){
		    var t = $(this);
		    $('.bj_pl').addClass('show').animate({"left":"22%"},200);
		    $('.disk').show();
		    // $('body').addClass('by')
  	})
  	$('.disk,.bj_pl .pl-1 ul li').click(function(){
  			var t = $(this);
		    $('.bj_pl').removeClass('show').animate({"left":"100%"},200);
		    // $('body').removeClass('by')
  	})
  	$('.bj_pl .province ul li').click(function(){
		var x = $(this);
		var index = x.index();
		$('.bj_pl .pl-1 ul').eq(index).show();
      	$('.bj_pl .pl-1 ul').eq(index).siblings().hide();
      	x.addClass('pr-bc');
      	x.siblings('li').removeClass('pr-bc');
	})
	// 表单验证
	$('.bj_list .submit').click(function(){
        var tel = $('.bj_list .phone').val();
        if ($('.bj_list .name').val() == "") {
			$('.bj_list .name-1').show();
	    	setTimeout(function(){$('.name-1').hide()},1000);
		}
        else if ($('.bj_list .phone').val() == "") {
            $('.bj_list .phone-1').show();
            setTimeout(function(){$('.bj_list .phone-1').hide()},1000);
        }
        else if (!(/^1[34578]\d{9}$/.test(tel))){
            $('.bj_list .phone-1').text('请填写正确的手机号').show();
            setTimeout(function(){$('.phone-1').hide()},1000);
        }
        else if ($('.bj_list .city').text('请选择您所在的城市')) {
         $('.bj_list .city-1').show();
         setTimeout(function(){$('.bj_list .city-1').hide()},1000);
         $('.bj_list .city').text('');
        }

    })
    $('.sj_list .submit').click(function(){
        var tel = $('.sj_list .phone').val();
        if ($('.sj_list .name').val() == "") {
			$('.sj_list .name-1').show();
	    	setTimeout(function(){$('.name-1').hide()},1000);
		}
        else if ($('.sj_list .phone').val() == "") {
            $('.sj_list .phone-1').show();
            setTimeout(function(){$('.sj_list .phone-1').hide()},1000);
        }
        else if (!(/^1[34578]\d{9}$/.test(tel))){
            $('.sj_list .phone-1').text('请填写正确的手机号').show();
            setTimeout(function(){$('.phone-1').hide()},1000);
        }
        else if ($('.sj_list .city').text('请选择您所在的城市')) {
         $('.sj_list .city-1').show();
         setTimeout(function(){$('.sj_list .city-1').hide()},1000);
         $('.sj_list .city').text('');
        }

    })


	// 区域选择
	$('.bj_pl .pl-1 ul li').click(function(){
			var  x = $(this);
			var  b = x.text();
			$('.bj_list .city').val(b);
		})
	$('.sj_pl .pl-1 ul li').click(function(){
			var  x = $(this);
			var  b = x.text();
			$('.sj_list .city').val(b);
		})
})
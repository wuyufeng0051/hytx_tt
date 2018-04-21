$(function(){
	// banna轮播图
	$('.picscroll .count').text($('#picscroll li').length);
	 $('#picscroll').slider({changedFun:function(n){
			 var li = $('#picscroll ul li'), active = li.eq(n);
			 if(n < li.length - 1) {
					 if(!active.hasClass('showed')) {
							 active.addClass('showed');
					 }
					 var next = li.eq(n+1);
					 next.addClass('showed');
			 }
			 $('#picscroll .number').text(++n);
	 }})
	var mySwiper = new Swiper('.swiper-container',{  
		autoplay : 5000,//可选选项，自动滑动  
		})
	// 装修效果图
	  $('.effect-lead ul li').click(function(){
	    var t = $(this), index = t.index();
	    t.addClass('effect-bc').siblings('li').removeClass('effect-bc');
	    $('.effect-pic .pic-com').eq(index).show().siblings().hide();
	  })	
	// 地区选择
	$('.city').click(function(){
		    var t = $(this);
		    $('.place').addClass('show').animate({"left":"22%"},200);
		    $('.disk').show();
		    // $('body').addClass('by')
  	})
  	$('.disk,.pl-1 ul li').click(function(){
  			var t = $(this);
		    $('.place').removeClass('show').animate({"left":"100%"},200);
		    $('.disk').hide();
		    // $('body').removeClass('by')
  	})
  	$('.check').click(function(){
		var dom = $("input[type='checkbox']").is(':checked')
  		if (dom) {
			$('.apply').addClass('sq')
		}else{
			$('.apply').removeClass('sq')
		}
  	})
	$('.province ul li').click(function(){
		var x = $(this);
		var index = x.index();
		$('.pl-1 ul').eq(index).show();
      	$('.pl-1 ul').eq(index).siblings().hide();
      	x.addClass('pr-bc');
      	x.siblings('li').removeClass('pr-bc');
	})


	

	// 表单验证
	$('.apply').click(function(){
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
		else if ($('.city').text() == '请选择您所在的城市') {
			$('.city-1').show();
	    	setTimeout(function(){$('.city-1').hide()},1000);
		};
	})
	// 区域选择
	$('.pl-1 ul li').click(function(){
			var  x = $(this);
			var  b = x.text();
			$('.city').text(b);
		})


})

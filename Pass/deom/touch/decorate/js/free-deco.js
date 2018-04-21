$(function(){
	$('.free_list .free_in span').click(function(){
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
	$('.province ul li').click(function(){
		var x = $(this);
		var index = x.index();
		$('.pl-1 ul').eq(index).show();
      	$('.pl-1 ul').eq(index).siblings().hide();
      	x.addClass('pr-bc');
      	x.siblings('li').removeClass('pr-bc');
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
$(function(){
	// 付款选择方式
	$('.pay_style ul li').click(function(){
		var x = $(this);
		x.addClass('pay_bc').siblings('li').removeClass('pay_bc');
	})
	// 提交验证
	$('.sure button').click(function(){
		var tel = $('.tel input').val();
		 if ($('.name input').val() == "") {
			$('.warning').text('请填写您的名字').show();
	    	setTimeout(function(){$('.warning').hide()},1000);
		}
        else if ($('.tel input').val() == "") {
            $(' .warning').text('请填写您的手机号').show();
            setTimeout(function(){$(' .warning').hide()},1000);
        }
        else if (!(/^1[34578]\d{9}$/.test(tel))){
            $(' .warning').text('请填写正确手机号').show();
            setTimeout(function(){$('.warning').hide()},1000);
        }
        else if ($('.huo input').val() == "") {
         $(' .warning').text('请填写您的货物类型').show();
         setTimeout(function(){$(' .warning').hide()},1000);
        }
        else if ($(' .t_wei input').val() == "") {
         $(' .warning').text('请填写您取货的位置及店铺！').show();
         setTimeout(function(){$(' .warning').hide()},1000);
        }
        else if ($(' .s_wei input').val() == "") {
         $(' .warning').text('请填写您送达的位置及店铺！').show();
         setTimeout(function(){$(' .warning').hide()},1000);
        }
	})
})
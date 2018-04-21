$(function(){
	// 提交验证
	$('.datum_button .save').click(function(){
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
        else if ($('.place input').val() == "") {
            $(' .warning').text('请填写您的地址').show();
            setTimeout(function(){$('.warning').hide()},1000);
        }
	})
})
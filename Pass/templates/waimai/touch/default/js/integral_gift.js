$(function(){
	// 提交验证
	$('.gift_button button').click(function(){
		var tel = $('.tel input').val();
		 if ($('.name input').val() == "") {
			$('.warning').text(langData['waimai'][3][83]).show();
	    	setTimeout(function(){$('.warning').hide()},1000);
		}
        else if ($('.tel input').val() == "") {
            $(' .warning').text(langData['waimai'][3][84]).show();
            setTimeout(function(){$(' .warning').hide()},1000);
        }
        else if (!(/^1[34578]\d{9}$/.test(tel))){
            $(' .warning').text(langData['waimai'][3][85]).show();
            setTimeout(function(){$('.warning').hide()},1000);
        }
	})
})

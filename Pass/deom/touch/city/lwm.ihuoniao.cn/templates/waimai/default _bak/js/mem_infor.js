$(function(){
	// 性别选项
	$('.mem_form .mem_txt label').click(function(){
		var x = $(this);
		x.addClass('la_bc').siblings('label').removeClass('la_bc');
	})
	// 绑定手机号
	$('.mem_form .mem_txt.tel span').click(function(){
		var x = $(this);
		x.hide();
		x.closest('.tel').find('input').show();
		$('.tel_1').show();
	})
	// 提交验证
	$('.mem_button button').click(function(){
		 if ($('.name input').val() == "") {
			$('.warning').text('请填写您的名字').show();
	    	setTimeout(function(){$('.warning').hide()},1000);
		}
        else if ($('.place input').val() == "") {
            $(' .warning').text('请填写您的地址').show();
            setTimeout(function(){$('.warning').hide()},1000);
        }
	})
})
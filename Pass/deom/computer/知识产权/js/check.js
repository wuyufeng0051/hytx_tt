$(function(){
	$('.save').click(function(){
		var email = $('.email').val();
		if ($('.company').val() == "") {
			$('.company_check').text('公司名不能为空').addClass('Validform_wrong').show();
			$('body').animate({scrollTop: $('.company').offset().top-200}, 1000);
			setTimeout(function(){$('.company_check').hide()},3000);
		}
		else if ($('.email').val() == "") {
			$('.email_check').text('邮箱不能为空').addClass('Validform_wrong').show();
			$('body').animate({scrollTop: $('.email').offset().top-200}, 1000);
			setTimeout(function(){$('.email_check').hide()},3000);
		}
		else if (!(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email))){
			$('.email_check').text('邮箱格式不正确！').addClass('Validform_wrong').show();
			$('body').animate({scrollTop: $('.email').offset().top-200}, 1000);
			setTimeout(function(){$('.email_check').hide()},3000);
		};
	
	})
})
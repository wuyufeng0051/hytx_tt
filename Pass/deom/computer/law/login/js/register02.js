$(function(){
//表单注册
	$('.messagebox01 input').click(function(){
		$(this).removeClass('flagquick');
		$(this).parent('.messagebox01').find('.phoneNum01').hide();
		$('.checkDuring .warningTxt').hide();
	})
	$('.messagebox03 a.nowbtn').click(function(){
		var tel = $('.checkEnding').find('input').val();
		var q = $('.checkEnding').find('input');
		var w = $('.checkLasting').find('input');
		var e = $('.checkBegining').find('input');
		var r = $('.checkDuring').find('input');
		if(!(/^1[34578]\d{9}$/.test(tel))){
			q.addClass('flagquick');
			$('.checkEnding').find('.phoneNum01').show();
		}
		else if(q.val() == ''){
			q.addClass('flagquick');
			$('.checkEnding').find('.phoneNum01').show();
		}
		else if(w.val() == ''){
			w.addClass('flagquick');
			$('.checkLasting').find('.phoneNum01').show();
		}
		else if(e.val() == ''){
			e.addClass('flagquick');
			$('.checkBegining').find('.phoneNum01').show();
		}
		else if(r.val() == ''){
			r.addClass('flagquick');
			$('.checkDuring').find('.phoneNum01').show();
		}
		//判断两次密码是否一致
		if(e.val() != r.val()){
			$('.warningTxt').text("两次密码输入不一致！请重新输入").css({"font-size":"14px","color":"red"})
			$('.checkDuring').find('.phoneNum01').hide();
			$('.checkDuring .warningTxt').show();
			r.addClass('flagquick');
		}
	})
//判断密码强度
	$('#pass').keyup(function(e) {
			 var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
			 var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
			 		 if (strongRegex.test($(this).val())) {
			 			$('.tipbox').className = 'ok';
			 			$('.tipbox').find('.strong').addClass('passClor');
			 			$('.tipbox').find('.middle').removeClass('passClor');
			 			$('.tipbox').find('.weak').removeClass('passClor');
			 		} 
			 		else if (mediumRegex.test($(this).val())) {
			 			$('.tipbox').className = 'alert';
			 			$('.tipbox').find('.middle').addClass('passClor');
			 			$('.tipbox').find('.strong').removeClass('passClor');
			 			$('.tipbox').find('.weak').removeClass('passClor');
			 		} 
			 		else {
			 			$('.tipbox').className = 'error';
			 			$('.tipbox').find('.weak').addClass('passClor');
			 			$('.tipbox').find('.strong').removeClass('passClor');
			 			$('.tipbox').find('.middle').removeClass('passClor');
			 		}
			 		return true;
	})

})
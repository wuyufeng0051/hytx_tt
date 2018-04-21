$(function(){
	//表单认证
	$('.Rglove dd input').click(function(){
		$(this).parent().parent().find('.phoneNum01').hide();
		$(this).removeClass('Youandme');
		$('.checkMiddle .warningTxt').hide();
	})
	$('.right a').click(function(){
		var tel = $('.checkBeginning').find('input').val();
		var q = $('.checkBeginning').find('input');
		var w = $('.checkDuring').find('input');
		var e = $('.checkMiddle').find('input');
		var r = $('.checkEndding').find('input');
		var t = $('.checkLasting').find('input');
		var y = $('.checkOf').find('input');
		if(!(/^1[34578]\d{9}$/.test(tel))){
			$('.checkBeginning').find('.phoneNum01').show();
			q.addClass('Youandme');
		}
		else if(q.val() == ''){
			$('.checkBeginning').find('.phoneNum01').show();
			q.addClass('Youandme');
		}
		else if(w.val() ==''){
			$('.checkDuring').find('.phoneNum01').show();
			w.addClass('Youandme');
		}
		else if(e.val() == ''){
			$('.checkMiddle').find('.phoneNum01').show();
			e.addClass('Youandme');
		}
		else if(r.val() == ''){
			$('.checkEndding').find('.phoneNum01').show();
			r.addClass('Youandme');
		}
		else if(t.val() == ''){
			$('.checkLasting').find('.phoneNum01').show();
			t.addClass('Youandme');
		}
		else if(y.val() == ''){
			$('.checkOf').find('.phoneNum01').show();
			y.addClass('Youandme');
		}
		//验证密码是否一致
		if(w.val() != e.val()){
			$('.warningTxt').text("两次输入密码不一致！请重新输入").css({"color":"red","font-size":"14px"})
			$('.checkMiddle').find('.phoneNum01').hide();
			$('.checkMiddle .warningTxt').show();
			e.addClass('Youandme');
		}
	})
	//密码强度
	$('#pass').keyup(function(e) {
			 var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
			 var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
			 		 if (strongRegex.test($(this).val())) {
			 			$('.password').className = 'ok';
			 			$('.password').find('.strong').addClass('current');
			 			$('.password').find('.middle').removeClass('current');
			 			$('.password').find('.weak').removeClass('current');
			 		} 
			 		else if (mediumRegex.test($(this).val())) {
			 			$('.password').className = 'alert';
			 			$('.password').find('.middle').addClass('current');
			 			$('.password').find('.strong').removeClass('current');
			 			$('.password').find('.weak').removeClass('current');
			 		} 
			 		else {
			 			$('.password').className = 'error';
			 			$('.password').find('.weak').addClass('current');
			 			$('.password').find('.strong').removeClass('current');
			 			$('.password').find('.middle').removeClass('current');
			 		}
			 		return true;
	})
})
var $mbg = $('<div class="modal-bg" style="position:fixed;left:0;top:0;width:100%;height:100%;background:#000;opacity:.5;filter:alpha(opacity=50);z-index:1999;display:none"></div>');
/* 客服 */
var kf = $('#right_kf'),firstkf = false,openlock = false;

function hideKF(type){
	firstkf = false;
	$mbg.fadeOut(200,function(){
		$mbg.remove();
	});
}

var kfcookie = $.cookie(cookiePre+'rkf');
if(kfcookie == null || kfcookie == '' || kfcookie == 0) {
	firstkf = true;
	kf.addClass('kf_big');
	$mbg.click(function(){
		$('.right_kf .close').click();
	})
	$('body').append($mbg);
	$mbg.fadeIn(500);

	firstkf = true;
	$.cookie(cookiePre+'rkf','open',{expires: 7});
} else {
	if(kfcookie == 'open') {
		$('.right_kf').addClass('open');
	}
}


$(function(){
	// 鼠标移入右侧客服
	$('.right_kf li').hover(function(){
		if(openlock || firstkf) return;
		$('.right_kf').addClass('open');
		$(this).addClass('hover');
		$.cookie(cookiePre+'rkf','open',{expires: 7});
	},function(){
		$(this).removeClass('hover');
	})
	// 关闭客服
	$('.right_kf .close').click(function(){
		if(firstkf) {
			firstkf = false;
			kf.removeClass('kf_big').addClass('open');
			hideKF();
		} else {
			openlock = true;
			setTimeout(function(){
				openlock = false;
			},300)
			$('.right_kf').removeClass('open');
			$.cookie(cookiePre+'rkf','close',{expires: 7});
		}
	})

	// 显示二维码
	$('#showewm').click(function(){
		var con = $('.emwbox');
		$mbg.click(function(){
			con.stop(true).show().animate({
				'top' :  '20%',
				'opacity' : 0
			},500,function(){
				con.hide();
			})
			$mbg.fadeOut(200,function(){
				$mbg.remove();
			});
		})
		con.stop(true).show().animate({
			'top' :  '25%',
			'opacity' : 1
		},500)
		$('body').append($mbg);
		$mbg.fadeIn(500);
	})

	/* 在线沟通工具绑定点击事件 */
	$('.kf_qq3').on('click',function(){
	    $('#nb_icon_wrap').click();
		if(firstkf) {
			firstkf = false;
			kf.removeClass('kf_big').addClass('open');
			hideKF();
		}
	})
	$('.kf_online').on('click',function(){
		$('#live800iconlink').click();
	})

})
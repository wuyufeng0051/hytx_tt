$(function(){

	// 报名
	$('.baoming').click(function(){
		var state = '';
		if(detail.state == 0){
			state = '投票还未开始';
		}else if(detail.state == 2){
			state = '报名已结束';
		}else if(detail.state == 3){
			state = '投票已结束';
		}
		if(state == ''){
			checkLogin();
		}else{
			$.dialog.alert(state);
		}
	})

	var uid = 0; //当前用户id
	var uname = '';

	// 打开投票层
	$('#list').delegate(".vote","click",function(){
		// 判断活动是否结束
		if(detail.state == 3){
			$.dialog.alert('抱歉，投票已结束！');
			return;
		}
		// 判断活动是否允许匿名
		var r = true;
		if(detail.voteuser == 1){
			r = checkLogin();
		}
		var t = $(this);
		uid = t.closest('.content').data('uid');
		uname = t.closest('.content').find('.user').text();
		if(r){
			$('.rewardS-mask,.opdv').show();
			$('.vdimgckinp').val('');
			$('.mname').focus();
		}
	})
	// 投票
	$('.votesubmit').click(function(){
		var t = $(this), mname = $('.mname').val(), mtel = $('.mtel').val(), vdimgck = $('.vdimgckinp').val(), tj = true;

		if(t.hasClass('disabled')) return;

		if(mname != '' && mtel == ''){
			tj = false;
			$.dialog.alert('请输入您的手机号');
		}else if(mname == '' && mtel != ''){
			tj = false;
			$.dialog.alert('请输入您的姓名');
		}
		if(mname != '' && mtel != ''){
			var telReg = !!mtel.match(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/);
			if(!telReg){
				tj = false;
				$.dialog.alert('您输入的手机号不正确');
			}
		}
		if(vdimgck == ''){
			tj = false;
			$.dialog.alert('请输入验证码');
		}

		if(tj){
			t.addClass('disabled').text('正在提交...');
			$.ajax({
				url: '/include/ajax.php?service=vote&action=vote&tid='+detail.id+'&uid='+uid+'&mname='+mname+'&mtel='+mtel+'&vdimgck='+vdimgck,
				type: 'GET',
				dataType: 'JSONP',
				success: function(data){
					$('.vdimgck').click();
					if(data && data.state == 100){
						$.dialog.tips('投票成功，感谢您对“'+uname+'”的支持！', 3, 'success.png');
						$('#list [data-uid="'+uid+'"] .n2').text(data.info)
						setTimeout(function(){
							$('.op-1 .close').click();
						},1000)
					}else{
						$.dialog.alert(data.info);
					}
					t.removeClass('disabled').text('我要投票');
				},
				error: function(){
					$('.vdimgck').click();
					t.removeClass('disabled').text('我要投票');
					$.dialog.alert('网络错误，请重试！');
				}
			})
		}
	})

	// 关闭投票窗口
	$('.op-1 .close').click(function(){
		$('.rewardS-mask,.opdv').hide();
	})

	// 更换验证码
	$('.vdimgck ,.change').click(function(){
		var img = $('.vdimgck');
		var src = img.attr('src') + '?v=' + new Date().getTime();
		img.attr('src',src);
	})
	// 验证是否登录
	function checkLogin(){
		var userid = $.cookie(cookiePre+"login_user");
		if(userid == null || userid == ""){
			top.location.href = masterDomain + '/login.html';
			return false;
		}else{
			return true;
		}
	}

	window._bd_share_config = {
	"common": {
	  "bdSnsKey": {},
	  "bdText": "",
	  "bdMini": "2",
	  "bdMiniList": false,
	  "bdPic": "",
	  "bdStyle": "0",
	  "bdSize": "16"
	},
	"share": {}
	};
	with(document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~ ( - new Date() / 36e5)];


})

$(function(){
	// 注册方式切换
	var type = 1;
	var mark = $('.mark');
	var mtimer;
	var regform = $('.registform');
	var djs = $('#djs'),dsjinfo = $('.vdimgckinfo');

	//第三方登录
	$(".loginconnect, .otherlogin a").click(function(e){
		e.preventDefault();
		var href = $(this).attr("href");
		loginWindow = window.open(href, 'oauthLogin', 'height=565, width=720, left=100, top=100, toolbar=no, menubar=no, scrollbars=no, status=no, location=yes, resizable=yes');

		//判断窗口是否关闭
		mtimer = setInterval(function(){
			if(loginWindow.closed){
				clearInterval(mtimer);
				huoniao.checkLogin(function(){
					location.reload();
				});
			}
		}, 1000);
	});

	$('.tab-nav li').click(function(){
		var a = $(this),index = a.index();
		clearInterval(mtimer);
		if(a.hasClass('active')) return;
		a.addClass('active').siblings().removeClass('active');
		var left = a.position().left,width = a.width();

		type = index + 1;
		regform.removeClass('ftype01 ftype02 ftype03').addClass('ftype0'+type).find('.error').text('');

		if(type == 1){
			$('.type02,.type03,.dtvdimgck').hide();
			$('.type01').show();
		}
		if(type == 2){
			$('.type01,.type03').hide();
			$('.type02,.dtvdimgck').show();
		}
		if(type == 3){
			$('.type01,.type02').hide();
			$('.type03,.dtvdimgck').show();
		}
		mark.stop(true).animate({
			'left':left+'px',
			'width':width+'px'
		},300)

	})
	// 会员类型
	$('.register .usertype label').click(function(){
		var a = $(this),i = a.children('input');
		if(i.is(':checked')){
			a.addClass('selected').siblings().removeClass('selected');
		}
	})
	// 协议
	$('.agreement label').click(function(){
		$(this).toggleClass('checked');
	})

	// 更换验证码
	$('.vdimgck ,.change').click(function(){
		var a = $(this),img;
		if(a.hasClass('change')){
			img = a.siblings('img');
		}else{
			img = a;
		}
		var src = img.attr('src') + '?v=' + new Date().getTime();
		img.attr('src',src);
	})



	regform.find('.inp').focus(function(){
		$(this).closest('.form-row').addClass('focus');
	}).blur(function(){
		$(this).closest('.form-row').removeClass('focus');
	})

	//倒计时（开始时间、结束时间、显示容器）
	var countDown = function(time, obj, func){
		$('.sendvdimgck'+type).hide();
		obj.text(time+'s后重新发送');
		mtimer = setInterval(function(){
			obj.text((--time)+'s后重新发送');
			if(time <= 0) {
				clearInterval(mtimer);
				obj.text('');
				$('.sendvdimgck'+type).show();
				// dsjinfo.hide();
			}
		}, 1000);
	}



	//发送验证码
	function sendVerCode(a){
		var b = $('.sendvdimgck'+type),v = $('.username'+type).val();

		if(vdimgck.username(type) && getdjz(type) === true){

			var action = type == 2 ? "getEmailVerify" : "getPhoneVerify";
			var dataName = type == 2 ? "email" : "phone";

			$.ajax({
				url: masterDomain+"/include/ajax.php?service=siteConfig&action="+action,
				data: $(".registform").serialize()+"&"+dataName+"="+v+"&type=signup",
				type: "POST",
				dataType: "jsonp",
				success: function (data) {
					//获取成功
					if(data && data.state == 100){
						var time = new Date().getTime();
						b.hide();
						countDown(60,djs);
						info(type,v);
						$.cookie("HN_getyzm_"+type,time,"/");
						$.cookie("HN_getyzmv_"+type,v,"/");

					//获取失败
					}else{
						alert(data.info);
					}
				},
				error: function(){
					alert("网络错误，发送失败！");
				}
			});

		}
	}



	//是否使用极验验证码
	var sendvdimgckBtn;
	if(geetest){

		//极验验证
		var handlerPopup = function (captchaObj) {
			captchaObj.appendTo("#popup-captcha");

			// 成功的回调
			captchaObj.onSuccess(function () {
				var validate = captchaObj.getValidate();
				$.ajax({
					url: masterDomain+"/include/ajax.php", // 进行二次验证
					type: "post",
					dataType: "json",
					data: {
						action: "geetest",
						geetest_challenge: validate.geetest_challenge,
						geetest_validate: validate.geetest_validate,
						geetest_seccode: validate.geetest_seccode
					},
					success: function (data) {
						sendVerCode(sendvdimgckBtn);
					}
				});
			});


			$(document).on('click','.sendvdimgck',function(){
				var a = $(this), b = $('.sendvdimgck'+type), v = $('.username'+type).val();
				if(vdimgck.username(type) && getdjz(type) === true){
					sendvdimgckBtn = a;
					captchaObj.show();
				}
			});

		};


	    $.ajax({
	        url: masterDomain+"/include/ajax.php?service=siteConfig&action=geetest&t=" + (new Date()).getTime(), // 加随机数防止缓存
	        type: "get",
	        dataType: "json",
	        success: function (data) {
	            initGeetest({
	                gt: data.gt,
	                challenge: data.challenge,
	                product: "popup",
	                offline: !data.success
	            }, handlerPopup);
	        }
	    });
	}



	// 发送验证码
	if(!geetest){
		$(document).on('click','.sendvdimgck',function(){
			sendVerCode($(this));
		})
	}

	function info(type,v){
		var t = type == 2 ? '邮箱' : '手机';
		dsjinfo.html('输入您的'+t+'<span>'+v.substr(0,2)+'*******'+v.substr(v.length-5)+'</span>上收到的验证码，填写些正确后可以设置新的登陆密码。如果60s未收到，请点击<a href="javascript:;" class="sendvdimgck"><i class="regicon regmail"></i>获取'+t+'验证码</a>重新获取').show();
	}

	function getdjz(type){
		var time = $.cookie('HN_getyzm_'+type);
		if(time) {
			var now = new Date().getTime();
			var c = now - time,s = parseInt(c/1000);
			if(s < 60){
				return {r:false,s:60-s};
			}else{
				return true;
			}
		}else{
			return true;
		}
	}


	var vdimgck = {
		username : function(type){
			var o = $('.username'+type),v = o.val(),e = o.siblings('.error');
			if(type == 1){
				if(v == ''){
					e.text('请填写您的用户名');
					return false;
				}else{
					if(v.length < 3 || v.length > 15){
						e.text('用户名为3~15个字符');
						return false;
					}else{
						return true;
					}
				}
			}
			if(type == 2){
				if(v == ''){
					e.text('请填写您的邮箱');
					return false;
				}else{
					var reg = !!v.match(/^([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/);
					if(!reg) {
						e.text('邮箱有误');
						return false;
					}else{
						return true;
					}
				}
			}
			if(type == 3){
				if(v == ''){
					e.text('请填写您的手机号');
					return false;
				}else{
					var telReg = !!v.match(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/);
					if(!telReg){
						e.text('号码有误');
						return false;
					}else{
						return true;
					}
				}
			}
		},
		password : function(){
			var o = $('.password'),v = o.val(),e = o.siblings('.error');
			if(v == ''){
				e.text('请填写密码');
				return false;
			}else{
				var o2 = $('.repassword'),v2 = o2.val(),e2 = o2.siblings('.error');
				if(v2 == ''){
					e2.text('请填写确认密码');
					return false;
				}else{
					if(v != v2){
						e2.text('两次密码不一致');
						return false;
					}else{
						return true;
					}
				}
			}
		},
		yzm : function(type){
			if(type == 1){
				var o = $('.yzm'),v = o.val(),e = o.siblings('.error');
				if(v == ''){
					e.text('请填写验证码');
					return false;
				}else{
					return true;
				}
			}
			if(type == 2 || type == 3){
				var o = $('.yzm2'),v = o.val(),e = o.siblings('.error');
				if(v == ''){
					e.text('请填写验证码');
					return false;
				}else{
					return true;
				}
			}
		}
	}
	// 提交
	regform.submit(function(e){
		regform.find('.error').text('');

		var btn = $(".submit");
		var mtype = $(".usertype .selected").index() + 1;
		var username = $(".username1").val();
		var password = $(".password").val();
		var vericode = $(".yzm").val();
		var username2 = $(".username2").val();
		var username3 = $(".username3").val();
		var yzm2 = $(".yzm2").val();
		var data = [];
		data.push('mtype='+mtype);
		data.push('rtype='+($(".tab-nav .active").index() + 1));
		data.push('password='+password);

		var tj = true;

		//邮箱、手机
		if(type > 1){
			if(vdimgck.username(type) && vdimgck.yzm(type) && vdimgck.password()){

				if(type == 2){
					data.push('account='+username2);
				}else{
					data.push('account='+username3);
				}
				data.push('vcode='+yzm2);

			}else{
				tj = false;
			}

		//用户名
		}else{
			if(vdimgck.username(type) && vdimgck.password() && vdimgck.yzm(type)){

				data.push('username='+username);
				data.push('vericode='+vericode);

			}else{
				tj = false;
			}
		}

		if(!tj) return false;
		btn.attr("disabled", true).val("提交中...");

		//异步提交
		$.ajax({
			url: masterDomain+"/registerCheck_v1.html",
			data: data.join("&"),
			type: "POST",
			dataType: "html",
			success: function (data) {

				var dataArr = data.split("|");
					var info = dataArr[1];
					if(data.indexOf("100|") > -1){
						$("body").append('<div style="display:none;">'+data+'</div>');
						location.href = userDomain;

					}else{
						alert(info.replace(new RegExp('<br />','gm'),'\n'));
					}
					btn.attr("disabled", false).val("重新提交");

			},
			error: function(){
				alert("网络错误，请稍候重试！");
				btn.attr("disabled", false).val("重新提交");
			}
		});
		return false;

	})

})

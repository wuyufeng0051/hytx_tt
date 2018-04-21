var huoniao = {
	login:function(){
		var html = '<div id="modal_login"> <div class="bg"></div> <div class="box"> <div class="title"> <a href="javascript:;" class="close"></a> <h3>火鸟账号</h3> </div> <div class="bd"> <form action=""> <div class="form-row"> <div class="form-ipt"> <div class="form-icon"><i class="icon-user"></i></div> <input type="text" class="form-input username" value="" autocomplete="off" placeholder="手机或邮箱"> <a href="javascript:;" class="clear"></a> </div> </div> <div class="form-row"> <div class="form-ipt"> <div class="form-icon"><i class="icon-pasd"></i></div> <input type="password" class="form-input password" value="" autocomplete="off" placeholder="密码"> <a href="javascript:;" class="clear"></a> </div> </div> <div class="form-error"></div> <div class="form-btn"> <input type="submit" class="submit" value="登录"> </div> </form> </div> <div class="link fn-clear"> <a href="'+passportDomain+'/login.html#getpasd" class="fn-left" target="_blank">忘记密码？</a><a href="'+passportDomain+'/regist.html" class="fn-right" target="_blank">注册</a> </div> </div> </div>';
		$('body').append(html);
		var $login = $('#modal_login'),$form = $login.find('form'),$username = $login.find('.username'),$pasd = $login.find('.password'),$error = $login.find('.form-error'),$close = $login.find('.close');
		// $username.focus();
		$(document).on("input propertychange","#modal_login .form-input",function(){
			var i = $(this),v = i.val();
			if(v != '') {
				i.siblings('.clear').show();
			} else {
				i.siblings('.clear').hide();
			}
		})

		$login.find('.form-ipt input').focus(function(){
			$(this).closest('.form-ipt').addClass('focus');
		})
		$(document).on("click","#modal_login .clear",function(){
			var c = $(this),i = c.siblings('input');
			i.val('').focus();
			console.log('ckkk')
			c.hide();
		})

		var inputVerify = {
			mobile: function(){
				var t = $username, val = t.val();
				var exp = new RegExp("^(13|14|15|17|18)[0-9]{9}$", "img");
				if(val == ""){
					return 0;
				}else{
					if(!/^(13|14|15|17|18)[0-9]{9}$/.test(val) && val != ""){
						return 1;
					}
				}
				return 2;
			},
			email: function(){
				var t = $username, val = t.val();
				if(val == "") {
					return 0;
				} else {
					var reg = !!val.match(/^([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/);
					if(!reg) {
						return 1;
					}
				}
				return 2;
			},
			pasd: function(){
				var t = $pasd, val = t.val();
				if(val == "") {
					return 0;
				}
				return 2;
			}
		}

		$username.on('blur',function(){
			if(inputVerify.mobile() == 1 && inputVerify.email() == 1) {
				$error.html('<i class="iconerror"></i>请输入正确的用户名');
				$username.focus();
			} else {
				$error.html('');
			}
			$username.closest('.form-ipt').removeClass('focus');
		})
		$pasd.on('blur',function(){
			$pasd.closest('.form-ipt').removeClass('focus');
		})

		$form.submit(function(){
			if(inputVerify.mobile() != 2 && inputVerify.email() != 2) {
				$error.html('<i class="iconerror"></i>请输入正确的用户名');
				$username.focus();
				return false;
			}
			if(!inputVerify.pasd()) {
				$error.html('<i class="iconerror"></i>请输入密码');
				$pasd.focus();
				return false;
			}

		})

		$close.on('click',function(){
			$login.remove();
		})
	}

	,checkLogin: function(fun){
		//异步获取用户信息
		$.ajax({
			url: masterDomain+'/include/ajax.php',
			data: {'action': 'getUserInfo'},
			type: "GET",
			async: false,
			dataType: "jsonp",
			success: function (data) {
				data && fun();
			},
			error: function(){
				return false;
			}
		});
	}
}


$(function(){
	var supportTransition = supportCss3('transition');
	// 搜索
	$('.ss').hover(function(){
		var s = $(this) , sbtn = $('.search');
		if(supportTransition) {
			s.addClass('hover');
		} else {
			s.addClass('hoverie');
			sbtn.stop(true,true).animate({
				'width' : '140px',
				'padding' : '5px'
			},300)
		}
		setTimeout(function(){
			sbtn.focus();
		},300)
	},function(){
		s = $(this) , sbtn = $('.search');
		if(supportTransition) {
			s.removeClass('hover');
		} else {
			s.removeClass('hoverie');
			sbtn.stop(true,true).animate({
				'width' : '0',
				'padding' : '5px 0'
			})
		}
	})


	//第三方登录
	var mtimer = null;
	$(".loginconnect").click(function(e){
		e.preventDefault();
		var href = $(this).attr("href");
		loginWindow = window.open(href, 'oauthLogin', 'height=565, width=720, left=100, top=100, toolbar=no, menubar=no, scrollbars=no, status=no, location=yes, resizable=yes');

		//var i = 0;
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



	// 主导航hover
	$('.mainnav li').hover(function(){
		var a = $(this);
		a.addClass('curr');
	},function(){
		var a = $(this);
		a.removeClass('curr');
	})

	//$mbg = $('<div class="modal-bg" style="position:fixed;left:0;top:0;width:100%;height:100%;background:#000;opacity:.5;filter:alpha(opacity=50);z-index:1999;display:none"></div>');

	/* 客服 */
	//var kf = $('#right_kf'),firstkf = false,openlock = false;

	// function hideKF(type){
	// 	firstkf = false;
	// 	$mbg.fadeOut(200,function(){
	// 		$mbg.remove();
	// 	});
	// }

	// var kfcookie = $.cookie(cookiePre+'rkf');
	// if(kfcookie == null || kfcookie == '' || kfcookie == 0) {
	// 	firstkf = true;
	// 	kf.addClass('kf_big');
	// 	$mbg.click(function(){
	// 		$('.right_kf .close').click();
	// 	})
	// 	$('body').append($mbg);
	// 	$mbg.fadeIn(500);

	// 	firstkf = true;
	// 	$.cookie(cookiePre+'rkf','open',{expires: 7 , path: '/', domain: masterDomain.replace("http://www.", "")});
	// } else {
	// 	if(kfcookie == 'open') {
	// 		$('.right_kf').addClass('open');
	// 	}
	// }


	// 鼠标移入右侧客服
	// $('.right_kf li').hover(function(){
	// 	if(openlock || firstkf) return;
	// 	$('.right_kf').addClass('open');
	// 	$(this).addClass('hover');
	// 	$.cookie(cookiePre+'rkf','open',{expires: 7 , path: '/', domain: masterDomain.replace("http://www.", "")});
	// },function(){
	// 	$(this).removeClass('hover');
	// })
	// // 关闭客服
	// $('.right_kf .close').click(function(){
	// 	if(firstkf) {
	// 		firstkf = false;
	// 		kf.removeClass('kf_big').addClass('open');
	// 		hideKF();
	// 	} else {
	// 		openlock = true;
	// 		setTimeout(function(){
	// 			openlock = false;
	// 		},300)
	// 		$('.right_kf').removeClass('open');
	// 		$.cookie(cookiePre+'rkf','close',{expires: 7 , path: '/', domain: masterDomain.replace("http://www.", "")});
	// 	}
	// })

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

	//页面自适应设置
	$(window).resize(function(){
		var screenwidth = window.innerWidth || document.body.clientWidth;
		var criticalPoint = criticalPoint != undefined ? criticalPoint : 1240;
		var criticalClass = criticalClass != undefined ? criticalClass : "w1200";
		if(screenwidth < criticalPoint){
			$("html").removeClass(criticalClass);
		}else{
			$("html").addClass(criticalClass);
		}

		if($("#login_bg").html() != undefined){
			$("#login_bg").css({"height": $(document).height()});
		}
	});

	/* 在线沟通工具绑定点击事件 */
	// $('.kf_qq3').on('click',function(){
 //    $('#nb_icon_wrap').click();
	// 	if(firstkf) {
	// 		firstkf = false;
	// 		kf.removeClass('kf_big').addClass('open');
	// 		hideKF();
	// 	}
 //  })
  $('.kf_online').on('click',function(){
  	$('#live800iconlink').click();
  })


	//立即购买
	$("body").delegate(".buynow", "click", function(){
		//验证登录
		var userid = $.cookie(cookiePre+"login_user");
		if(userid == null || userid == ""){
			top.location = passportDomain;
			return false;
		}

		var t = $(this), type = t.data("type"), id = t.data("id");
		$.dialog({
			id: 'buynowPopup',
			width: 620,
			title: '在线支付',
			content: 'url:'+masterDomain+'/onlinepay.html?type='+type+'&id='+id
		});
	});


	$("a[target=qqlink_iframe]").each(function(){
		var browserName = navigator.appName;
		if(browserName == "Microsoft Internet Explorer"){
			$(this).attr("target", "_blank");
		}
	});
})

//是否支持css的某个属性
function supportCss3(style) {
    var prefix = ['webkit', 'Moz', 'ms', 'o'],
    i,
    humpString = [],
    htmlStyle = document.documentElement.style,
    _toHumb = function(string) {
        return string.replace(/-(\w)/g,
        function($0, $1) {
            return $1.toUpperCase();
        });
    };
    for (i in prefix) humpString.push(_toHumb(prefix[i] + '-' + style));
    humpString.push(_toHumb(style));
    for (i in humpString) if (humpString[i] in htmlStyle) return true;
    return false;
}



!function(e){function o(s){if(t[s])return t[s].exports;var n=t[s]={exports:{},id:s,loaded:!1};return e[s].call(n.exports,n,n.exports,o),n.loaded=!0,n.exports}var t={};return o.m=e,o.c=t,o.p="",o(0)}([function(e,o,t){e.exports=t(1)},function(e,o){!function(){var e;if(window.console&&"undefined"!=typeof console.log){try{(window.parent.__has_console_security_message||window.top.__has_console_security_message)&&(e=!0)}catch(o){e=!0}if(window.__has_console_security_message||e)return;var t="\u6e29\u99a8\u63d0\u793a\uff1a\u8bf7\u4e0d\u8981\u8c03\u76ae\u5730\u5728\u6b64\u7c98\u8d34\u6267\u884c\u4efb\u4f55\u5185\u5bb9\uff0c\u8fd9\u53ef\u80fd\u4f1a\u5bfc\u81f4\u60a8\u7684\u8d26\u6237\u53d7\u5230\u653b\u51fb\uff0c\u7ed9\u60a8\u5e26\u6765\u635f\u5931\u0020\uff01\u005e\u005f\u005e";/msie/gi.test(navigator.userAgent)?(console.log(t)):(console.log("%c \u706b\u9e1f\u95e8\u6237 %c Copyright \xa9 2013-%s",'font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;font-size:40px;color:#000;font-weight:700;background-image:-webkit-gradient(linear, 15 0, 10 bottom, from(rgba(248, 160, 8, 1)), to(rgba(234, 0, 45, 1)));-webkit-background-clip:text;-webkit-text-fill-color:transparent;',"font-size:12px;color:#999999;",(new Date).getFullYear()),console.log("%c "+t,"color:#333;font-size:14px;line-height:30px;")),window.__has_console_security_message=!0}}()}]);

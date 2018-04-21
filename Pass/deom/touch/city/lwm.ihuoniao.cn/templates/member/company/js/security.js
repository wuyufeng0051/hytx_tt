$(function(){

	var interval = [200, 400, 600, 800, 1000];
	var i = 0, score = 100;
	var testing = $(".testing"), percentage = testing.find(".percentage"), progress = testing.find(".progress");
	var verifyFunc = verifyType = verifyData = opera = returnUrl = null;
	var title = testing.find("h5");
	var p1 = progress.find(".p1"),
			p2 = progress.find(".p2"),
			p3 = progress.find(".p3"),
			p4 = progress.find(".p4"),
			p5 = progress.find(".p5");

	// if(doget != ""){
	// 	setPercentage(rating, 1);
	// 	$(".list ul").show();
	// 	setTimeout(function(){
	// 		//查看等待审核中的企业认证资料
	// 		if(doget == "chCertify" && (certifyState == 3 || certifyState == 1)){
	// 			$("#shCertify").click();
	// 		}else{
	// 			$("#"+doget).click();
	// 		}
	// 	}, 1);
	// }else{
		//异步获取体检结果
		$.ajax({
			url: masterDomain+"/include/ajax.php?service=member&action=riskAdvicePolicy",
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				//检测成功
				if(data && data.state != 200){
					animation(data.info);

				// //检测失败
				}else{
					progress.hide();
					percentage.removeClass().addClass("percentage complete l3").html("0");
					testing.find(".suc-tip").html("<font color='#de0202'>本次体检未完成，建议您重新进行体检！<br /><a href='javascript:;' class='btn' onclick='location.reload();'>重新体检</a></font>").show();
					title.html("体检已取消！");
				}
			}
		});
	// }

	function animation(data){
		var term = setTimeout(function(){
			if(i < interval.length){
				clearTimeout(term);
				if(i == 0){
					title.html("正在进行企业认证验证···");
					if(data.paypwd == "ok"){
						p1.addClass("ok");
					}else{
						p1.addClass("fail");
						$(".paypwd").addClass("fail");
						score -= 20;
					}
					$(".paypwd").fadeIn();
				}else if(i == 1){
					title.html("正在进行手机绑定验证···");
					if(data.licenseState == "ok"){
						p2.addClass("ok");
					}else{
						p2.addClass("fail");
						$(".certify").addClass("fail");
						score -= 20;
					}
					$(".certify").fadeIn();
				}else if(i == 2){
					title.html("正在进行邮箱绑定验证···");
					if(data.phoneCheck == "ok"){
						p3.addClass("ok");
					}else{
						p3.addClass("fail");
						$(".mobile").addClass("fail");
						score -= 20;
					}
					$(".mobile").fadeIn();
				}else if(i == 3){
					title.html("正在进行安全问题验证···");
					if(data.emailCheck == "ok"){
						p4.addClass("ok");
					}else{
						p4.addClass("fail");
						$(".email").addClass("fail");
						score -= 20;
					}
					$(".email").fadeIn();
				}else if(i == 4){
					title.html("完成体检，正在汇总得分···");
					if(data.security == "ok"){
						p5.addClass("ok");
					}else{
						p5.addClass("fail");
						$(".question").addClass("fail");
						score -= 20;
					}
					$(".question").fadeIn();
				}
				i++;
				setPercentage(score, 0);
				animation(data);
			}else{
				setTimeout(function(){setPercentage(score, 1);}, 500);
			}
		}, interval[Math.round(Math.random() * 2)]);
	}

	function setPercentage(num, state){
		percentage.html(num);
		var cla = "", txt = "";
		progress.find(".bar i").animate({"width": (i*20)+"%"}, 500);
		if(state == 1){
			// progress.hide();
			if(num < 100 && num > 40){
				percentage.removeClass().addClass("percentage complete l2");
				// testing.find(".suc-tip").html("<font color='#ffb014'>建议继续完善，获得更高保障<br />完善建议：支付密码不使用连续的或简单重复的数字/字母，使用两种以上字符设置安全问题</font>").show();
				cla = "ffb014";
				txt = "中";
			}else if(num <= 40){
				percentage.removeClass().addClass("percentage complete l3");
				// testing.find(".suc-tip").html("<font color='#de0202'>您的帐户存在严重安全隐患，强烈建议您立即升级！<br />友情提示：升级您的帐户信息将享受安全的在线支付服务以及方便查看和管理账户支出和收入</font>").show();
				cla = "de0202";
				txt = "低";
			}else{
				percentage.removeClass().addClass("percentage complete l1");
				// testing.find(".suc-tip").html("<font color='#008e11'>恭喜您，您已获得全面的安全保障<br />温馨建议：在账号日常操作中注意密码等安全信息的保护，切勿泄露</font>").show();
				cla = "008e11";
				txt = "高";
			}
			title.html("账号安全等级：<strong style='color: #"+cla+"'>"+txt+"</strong>");
			$(".checkSecure").show();
		}
	}

	$("html").delegate(".editForm input", "focus", function(){
		$(this).closest("dl").addClass("focus");
	});

	$("html").delegate(".editForm input", "blur", function(){
		$(this).closest("dl").removeClass("focus");
	});

	//修改登录密码
	$("#chpassword").bind("click", function(){
		modifyFun("修改登录密码", "chpasswordEdit", "password", 500, "确定修改", function(){
			var old = $("#old"), newest = $("#new"), confirm = $("#confirm");
			return "old="+old.val()+"&new="+newest.val()+"&confirm="+confirm.val();
		}, function(){
			var old = $("#old"), newest = $("#new"), confirm = $("#confirm"), passwordStrengthDiv = $("#passwordStrengthDiv").attr("class");
			if($.trim(old.val()) == ""){
				popTip("请输入当前密码", "error");
				old.focus();
				return "false";
			}
			if($.trim(newest.val()) == ""){
				popTip("请输入新密码", "error");
				newest.focus();
				return "false";
			}
			if(passwordStrengthDiv == "" || passwordStrengthDiv == undefined || Number(passwordStrengthDiv.replace("is", "")) < 50){
				popTip("您输入的新密码太过简单，请重新输入", "error");
				newest.focus();
				return "false";
			}
			if($.trim(confirm.val()) == ""){
				popTip("请确认新密码", "error");
				confirm.focus();
				return "false";
			}
			if(newest.val() != confirm.val()){
				popTip("两次输入的密码不一致，请重新输入", "error");
				confirm.focus();
				return "false";
			}
		});

		$(".editForm #new").passwordStrength();
	});

	//设置支付密码
	$("#paypwdAdd").bind("click", function(){
		modifyFun("设置支付密码", "chpaypwdAdd", "paypwdAdd", 500, "确定提交", function(){
			var pay1 = $("#pay1"), pay2 = $("#pay2");
			return "pay1="+pay1.val()+"&pay2="+pay2.val();
		}, function(){
			var pay1 = $("#pay1"), pay2 = $("#pay2"), passwordStrengthDiv = $("#passwordStrengthDiv").attr("class");
			if($.trim(pay1.val()) == ""){
				popTip("请输入支付密码", "error");
				pay1.focus();
				return "false";
			}
			if(passwordStrengthDiv == "" || passwordStrengthDiv == undefined || Number(passwordStrengthDiv.replace("is", "")) < 50){
				popTip("您输入的新密码太过简单，请重新输入", "error");
				pay1.focus();
				return "false";
			}
			if($.trim(pay2.val()) == ""){
				popTip("请确认支付密码", "error");
				pay2.focus();
				return "false";
			}
			if(pay1.val() != pay2.val()){
				popTip("两次输入的密码不一致，请重新输入", "error");
				pay2.focus();
				return "false";
			}
		});

		$(".editForm #pay1").passwordStrength();
	});

	//修改支付密码
	$("#paypwdEdit").bind("click", function(){
		modifyFun("修改支付密码", "chpaypwdEdit", "paypwdEdit", 500, "确定提交", function(){
			var old = $("#old"), newpay = $("#new"), confirm = $("#confirm");
			return "old="+old.val()+"&new="+newpay.val()+"&confirm="+confirm.val();
		}, function(){
			var old = $("#old"), newpay = $("#new"), confirm = $("#confirm"), passwordStrengthDiv = $("#passwordStrengthDiv").attr("class");
			if($.trim(old.val()) == ""){
				popTip("请输入原支付密码", "error");
				old.focus();
				return "false";
			}
			if($.trim(newpay.val()) == ""){
				popTip("请输入新的支付密码", "error");
				newpay.focus();
				return "false";
			}
			if(passwordStrengthDiv == "" || passwordStrengthDiv == undefined || Number(passwordStrengthDiv.replace("is", "")) < 50){
				popTip("您输入的新密码太过简单，请重新输入", "error");
				newpay.focus();
				return "false";
			}
			if($.trim(confirm.val()) == ""){
				popTip("请确认支付密码", "error");
				confirm.focus();
				return "false";
			}
			if(newpay.val() != confirm.val()){
				popTip("两次输入的密码不一致，请重新输入", "error");
				confirm.focus();
				return "false";
			}
		});

		$(".editForm #new").passwordStrength();
	});

	//重置支付密码
	$("#paypwdReset").bind("click", function(){
		opera = "paypwd";
		authentication(bindPaypwdUrl);
	});



	//删除文件
	$("html").delegate(".spic .reupload", "click", function(){
		var t = $(this), parent = t.parent(), input = parent.siblings("input"), iframe = parent.siblings("iframe"), src = iframe.attr("src");
		delFile(input.val(), false, function(){
			input.val("");
			t.prev(".sholder").html('');
			parent.hide();
			iframe.attr("src", src).show();
		});
	});

	//企业认证
	$("#chCertify").bind("click", function(){
		modifyFun("企业认证", "chCertifyAdd", "certify", 580, "提交认证", function(){
			var realname = $("#realname"), idcard = $("#idcard"), front = $("#front"), back = $("#back"), license = $("#license");
			return "realname="+realname.val()+"&idcard="+idcard.val()+"&front="+front.val()+"&back="+back.val()+"&license="+license.val();
		}, function(){
			var realname = $("#realname"), idcard = $("#idcard"), front = $("#front"), back = $("#back"), license = $("#license");
			if($.trim(realname.val()) == ""){
				popTip("请输入真实姓名", "error");
				realname.focus();
				return "false";
			}
			if($.trim(idcard.val()) == ""){
				popTip("请输入18位身份证号码", "error");
				idcard.focus();
				return "false";
			}
			if(!checkIdcard(idcard.val())){
				popTip("请输入正确的身份证号码", "error");
				idcard.focus();
				return "false";
			}
			if($.trim(front.val()) == ""){
				popTip("请上传身份证正面照片", "error");
				return "false";
			}
			if($.trim(back.val()) == ""){
				popTip("请上传身份证反面照片", "error");
				return "false";
			}
			if($.trim(license.val()) == ""){
				popTip("请上传营业执照", "error");
				return "false";
			}
		});

		$(".cardUpload .spic").hover(function(){
			$(this).find(".reupload").show();
		}, function(){
			$(this).find(".reupload").hide();
		});

	});

	//查看企业认证资料
	var certifyData = null;
	$("#shCertify").bind("click", function(){
		modifyFun("企业认证信息", "chCertify", "certify", 580, false);

		if(certifyData == null){
			$.ajax({
				url: masterDomain+"/include/ajax.php?service=member&action=updateAccount&do=getCerfityData",
				type: "GET",
				dataType: "jsonp",
				success: function (data) {
					//获取成功
					if(data && data.state != 200){
						certifyData = data.info;
						bindCertifyData(data.info);

					//获取失败
					}else{
						alert("信息获取失败，请刷新页面重试！");
					}
				}
			});
		}else{
			bindCertifyData(certifyData);
		}
	});

	//填充认证数据
	function bindCertifyData(data){
		if(data){
			$("#realname").val(data.realname);
			$("#idcard").val(data.idcard);
			$(".front .sholder").html('<a href="'+data.front+'" target="_blank"><img src="'+data.front+'" /></a>');
			$(".back .sholder").html('<a href="'+data.back+'" target="_blank"><img src="'+data.back+'" /></a>');
			$(".licenseUpload .sholder").html('<a href="'+data.license+'" target="_blank"><img src="'+data.license+'" /></a>');
		}else{
			alert("信息获取失败，请刷新页面重试！");
		}
	}


	//获取短信验证码
	$("html").delegate("#getPhoneVerify", "click", function(){
		var t = $(this), phone = $("#phone");

		if(t.hasClass("disabled")) return false;

		if(!checkPhone(phone.val())){
			popTip("请输入正确的手机号码", "error");
			phone.focus();
		}else{

			t.addClass("disabled");
			t.html('<img src="'+staticPath+'images/loading_16.gif" /> 获取中...');

			popTip("请输入短信验证码，没收到短信？<br />1. 网络通讯异常可能会造成短信丢失，请重新获取或稍后再试<br />2. 请核实手机是否已欠费停机，或者屏蔽了系统短信", "");

			$.ajax({
				url: masterDomain+"/include/ajax.php?service=siteConfig&action=getPhoneVerify&type=verify",
				data: "phone="+phone.val(),
				type: "POST",
				dataType: "jsonp",
				success: function (data) {
					//获取成功
					if(data && data.state == 100){
						countDown(t);

					//获取失败
					}else{
						t.removeClass("disabled").html("获取短信验证码");
						popTip(data.info, "error");
						alert(data.info);
					}
				}
			});

			$("#vdimgck").focus();
		}
	});

	var wait = 60;
	function countDown(t) {
		if (wait == 0) {
			t.removeClass("disabled");
			t.html("重新获取验证码");
			wait = 60;
		} else {
			t.addClass("disabled");
			t.html(wait+" 秒后可重新获取");
			wait--;
			setTimeout(function() {
				countDown(t)
			}, 1000);
		}
	}

	//绑定手机
	$("#chphone").bind("click", function(){
		modifyFun("手机认证", "chphoneAdd", "chphone", 500, "提交认证", function(){
			var phone = $("#phone"), vdimgck = $("#vdimgck");
			return "phone="+phone.val()+"&vdimgck="+vdimgck.val();
		}, function(){
			var phone = $("#phone"), vdimgck = $("#vdimgck");
			if($.trim(phone.val()) == "" || !checkPhone(phone.val())){
				popTip("请输入正确的手机号码", "error");
				phone.focus();
				return "false";
			}
			if($.trim(vdimgck.val()) == ""){
				popTip("请输入6位短信验证码", "error");
				vdimgck.focus();
				return "false";
			}
		});
	});

	//修改手机号码
	$("#chphoneEdit").bind("click", function(){
		opera = "changePhone";
		authentication(bindPhoneUrl);
	});

	//解绑手机号码
	$("#chphoneDel").bind("click", function(){
		opera = "changePhone";
		authentication(pageUrl);
	});


	//绑定邮箱
	var memeryEmailData = "";
	$("#chemail").bind("click", function(){
		modifyFun("邮箱认证", "chemailAdd", "chemail", 500, "下一步", function(){
			var email = $("#email");
			data = "email="+email.val();
			memeryEmailData = data;
			return data;
		}, function(){
			var email = $("#email");
			if($.trim(email.val()) == "" || !checkEmail(email.val())){
				popTip("请输入正确的邮箱地址", "error");
				email.focus();
				return "false";
			}
		});
	});

	//修改邮箱
	$("#chEmailEdit").bind("click", function(){
		opera = "changeEmail";
		authentication(bindEmailUrl);
	});

	//解绑邮箱
	$("#chEmailDel").bind("click", function(){
		opera = "changeEmail";
		authentication(pageUrl);
	});

	//重新发送
	$("html").delegate("#sendAgain", "click", function(){
		if(memeryEmailData != ""){
			var t = $(this);

			t.html("重新发送中...");
			$.ajax({
				url: masterDomain+"/include/ajax.php?service=member&action=updateAccount&do=chemail",
				data: memeryEmailData,
				type: "POST",
				dataType: "jsonp",
				success: function (data) {
					if(data && data.state == 100){
						t.html("发送成功");
					}
				}
			});
			modifyFun("邮箱认证", "chemailAdd", "chemail", 500, "下一步", function(){return memeryEmailData;}, null);
		}else{
			alert("信息读取失败，请刷新页面重试！");
			location.reload();
		}
	});

	$("html").delegate(".sel select", "change", function(){
		var selVal = $(this).val(), label = $(this).siblings("label"), input = $(this).parent().next("input");
		input.val(selVal == "请选择" ? "" : selVal);
		label.html(selVal+"<s></s>");
	});

	//设置安全保护问题
	$("#question").bind("click", function(){
		modifyFun("安全保护问题", "questionAdd", "question", 500, "确定提交", function(){
			var q1 = $("#q1"), q2 = $("#q2"), answer = $("#answer");
			data = "q1="+q1.val()+"&q2="+q2.val()+"&answer="+answer.val();
			return data;
		}, function(){
			var q1 = $("#q1"), q2 = $("#q2"), answer = $("#answer");
			if($.trim(q1.val()) == ""){
				popTip("请选择您的问题一", "error");
				return "false";
			}
			if($.trim(q2.val()) == ""){
				popTip("请选择您的问题二", "error");
				return "false";
			}
			if($.trim(answer.val()) == ""){
				popTip("请输入您的问题答案", "error");
				answer.focus();
				return "false";
			}
		});
	});

	//修改安全保护问题
	$("#chQuestionEdit").bind("click", function(){
		opera = "changeQuestion";
		authentication(bindQuestionUrl);
	});

	//重置安全保护问题
	$("#chQuestionDel").bind("click", function(){
		opera = "changeQuestion";
		authentication(pageUrl);
	});

	//异步提交修改
	function modifyFun(title, editForm, type, width, btn, param, func){
		var button = btn == false ? null : [{
					id: "okBtn",
					name: btn,
					callback: function(){

						if(func() == "false") return false;
						var t = this;
						var data = param();

						t.button({
							id:'okBtn',
							name:'操作中...',
							disabled: true
						});

						$.ajax({
							url: masterDomain+"/include/ajax.php?service=member&action=updateAccount&do="+type,
							data: data,
							type: "POST",
							dataType: "jsonp",
							success: function (data) {
								if(data && data.state == 100){
									t.button({
										id:'okBtn',
										name:'操作成功',
										disabled: true
									});

									//绑定邮箱提示
									if(type == "chemail"){

										$(".edit-tip, .ui_buttons").hide();
										t.content('<div class="bindSuccess">'+data.info+'<br /><br /><small>没有收到邮件？<br />1. 请先检查是否在垃圾邮件中<br />2. 如果还未收到，请【<a href="javascript:;" id="sendAgain">重新发送</a>】<br />3. 重新发送邮件，还未收到？请试试 <a href="javascript:;" onclick="javascript:location.reload();">更换邮箱</a></small></div>');

									}else{
										popTip(data.info, "success");
										setTimeout(function(){
											modifyPop.close();
											location.href = pageUrl;
										}, 1000);
									}
								}else{
									popTip(data.info, "error");
									t.button({
										id:'okBtn',
										name: btn,
										disabled: false
									});
								}
							}
						});

						return false;
					},
					focus: true
				}]
		var modifyPop = $.dialog({
			id: "modifyPop",
			fixed: true,
			title: title,
			content: $("#"+editForm).html(),
			width: width,
			button: button
		});
	}

	function popTip(txt, cla){
		$(".edit-tip").removeClass().addClass("edit-tip "+cla);
		$(".edit-tip p").html(txt);
	}






	//确定身份验证方式
	$("html").delegate(".authenticated li", "click", function(){
		var t = $(this), index = t.index();
		$(".authenticated, .footer-tip").hide();
		$(".authlist, .authlist .item:eq("+index+"), .ui_buttons").fadeIn(300);
		$(".ui_buttons").prepend('<a href="javascript:;" class="anotherWay">&laquo; 选择其它方式验证</a>');

		//短信验证
		if(t.hasClass("p")){

			verifyType = "authPhone";

			//验证脚本
			verifyFunc = function(){
				var vdimgck = $("#vdimgck");
				if($.trim(vdimgck.val()) == ""){
					popTip("请输入6位短信验证码", "error");
					vdimgck.focus();
					return "false";
				}
			};

			//传送数据
			verifyData = function(){
				return "vdimgck="+$("#vdimgck").val();
			};

		//邮箱验证
		}else if(t.hasClass("e")){

			verifyType = "authEmail";

			//验证脚本
			verifyFunc = function(){
				var vdimgck = $("#vdimgckEmail");
				if($.trim(vdimgck.val()) == ""){
					popTip("请输入6位邮箱验证码", "error");
					vdimgck.focus();
					return "false";
				}
			};

			//传送数据
			verifyData = function(){
				return "vdimgck="+$("#vdimgckEmail").val();
			};

		//安全保护问题
		}else if(t.hasClass("q")){

			verifyType = "authQuestion";

			//验证脚本
			verifyFunc = function(){
				var answer = $("#answer");
				if($.trim(answer.val()) == ""){
					popTip("请输入您的密保答案！", "error");
					answer.focus();
					return "false";
				}
			};

			//传送数据
			verifyData = function(){
				return "answer="+$("#answer").val();
			};

		}

	});

	//短信验证
	$("html").delegate("#getPhoneAuthVerify", "click", function(){
		var t = $(this);

		if(t.hasClass("disabled")) return false;
		t.addClass("disabled");
		t.html('<img src="'+staticPath+'images/loading_16.gif" /> 获取中...');

		popTip("请输入短信验证码，没收到短信？<br />1. 网络通讯异常可能会造成短信丢失，请重新获取或稍后再试<br />2. 请核实手机是否已欠费停机，或者屏蔽了系统短信", "");

		$.ajax({
			url: masterDomain+"/include/ajax.php?service=siteConfig&action=getPhoneVerify&type=auth",
			type: "POST",
			dataType: "jsonp",
			success: function (data) {
				//获取成功
				if(data && data.state == 100){
					countDown(t);

				//获取失败
				}else{
					t.removeClass("disabled").html("获取短信验证码");
					popTip(data.info, "error");
					alert(data.info);
				}
			}
		});

		$("#vdimgck").focus();
	});

	//邮箱验证
	$("html").delegate("#getEmailAuthVerify", "click", function(){
		var t = $(this);

		if(t.hasClass("disabled")) return false;
		t.addClass("disabled");
		t.html('<img src="'+staticPath+'images/loading_16.gif" /> 获取中...');

		popTip("请输入邮箱验证码，没有收到邮件？<br />请先检查是否在垃圾邮件中，或者稍候再次发送！", "");

		$.ajax({
			url: masterDomain+"/include/ajax.php?service=siteConfig&action=getEmailVerify&type=auth",
			type: "POST",
			dataType: "jsonp",
			success: function (data) {
				//获取成功
				if(data && data.state == 100){
					countDown(t);

				//获取失败
				}else{
					t.removeClass("disabled").html("获取短信验证码");
					popTip(data.info, "error");
					alert(data.info);
				}
			}
		});

		$("#vdimgck").focus();
	});

	//选择其它方式验证
	$("html").delegate(".anotherWay", "click", function(){
		popTip("您接下来的操作涉及帐户安全，请先进行身份验证！", "");
		$(".authenticated, .footer-tip").fadeIn(300);
		$(".authlist, .authlist .item, .ui_buttons").hide();
		$(this).remove();
	});


	//验证身份信息
	function authentication(url){
		if(phoneCheck == 1 || emailCheck == 1 || questionSet == 1){

			returnUrl = url;
			authVerifyFun();
			$(".ui_buttons").hide();

		}else{
			$.dialog.alert("请先进行【手机认证、邮箱认证、安全保护问题】<br />这三项其中一项的绑定/启用才可以进行重置！<br /><br />或者直接进行 <a href='#' target='_blank' style='color:#08f;'><u>申诉</u></a> 找回！");
		}
	}

	//异步提交修改
	function authVerifyFun(){
		var button = [{
					id: "okBtn",
					name: "下一步",
					callback: function(){

						if(verifyFunc() == "false") return false;
						var t = this;

						t.button({
							id:'okBtn',
							name:'操作中...',
							disabled: true
						});

						$.ajax({
							url: masterDomain+"/include/ajax.php?service=member&action=authentication&do="+verifyType+"&opera="+opera,
							data: verifyData(),
							type: "POST",
							dataType: "jsonp",
							success: function (data) {
								if(data && data.state == 100){
									t.button({
										id:'okBtn',
										name:'操作成功',
										disabled: true
									});

									popTip(data.info, "success");
									setTimeout(function(){
										authVerifyPop.close();
										location.href = returnUrl;
									}, 1000);

								}else{
									popTip(data.info, "error");
									t.button({
										id:'okBtn',
										name: "下一步",
										disabled: false
									});
								}
							}
						});

						return false;
					},
					focus: true
				}]
		var authVerifyPop = $.dialog({
			id: "authVerifyPop",
			fixed: true,
			title: "验证身份信息",
			content: $("#authentication").html(),
			width: 500,
			button: button
		});
	}






});


//上传成功接收
function uploadSuccess(obj, file, filetype, path){
	$("#"+obj).val(file);
	$("#"+obj).siblings(".spic").find(".sholder").html('<img src="'+path+'" />');
	$("#"+obj).siblings(".spic").show();
	$("#"+obj).siblings("iframe").hide();

	if(obj == "license"){
		$("#"+obj).siblings(".spic").find(".reupload").show();
	}
}

//删除已上传的文件
function delFile(b, d, c) {
	var g = {
		mod: "siteConfig",
		type: "delCard",
		picpath: b,
		randoms: Math.random()
	};
	$.ajax({
		type: "POST",
		cache: false,
		async: d,
		url: "/include/upload.inc.php",
		dataType: "json",
		data: $.param(g),
		success: function(a) {
			try {
				c(a)
			} catch(b) {}
		}
	})
}

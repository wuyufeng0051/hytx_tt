$(function(){
	var zindex = 1000, showTip = function(obj, state, txt){
		var offset = obj.parent().offset(),
				objwid = obj.parent().width() + 15,
				left = offset.left + objwid + "px",
				top  = offset.top + "px",
				id   = obj.attr("id"),
				nid  = id+"_Tip";
		state == "error" ? obj.addClass("err") : "";
		$(".inptip").remove();
		$("body").append('<div id="'+nid+'" class="inptip '+state+'" style="left: '+left+'; top: '+top+'; z-index: '+zindex+'"><s></s><i></i><p>'+txt+'</p></div>');
		zindex++;
	};

	var verifyInput = function(t){
		var id = t.attr("id");
		t.removeClass("focus");
		if($.trim(t.val()) == ""){
			t.next("span").show();

			if(id == "email"){
				showTip(t, "error", "请输入邮箱地址！");
			}else if(id == "phone"){
				showTip(t, "error", "请输入手机号码！");
			}else if(id == "vericode"){
				showTip(t, "error", "请输入验证码！");
			}else if(id == "vdimgck"){
				showTip(t, "error", "请输入短信验证码！");
			}
			return false;

		}else{
			if(id == "email" && !/^[a-z0-9]+([\+_\-\.]?[a-z0-9]+)*@([a-z0-9]+\.)+[a-z]{2,6}$/i.test($.trim(t.val()))){
				showTip(t, "error", "邮箱格式错误！");
				return false;
			}else if(id == "phone" && !/(13|14|15|17|18)[0-9]{9}/.test($.trim(t.val()))){
				showTip(t, "error", "手机号码格式错误！");
				return false;
			}else if(id == "vericode"){
				t.removeClass("err");
				$.ajax({
					url: "/include/ajax.php?service=siteConfig&action=checkVdimgck&code="+t.val(),
					type: "GET",
					dataType: "jsonp",
					async: false,
					success: function (data) {
						if(data && data.state == 100){
							if(data.info == "error"){
								t.addClass("err");
								showTip(t, "error", "验证码输入错误，请重试！");
								$("#verifycode").click();
							}
						}
					}
				});
			}else{
				t.removeClass("err");
			}
		}
		return true;
	}, emailMemData = "";


	//类型切换
	var typeval = 1;
	$("input[name=type]").bind("click", function(){
    if($(this).val() == 2){
		typeval = 2;
	  if(geetest){
		$(".vdcode").hide();
	  }
	  $(".eobj").hide();
      $(".pobj").show();
    }else{
		typeval = 1;
	  if(geetest){
		$(".vdcode").show();
	  }
      $(".eobj").show();
      $(".pobj").hide();
    }
  });


	//表单占位符
	$(".form-horizontal li span").bind("click", function(){
		var t = $(this);
		t.hide();
		t.prev("input").focus();
	});

	//表单聚焦时状态
	$(".form-horizontal li input").bind("focus", function(){
		var t = $(this), id = t.attr("id");
		t.next("span").hide();
		t.removeClass("error").addClass("focus");
		$(".inptip").remove();
	});

	//表单失去焦点时状态
	$(".form-horizontal li input").bind("blur", function(){
		verifyInput($(this));
	});

	//更新验证码
	var verifycode = $("#verifycode").attr("src");
	$("#verifycode").bind("click", function(){
		$(this).attr("src", verifycode+"?v="+Math.random());
	});



	//重新发送公共函数
	function sendAgain(t){
		if(!t.hasClass("disabled")){

			//异步提交
			$.ajax({
				url: masterDomain+"/include/ajax.php?service=member&action=backpassword",
				data: $(".form-horizontal").serialize()+"isend=1&type=1&email="+emailMemData,
				type: "POST",
				dataType: "jsonp",
				success: function (data) {
					if(data){
						if(data.state == 100){
							countDown(t);
						}else{
							alert(data.info);
							t.removeClass("disabled");
							t.html("重新发送");
						}
					}else{
						alert("发送失败，请重试！");
						t.removeClass("disabled");
						t.html("重新发送");
					}
				}
			});

		}
	}


	//重新发送邮件
	if(!geetest){
		$("html").delegate("#sendAgain", "click", function(){
			if(emailMemData != ""){
				sendAgain($(this));
			}else{
				location.href = masterDomain+"/fpwd.html";
			}
		});
	}




	//没有使用极验获取短信验证码
	if(!geetest){
		$("html").delegate("#getPhoneVerify", "click", function(){
			var t = $(this), phone = $("#phone");

			if(t.hasClass("disabled")) return false;
			if(!verifyInput($("#phone"))) return false;

			var vericode = $("#vericode");
			if(!verifyInput(vericode)) return false;

			t.addClass("disabled");
			t.html('<img src="'+staticPath+'images/loading_16.gif" /> 获取中...');

			$.ajax({
				url: masterDomain+"/include/ajax.php?service=siteConfig&action=getPhoneVerify&type=fpwd",
				data: "vericode="+$("#vericode").val()+"&phone="+phone.val(),
				type: "POST",
				dataType: "jsonp",
				success: function (data) {
					//获取成功
					if(data && data.state == 100){
						countDown(t);

					//获取失败
					}else{
						t.removeClass("disabled").html("获取短信验证码");
						alert(data.info);
					}
				}
			});
		});
	}


	var wait = 60;
	function countDown(t) {
		if (wait == 0) {
			t.removeClass("disabled");
			t.html("重新发送");
			wait = 60;
		} else {
			t.addClass("disabled");
			t.html(wait+" 秒重新发送");
			wait--;
			setTimeout(function() {
				countDown(t)
			}, 1000);
		}
	}


	//回车提交
	$(".form-horizontal input").keyup(function (e) {
		if (!e) {
			var e = window.event;
		}
		if (e.keyCode) {
			code = e.keyCode;
		}else if (e.which) {
			code = e.which;
		}
		if (code === 13) {
			$("#submitFpwd").click();
		}
	});

	//提交
	//没有开启极验，或者开启了但是必须是手机找回时才可用
	$("#submitFpwd").bind("click", function(){
		if(!geetest || (geetest && typeval == 2)){
			var t = $(this), tj = true;

			if(t.hasClass("disabled")) return false;

			var type = $("input[name=type]:checked").val();

			if(type == 1){
				if(!verifyInput($("#email"))){
					tj = false;
					return false;
				}
				if(!verifyInput($("#vericode")) && !geetest){
					tj = false;
					return false;
				}
			}
			if(type == 2){
				if(!verifyInput($("#phone"))){
					tj = false;
					return false;
				}
				if(!verifyInput($("#vericode")) && !geetest){
					tj = false;
					return false;
				}
				if(!verifyInput($("#vdimgck"))){
					tj = false;
					return false;
				}
			}

			if(!tj) return false;

			t.addClass("disabled").html("请稍候...");

			//异步提交
			$.ajax({
				url: masterDomain+"/include/ajax.php?service=member&action=backpassword",
				data: $(".form-horizontal").serialize(),
				type: "POST",
				dataType: "jsonp",
				success: function (data) {
					if(data){

						if(data.state == 100){

							if(type == 1){
								emailMemData = $("#email").val();
								$(".form-horizontal ul").html('<li class="success"><p>找回密码邮件已经发送至<br /><strong>'+emailMemData+'</strong><br />请注意查收！</p><div class="btns">没有收到邮件？<a href="javascript:;" id="sendAgain">重新发送</a> <em>或</em> <a href="'+masterDomain+'/fpwd.html" class="reset">返回重填</a></div></li>');
							}else{
								location.href = data.info;
							}

						}else{
							alert(data.info);
							t.removeClass("disabled").html("确认");
							$("#verifycode").click();
						}

					}else{
						alert("提交失败，请重试！");
						t.removeClass("disabled").html("确认");
					}
				}
			});
			return false;

		}
	});

	//是否使用极验验证码
	if(geetest){

		//极验验证
		var handlerPopup = function (captchaObj) {
			captchaObj.appendTo("#popup-captcha");

			// 成功的回调
			captchaObj.onSuccess(function () {

				//发送邮箱验证码
				var type = $("input[name=type]:checked").val();
				if(type == 1 || (type == undefined && emailMemData)){

					//重新发送
					if(emailMemData){
						sendAgain($("#sendAgain"));

					//第一次发送
					}else{

						var t = $("#submitFpwd");
						t.addClass("disabled").html("请稍候...");

						//异步提交
						$.ajax({
							url: masterDomain+"/include/ajax.php?service=member&action=backpassword",
							data: $(".form-horizontal").serialize(),
							type: "POST",
							dataType: "jsonp",
							success: function (data) {
								if(data){

									if(data.state == 100){

										emailMemData = $("#email").val();

										$(".form-horizontal ul").html('<li class="success"><p>找回密码邮件已经发送至<br /><strong>'+emailMemData+'</strong><br />请注意查收！</p><div class="btns">没有收到邮件？<a href="javascript:;" id="sendAgain">重新发送</a> <em>或</em> <a href="'+masterDomain+'/fpwd.html" class="reset">返回重填</a></div></li>');

									}else{
										alert(data.info);
										t.removeClass("disabled").html("确认");
									}

								}else{
									alert("提交失败，请重试！");
									t.removeClass("disabled").html("确认");
								}
							}
						});
					}


				//获取短信验证码
				}else{
					var t = $("#getPhoneVerify"), phone = $("#phone");
					t.addClass("disabled");
					t.html('<img src="'+staticPath+'images/loading_16.gif" /> 获取中...');

					$.ajax({
						url: masterDomain+"/include/ajax.php?service=siteConfig&action=getPhoneVerify",
						data: $(".form-horizontal").serialize()+"&type=fpwd",
						type: "POST",
						dataType: "jsonp",
						success: function (data) {
							//获取成功
							if(data && data.state == 100){
								countDown(t);

							//获取失败
							}else{
								t.removeClass("disabled").html("获取短信验证码");
								alert(data.info);
							}
						}
					});
				}


			});


			//获取短信验证码
			$("html").delegate("#getPhoneVerify", "click", function(){
				var t = $(this), phone = $("#phone");
				if(t.hasClass("disabled")) return false;
				if(!verifyInput($("#phone"))) return false;
				captchaObj.show();
			});

			//邮箱确认找回
			$("#submitFpwd").bind("click", function(){
				if(typeval == 1){
					var t = $(this);
					if(t.hasClass("disabled")) return false;
					if(!verifyInput($("#email"))){
						tj = false;
						return false;
					}
					captchaObj.show();
				}
			});

			//重新发送邮件
			$("html").delegate("#sendAgain", "click", function(){
				var t = $(this);
				if(t.hasClass("disabled")) return false;
				if(emailMemData){
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


	particlesJS('particles-js',{particles:{number:{value:20,density:{enable:!0,value_area:1E3}},color:{value:"#e1e1e1"},shape:{type:"circle",stroke:{width:0,color:"#000000"},polygon:{nb_sides:5},image:{src:"img/github.svg",width:100,height:100}},opacity:{value:.8,random:!1,anim:{enable:!1,speed:1,opacity_min:.1,sync:!1}},size:{value:15,random:!0,anim:{enable:!1,speed:180,size_min:.1,sync:!1}},line_linked:{enable:!0,distance:650,color:"#cfcfcf",opacity:.26,width:1},move:{enable:!0,speed:2,direction:"none",random:!0,straight:!1,out_mode:"out",bounce:!1,attract:{enable:!1,rotateX:600,rotateY:1200}}},interactivity:{detect_on:"canvas",events:{onhover:{enable:!1,mode:"repulse"},onclick:{enable:!1,mode:"push"},resize:!0},modes:{grab:{distance:400,line_linked:{opacity:1}},bubble:{distance:400,size:40,duration:2,opacity:8,speed:3},repulse:{distance:200,duration:.4},push:{particles_nb:4},remove:{particles_nb:2}}},retina_detect:!0});
});

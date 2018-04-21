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

	var mtimer = null;

	//如果在iframe页面则去除margin值以及背景色
	if(top.location != location){
		$(".login-pup").css({"margin": "0 auto"});
		$("html").css({"background": "none"});

		var height = $(".login-pup").height();
		height = height == 0 ? 350 : height;

		$("<div>")
			.attr("id", "site_iframe")
			.html('<iframe scrolling="no" src="'+site+'/loginFrame.html?v='+Math.random()+'#height_'+height+'" frameborder="0" allowtransparency="true" style="display: none;"></iframe>')
			.appendTo("body");

	};

	$("#close").bind("click", function(){
		if(top.location != location){
			$(".login-pup").remove();
			$("#site_iframe iframe").attr("src", site+"/loginFrame.html?v=" + Math.random() + "#close_1");
		}else{
			top.location.href = redirectUrl;
		}
		clearInterval(mtimer);
	});

	//验证是否已经登录
	if($("#isLogin").html() == 1){
		if(top.location != location){
			$("#site_iframe iframe").attr("src", site+"/loginFrame.html?v=" + Math.random() + "#success_1");
		}else{
			location.href = redirectUrl;
		}
	}

	//第三方登录
	$(".login-left a").click(function(e){
		e.preventDefault();
		var href = $(this).attr("href");
		loginWindow = window.open(href, 'oauthLogin', 'height=565, width=720, left=100, top=100, toolbar=no, menubar=no, scrollbars=no, status=no, location=yes, resizable=yes');

		//var i = 0;
		//判断窗口是否关闭
		mtimer = setInterval(function(){
			if(loginWindow.closed){
				//if(i >= 10){
				//	clearInterval(mtimer);
				//	alert("授权失败，请重试！");
				//	return false;
				//}
				clearInterval(mtimer);

				huoniao.checkLogin(function(){
					if(top.location != location){
						$("#site_iframe iframe").attr("src", site+"/loginFrame.html?v=" + Math.random() + "#success_1");
					}else{
						location.href = redirectUrl;
					}
				});
				//i++;
			}
		}, 1000);
	});

	//注册、找回密码
	$("#regbtn, #pwdbtn").bind("click", function(event){
		var href = $(this).attr("href");
		if(top.location == location){
			event.preventDefault();
			location.href = href;
		}
	});

	//表单占位符
	$("#loginForm li span").bind("click", function(){
		var t = $(this);
		t.hide();
		t.prev("input").focus();
	});

	//表单聚焦时状态
	$("#loginForm li input").bind("focus", function(){
		var t = $(this), id = t.attr("id");
		t.next("span").hide();
		t.removeClass("error").addClass("focus");
		$("#"+id+"_Tip").remove();
	});

	//表单失去焦点时状态
	$("#loginForm li input").bind("blur", function(){
		var t = $(this), id = t.attr("id");
		if($.trim(t.val()) == ""){
			t.next("span").show();

			if(id == "loginuser"){
				showTip($("#loginuser"), "error", "请输入邮箱/手机号/用户名");
			}else if(id == "loginpass"){
				showTip($("#loginpass"), "error", "请输入密码");
			}else if(id == "logincode"){
				showTip($("#logincode"), "tip", "请输入验证码");
			}
		}else{
			if(id == "loginpass" && !/^.{5,}$/.test($.trim($("#loginpass").val()))){
				showTip($("#loginpass"), "error", "密码长度最少为 5 位");
			}else{
				t.removeClass("err");
			}
		}
		t.removeClass("focus");
	});

	//更新验证码
	var verifycode = $("#verifycode").attr("src");
	$("#verifycode").bind("click", function(){
		$(this).attr("src", verifycode+"?v="+Math.random());
	});

	setTimeout(function(){
		var loginuser = $("#loginuser"),
				loginpass = $("#loginpass");
		if($.trim(loginuser.val()) != ""){
			loginuser.next("span").hide();
			loginpass.next("span").hide();
		}
	}, 100);	

	//回车提交
	$("#loginForm input").keyup(function (e) {
		if (!e) {
			var e = window.event;
		}
		if (e.keyCode) {
			code = e.keyCode;
		}else if (e.which) {
			code = e.which;
		}
		if (code === 13) {
			$("#submitLogin").click();
		}
	});

	//提交
	$("#submitLogin").bind("click", function(){
		var t = $(this),
				loginuser = $("#loginuser"),
				loginpass = $("#loginpass"),
				logincode = $("#logincode"),
				data = [];

		if(t.hasClass("disabled")) return false;

		if($.trim(loginuser.val()) == ""){
			showTip(loginuser, "error", "请输入邮箱/手机号/用户名");
			return false;
		}

		if($.trim(loginpass.val()) == ""){
			showTip(loginpass, "error", "请输入密码");
			return false;
		}

		if(!/^.{5,}$/.test($.trim(loginpass.val())) && $.trim(loginpass.val()) != ""){
			showTip(loginpass, "error", "密码长度最少为 5 位");
			return false;
		}

		if(logincode && $.trim(logincode.val()) == "" && logincode.val() != undefined){
			showTip(logincode, "tip", "请输入验证码");
			return false;
		}

		data.push("username="+loginuser.val());
		data.push("password="+loginpass.val());
		if(logincode.val() != undefined){
			data.push("vericode="+logincode.val());
		}

		t.addClass("disabled").html("登录中...");

		//异步提交
		$.ajax({
			url: "/loginCheck.html",
			data: data.join("&"),
			type: "POST",
			dataType: "html",
			success: function (data) {
				if(data){
					if(data.indexOf("100") > -1){
						$("body").append('<div style="display:none;">'+data+'</div>');
						t.html("登录成功");
						if(top.location != location){
							$("#site_iframe iframe").attr("src", site+"/loginFrame.html?v=" + Math.random() + "#success_1");
						}else{
							top.location.href = redirectUrl;
						}
					}else if(data.indexOf("201") > -1){
						var data = data.split("|");
						showTip($("#loginuser"), "error", data[1]);
						t.removeClass("disabled").html("登录");
					}else if(data.indexOf("202") > -1){
						var data = data.split("|");
						showTip($("#logincode"), "error", data[1]);
						t.removeClass("disabled").html("登录");
					}
				}else{
					alert("登录失败，请重试！");
					t.removeClass("disabled").html("登录");
				}
			}
		});
		return false;

	});
});
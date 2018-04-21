$(function(){

	//第三方登录
	$(".loginconnect, .othertype a").click(function(e){
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


	// 记住密码
	var remember = $('.rememberpsd');
	remember.click(function(){
		remember.toggleClass('checked');
	})
	// 更换验证码
	$('#vdimgck,.change').click(function(){
		var img = $('#vdimgck'),src = img.attr('src') + '?v=' + new Date().getTime();
		img.attr('src',src);
	})
	// 二维码登陆
	$('.ewmlogin').click(function(){
		$('.ewmlogin ,.saoma').toggleClass('open');
	})


	var lgform = $('.loginform');

	lgform.find('.inp').focus(function(){
		$(this).closest('.inpbdr').addClass('focus');
	}).blur(function(){
		$(this).closest('.inpbdr').removeClass('focus');
	})

	// 提交
	var err = lgform.find('.error p');
	lgform.submit(function(e){
		e.preventDefault();
		err.text('').hide();
		var nameinp = $('.username'),
			name = nameinp.val(),
			psdinp = $('.password'),
			psd = psdinp.val(),
			vdimgckinp = $('.vdimgck'),
			vdimgck = vdimgckinp.val(),
			submit = $(".submit"),
			r = true;
		if(name == ''){
			console.log(name)
			err.text('请填写登录帐号').show();
			nameinp.focus();
			r = false;
		}
		if(r && psd == ''){
			err.text('请填写登陆密码').show();
			psdinp.focus();
			r = false;
		}
		if(r && vdimgckinp && vdimgck == "" && vdimgck != undefined){
			err.text('请填写验证码').show();
			vdimgckinp.focus();
			r = false;
		}

		if(r){

			submit.attr("disabled", true);
			var data = [];
			data.push("username="+name);
			data.push("password="+psd);
			if(vdimgck != undefined){
				data.push("vericode="+vdimgck);
			}

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
							top.location.href = redirectUrl;
						}else if(data.indexOf("201") > -1){
							var data = data.split("|");
							err.text(data[1]).show();
							nameinp.focus();
							submit.attr("disabled", false);

						}else if(data.indexOf("202") > -1){
							var data = data.split("|");
							err.text(data[1]).show();
							$('#vdimgck').click();
							vdimgckinp.focus();
							submit.attr("disabled", false);

						}else{
							alert("登录失败，请重试！");
							$('#vdimgck').click();
							submit.attr("disabled", false);
						}
					}else{
						alert("登录失败，请重试！");
						$('#vdimgck').click();
						submit.attr("disabled", false);
					}
				},
				error: function(){
					alert("网络错误，登录失败！");
					$('#vdimgck').click();
					submit.attr("disabled", false);
				}
			});
			return false;


		}
	})


})

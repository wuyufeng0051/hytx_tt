$(function(){

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
			err.text(langData['siteConfig'][20][541]).show();
			nameinp.focus();
			r = false;
		}
		if(r && psd == ''){
			err.text(langData['siteConfig'][20][542]).show();
			psdinp.focus();
			r = false;
		}
		if(r && vdimgckinp && vdimgck == "" && vdimgck != undefined){
			err.text(langData['siteConfig'][20][540]).show();
			vdimgckinp.focus();
			r = false;
		}

		if(r){

			submit.attr("disabled", true).val(langData['siteConfig'][2][5]+"...");
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
							submit.attr("disabled", false).val(langData['siteConfig'][16][158]);

						}else if(data.indexOf("202") > -1){
							var data = data.split("|");
							err.text(data[1]).show();
							$('#vdimgck').click();
							vdimgckinp.focus();
							submit.attr("disabled", false).val(langData['siteConfig'][16][158]);

						}else{
							alert(langData['siteConfig'][21][3]);
							$('#vdimgck').click();
							submit.attr("disabled", false).val(langData['siteConfig'][16][158]);
						}
					}else{
						alert(langData['siteConfig'][21][3]);
						$('#vdimgck').click();
						submit.attr("disabled", false).val(langData['siteConfig'][16][158]);
					}
				},
				error: function(){
					alert(langData['siteConfig'][20][168]);
					$('#vdimgck').click();
					submit.attr("disabled", false).val(langData['siteConfig'][16][158]);
				}
			});
			return false;


		}
	})


})

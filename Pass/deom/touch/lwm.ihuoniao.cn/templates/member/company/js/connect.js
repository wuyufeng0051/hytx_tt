$(function(){

	//绑定社交帐号
	$(".fail a").bind("click", function(e){
		e.preventDefault();
		var href = $(this).attr("href");
		loginWindow = window.open(href, 'oauthLogin', 'height=565, width=720, left=100, top=100, toolbar=no, menubar=no, scrollbars=no, status=no, location=yes, resizable=yes');

		$(this).addClass("disabled").html("<img src='"+staticPath+"images/loading_16.gif' /> 绑定中...");

		//判断窗口是否关闭
		mtimer = setInterval(function(){
			if(loginWindow.closed){
				clearInterval(mtimer);

				location.reload();
			}
		}, 1000);
	});

	//解除绑定
	$(".ok a").bind("click", function(){
		var t = $(this), li = t.closest("li"), id = li.data("id");
		if(id != "" && id != 0 && id != undefined && !t.hasClass("disabled")){
			$.dialog.confirm("您确定要解除绑定吗？<br />确定后将无法再次使用此社交帐号登录网站，请谨慎操作！", function(){
				t.addClass("disabled").html("<img src='"+staticPath+"images/loading_16.gif' /> 解除中...");

				$.ajax({
					url: "/include/ajax.php?service=member&action=unbindConnect",
					data: "id="+id,
					type: "POST",
					dataType: "json",
					success: function (data) {
						if(data && data.state == 100){
							
							t.removeClass("disabled").html("解除成功");
							setTimeout(function(){
								location.reload();
							}, 1000);

						}else{
							$.dialog.alert(data.info);
							t.removeClass("disabled").html("解除绑定");
						}
					},
					error: function(){
						$.dialog.alert("网络错误，请重试！");
							t.removeClass("disabled").html("解除绑定");
					}
				});

			});
		}
	});
	
});


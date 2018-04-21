$(function(){

	// $(".sidebar dl").each(function(index){
	// 	if(index > 0){
	// 		$(this).addClass("curr");
	// 		$(this).find("dd").hide();
	// 	}
	// });

	//绑定社交帐号
	$(".fail a").bind("click", function(e){
		e.preventDefault();
		var href = $(this).attr("href");
		loginWindow = window.open(href, 'oauthLogin', 'height=565, width=720, left=100, top=100, toolbar=no, menubar=no, scrollbars=no, status=no, location=yes, resizable=yes');

		$(this).addClass("disabled").html("<img src='"+staticPath+"images/loading_16.gif' /> "+langData['siteConfig'][6][134]+"...");

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
			if(confirm(langData['siteConfig'][20][254])){
				t.addClass("disabled").html("<img src='"+staticPath+"images/loading_16.gif' /> "+langData['siteConfig'][6][135]+"...");

				$.ajax({
					url: masterDomain + "/include/ajax.php?service=member&action=unbindConnect",
					data: "id="+id,
					type: "POST",
					dataType: "json",
					success: function (data) {
						if(data && data.state == 100){

							t.removeClass("disabled").html(langData['siteConfig'][20][255]);
							setTimeout(function(){
								location.reload();
							}, 1000);

						}else{
							alert(data.info);
							t.removeClass("disabled").html(langData['siteConfig'][6][133]);
						}
					},
					error: function(){
						alert(langData['siteConfig'][20][183]);
							t.removeClass("disabled").html(langData['siteConfig'][6][133]);
					}
				});

			};
		}
	});

});

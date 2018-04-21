$(function(){

	function showTip(obj, state, txt){
	    var error = obj.closest('.inpbox').siblings('.error');
	    error.show().find('span').text(txt);
	}

	//提交
	$(".form-horizontal").submit(function(){
		var t = $("#submitFpwd"), tj = true;

		if(t.hasClass("disabled")) return false;

		var password = $('#password'), repassword = $('#repassword');
		if (password.val() == "") {
          showTip(password, "error", langData['siteConfig'][20][164]);
          return false;
        }else if (repassword.val() == "") {
          showTip(repassword, "error", langData['siteConfig'][20][559]);
          return false;
        }else if (password.val() != repassword.val()) {
          showTip(repassword, "error", langData['siteConfig'][20][493]);
          return false;
        }

		if(!tj) return false;

		t.addClass("disabled").html(langData['siteConfig'][7][1]+"...");

		//异步提交
		$.ajax({
			url: masterDomain+"/include/ajax.php?service=member&action=resetpwd",
			data: $(".form-horizontal").serialize(),
			type: "POST",
			dataType: "jsonp",
			success: function (data) {
				if(data){

					if(data.state == 100){

						t.html(langData['siteConfig'][20][560]);
						setTimeout(function(){
							location.href = userDomain;
						}, 500);

					}else{
						alert(data.info);
						t.removeClass("disabled").html(langData['siteConfig'][6][0]);
					}

				}else{
					alert(langData['siteConfig'][20][180]);
					t.removeClass("disabled").html(langData['siteConfig'][6][0]);
				}
			}
		});
		return false;

	});

	$("#submitFpwd").bind("click", function(){
		$(".form-horizontal").submit();
	})

});

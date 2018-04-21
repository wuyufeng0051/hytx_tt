$(function(){

	$("#resetForm").submit(function(event){
		event.preventDefault();
		$('.login-btn input').click();
	});

	$('.login-btn input').click(function(){
		var btn = $(this);
		var pwd = $('.password').val();
		if (pwd == '') {
			alert('请输入新密码');
			return false;
		}else{
			var repwd = $('.repassword').val();
			if (repwd == '') {
				alert('请再输入一次');
				return false;
			}else{
				if (pwd != repwd) {
					alert('两次密码不一致');
					return false;
				}else{

					btn.attr("disabled", true).val("提交中...");

					//异步提交
					$.ajax({
						url: masterDomain+"/include/ajax.php?service=member&action=resetpwd",
						data: $("#resetForm").serialize(),
						type: "GET",
						dataType: "jsonp",
						success: function (data) {
							if(data){

								if(data.state == 100){

									btn.val("重置成功");
									setTimeout(function(){
										location.href = userDomain;
									}, 500);

								}else{
									alert(data.info);
									btn.removeAttr("disabled", false).val("确定");
								}

							}else{
								alert("提交失败，请重试！");
								btn.removeAttr("disabled", false).html("确定");
							}
						}
					});

				}
			}
		}
	})

})

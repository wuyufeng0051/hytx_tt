$(function(){
	$('.input').click(function(){
		console.log($('#in_1').val())
		console.log($('#in_2').val())
		if ($('#in_1').val() != $('#in_2').val()) {
			$('#user_pw1_show').html('两次输入密码不相同')
		}else{
			$('#user_pw1_show').html('密码为6-12位字符')
		};
	})
})
$(function(){
	$('.bind_box  .re_set .set_list ul li .t_1').click(function(){
		var  x = $(this);
		var find = x.closest('li').find('em')
		if (x.prop('checked') == true) {
			find.text('（已开启短信通知）');
		}else{
			find.text('（已关闭短信通知）');
		}
	})
	$('.bind_box  .re_set .set_list ul li .t_2').click(function(){
		var  x = $(this);
		var find = x.closest('li').find('em')
		if (x.prop('checked') == true) {
			find.text('（已开启邮件通知）');
		}else{
			find.text('（已关闭邮件通知）');
		}
	})
	$('.bind_box  .re_set .set_list ul li .t_3').click(function(){
		var  x = $(this);
		var find = x.closest('li').find('em')
		if (x.prop('checked') == true) {
			find.text('（已开启微信通知）');
		}else{
			find.text('（已关闭微信通知）');
		}
	})
})
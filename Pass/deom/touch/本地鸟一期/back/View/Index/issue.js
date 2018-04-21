$(function(){

	// 选择续费套餐
	$('.renew').click(function(){
		$('.renew_box').slideDown(300);
		$('.disk,.renew_box').show();
	})
	$('.disk , .renew_box .cancel').click(function(){
		$('.renew_box').slideUp(300);
		$('.disk').hide();
	})
	$('.renew_box ul li').click(function(){
		var x = $(this);
		x.addClass('re_check').siblings().removeClass('re_check');
	})
	$('.agreement').click(function(){
		var x = $(this);
		if (x.hasClass('agree_bc')) {
			x.removeClass('agree_bc');
		}else{
			x.addClass('agree_bc');
		}
	})

	// 选择续费套餐
	$('.stick').click(function(){
		$('.stick_box').slideDown(300);
		$('.disk,.stick_box').show();
	})
	$('.disk , .stick_box .cancel').click(function(){
		$('.stick_box').slideUp(300);
		$('.disk').hide();
		$('.delete').hide();
	})	

	// 关闭续费成功弹出层
	$('.succeed_box p span').click(function(){
		$('.succeed_box').hide();
		$('.disk').hide();
	})

	// 删除活动
	$('.delete_btn').click(function(){
		var x = $(this);
		$('.delete').show();
		$('.disk').show();
		$('.delete .sure').click(function(){
			x.closest('.iss_txt').remove();
			x.closest('.job_detail').remove();
			x.closest('.job_jl').remove();
			$('.delete').hide();
			$('.disk').hide();
		})
	})
	$('.delete .cancel').click(function(){
		$('.delete').hide();
		$('.disk').hide();
	})

})
$(function(){

	// 右侧看房团报名表单多选
	$('.choice_box input').click(function(){
		var x = $(this),
			find = x.closest('label ').find('span');
		if (x.is(':checked')) {
			find.addClass('sure')
		}else{
			find.removeClass('sure')
		};
	})

	// 右侧求租求购tab切换
	$('.Rent_lead ul li').hover(function(){
		var x = $(this),
			index = x.index();
		x.addClass('Rent_bc').siblings().removeClass('Rent_bc');
		$('.Rent_list .Rent_txt').eq(index).show().siblings().hide();
	})
})
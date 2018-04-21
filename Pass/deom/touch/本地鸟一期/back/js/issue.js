$(function(){
    // 选择续费套餐
    $('.renew').click(function(){
        var x=$(this);
        var goods_id  = x.closest('.dataval').data('id');
        $("#buyorderform2 #goods_id").val(goods_id);
        var table_name = x.closest('.dataval').data('table');
        $("#buyorderform2 #table_name").val(table_name);
        $('.renew_box').slideDown(300);
        $('.disk,.renew_box').show();
    })
	// 续费成功后刷新页面
	$(".renew_success p span").click(function () {
		location.reload();
    })
    $(".cheng_success p span").click(function () {
        location.reload();
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
	// 申请开通弹出层
	$('.dredge').click(function(){
        var x=$(this);
        var goods_id  = x.closest('.dataval').data('id');
        $("#buyorderform3 #goods_id").val(goods_id);
		var table_name = x.closest('.dataval').data('table');
        $("#buyorderform3 #table_name").val(table_name);
		$('.dredge_box').slideDown(300);
		$('.disk,.dredge_box').show();
	})
	$('.wei_pay ul li').click(function(){
		var x = $(this);
		x.addClass('re_check').siblings().removeClass('re_check');
		$('.cash_pay ul li').removeClass('re_check');
	})
	$('.cash_pay ul li').click(function(){
		var x = $(this);
		x.addClass('re_check').siblings().removeClass('re_check');
		$('.wei_pay ul li').removeClass('re_check');
	})

    $('.disk , .stick_box .cancel , .dredge_box .cancel').click(function(){
		$('.stick_box').slideUp(300);
		$('.dredge_box').slideUp(300);
		$('.disk').hide();
		$('.delete').hide();
	})	
	$('.stick_box ul li').click(function(){
		var x = $(this);
		x.addClass('stick_bc').siblings().removeClass('stick_bc');
	})
	// 关闭续费成功弹出层
	$('.succeed_box p span').click(function(){
		$('.succeed_box').hide();
		$('.disk').hide();
	})

	$('.delete .cancel').click(function(){
		$('.delete').hide();
		$('.disk').hide();
	})

})
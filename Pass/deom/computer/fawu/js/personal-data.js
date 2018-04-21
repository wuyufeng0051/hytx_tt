$(function(){
	// 点击label切换效果
	$('.ba-bo label span').click(function(){
		var t = $(this);
		t.addClass('ji_1').parent('label').siblings().find('span').removeClass('ji_1');
	})
	// 表单验证
	$('.ch-1 input').click(function(){
		$(this).parent().find('span').hide();
		$(this).removeClass('rte-1');
		$(this).parent().find('i').hide();
	})
	$('.save-e a').click(function(){
	var t = $(this).parent().siblings('.zi-l').find('.gui-d').find('input').val();
	var u = $(this).parent().siblings('.zi-l').find('.gui-d1').find('input').val();
	var p = $(this).parent().siblings('.zi-l').find('.e-m').find('input').val();
		if(t == ''){
			$('.gui-d').find('input').addClass('rte-1');
			$('.gui-d').find('span').show();
		}
		if(!(/^1[34578]\d{9}$/.test(u))){
			$('.gui-d1').find('input').addClass('rte-1');
			$('.gui-d1').find('input').removeClass('rte-2');
			$('.gui-d1').find('i').hide();
			$('.gui-d1').find('.yu1').show();
		}
		else if((/^1[34578]\d{9}$/.test(u))){
			$('.gui-d1').find('input').removeClass('rte-1');
			$('.gui-d1').find('input').addClass('rte-2');
			$('.gui-d1').find('i').show();
			$('.gui-d1').find('.yu1').hide();
		}
		if(p == ''){
			$('.e-m').find('input').addClass('rte-1');
			$('.e-m').find('input').removeClass('rte-2');
			$('.e-m').find('i').hide();
			$('.e-m').find('.yu1').show();
		}
		else if(!p == ''){
			$('.e-m').find('input').removeClass('rte-1');
			$('.e-m').find('input').addClass('rte-2');
			$('.e-m').find('i').show();
			$('.e-m').find('.yu1').hide();
		}
	})
})
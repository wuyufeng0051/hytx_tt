$(function(){

// 全部服务机构
	$('.t-list ul').hover(function(){
		var x = $(this);
		x.addClass('live');
	},function(){
		var x = $(this);
		x.removeClass('live');
	});
// 区域选择
	$('.jk').click(function(){
		var y = $(this);
		y.addClass('bb');
		y.siblings('li').removeClass('bb');
	})
	
// 信息主题
	$('.information').hover(function(){
		var c = $(this);
		c.addClass('hover');
	},function(){
		var c = $(this);
		c.removeClass('hover');
	})
// 电话、邮箱、微信
	$('.phone .droptit').hover(function(){
		$(this).find('.p-1').show();
	},function(){
		$(this).find('.p-1').hide();
	})
	$('.phone .droptit').hover(function(){
		$(this).find('.p-2').show();
	},function(){
		$(this).find('.p-2').hide();
	})
	$('.phone .droptit ').hover(function(){
		$(this).find('.p-3').show();
	},function(){
		$(this).find('.p-3').hide();
	})
})
$(function(){
	// checkbox选中
	$('.add_box .st_box .st .st_place .stp ul li').click(function(){
		var x = $(this);
		x.addClass('stp_bc');
		x.siblings().removeClass('stp_bc');
	})
	$('.add_box .st_box .set .set_list div ul li').click(function(){
		var x = $(this);
		x.addClass('set_bc');
		x.siblings().removeClass('set_bc');
	})
	$('.add_box .st_box .mubiao ul li').click(function(){
		var x = $(this);
		x.addClass('mubiao_bc');
		x.siblings().removeClass('mubiao_bc');
	})


	// 自定义兴趣
	$('.add_box .st_box .st .st_place .stp ul li').click(function(){
		if ($('.zi').hasClass('stp_bc')) {
			$('.zi_box').show();
		}else{
			$('.zi_box').hide();
		};
	})


	// 选择广告展现形式

	$('.kind_1').click(function(){
		var x = $(this);
		x.addClass('check_bc');
		x.siblings().removeClass('check_bc');
	})

	$('.c-1').click(function(){
		var x = $(this);
		$("#img_a").attr("src", "../images/canvas.png"); 
		if (x.hasClass('check_bc')) {
			$("#img_a").attr("src", "../images/canvas.gif"); 
		}else{
		};
		if ($('.c-2').hasClass('check_bc')) {
		}else{
			$("#img_b").attr("src", "../images/regular.png"); 
		};
	})

	$('.c-2').click(function(){
		var x = $(this);
		$("#img_b").attr("src", "../images/regular.png"); 
		if (x.hasClass('check_bc')) {
			$("#img_b").attr("src", "../images/regular.gif"); 
		}else{
		};
		if ($('.c-1').hasClass('check_bc')) {
		}else{
			$("#img_a").attr("src", "../images/canvas.png"); 
		};
	})


	// 选择后当前div消失
	$('.add_box .st_box .st .show_style .sure p').click(function(){
		$('.show_style').hide();
		$('.show_com').show();
	})
})
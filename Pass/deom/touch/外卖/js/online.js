$(function(){
	// 人数加减
	$('.plus').click(function(){
		var number =Number($('.num-account').text());
		NewCount = number+1;
		$('.num-account').text(NewCount);
	})
	$('.reduce').click(function(){
		var number =Number($('.num-account').text());
		NewCount = number-1;
		if (NewCount >= 0) {
			$('.num-account').text(NewCount);
		}
	})


	// 是否定包房Check
	$(".open_btn input").click(function(){
		if($('.open_btn input').is(':checked')) {
			$(".accept").show();
			$(".table_num").hide();
		}else{
			$(".accept").hide();
			$(".table_num").show();
		}
	})


	// 选择包房后确定是否可以接受大厅
	$('.accept_box').click(function(){
		var x = $(this);
		if (x.find('i').hasClass('check')) {
			x.find('i').removeClass('check');
		}else{
			x.find('i').addClass('check');
		}
	})


	// 桌位号码3选一
	$('.table_num .tn_list ul li').click(function(){
		var  x = $(this);
		x.addClass('tn_bc').siblings().removeClass('tn_bc');
	})

	
	// 性别选择
	$('.proposer .name  ul li').click(function(){
		var  x = $(this);
		x.addClass('check').siblings().removeClass('check');
	})


	// 桌位选择展开层
	$('.tn_list a').click(function(){
		if ($('.TableChoice_box').css("display") == "none") {
			$('.TableChoice_box').show();
			$('body').addClass('fix');
		}else{
			$('.TableChoice_box').hide();
			$('body').removeClass('fix');
		}
	})
	$('.TableChoice_back').click(function(){
		$('.TableChoice_box').hide();
	})

	// 桌位选择展开层单选，点击确认后将选中内容放入主页面
	$('.table_list ul li').click(function(){
		var x = $(this);
		$('.table_list ul li').removeClass('tl_bc');
		x.addClass('tl_bc');
	})
	$('.table_sure').click(function(){
		var txt = $('.table_list ul li.tl_bc').text();
		$('.tn_sure').text(txt);
		$('.TableChoice_box').hide();
		$('.tn_sure').addClass('tn_bc').siblings('li').removeClass('tn_bc');
	})
})
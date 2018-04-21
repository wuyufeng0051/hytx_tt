$(function(){
	// 日期选择插件
	var currYear = (new Date()).getFullYear(); 
	$('#time').mobiscroll().date({  
	    theme: 'mobiscroll',  
	    display: 'bottom'  ,
	    showNow: true,
			nowText: "今天",
		startYear: currYear-0, 
		endYear: currYear +0,
		dateFormat: 'yyyy-mm'
	});  


	$('.time_lead ul li').click(function(){
		var x = $(this),
			index = x.index();
		x.addClass('tl_bc').siblings().removeClass('tl_bc');
		$('.Time_box .Time_list').eq(index).show().siblings().hide();
	})
	// 选择时间
	$('.time_detail ul li').click(function(){
		var x = $(this);
		if (x.hasClass('tl_bc')) {
			$('.time_detail ul li').removeClass('tl_bc');
			x.removeClass('tl_bc');
			$('.sure_btn').removeClass('sure_bc');
		}else{
			$('.time_detail ul li').removeClass('tl_bc');
			x.addClass('tl_bc');
			$('.sure_btn').addClass('sure_bc');
		}
	})


	// 时间更多展开
	$('.Time_More').click(function(){
		var x = $(this);
		x.closest('.time_detail').addClass('height');
		x.remove();
		$('.sure_btn').removeClass('sure_bc');
	})
})
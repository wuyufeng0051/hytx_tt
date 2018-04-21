$(function(){
	// 选择
    $('#JS_filter_cats a').click(function(){
        var x = $(this);
        x.addClass('current');
        x.siblings("a").removeClass('current');
    })
    
	$('.JS_more').click(function(){
		var box = $(this).closest('dd').find('.shell');
		var z = $(this).closest('dd').find('.isSure');
		if (box.hasClass('auto')) {
			box.removeClass('auto');
			$(this).closest('.normal').removeClass('multi');
		}else{
			box.addClass('auto');
			z.addClass('none');
		}
	})
	$('.JS_Multiselect').click(function(){
		var box = $(this).closest('dd').find('.shell');
		var z = $(this).closest('dd').find('.isSure');
		$(this).closest('.normal').addClass('multi');
		box.addClass('auto');
		z.removeClass('none');
	})
	$('.JS_cancle').click(function(){
		var box = $(this).closest('dd').find('.shell');
		var z = $(this).closest('dd').find('.isSure');
		$(this).closest('.normal').removeClass('multi');
		box.removeClass('auto');
		z.addClass('none');
	})
})
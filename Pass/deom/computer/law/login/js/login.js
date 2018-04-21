$(function(){
	// 登录
	$('.box_08 s').click(function(){
		$(this).closest('.box_08').hide();
	})
	$('.box_03 input').click(function(){
		$(this).parent().removeClass('Rewrite');
		$(this).siblings('.box_08').hide();	
	})
	$('.box_05').click(function(){
		var q = $('.cl-1 input');
		var w = $('.write input');
		    if(q.val() == ""){
		    	q.parent().addClass('Rewrite');
		    	q.siblings('.lio-1').show();
		    }
			else if(w.val() == ""){
				w.parent().addClass('Rewrite');
				w.siblings('.lio-3').show();
			}
	})
	
})
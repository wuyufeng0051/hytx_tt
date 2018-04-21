$(function(){
	$('.f_kind ul li').click(function(){
		var x = $(this);
		if (x.hasClass('kind_bc')) {
		   x.removeClass('kind_bc');  
        }else{
            x.addClass('kind_bc');
        }
	})
})
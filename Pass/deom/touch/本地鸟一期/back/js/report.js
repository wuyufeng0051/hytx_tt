$(function(){
	$('.report_box .choice_box ul li').click(function(){
		var x = $(this);
		if (x.hasClass('cb_bc')) {
			x.removeClass('cb_bc');
		}else{
			x.addClass('cb_bc');
		}
	})
    $('.delete .cancel').click(function(){
      $('.delete').hide();
      $('.disk').hide();
    })
    $('.disk').click(function(){
      $('.delete').hide();
      $('.disk').hide();
    })
})
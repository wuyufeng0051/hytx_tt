$(function(){
	// 选装修阶段
	$('.stra_ll p a').click(function(){
		    var t = $(this);
		    $('.choice').addClass('show').animate({"left":"22%"},200);
		    $('.disk').show();
		    $('body').addClass('by')
  	})
  	$('.disk,.pl-1 ul li').click(function(){
  			var t = $(this);
		    $('.choice').removeClass('show').animate({"left":"100%"},200);
		    $('.disk').hide();
		    $('body').removeClass('by')
  	})
  	$('.ch_list h1').click(function(){
  			var x = $(this);
  			var box = x.closest('.ch_list').find('ul');
  			if (box.css("display")=="none") {
  				box.show();
  				x.addClass('arrow');
  			}else{
  				box.hide();
  				x.removeClass('arrow');
  			}
  			
  	})
})
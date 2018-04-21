$(function(){


	$('.nav ul li').click(function(){
        var $t = $(this),
         index = $t.index(),
           box = $('.nav_list .nav_de').eq(index);
         if (box.css("display")=="none") {
            $t.addClass('nav_bac').siblings().removeClass('nav_bac');
            box.show().siblings().hide();
            $('.disk').show();
            // $('body').addClass('by');
         }else{
            $t.removeClass('nav_bac');
            box.hide();
            $('.disk').hide();
            // $('body').removeClass('by');
         }
    })
	$('.nav_list .nav_de ul li ').click(function(){
			var  x = $(this);
			var  index = x.closest(".nav_de").index();
			var  lead = $('.nav ul li').eq(index);
			var txt = x.text();
			x.addClass('nav_bc');
	      	x.siblings('li').removeClass('nav_bc');
			$('.disk').hide();
	      	$('.nav_list .nav_de').hide(); 
			lead.removeClass('nav_bac');
            // $('body').removeClass('by');
			lead.find('em').text(txt);
		})
    $('.disk').on('click',function(){
        $('.disk').hide();
        $('.nav_list .nav_de').hide();  
        // $('body').removeClass('by');
        $('.nav ul li').removeClass('nav_bac');
    })

})
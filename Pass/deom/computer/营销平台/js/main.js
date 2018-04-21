

$(function(){
    $(".ce > li > a").click(function(){
	     $(this).addClass("xz").parents().siblings().find("a").removeClass("xz").removeClass('dao');
		 $(this).parents().siblings().find(".er").hide(300);
		 $(this).siblings(".er").toggle(300);
		 $(this).parents().siblings().find(".er > li > .thr").hide().parents().siblings().find(".thr_nr").hide();
		if ($(this).hasClass('dao')) {
	    	$(this).removeClass('dao');
	    }else{
	    	$(this).addClass('dao');
	    };
	})
	
    $(".er > li > a").click(function(){
        $(this).addClass("sen_x").parents().siblings().find("a").removeClass("sen_x").removeClass('dao');
        $(this).parents().siblings().find(".thr").hide(300);	
	    $(this).siblings(".thr").toggle(300);	
	    if ($(this).hasClass('dao')) {
	    	$(this).removeClass('dao');
	    }else{
	    	$(this).addClass('dao');
	    };
	})

    $(".thr > li > a").click(function(){
	     $(this).addClass("xuan").parents().siblings().find("a").removeClass("xuan").removeClass('dao');
		 $(this).parents().siblings().find(".thr_nr").hide();	
	     $(this).siblings(".thr_nr").toggle();
	     if ($(this).hasClass('dao')) {
	    	$(this).removeClass('dao');
	    }else{
	    	$(this).addClass('dao');
	    };
	})






})


 














   
 $(window).on('load', function () {

           
 $('.selectpicker').selectpicker({
                'selectedText': 'cat'
            });

         
   // $('.selectpicker').selectpicker('hide');
        });














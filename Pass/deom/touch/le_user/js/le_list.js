$(function(){
	var xiding = $(".nav_lead");
    var chtop = parseInt(xiding.offset().top);
	// 筛选
	$('.nav_lead ul li').click(function(){
        var $t = $(this),
         index = $t.index(),
           box = $('.nav_txt .nav').eq(index);
         if (box.css("display")=="none") {
            $t.addClass('nav_lbc').siblings().removeClass('nav_lbc');
            box.show().siblings().hide();
            $('.disk').show();
            // $('body').addClass('by');
            $(".nav_lead").addClass('com_screen_top');
            $('body').scrollTop(chtop);
            $('.navigation').addClass('com_screen_top')
         }else{
            $t.removeClass('nav_lbc');
            box.hide();
            $('.disk').hide();
            // $('body').removeClass('by');
            $('.navigation').removeClass('com_screen_top')
            $(".nav_lead").removeClass('com_screen_top');
         }
    })
	$('.nav_txt .nav ul li ').click(function(){
			var  x = $(this);
			var  index = x.closest(".nav").index();
			var  lead = $('.nav_lead  ul li').eq(index);
			var  b = x.find('a').text();
			$(lead).find('em').text(b);
			x.addClass('nav_bc');
	      	x.siblings('li').removeClass('nav_bc');
			$('.disk').hide();
	      	$('.nav_txt .nav').hide(); 
			$('.nav_lead ul li').removeClass('nav_lbc');
			// $('body').removeClass('by');
            $('.navigation').removeClass('com_screen_top')
			$(".nav_lead").removeClass('com_screen_top');
		})
     // 遮罩层
    $('.disk').on('click',function(){
        $('.disk').hide();
        $('.nav_txt .nav').hide();  
        $('.nav_lead ul li').removeClass('nav_lbc');
            $('.navigation').removeClass('com_screen_top')
        // $('body').removeClass('by')
		$(".nav_lead").removeClass('com_screen_top');
    })


    // 吸顶	
    $(window).on("scroll", function() {
		var thisa = $(this);
		var st = thisa.scrollTop();
		if (st >= chtop) {
			$(".nav_lead").addClass('com_screen_top');
		} else {
			$(".nav_lead").removeClass('com_screen_top');
		}
	});
})
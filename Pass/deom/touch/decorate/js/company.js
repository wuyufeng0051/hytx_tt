$(function(){
	var xiding = $(".com_screen");
    var chtop = parseInt(xiding.offset().top);
	// 筛选
	$('.com_screen ul li').click(function(){
        var $t = $(this),
         index = $t.index(),
           box = $('.coms_l ul').eq(index);
         if (box.css("display")=="none") {
            $t.addClass('cur').siblings().removeClass('cur');
            box.show().siblings().hide();
            $('.disk').show();
            // $('body').addClass('by');
            $(".com_screen").addClass('com_screen_top');
            $('body').scrollTop(chtop);
         }else{
            $t.removeClass('cur');
            box.hide();
            $('.disk').hide();
            // $('body').removeClass('by');
            $(".com_screen").removeClass('com_screen_top');
         }
    })
	$('.coms_l ul li ').click(function(){
			var  x = $(this);
			var  index = x.closest("ul").index();
			var  lead = $('.com_screen  ul li').eq(index);
			// var  b = x.text();
			// $(lead).find('i').text(b);
			x.addClass('leib');
	      	x.siblings('li').removeClass('leib');
			$('.disk').hide();
	      	$('.coms_l ul').hide(); 
			$('.com_screen ul li').removeClass('cur');
			// $('body').removeClass('by');
			$(".com_screen").removeClass('com_screen_top');
		})
     // 遮罩层
    $('.disk').on('click',function(){
        $('.disk').hide();
        $('.coms_l  ul').hide();  
        $('.com_screen ul li').removeClass('cur');
        // $('body').removeClass('by')
        $('.stylist_lead').removeClass('sc_1');
		$('.screen').removeClass('sc_1');
		$(".com_screen").removeClass('com_screen_top');
    })


    // 吸顶	
    $(window).on("scroll", function() {
		var thisa = $(this);
		var st = thisa.scrollTop();
		if (st >= chtop) {
			$(".com_screen").addClass('com_screen_top');
		} else {
			$(".com_screen").removeClass('com_screen_top');
		}
	});
})
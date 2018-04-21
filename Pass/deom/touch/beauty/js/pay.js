$(function(){

    var xiding = $(".pay_screen");
    var chtop = parseInt(xiding.offset().top);   
	    // 筛选框
    $('.pay_screen ul li').click(function(){
        var $t = $(this),
         index = $t.index(),
           box = $('.screen_list .no').eq(index);
         if (box.css("display")=="none") {
            $t.addClass('active').siblings().removeClass('active');
            box.show().siblings().hide();
            $('.disk').show();
            $(".pay_screen").addClass('com_screen_top');
            // $("body").addClass('by');
         }else{
            $t.removeClass('active');
            box.hide();
            $('.disk').hide();
            $("body").removeClass('by');
            $(".pay_screen").removeClass('com_screen_top');
         }
    }) 	
    $('.all_left ul li').click(function(){
        var  u = $(this);
		var index = u.index();
		$('.all_right ul').eq(index).show();
		$('.all_right ul').eq(index).siblings().hide();
		u.addClass('all_bc');
		u.siblings('li').removeClass('all_bc');
    })
    $('.all_right ul li').click(function(){
    	var  u = $(this);
		u.addClass('all_font');
		u.siblings('li').removeClass('all_font');
        $(".all_fu").hide();
        $("body").removeClass('by');
        $(".pay_screen").removeClass('com_screen_top');
        $('.disk').hide();
        $('.pay_screen ul li').removeClass('active');
    })
    $('.zhineng  ul li').click(function(){
    	var  u = $(this);
		u.addClass('all_font');
		u.siblings('li').removeClass('all_font');
        $(".zhineng").hide();
        $("body").removeClass('by');
        $(".pay_screen").removeClass('com_screen_top');
        $('.disk').hide();
        $('.pay_screen ul li').removeClass('active');
    })
    $('.nan  ul li').click(function(){
    	var  u = $(this);
		u.addClass('all_font');
		u.siblings('li').removeClass('all_font');
        $(".nan").hide();
        $("body").removeClass('by');
        $(".pay_screen").removeClass('com_screen_top');
        $('.disk').hide();
        $('.pay_screen ul li').removeClass('active');
    })
        // 吸顶   
    $(window).on("scroll", function() {
        var thisa = $(this);
        var st = thisa.scrollTop();
        if (st >= chtop) {
            $(".pay_screen").addClass('com_screen_top');
            $(".pay_list").addClass('top');
        } else {
            $(".pay_screen ").removeClass('com_screen_top');
            $(".pay_list").removeClass('top');
        }
    });
         // 遮罩层
    $('.disk').on('touchstart',function(){
        $('.disk').hide();
        $(".nan").hide();
        $(".zhineng").hide();
        $(".all_fu").hide();
        $("body").removeClass('by');
        $(".pay_screen").removeClass('com_screen_top');
        $('.pay_screen ul li').removeClass('active');
    })
    // 收藏
    $('.pay_list .list_img span').click(function(){
        var z = $(this);
        if (z.hasClass('chick')) {
           z.removeClass('chick');  
        }else{
            z.addClass('chick');
        }
    })
})





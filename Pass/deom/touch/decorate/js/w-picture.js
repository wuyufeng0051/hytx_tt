$(function(){
    var xiding = $(".deco_pic_lead");
    var chtop = parseInt(xiding.offset().top);
	// 筛选
	$('.deco_pic_lead ul li').click(function(){
        var $t = $(this),
         index = $t.index(),
           box = $('.pic_lead_list ul').eq(index);
         if (box.css("display")=="none") {
            $t.addClass('cur').siblings().removeClass('cur');
            box.show().siblings().hide();
            $('.disk').show();
            $('body').scrollTop(chtop);
         }else{
            $t.removeClass('cur');
            box.hide();
            $('.disk').hide();
         }
    })
	$('.pic_lead_list ul li ').click(function(){
			var  x = $(this);
			var  index = x.closest("ul").index();
			var  lead = $('.deco_pic_lead  ul li').eq(index);
			x.addClass('leib');
	      	x.siblings('li').removeClass('leib');
			$('.disk').hide();
	      	$('.pic_lead_list  ul').hide(); 
			$('.deco_pic_lead  ul li').removeClass('cur');
		})
     // 遮罩层
    $('.disk').on('touchstart',function(){
        $('.disk').hide();
        $('.pic_lead_list  ul').hide();  
        $('.deco_pic_lead ul li').removeClass('cur');
    })
    // 吸顶
    
    $(window).on("scroll", function() {
		var thisa = $(this);
		var st = thisa.scrollTop();
		if (st >= chtop) {
			$(".deco_pic_lead").addClass('deco_pic_lead-top1');

		} else {
			$(".deco_pic_lead").removeClass('deco_pic_lead-top1');

		}
	});

})
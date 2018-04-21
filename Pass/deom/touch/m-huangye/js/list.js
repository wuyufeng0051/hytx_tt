$(function(){
	//下拉列表
 	$('.choice ul li').click(function(){
        var $t = $(this),
         index = $t.index(),
           box = $('.choice-list .ol').eq(index);
         if (box.css("display")=="none") {
            $t.addClass('lisc').siblings().removeClass('lisc');
            box.show().siblings().hide();
            $('.disk').show();
         }else{
            $t.removeClass('lisc');
            box.hide();
            $('.disk').hide();
         }
    })
     $('.list-right ul li').click(function(){
        var  u = $(this);
        u.addClass('bc');
        u.siblings('li').removeClass('bc');
    })

    // 下拉二级
    $('.cl-left ul li').click(function(){
		var  u = $(this);
		var index = u.index();
		$('.cl-right ul').eq(index).show();
		$('.cl-right ul').eq(index).siblings().hide();
		u.addClass('bc');
		u.siblings('li').removeClass('bc');
	})
     $('.cl-right ul li').click(function(){
        var  u = $(this);
        u.addClass('bc');
        u.siblings('li').removeClass('bc');
    })


     // 列表body置顶
    $('.choice ul li').click(function(){
        var dom = $('.choice ul li')
        if (dom.hasClass('lisc')) {
            $('body').addClass('by')
        }else{
            $('body').removeClass('by')
        }
    })

    //遮罩层
     $('.disk').click(function(){
        $('.disk').hide();
        $('.choice-list .ol').hide();  
        $('body').removeClass('by');
        $('.choice li').removeClass('lisc');
    })
})
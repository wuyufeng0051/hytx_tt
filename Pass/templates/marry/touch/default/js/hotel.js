$(function(){
	// 导航栏选项卡
	$('.navigation ul li').click(function(){
        var $t = $(this),
         index = $t.index(),
           box = $('.nav-list .nav-ll').eq(index);
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
    $('.position ul li').click(function(){
        var  u = $(this);
		var index = u.index();
		$('.site .site-1').eq(index).show();
		$('.site .site-1').eq(index).siblings().hide();
		u.addClass('ll');
		u.siblings('li').removeClass('ll');
    })
    $('.site .site-1 span').click(function(){
        var  u = $(this);
        u.addClass('lisc');
        u.siblings('span').removeClass('lisc');
    })
    $('.nav-ll ul li').click(function(){
        var  u = $(this);
        u.addClass('lisc');
        u.siblings('li').removeClass('lisc');
    })
    $('.dis-list span').click(function(){
        var  u = $(this);
        u.addClass('shai');
        u.siblings('span').removeClass('shai');
    })
    $('.disz-list span').click(function(){
		var i = $(this);
		if (i.hasClass('shai')) {
			i.removeClass('shai');
		}else{
			i.addClass('shai')
		}
	})
    $('.site-1 span').click(function(){
			var  x = $(this);
			var  index = x.closest(".nav-ll").index();
			var  lead = $('.navigation ul li').eq(index);
			var  b = x.text();
			$(lead).find('em').text(b);
			$('.nav-ll').hide();
			$('.disk').hide();
			$('.navigation ul li').removeClass('lisc');
			$('body').removeClass('by')
		})
     $('.nav-list .nic li').click(function(){
			var  x = $(this);
			var  index = x.closest(".nav-ll").index();
			var  lead = $('.navigation ul li').eq(index);
			var  b = x.text();
			$(lead).find('em').text(b);
			$('.nav-ll').hide();
			$('.disk').hide();
			$('.navigation ul li').removeClass('lisc');
			$('body').removeClass('by')
		})
    // 列表body置顶
    $('.navigation ul li').click(function(){
        var dom = $('.navigation ul li')
        if (dom.hasClass('lisc')) {
            $('body').addClass('by')
        }else{
            $('body').removeClass('by')
        }
    })
    //遮罩层
     $('.disk').click(function(){
        $('.disk').hide();
        $('.nav-list .nav-ll').hide();  
        $('body').removeClass('by');
        $('.navigation ul li').removeClass('lisc');
    })
})
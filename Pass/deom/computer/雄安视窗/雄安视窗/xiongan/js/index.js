$(function(){
	// 幻灯片
	$('.flash ').slide({mainCell:".bd", titCell:".hd ul", autoPlay:true, autoPage:true,effect:"fold"})	

	jQuery(".gonggao").slide({mainCell:".gg_list",autoPlay:true,effect:"topMarquee",vis:1,interTime:100,trigger:"click"});

	jQuery(".part_3").slide({mainCell:".p3_list ul",autoPlay:true,effect:"leftMarquee",vis:6,interTime:50,trigger:"click"});

	// 寻找美食tab切换
	$('.p2l_tab .tab ul li').hover(function(){
		var x = $(this),index = x.index(),close = x.closest('.p2l_tab ').find('.tab_list ul');
		close.eq(index).show().siblings().hide();
		x.addClass(' tab_bc');
		x.siblings().removeClass(' tab_bc');
	})
	// 出租选项卡
	$('.p5_mid .p5_lead ul li').hover(function(){
		var x = $(this),index = x.index(),close = x.closest('.p5_mid ').find('.p5_ll .p5_list');
		close.eq(index).show().siblings().hide();
		x.addClass('pl_bc');
		x.siblings().removeClass('pl_bc');
	})

	// part10选项卡
	$('.p10_lead ul li').hover(function(){
		var x = $(this),index = x.index(),close = x.closest('.p10_left ').find('.p10_lt .p10_ll');
		close.eq(index).show().siblings().hide();
		x.addClass('p10_bc');
		x.siblings().removeClass('p10_bc');
	})

	// 友情链接选项卡切换
	$('.part_12 .p12_lead ul li').hover(function(){
		var x = $(this),index = x.index(),close = x.closest('.part_12 ').find('.p12_list .p12_ll');
		close.eq(index).show().siblings().hide();
		x.addClass('p12_bc');
		x.siblings().removeClass('p12_bc');
	})

	// 左侧导航栏置顶
	var Ggoffset = $('.suspend_left').offset().top;
	$(window).bind("scroll",function(){
		var d = $(document).scrollTop()-5;
		if(Ggoffset < d){
			$('.suspend_left').addClass('fixed');
		}else{
			$('.suspend_left').removeClass('fixed');
		}
	});

  $(window).scroll(function() {
    var height = $(window).scrollTop();
      if (height > 600) {
        $('.suspend_right').show();
      }else {
        $('.suspend_right').hide();
      }
  });
	$(window).scroll(function() {
    var height = $(window).scrollTop();
      if (height > 850) {
        $('.suspend_left').show();
      }else {
        $('.suspend_left').hide();
      }
  });

	// 返回顶部
	$(".suspend_right ul li.sr_1").bind("click", function(){
		$('html, body').animate({scrollTop:0}, 300);
	});

	// 公用搜索tab切换
	$('.sear_lead  ul li').hover(function(){
		var x = $(this),index = x.index(),close = x.closest('.h_search ').find('.sear_list .sear ');
		close.eq(index).show().siblings().hide();
		x.addClass('sea_bc');
		x.siblings().removeClass('sea_bc');
	})
	$('body').click(function(){
		var x = $('.select'),
			find = x.find('ul');
		find.hide();
	})
	$('.select').click(function(){
		var x = $(this),
			find = x.find('ul');
		find.show();
		return false
	})
	$('.select ul li').click(function(){
		var x = $(this),
			txt = x.text(),
			close = x.closest('.select').find('.sle');
		close.text(txt);
		$('.select ul').hide();
		return false
	})

	// 美食页面美食活动tab切换
	$('.p1_list .p1l_lead ul li').hover(function(){
		var x = $(this),index = x.index(),close = x.closest('.p1_list ').find('.p1ll .p1l_txt ');
		close.eq(index).show().siblings().hide();
		x.addClass('p1l_bc');
		x.siblings().removeClass('p1l_bc');
	})
})
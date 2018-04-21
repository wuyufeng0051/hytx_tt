$(function(){
	// foot二维码tab切换
	$(".QR_code li").hover(function() {
        var index = $(this).index();
        $(this).addClass("current").siblings().removeClass("current");
        $(".QR_code .code_tp").eq(index).removeClass("hide").siblings().addClass("hide");
      });

	// 全部商品分类
	$(".home_categorys").hover(function(){
		var x = $(this);
		var next = x.closest('.home_categorys').find('.dd');
		var z = x.closest('.home_categorys').find('.dt');
        if( next.css("display")=='none' ) { 
            next.show();
            z.addClass('up');
        }else{
            next.hide();
            z.removeClass('up');
        }
    });

	$('.sl-v-list li').click(function(){
		var x = $(this);
		x.addClass("curr").siblings().removeClass("curr");
	});

    // 排序
    $('.button-strip li').click(function(){
        var t = $(this);

        t.siblings('li').removeClass('current l-d');

        if (!t.hasClass('current')) {
            t.removeClass('l-d').addClass('current');
        }else{
            t.removeClass('current').addClass('l-d')
        }

    })
    // 购物车
    var winHeight = $(window).height();
    $(".tbar-panel-content").css({
      "height": winHeight - 128
    });
    $(".tbar-panel-main").css({
      "height": winHeight - 38
    });
    $(window).resize(function() {
      winHeight = $(this).height();
      $(".tbar-panel-main").css({
        "height": winHeight - 38
      });
      $(".tbar-panel-content").css({
        "height": winHeight - 128
      });
    });
    //商品收藏和店铺收藏切换
     $(".tbar-panel-main").slide({
        titCell: ".follow-tabnav li",
        mainCell: ".follow-tabcontents",
        effect: "left",
        titOnClassName: "curr"
      });
   // 购物车
  var winHeight = $(window).height();
  $(".tbar-panel-content").css({
    "height": winHeight - 128
  });
  $(".tbar-panel-main").css({
    "height": winHeight - 38
  });
  $(window).resize(function() {
    winHeight = $(this).height();
    $(".tbar-panel-main").css({
      "height": winHeight - 38
    });
    $(".tbar-panel-content").css({
      "height": winHeight - 128
    });
  });
  //商品收藏和店铺收藏切换
   $(".tbar-panel-main").slide({
      titCell: ".follow-tabnav li",
      mainCell: ".follow-tabcontents",
      effect: "left",
      titOnClassName: "curr"
    });
    // 购物车
	$('.quick_links .pp_lead').click(function(){
		var  u = $(this);
		var index = u.index();
		$('.pop_list .pp').eq(index).show();
		$('.pop_list .pp').eq(index).siblings().hide();
		if (u.hasClass('current')) {
            $('.mui-mbar-tabs').removeClass('right')
			u.removeClass('current');
        }else{
            $('.mui-mbar-tabs').addClass('right')
            u.addClass('current');
			u.siblings('li').removeClass('current');
        }
	})
	$('.ibar_closebtn').click(function(){
		$('.mui-mbar-tabs').removeClass('right')
	})
	$(".mpbtn_email").click(function() {
        var obj = $(".email_sub");
        if (obj.hasClass("show")) {
          obj.removeClass("show");
        } else {
          obj.addClass("show");
        }
      });
  //移动图标出现文字
      $(".quick_links_panel li").mouseenter(function() {
        $(this).children(".mp_tooltip").stop().animate({
          left: -92,
          queue: true
        });
        $(this).children(".mp_tooltip").css("visibility", "visible");
        $(this).children(".ibar_login_box").css("display", "block");
      });
      $(".quick_links_panel li").mouseleave(function() {
        $(this).children(".mp_tooltip").css("visibility", "hidden");
        $(this).children(".mp_tooltip").stop().animate({
          left: -121,
          queue: true
        });
        $(this).children(".ibar_login_box").css("display", "none");
      });
      $(".quick_toggle li").mouseover(function() {
        $(this).children(".mp_qrcode").show();
      });
      $(".quick_toggle li").mouseleave(function() {
        $(this).children(".mp_qrcode").hide();
      });
  //首页购物车展开
  $(".shopcart-2015").hover(function(){
    $(this).addClass("hover");
  },function(){
    $(this).removeClass("hover");
  });
})
$(function() {

  $('#cata-nav .item').unbind('mouseleave').bind('mouseleave',
  function() {
    $(this).removeClass("selected");
    $(this).children(".cata-nav-layer").hide();
  });


  var winWidth = $(window).width();
  var left = (winWidth - 1200) / 2;
  $("#slideTxtBox").css({
    "left": left
  });

  $(window).resize(function() {
    winWidth = $(this).width();
    if (winWidth > 1200) {
      left = (winWidth - 1200) / 2;
      $("#slideTxtBox").css({
        "left": left
      });
    } else {
      $("#slideTxtBox").css({
        "left": 0
      });
    }
  });


  //价格筛选提交
  $('.ui-btn-submit').click(function() {
    var min_price = Number($(".price-min").val());
    var max_price = Number($(".price-max").val());

    if (min_price == '' && max_price == '') {
      alert('请填写筛选价格');
      return false;
    } else if (min_price == '') {
      alert('请填写筛选左边价格');
      return false;
    } else if (max_price == '') {
      alert('请填写筛选右边价格');
      return false;
    } else if (min_price > max_price || min_price == max_price) {
      alert('左边价格不能大于或等于右边价格');
      return false;
    }
    $("form[name='listform']").submit();
  });

  $('.ui-btn-clear').click(function() {
    $("input[name='price_min']").val('');
    $("input[name='price_max']").val('');
  });

  $(".zimu_list").hover(function() {
    $(".zimu_list").perfectScrollbar();
  });
  function selectStoreTab(a) {
  var li = $(".tab").find("li").eq(a);
  if (!li.hasClass("curr")) {
    li.addClass("curr").siblings().removeClass("curr");
  }
    $("#stock_list").find(".mc").eq(a).removeClass("hide").siblings(".mc").addClass("hide");
  }
  $(".hotsale").slide({
    mainCell: ".bd ul",
    effect: "left",
    pnLoop: false,
    autoPlay: false,
    autoPage: true,
    scroll: 1,
    vis: 4
  });
  $(".share-content").slide({
    mainCell: ".bd ul",
    effect: "left",
    pnLoop: false,
    autoPlay: false,
    autoPage: true,
    scroll: 1,
    vis: 7
  });


  // 点击全部查看全部品牌
  $('.choose_open').click(function(){
  var x = $(this);
  if($('.brand_div').hasClass('brand_height')) {
  $('.brand_div').removeClass('brand_height');
  x.removeClass('arrow');
  }else{
  $('.brand_div').addClass('brand_height');
  x.addClass('arrow');
  };
  })
  // 排序
  $('.button-strip .ii').click(function(){
  var t = $(this);

  t.siblings('.ii').removeClass('current l-d');

  if (!t.hasClass('current')) {
      t.removeClass('l-d').addClass('current');
  }else{
      t.removeClass('current').addClass('l-d')
  }
  })
  // 列表模式和矩阵模式TAb切换
  $('.filter-sortbar .styles .item').click(function(){
  var x = $(this),
    index = x.index();
  $('.pp_list .car_goods_list ').eq(index).show();
  $('.pp_list .car_goods_list ').eq(index).siblings().hide();
  x.addClass('current');
  x.siblings().removeClass('current');
  })
  // 底部二维码TAB切换
  $(".QR_code li").hover(function() {
  var index = $(this).index();
  $(this).addClass("current").siblings().removeClass("current");
  $(".QR_code .code_tp").eq(index).removeClass("hide").siblings().addClass("hide");
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
});





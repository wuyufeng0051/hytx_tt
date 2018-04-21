$(function(){
	function changenum(rec_id, diff, warehouse_id, area_id) {
              var cValue = $('#cart_value').val();
              var goods_number = Number($('#goods_number_' + rec_id).text()) + Number(diff);
              if (goods_number < 1) {
                return false;
              } else {
                change_goods_number(rec_id, goods_number, warehouse_id, area_id, cValue);
              }
            }
            function change_goods_number(rec_id, goods_number, warehouse_id, area_id, cValue) {
              if (cValue != '' || cValue == 'undefined') {
                var cValue = $('#cart_value').val();
              }

            }
            function change_goods_number_response(result) {
              var rec_id = result.rec_id;
              if (result.error == 0) {
                $('#goods_number_' + rec_id).val(result.goods_number); //更新数量
                $('#goods_subtotal_' + rec_id).html(result.goods_subtotal); //更新小计
                if (result.goods_number <= 0) { // 数量为零则隐藏所在行
                  $('#tr_goods_' + rec_id).style.display = 'none';
                  $('#tr_goods_' + rec_id).innerHTML = '';
                }
                $('#total_desc').html(result.flow_info); //更新合计
                if ($('ECS_CARTINFO')) { //更新购物车数量
                  $('#ECS_CARTINFO').html(result.cart_info);
                }

                if (result.group.length > 0) {
                  for (var i = 0; i < result.group.length; i++) {
                    $("#" + result.group[i].rec_group).html(result.group[i].rec_group_number); //配件商品数量
                    $("#" + result.group[i].rec_group_talId).html(result.group[i].rec_group_subtotal); //配件商品金额
                  }
                }

                $("#goods_price_" + rec_id).html(result.goods_price);

                //ecmoban模板堂 --zhuo 优惠活动 start
                $('#favourable_list').html(result.favourable_list_content);
                $('#your_discount').html(result.your_discount);
                if (result.discount) {
                  $('#cart_discount').css({
                    "display": ""
                  });
                } else {
                  $('#cart_discount').css({
                    "display": "none"
                  });
                }
                //ecmoban模板堂 --zhuo 优惠活动 end
                $(".cart_num").html(result.subtotal_number);
              } else if (result.message != '') {
                $('#goods_number_' + rec_id).val(result.cart_Num); //更新数量
                alert(result.message);
              }
            }



        $('#cata-nav .item').unbind('mouseenter').bind('mouseenter',
        function() {
          var T = $(this);
          var cat_id = T.children('.item-left').children('.cata-nav-name').data('id');
          var eveval = T.children('.item-left').children('.cata-nav-name').attr('eveval');

          if (eveval != 1) {
            T.children('.item-left').children('.cata-nav-name').attr('eveval', '1');
            /*加载中by wu*/
            $('#subitems_' + cat_id).html('<img src="images/loadGoods.gif" width="200" height="200" class="lazy" style="margin:100px 281px">');
          }

          T.addClass("selected");
          T.children('.cata-nav-layer').show();
        });

        $('#cata-nav .item').unbind('mouseleave').bind('mouseleave',
        function() {
          $(this).removeClass("selected");
          $(this).children(".cata-nav-layer").hide();
        });



        $("#clear_price").click(function() {
        $("#price-min").val('');
        $("#price-max").val('');
      });

      $(".QR_code li").hover(function() {
        var index = $(this).index();
        $(this).addClass("current").siblings().removeClass("current");
        $(".QR_code .code_tp").eq(index).removeClass("hide").siblings().addClass("hide");
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

      $(".mpbtn_email").click(function() {
        var obj = $(".email_sub");
        if (obj.hasClass("show")) {
          obj.removeClass("show");
        } else {
          obj.addClass("show");
        }
      });

      //判断浏览器下滚还是上滚
      $(document).ready(function() {
        var p = 0,
        t = 0;
        var obj = $(".email_sub");
        $(window).scroll(function(e) {
          p = $(this).scrollTop();
          if (t <= p) {
            if (obj.hasClass("show")) {
              obj.addClass("show");
            }
          } else {
            obj.removeClass("show");
          }
          setTimeout(function() {
            t = p;
          },
          0);
        });
      });

      function openWin(obj) {
        if ($(obj).attr('IM_type') != 'dsc') {
          var goods_id = '&goods_id=' + $(obj).attr('goods_id');
        } else {
          var goods_id = '';
        }
        var url = 'online.php?act=service' + goods_id //转向网页的地址;
        var name = 'webcall'; //网页名称，可为空;
        var iWidth = 700; //弹出窗口的宽度;
        var iHeight = 500; //弹出窗口的高度;
        //获得窗口的垂直位置
        var iTop = (window.screen.availHeight - 30 - iHeight) / 2;
        //获得窗口的水平位置
        var iLeft = (window.screen.availWidth - 10 - iWidth) / 2;
        window.open(url, name, 'height=' + iHeight + ',,innerHeight=' + iHeight + ',width=' + iWidth + ',innerWidth=' + iWidth + ',top=' + iTop + ',left=' + iLeft + ',status=no,toolbar=no,menubar=no,location=no,resizable=no,scrollbars=0,titlebar=no');
      }

      var email = document.getElementById('user_email');
      function add_email_list() {
        if (check_email()) {
          Ajax.call('user.php?act=email_list&job=add&email=' + email.value, '', rep_add_email_list, 'GET', 'TEXT');
        }
      }
      function rep_add_email_list(text) {
        get_email(text);
      }

      function check_email() {
        if (Utils.isEmail(email.value)) {
          return true;
        } else {
          get_email('邮件地址非法！');
          return false;
        }
      }

      function get_email(text) {
        var ok_title = determine;
        var cl_title = cancel;
        var title = Prompt_information;
        var width = 455;
        var height = 58;
        var divId = "email_div";

        var content = '<div id="' + divId + '">' + '<div class="tip-box icon-box">' + '<span class="warn-icon m-icon"></span>' + '<div class="item-fore">' + '<h3 class="ftx-04">' + text + '</h3>' + '</div>' + '</div>' + '</div>';

        pb({
          id: divId,
          title: title,
          width: width,
          height: height,
          ok_title: ok_title,
          //按钮名称
          cl_title: cl_title,
          //按钮名称
          content: content,
          //调取内容
          drag: false,
          foot: true,
          onOk: function() {},
          onCancel: function() {}
        });

        $('.pb-ok').addClass('color_df3134');
        $('#' + divId + ' .pb-ct .item-fore').css({
          'height': '58px'
        });

        if (text.length <= 15) {
          $('#' + divId + ' .pb-ct .item-fore').css({
            "padding-top": '10px'
          });
        }
      }


    //首页幻灯片
      $(".banner-box").slide({
        titCell: ".hd ul",
        mainCell: ".bd ul",
        effect: "fold",
        interTime: 3500,
        delayTime: 500,
        autoPlay: true,
        autoPage: true,
        trigger: "click",
        endFun: function(i, c, s) {
          $(window).resize(function() {
            var width = $(window).width();
            s.find(".bd li").css("width", width);
          });
        }
      });
      //立即抢购滚动
      $(".right-sidebar").slide({
        mainCell: ".panic-buy-slide ul",
        effect: "left",
        pnLoop: false,
        autoPlay: false,
        autoPage: true,
        scroll: 1,
        vis: 1,
        prevCell: ".buy-prev",
        nextCell: ".buy-next"
      });
      //商城公告和招商入驻切换
      $(".proclamation").slide({
        titCell: ".tabs-nav li",
        mainCell: ".tabs"
      });
      //首页新品热卖3条广告切换
      $(".focus-trigeminy").slide({
        mainCell: ".bd_lunbo ul",
        effect: "left",
        pnLoop: false,
        autoPlay: false,
        autoPage: true,
        prevCell: ".tri_prev",
        nextCell: ".tri_next"
      });
      $(".focus-trigeminy").hover(function() {
        $(this).children(".tri_prev,.tri_next").animate({
          'opacity': 0.5
        });
      },
      function() {
        $(this).children(".tri_prev,.tri_next").animate({
          'opacity': 0
        });
      });
      $('.bd_lunbo a').jfade({
        start_opacity: "1",
        high_opacity: "1",
        low_opacity: "0.5",
        timing: "500"
      });
      $('.floor-new ul li').jfade({
        start_opacity: "1",
        high_opacity: "1",
        low_opacity: "0.5",
        timing: "500"
      });
      //首页热门推荐,抢购,商城推荐,热评商品tab切换
      $(".done-left").slide({
        titCell: ".done-tabs-nav li",
        mainCell: ".done-content"
      });
      $("#dome1").slide({
        mainCell: ".done-warp ul",
        effect: "left",
        pnLoop: false,
        autoPlay: false,
        autoPage: true,
        scroll: 1,
        vis: 5,
        prevCell: ".done-prev",
        nextCell: ".done-next"
      });
      $("#dome2").slide({
        mainCell: ".done-warp ul",
        effect: "left",
        pnLoop: false,
        autoPlay: false,
        autoPage: true,
        scroll: 1,
        vis: 5,
        prevCell: ".done-prev",
        nextCell: ".done-next"
      });
      $("#dome3").slide({
        mainCell: ".done-warp ul",
        effect: "left",
        pnLoop: false,
        autoPlay: false,
        autoPage: true,
        scroll: 1,
        vis: 5,
        prevCell: ".done-prev",
        nextCell: ".done-next"
      });
      $("#dome4").slide({
        mainCell: ".done-warp ul",
        effect: "left",
        pnLoop: false,
        autoPlay: false,
        autoPage: true,
        scroll: 1,
        vis: 5,
        prevCell: ".done-prev",
        nextCell: ".done-next"
      });
      //首页团购左右滚动
      $(".done-right").slide({
        mainCell: ".shop-group ul",
        effect: "left",
        pnLoop: false,
        autoPlay: false,
        autoPage: true,
        scroll: 1,
        vis: 1
      });
      //品牌街左右滚动
      $(".brand-warp").slide({
        mainCell: ".brand-warp-list",
        effect: "left",
        pnLoop: false,
        autoPlay: false,
        autoPage: true,
        scroll: 1,
        vis: 1
      });
      $(".brand-adv").slide({
        titCell: ".hd ul",
        mainCell: ".bd ul",
        effect: "leftLoop",
        autoPlay: true,
        autoPage: true,
        scroll: 1,
        vis: 1
      });
      $(".floor-left-banner").slide({
        titCell: ".hd ul",
        mainCell: ".bd ul",
        effect: "leftLoop",
        autoPlay: true,
        autoPage: true,
        scroll: 1,
        vis: 1
      });
      //限时抢购倒计时
      $(".time").each(function() {
        $(this).yomi();
      });
      //首页，顶级分类页广告栏按钮自适应宽度
      $.liWidth(".floor");
      $.liWidth(".brand-adv");
      //首页悬浮栏
      $(window).scroll(function() {
        var scrollTop = $(document).scrollTop();
        var content = $(".nav").offset().top;
        if (scrollTop > content) {
          $(".attached-search-container").addClass("show");
        } else {
          $(".attached-search-container").removeClass("show");
        }
      });

     
      
	  // 头部下拉加边线, 右侧回到顶部
	  $(window).scroll(function() {
	    var height = $(window).scrollTop();
	      if (height > 1000) {
	        $('.elevator').show();
	      }else {
	        $('.elevator').hide();
	      }
	  });
	  // 锚链接
	  $('.elevator li a').click(function(){
	    var t = $(this);
	    var close = t.closest('li')
	    close.addClass('curr');
	    close.siblings('li').removeClass('curr');
	  })

      // 楼层品牌切换
      jQuery(".floor-brand").slide({mainCell:".bd-brand-list",autoPage:false,effect:"left",autoPlay:false,scroll:1,vis:1,prevCell:".prev",nextCell	:".next"});
      // 楼层tab切换
      $('.floor-container .floor-title li').hover(function(){
		var  u = $(this);
		var index = u.index();
		var find = u.closest('.floor-container').find('.floor-tabs-content .ecsc-main');
		find.eq(index).show();
		find.eq(index).siblings().hide();
		u.addClass('on');
		u.siblings('li').removeClass('on');
	})
      $(function(){  
		  $('a[href*=#],area[href*=#]').click(function() {
		    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
		      var $target = $(this.hash);
		      $target = $target.length && $target || $('[name=' + this.hash.slice(1) + ']');
		      if ($target.length) {
		        var targetOffset = $target.offset().top;
		        $('html,body').animate({
		          scrollTop: targetOffset
		        },
		        1000);
		        return false;
		      }
		    }
		  });
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
	//首页楼层悬浮框
	indexfloor();
function indexfloor(){
	var elevator,winHeight,winWidth,elevatorHeight,elevatorWidth,top,left,disTop,floors,li,index;
	
	elevator =$("#elevator");
	floors = $(".floor");
	li = elevator.find("li");
	winHeight = $(window).height();
	winWidth = $(window).width();
	elevatorHeight = elevator.height();
	elevatorWidth = elevator.width();
	top = (winHeight-elevatorHeight)/2;
	left = (winWidth-1200)/2-elevatorWidth-40;
	
	disTop = $(".floor-container").offset().top - top;
	elevator.css({"position":"fixed","top":top,"left":left});
	
	$(window).resize(function(){
		winWidth = $(this).width();
		left = (winWidth-1200)/2-elevatorWidth-40;
		elevator.css({"left":left});
	});
	li.click(function(){
		index = $(this).index();
		top = parseInt(floors.eq(index).offset().top-60);
		$("body,html").stop().animate({scrollTop:top});
	});
	
	$(window).scroll(function(){
		var scrollTop = $(document).scrollTop();
		var guessloveTop = $(".guess-love").offset().top;
		if(scrollTop>disTop){
			elevator.stop().animate({"opacity":1});
			elevator.css({'*display':'block','display':'block'});
		}else{
			elevator.stop().animate({"opacity":0});
			elevator.css({'*display':'none','display':'none'});
		}
		
		if(scrollTop>guessloveTop-600){
			elevator.stop().animate({"opacity":0});
			elevator.css({'*display':'none','display':'none'});
		}
		
		for(var i=0;i<floors.length;i++){
			top =  parseInt(floors.eq(i).offset().top);
			if(scrollTop >= top-500){
				li.eq(i).addClass("curr").siblings().removeClass("curr");
			}
		}
	});
	}
    //首页购物车展开
  $(".shopcart-2015").hover(function(){
    $(this).addClass("hover");
  },function(){
    $(this).removeClass("hover");
  });
})
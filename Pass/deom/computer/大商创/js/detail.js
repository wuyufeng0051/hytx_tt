$(function(){
	window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},"image":{"viewList":[],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":[]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];


	$(".fitting-tab").tabso({
	cntSelect: ".fitting-list",
	tabEvent: "click",
	tabStyle: "normal",
	onStyle: "on"
	});
	$(".charts-tab").tabso({
	cntSelect: ".charts-list",
	tabEvent: "click",
	tabStyle: "normal",
	onStyle: "on"
	});
	$(".spec-list").slide({
	mainCell: ".spec-items ul",
	effect: "left",
	trigger: "click",
	pnLoop: false,
	autoPage: true,
	scroll: 1,
	vis: 5,
	prevCell: ".spec-prev",
	nextCell: ".spec-next"
	});
	$(".fitting-content").slide({
	mainCell: ".fitting-wrap ul",
	effect: "left",
	trigger: "click",
	pnLoop: false,
	autoPage: true,
	scroll: 1,
	vis: 5,
	prevCell: ".fitting-prev",
	nextCell: ".fitting-next"
	});
	$(".p-photos-wrap").slide({
	mainCell: ".bd ul",
	effect: "left",
	autoPlay: false,
	prevCell: ".photo_prev",
	nextCell: ".photo_next"
	});
	$(".ecsc-single-desc").jfloor(43, 0);


  //数量选择
	function quantity() {
	$(".btn-reduce").click(function() {
	  var quantity = Number($("#quantity").val());
	  var perNumber = Number($("#perNumber").val());
	  var perMinNumber = Number($("#perMinNumber").val());

	  if (quantity > perMinNumber) {
	    quantity -= 1;
	    $("#quantity").val(quantity);
	    changePrice(); //@author bylu 数量减少后获取白条分期新价格;
	  } else {
	    $("#quantity").val(perMinNumber);
	  }
	});

	$(".btn-add").click(function() {
	  var quantity = Number($("#quantity").val());
	  var perNumber = Number($("#perNumber").val());
	  var perMinNumber = Number($("#perMinNumber").val());
	  var err = 0;

	  if (quantity < perNumber) {

	    quantity += 1;

	    //限购
	    if (quantity == 1) {
	      err = 0;
	    }
	    $("#quantity").val(quantity);
	    changePrice(); //@author bylu 数量增加后获取白条分期新价格;
	  } else {
	    if (perNumber == 0) {
	      perNumber = 1;
	    }
	    $("#quantity").val(perNumber);
	  }

	})
	}
	quantity();

	function getImgUrl(result) {
	if (result.t_img != '') {
	  $('#Zoomer').attr({
	    href: "" + result.t_img + ""
	  });
	  //$('#J_prodImg').attr({href:"" +result.t_img+ "", src:"" +result.t_img+ ""});
	  $('#J_prodImg').attr({
	    src: "" + result.t_img + ""
	  });
	  $('.MagicBoxShadow').eq(0).find('img').eq(0).attr({
	    src: "" + result.t_img + ""
	  });
	  $('.MagicThumb-expanded').find('img').attr({
	    src: "" + result.t_img + ""
	  });
	}
	}

	//关闭弹框
	$(".thickclose").click(function() {
	  $(".thickdiv").hide();
	  $("#notify_box").hide();
	})
	 $(".QR_code li").hover(function() {
	var index = $(this).index();
	$(this).addClass("current").siblings().removeClass("current");
	$(".QR_code .code_tp").eq(index).removeClass("hide").siblings().addClass("hide");
	})

	// 地区选择
	$('.select_area_box .select_tab').hover(function(){
		var  x = $(this),
			index = x.index();
		$('.place .house_list_style').eq(index).show();
		$('.place .house_list_style').eq(index).siblings().hide();
		x.addClass('curr');
		x.siblings().removeClass('curr');
	})
	// 加入购物车
	$('.btn-append').click(function(){
		if ($('.loading').css('display') == 'none') {
			$('.loading').show();
			$('.loading-mask').show();
		}else{
			$('.loading').hide();
			$('.loading-mask').hide();
		};
	})
	$('.loading .title .loading-x').click(function(){
		$('.loading').hide();
		$('.loading-mask').hide();
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
	$('.choose-btn-coll').click(function(){
	if ($('#goods_collect').css('display') == 'none') {
		$('#goods_collect').show();
		$('#pb-mask').show();
		$('.choose-btn-coll').addClass('selected');
	}else{
		$('#goods_collect').hide();
		$('#pb-mask').hide();
	}
	})
	$('.pb-hd .pb-x').click(function(){
		$('#goods_collect').hide();
		$('#pb-mask').hide();
	})
		//首页购物车展开
	$(".shopcart-2015").hover(function(){
		$(this).addClass("hover");
	},function(){
		$(this).removeClass("hover");
	});
})
$(function(){


  var swiperNav = [], mainNavLi = $('.mainNav li');
  for (var i = 0; i < mainNavLi.length; i++) {
    swiperNav.push('<li>'+$('.mainNav li:eq('+i+')').html()+'</li>');
  }

  var liArr = [];
  for(var i = 0; i < swiperNav.length; i++){
    liArr.push(swiperNav.slice(i, i + 10).join(""));
    i += 9;
  }

  $('.mainNav .swiper-wrapper').html('<div class="swiper-slide"><ul class="fn-clear">'+liArr.join('</ul></div><div class="swiper-slide"><ul class="fn-clear">')+'</ul></div>');

  var swiper1 = $('#swiper-container1');
  var navHeight = swiper1.offset().top;

  // 房产切换
  $('.house-tab li').click(function(){
    var t = $(this), index = t.index();
    $('.house-tab li').removeClass('curr').eq(index).addClass('curr');
    $('.house-content ul').hide().eq(index).show();
  })


  // banna轮播图
	$('.picscroll .count').text($('#picscroll li').length);
	 $('#picscroll').slider({changedFun:function(n){
			 var li = $('#picscroll ul li'), active = li.eq(n);
			 if(n < li.length - 1) {
					 if(!active.hasClass('showed')) {
							 active.addClass('showed');
					 }
					 var next = li.eq(n+1);
					 next.addClass('showed');
			 }
			 $('.picscroll .page').text(++n);
	 }})


  // 导航更多
  $('.fixhead .hmore i').click(function(){
    var t = $(this), more = $('.fixhead .hmore ul');
    if (more.css('display') == 'none') {
      t.addClass('open');
      $('.fixhead .hmore em').show();
      more.show();
    }else {
      t.removeClass('open');
      $('.fixhead .hmore em').hide();
      more.hide();
    }
    return false;
  })

  $(document).click(function(){
    $('.fixhead .hmore ul').hide();
    $('.fixhead .hmore .arrow').hide();
    $('.fixhead .hmore i').removeClass('open');
  })

  // 头部导航渐显
 	var Color = {
 	    init: function() {
 	        var t = this.getopacity();
 	        this.changeColor(t)
 	    },
 	    changeColor: function(t) {
 	        var n = $(".headbg");
 	        t < 25 ? (n.css("background", "rgba(255,80,0,0 )")) : (t /= 100, n.css("background", "rgba(255,80,0," + t + ")"))
 	    },
 	    getopacity: function() {
 	        var t = $(window).scrollTop();
 	        return t /= 2, t > 90 ? 90 : t
 	    }
 	};
 	Color.init(),
 	$(window).on("scroll", function() {
 	    Color.init()
 	});



  // 滑动导航
	var mySwiperNav = new Swiper('.mainNav',{pagination : '.swiper-pagination',})
  // 同城头条
  var mySwiperNews = new Swiper('.swiper-news', {direction: 'vertical', autoplay:4000, loop : true, speed: 700, height: 80});
  mySwiperNews.detachEvents()

  var mySwiper1 = new Swiper('#swiper-container1', {
  		watchSlidesProgress: true,
  		watchSlidesVisibility: true,
  		slidesPerView: 7,
  		onTap: function() {
  			mySwiper2.slideTo(mySwiper1.clickedIndex)
  		}
  	})

  	var isLoadVideoArr = [];
  	var mySwiper2 = new Swiper('#swiper-container2', {
  		speed:500,
  		autoHeight: true,
  		freeModeMomentumBounce: false,
      spaceBetween: 30,
  		onSlideChangeStart: function() {
  			updateNavPosition();
        if (swiper1.hasClass('fixed')) {
          $(window).scrollTop(navHeight);
        }
  		}

  	})

  	function updateNavPosition() {
  		$('#swiper-container1 .active-nav').removeClass('active-nav')
  		var activeNav = $('#swiper-container1 .swiper-slide').eq(mySwiper2.activeIndex).addClass('active-nav');

  		if (!activeNav.hasClass('swiper-slide-visible')) {
  			if (activeNav.index() > mySwiper1.activeIndex) {
  				var thumbsPerNav = Math.floor(mySwiper1.width / activeNav.width()) - 1
  				mySwiper1.slideTo(activeNav.index() - thumbsPerNav)
  			} else {
  				mySwiper1.slideTo(activeNav.index())
  			}
  		}
  	}

  	var tabIndex = $('#swiper-container1 .active-nav').index();
  	mySwiper1.slideTo(tabIndex, 0, false);
  	mySwiper2.slideTo(tabIndex, 0, false);


    //注册客户端webview
    function setupWebViewJavascriptBridge(callback){
      if(window.WebViewJavascriptBridge){
        return callback(WebViewJavascriptBridge);
      }else{
        document.addEventListener("WebViewJavascriptBridgeReady", function() {
          return callback(WebViewJavascriptBridge);
        }, false);
      }

      if(window.WVJBCallbacks){return window.WVJBCallbacks.push(callback);}
      window.WVJBCallbacks = [callback];
      var WVJBIframe = document.createElement("iframe");
      WVJBIframe.style.display = "none";
      WVJBIframe.src = "wvjbscheme://__BRIDGE_LOADED__";
      document.documentElement.appendChild(WVJBIframe);
      setTimeout(function(){document.documentElement.removeChild(WVJBIframe) }, 0);
    }

    // 扫一扫
    $('.fixhead .sao').click(function(){
      setupWebViewJavascriptBridge(function(bridge) {
        bridge.callHandler("QRCodeScan", {}, function(){});
      });
    })

    // 开启下拉刷新
    setupWebViewJavascriptBridge(function(bridge) {
      bridge.callHandler("setDragRefresh", {"value": "on"}, function(){});
    });


  // 导航吸顶
	$(window).on("scroll", function(){
		if ($(window).scrollTop() > navHeight) {
			$('#swiper-container1').addClass('fixed');

      setupWebViewJavascriptBridge(function(bridge) {
      	bridge.callHandler("addAppStatusBarBgdColor", {}, function(){});
      });

		}else {
      $('#swiper-container1').removeClass('fixed');

      setupWebViewJavascriptBridge(function(bridge) {
        bridge.callHandler("deleteAppStatusBarBgdColor", {}, function(){});
      });

		}
	});





})

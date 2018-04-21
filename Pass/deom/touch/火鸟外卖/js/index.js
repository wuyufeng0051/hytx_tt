$(function(){
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
    // 同城头条
  var mySwiperNews = new Swiper('.swiper-news', {direction: 'vertical', autoplay:4000, loop : true, speed: 700, height: 80});
  mySwiperNews.detachEvents()

  var mySwiper1 = new Swiper('#swiper-container1', {
  		watchSlidesProgress: true,
  		watchSlidesVisibility: true,
  		slidesPerView: 2,
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
  	
  	// 导航
	var mySwiper = new Swiper('#slideNav',{pagination : '.swiper-pagination',});

	 var navbar = $('.navbar');
	  var navHeight = navbar.offset().top;

	  // 导航条左右切换模块
	  var tabsSwiper = new Swiper('#tabs-container',{
	    speed:350,
	    autoHeight: true,
			touchAngle : 35,
	    onSlideChangeStart: function(){
				loadMoreLock = false;
	      $(".navbar .active").removeClass('active');
	      $(".navbar li").eq(tabsSwiper.activeIndex).addClass('active');
	      if (navbar.hasClass('fixed')) {
	        $(window).scrollTop(navHeight + 2);
	      }

				// $("#tabs-container .swiper-slide").eq(tabsSwiper.activeIndex).css('height', 'auto').siblings('.swiper-slide').height($(window).height());

				// 当模块的数据为空的时候加载数据
				// if($.trim($("#tabs-container .swiper-slide").eq(tabsSwiper.activeIndex).find(".content-slide").html()) == ""){
				// 	$("#tabs-container .swiper-slide").eq(tabsSwiper.activeIndex).find('.content-slide').html('<div class="loading"><i class="icon-loading"></i>加载中...</div>')
				// 	getList();
				// }

	    },
	    onSliderMove: function(){
	      // isload = true;
	    },
	    onSlideChangeEnd: function(){
	      // isload = false;
	    }
	  })
	  $(".navbar li").on('touchstart mousedown',function(e){
	    e.preventDefault();
	    $(".navbar .active").removeClass('active');
	    $(this).addClass('active');
	    tabsSwiper.slideTo( $(this).index() );

	  })
	  $(".tabs a").click(function(e){
	    e.preventDefault();
	  })
})
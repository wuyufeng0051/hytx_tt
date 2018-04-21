var snav_scrollTop = 0;
var Comiis_Touch_on = 1;
var Comiis_Touch_openleftnav = 0;
var Comiis_Touch_endtime = 0;
var snav_load_yes_on = 0;

$(function(){

  //获取天气预报
	$.ajax({
		url: "/include/ajax.php?service=siteConfig&action=getWeatherApi&day=1&skin=2",
		dataType: "json",
		success: function (data) {
			if(data && data.state == 100){
				$("#weather").append(data.info);
			}
		}
	});

$('.xx').change(function(){
	var t = $(this), val = t.val();
	$('.span').text(val);
})

	var mySwiper1 = new Swiper('#swiper-container1', {
			watchSlidesProgress: true,
			watchSlidesVisibility: true,
			slidesPerView: 7,
            onInit: function(swiper){
                $("#swiper-container1").addClass("isload")
            },
			onTap: function() {
				mySwiper2.slideTo(mySwiper1.clickedIndex)
			}
		})

	var myscroll_nav = new iScroll("navlist", {vScrollbar: false});
	$('.toggleBtn').click(function(){
      var a = $(this), header = $('#header').height(), swipernav = $('.swipernav'), swiper = swipernav.height() - 1, offset = swipernav.offset().top - $(window).scrollTop(), height = swiper + offset - 1;
      if(!a.hasClass('open')) {
				a.addClass('open');
				if (swipernav.hasClass('fixed')) {
					$('#navBox').css({'top':swiper, 'bottom':0});
				}else {
					$(window).scrollTop(header+2);
					$('#navBox').css({'top':swiper, 'bottom':0});
				}
					$('#navBox .bg').css({'height':'100%','opacity':1});
					myscroll_nav.refresh();
      }else {
				$('#navBox').css({'top':swiper, 'bottom':'200%'});
        a.removeClass('open');
				closeShearBox();
      }
  })



		$('#cancelNav').click(function(){
				closeShearBox();
		})

		// 导航更多
		$('#shearBg').click(function(){
				closeShearBox();
		})

		function closeShearBox(){
				$('.toggleBtn').removeClass('open');
				$('#navBox').css('top','-100%');
				$('#navBox .bg').css({'height':'0','opacity':0});
		}

		$(window).scroll(function(){
			var height = $('#header').height();
			var scroll = $(this).scrollTop();
			if (scroll > height) {
				$('.swipernav').addClass('fixed');
			}else {
				$('.swipernav').removeClass('fixed');
			}
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

    // 导航下拉


    // 频道导航
    setScrollPanel('.chanelList','','.item',8);

    var countDown = function(stime, etime, obj, func){
        sys_second = etime - stime;

        var timer = setInterval(function(){
            if (sys_second > 0) {
                sys_second -= 1;
                var hour = Math.floor((sys_second / 3600) % 24);
                var minute = Math.floor((sys_second / 60) % 60);
                var second = Math.floor(sys_second % 60);
                $(obj).find(".h").text(hour < 10 ? "0" + hour : hour);
                $(obj).find(".m").text(minute < 10 ? "0" + minute : minute);
                $(obj).find(".s").text(second < 10 ? "0" + second : second);
            } else {
                clearInterval(timer);
                // clearInterval(mtimer);
                typeof func === 'function' ? func() : "";
            }
        }, 1000);
    }
    function getTime(){
        $.ajax({
            url:masterDomain + '/include/ajax.php?service=system&action=getSysTime',
            type:'GET',
            dataType:'jsonp',
            success:function(data){
                if(data){
                    var now = data.now, nextHour = data.nextHour;
                    countDown(now, nextHour, '.mdqgdjs', function(){

                    })
                }
            }
        })
    }
    getTime();


    $('img').scrollLoading();


    // 美食外卖 优惠信息条数判断
    $('#waimaiList dl').each(function(){
        var d = $(this).find('dd'),
            yhn = d.children('.youhui').length;
        if(yhn > 2) {
            d.addClass('more');
        }
    })
    $('#waimaiList .toggle').click(function(e){
        e.preventDefault();
        $(this).closest('dd').toggleClass('open');
    })

    function setScrollPanel(objid,content,child,num,pages) {
        var obj = $(objid),
            content = content ? content : 'ul',
            item = obj.find(child),
            itemLen = item.length,
            pages = pages ? pages : '';

        item.each(function(i){
            item.slice(i*num,i*num+num).wrapAll('<li></li>');
            if(i == itemLen - 1) {
                obj.slider({
                    content:content,
                    autoScroll:false,
                    pagePar:pages
                })
            }
        })
    }

    var hovertime;
    $('dl>a , .loadMoreBtn ,.list>.item').on('touchstart',function(){
        var a = $(this);
        hovertime = setTimeout(function(){
            a.addClass('hover');
        },100)
    })
    $('dl>a ,.loadMoreBtn ,.list>.item').on('touchmove touchend touchcancel',function(){
        clearTimeout(hovertime);
        $(this).removeClass('hover');
    })



		$('#icon_user').click(function(){
			$('.loginbox').animate({'bottom':'0'}, 300);
			$('.loginbox .bg').show().css('opacity','.5');
			$('body').bind('touchmove', function(e){e.preventDefault()});
		});

		$('.loginbox .bg').click(function(){
			$('.loginbox').animate({'bottom':'-200%'}, 300);
			$('.loginbox .bg').css('opacity','0');
			setTimeout(function(){
				$('.loginbox .bg').hide();
			}, 300);
			$('body').unbind('touchmove');
		})










		// 登录注册弹出层
		$('.logintab li').click(function(){
			var t = $(this), index = t.index();
			t.addClass('curr').siblings('li').removeClass('curr');
			$('.typebox .form-box').hide().eq(index).show();
		});










		$('.leftBtn').click(function(){
			snav_leftnv();
		})

		var myscroll_side = new iScroll("sidenv_li", {vScrollbar: false});


		function snav_leftnv(){
			if(!$('.snav_body').hasClass('snav_showleftnv')){
				$('body').css({'height' : '100%','width' : '100%', 'overflow' : 'hidden'});
				$('body').bind('touchmove', function(e){event.preventDefault();})
				$('.snav_leftmenubg,.snav_sidenv_box').css({'display' : 'block'});
				snav_scrollTop = $(window).scrollTop();
				$('.snav_body').css({'height' : '100%', 'overflow' : 'hidden'});
				$('.snav_body').scrollTop(snav_scrollTop);
				$('.snav_body').removeClass('snav_hideleftnv').addClass("snav_showleftnv");
				$('.snav_sidenv_box').on('webkitTransitionEnd transitionend', function() {
					$(this).off('webkitTransitionEnd transitionend');
					$('.snav_leftmenubg').on("click", snav_leftnv);
				});
			}else{
				$('body').unbind('touchmove')
				$('.snav_leftmenubg').off("click", snav_leftnv);
				$('.snav_body').removeClass("snav_showleftnv").addClass('snav_hideleftnv').on('webkitTransitionEnd transitionend', function() {
					$('.snav_sidenv_box,.snav_leftmenubg').css({'display' : 'none'});
					$(this).off('webkitTransitionEnd transitionend').removeClass('snav_hideleftnv').css({'height' : '', 'overflow' : ''});
					$('body').css({'height' : '','width' : '', 'overflow' : ''});
					$(window).scrollTop(snav_scrollTop);
				});
			}
		}






})

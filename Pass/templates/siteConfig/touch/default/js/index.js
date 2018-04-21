
function transTimes(timestamp, n){
		update = new Date(timestamp*1000);//时间戳要乘1000
		year   = update.getFullYear();
		month  = (update.getMonth()+1<10)?('0'+(update.getMonth()+1)):(update.getMonth()+1);
		day    = (update.getDate()<10)?('0'+update.getDate()):(update.getDate());
		hour   = (update.getHours()<10)?('0'+update.getHours()):(update.getHours());
		minute = (update.getMinutes()<10)?('0'+update.getMinutes()):(update.getMinutes());
		second = (update.getSeconds()<10)?('0'+update.getSeconds()):(update.getSeconds());
		if(n == 1){
			return (year+'-'+month+'-'+day+' '+hour+':'+minute+':'+second);
		}else if(n == 2){
			return (year+'-'+month+'-'+day);
		}else if(n == 3){
			return (month+'-'+day);
		}else if(n == 4){
			return (hour+':'+minute);
		}else{
			return 0;
		}
	}

$(function(){

	var device = navigator.userAgent;
	var cookie = $.cookie("HN_float_hide");

	// 判断设备类型，ios全屏
	if (device.indexOf('huoniao_iOS') > -1) {
		$('body').addClass('huoniao_iOS');
		$('.header').addClass('padTop20');
	}

	//如果不是在客户端，显示下载链接
	if (device.indexOf('huoniao') <= -1 && cookie == null) {
		$('.float-download').show();
	}


	$('.float-download .closesd').click(function(){
		$('.float-download').hide();
		$('.header').css('top', '0');
		setCookie('HN_float_hide', '1', '1');
	})

	function setCookie(name, value, hours) { //设置cookie
     var d = new Date();
     d.setTime(d.getTime() + (hours * 60 * 60 * 1000));
     var expires = "expires=" + d.toUTCString();
     document.cookie = name + "=" + value + "; " + expires;
  }


	var loadMoreLock = false;

  // 幻灯片
  new Swiper('#slider', {pagination: '.pagination', slideClass: 'slideshow-item', paginationClickable: true, loop: true, autoplay: 2000, autoplayDisableOnInteraction : false});

  // 滑动导航
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

	var mySwiperNav = new Swiper('.mainNav',{pagination : '.swiper-pagination',})

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

			$("#tabs-container .swiper-slide").eq(tabsSwiper.activeIndex).css('height', 'auto').siblings('.swiper-slide').height($(window).height());

			// 当模块的数据为空的时候加载数据
			if($.trim($("#tabs-container .swiper-slide").eq(tabsSwiper.activeIndex).find(".content-slide").html()) == ""){
				$("#tabs-container .swiper-slide").eq(tabsSwiper.activeIndex).find('.content-slide').html('<div class="loading"><i class="icon-loading"></i>加载中...</div>')
				getList();
			}

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


  // 导航吸顶
	$(window).on("scroll", function(){
		var sct = $(window).scrollTop();
		if ($(window).scrollTop() > navHeight) {
			$('.navbar').addClass('fixed');
			if (device.indexOf('huoniao_iOS') > -1) {
				$('.navbar, .navblank').addClass('padTop20');
			}
		}else {
      $('.navbar').removeClass('fixed padTop20');
      $('.navblank').removeClass('padTop20');
			$('.gotop').hide();
		}

		if(sct + $(window).height() + 50 > $(document).height() && !loadMoreLock) {
        var page = parseInt($('.navbar .active').attr('data-page')),
            totalPage = parseInt($('.navbar .active').attr('data-totalPage'));
        if(page < totalPage) {
						++page;
						$('.navbar .active').attr('data-page', page);
						getList();
        }
    }



	});


  getList();


  // 异步获取列表
  function getList(){
    var active = $('.navbar .active'), action = active.attr('data-action'), url;
    var page = active.attr('data-page');

    if (action == "article") {
      url = masterDomain + "/include/ajax.php?service=article&action=alist&page=" + page + "&pageSize=10";
    }else if (action == "huodong") {
      url = masterDomain + "/include/ajax.php?service=huodong&action=hlist&page=" + page + "&pageSize=10";
    }else if (action == "tieba") {
      url = masterDomain + "/include/ajax.php?service=tieba&action=tlist&page=" + page + "&pageSize=10";
    }else if (action == "video") {
      url = masterDomain + "/include/ajax.php?service=video&action=alist&page=" + page + "&pageSize=10";
    }else if (action == "live") {
      // url = masterDomain + "/include/ajax.php?service=huodong&action=hlist&page=" + page + "&pageSize=10";
    }else{
      url = masterDomain + "/include/ajax.php?service=info&action=ilist&page=" + page + "&pageSize=10";
    }

		loadMoreLock = true;

    $.ajax({
      url: url,
      type: "GET",
      dataType: "jsonp",
      success: function(data){
        if (data && data.state != 200) {
          if (data.state == 101) {
						$('.loading').html('暂无数据！');
            // panel.children('.content').append("<p class='error'>"+data.info+"</p>");
          }else {
            var list = data.info.list, articleHtml = [], huodongHtml = [], tiebaHtml = [], videoHtml = [], liveHtml = [], infoHtml = [];
            var totalPage = data.info.pageInfo.totalPage;
						active.attr('data-totalPage', totalPage);
            for (var i = 0; i < list.length; i++) {
              // 资讯模块
              if (action == "article") {

                // 如果是图集
                if(list[i].group_img){
                  articleHtml.push('<div class="item imglist">');
                  articleHtml.push('<a href="' + list[i].url + '" class="clearfix">');
                  articleHtml.push('<div class="item-txt">');
                  articleHtml.push('<p class="item-tit">' + list[i].title + '</p>');
                  // articleHtml.push('<p class="item-des">' + list[i].description + '</p>');
                  articleHtml.push('<ul class="item-pics clearfix">');
                  var n = 0;
                  for (var g = 0; g < list[i].group_img.length; g++) {
                    var src = huoniao.changeFileSize(list[i].group_img[g].path, "small");
                    if(src && n < 3) {
                      articleHtml.push('<li><img src="' + src +'"></li>');
                      n++;
                      if(n == 3) break;
                    }
                  }
                  articleHtml.push('</ul>');
                  articleHtml.push('<ul class="item-info clearfix"><li class="time">' + returnHumanTime(list[i].pubdate,3) + '</li><li class="comment">' + list[i].common + '</li></ul>');
                  articleHtml.push('</div>');
                  articleHtml.push('</a>');
                  articleHtml.push('</div>');

                // 缩略图
                }else {
                  var litpic = list[i].litpic;
                  articleHtml.push('<div class="item">');
                  articleHtml.push('<a href="' + list[i].url + '" class="clearfix">');
                  if (litpic) {
                    articleHtml.push('<div class="item-img"><img src="' + list[i].litpic + '"></div>');
                  }
                  articleHtml.push('<div class="item-txt">');
                  if (litpic) {
	                  articleHtml.push('<p class="item-tit">' + list[i].title + '</p>');
									}else {
										articleHtml.push('<p class="item-tit mb0">' + list[i].title + '</p>');
									}
                  // articleHtml.push('<p class="item-des">' + list[i].description + '</p>');
                  articleHtml.push('<ul class="item-info clearfix"><li class="time">' + returnHumanTime(list[i].pubdate,3) + '</li><li class="comment">' + list[i].common + '</li></ul>');
                  articleHtml.push('</div>');
                  articleHtml.push('</a>');
                  articleHtml.push('</div>');
                }

              // 活动列表
              }else if (action == "huodong") {
                var userphoto = list[i].userphoto, feetype = list[i].feetype;
                huodongHtml.push('<div class="item">');
                huodongHtml.push('<a href="' + list[i].url + '" class="clearfix">');
                huodongHtml.push('<div class="item-user clearfix">');
                if (userphoto) {
                  huodongHtml.push('<img src="' + userphoto + '" alt="">');
                }else {
                  huodongHtml.push('<img src="' + templets + 'images/noavatar_middle.gif">');
                }
                huodongHtml.push('<span>' + list[i].username + '</span>');
                if (feetype == 1) {
                  huodongHtml.push('<em class="price">'+echoCurrency('symbol')+ list[i].mprice + '</em>');
                }else {
                  huodongHtml.push('<em>免费</em>');
                }
                huodongHtml.push('</div>');
                huodongHtml.push('<div class="item-img">');
                huodongHtml.push('<img src="' + list[i].litpic + '">');
                huodongHtml.push('<p>' + list[i].title + '</p>');
                huodongHtml.push('<i></i>');
                huodongHtml.push('</div>');
                huodongHtml.push('<div class="item-info clearfix">');
                huodongHtml.push('<span class="time">' + returnHumanTime(list[i].pubdate,3) + ' 开始</span>');
                huodongHtml.push('<span class="addr">' + list[i].addrname[0] + '</span>');
                huodongHtml.push('</div>');
                huodongHtml.push('</a>');
                huodongHtml.push('</div>');

              // 贴吧列表
              }else if (action == "tieba") {
                var group = list[i].imgGroup, username = list[i].username;
                tiebaHtml.push('<div class="item">');
                tiebaHtml.push('<a href="' + list[i].url + '" class="clearfix">');
                tiebaHtml.push('<div class="item-user clearfix">');
								if (list[i].photo == "") {
	                tiebaHtml.push('<img src="' + templets + 'images/noavatar_middle.gif">');
								}else{
									tiebaHtml.push('<img src="' + list[i].photo + '">');
								}
                // 有没有名字
                if (username != "") {
                  tiebaHtml.push('<span>' + username + '</span>');
                }else {
                  tiebaHtml.push('<span>匿名</span>');
                }
                tiebaHtml.push('<em class="biaoqian">' + list[i].typename[0] + '</em>');
                tiebaHtml.push('</div>');
                if (list[i].content != "") {
                  tiebaHtml.push('<div class="item-txt">' + list[i].content + '</div>');
                }

                //图集
  							if(group.length > 0){
                  if (group.length == 1) {
                    tiebaHtml.push('<div class="item-img"><img src="' + group[0] + '" alt=""></div>');
                  }else {
                    tiebaHtml.push('<div class="item-pics clearfix">')
    								if(group.length > 3){
    									tiebaHtml.push('<span class="total">共 '+group.length+' 张</span>');
    								}
    								for(var g = 0; g < group.length; g++){
    									if(g < 3){
    										tiebaHtml.push('<img src="' + group[g] + '" alt="">');
    									}
    								}
                    tiebaHtml.push('</div>');
                  }
  							}

                // tiebaHtml.push('<div class="item-comment">行走的美好  评论：是的，你冲她发牢骚,你大声顶撞她甚至当着她的面摔碗，她都不会记恨你，原因很简单，因为她是你的母亲.....</div>');
                tiebaHtml.push('<div class="item-info">');
                tiebaHtml.push('<span class="time">' + transTimes(list[i].pubdate, 4) + '</span>');
                tiebaHtml.push('<span class="comment">' + list[i].reply + '</span>');
                tiebaHtml.push('<span class="click">' + list[i].click + '</span>');
                tiebaHtml.push('</div>');
                tiebaHtml.push('</a>');
                tiebaHtml.push('</div>');

              // 视频
              }else if (action == "video") {
                videoHtml.push('<div class="item">');
                videoHtml.push('<a href="' + list[i].url + '">');
                videoHtml.push('<p class="item-tit">' + list[i].title + '</p>');
                videoHtml.push('<div class="item-thumb">');
                videoHtml.push('<img src="' + list[i].litpic + '">');
                videoHtml.push('<i class="video-bg"></i>');
                // videoHtml.push('<em class="video-time"><s></s>01:40</em>');
                videoHtml.push('</div>');
                videoHtml.push('<div class="item-info clearfix">');
                // videoHtml.push('<div class="item-user clearfix"><img src="http://ios.woaisezhan.com/uploads/siteConfig/photo/large/2017/03/23/98461490263301.png" alt="">叶落纷飞</div>');
                videoHtml.push('<div class="item-click">' + list[i].click + '次播放</div>');
                videoHtml.push('<div class="item-comment">' + list[i].common + '</div>');
                // videoHtml.push('<div class="item-share">2.1万</div>');
                videoHtml.push('</div>');
                videoHtml.push('</a>');
                videoHtml.push('</div>');

              // 直播
              }else if (action == "live") {

              // 二手
              }else {
                var username = list[i].member.nickname, userphoto = list[i].member.photo;
                infoHtml.push('<div class="item">');
                infoHtml.push('<a href="' + list[i].url + '">');
                infoHtml.push('<div class="item-user clearfix">');
                if (userphoto == null) {
                  infoHtml.push('<div class="item-img"><img src="' + templets + 'images/noavatar_middle.gif"></div>');
                }else {
                  infoHtml.push('<div class="item-img"><img src="' + userphoto + '"></div>');
                }
                if (username) {
                  infoHtml.push('<div class="item-name"><p>' + username + '</p>');
                }else {
                  infoHtml.push('<div class="item-name"><p>匿名</p>');
                }
                infoHtml.push('<p class="item-local">3分钟前来过</p></div>');
                // infoHtml.push('<div class="item-tag">￥<em>1350.00</em></div>');
                infoHtml.push('</div>');
                infoHtml.push('<div class="item-img"><img src="' + list[i].litpic + '"></div>');
                infoHtml.push('<p class="item-info">' + list[i].title + '</p>');
                // infoHtml.push('<div class="item-msg">');
                // infoHtml.push('<p>主人回复：对的</p>');
                // infoHtml.push('<p>余新梅：看得出来质量很好，九成新对吧？</p>');
                // infoHtml.push('</div>');
                infoHtml.push('</a>');
                infoHtml.push('<div class="item-zan">');
                // infoHtml.push('<ul class="clearfix">');
                // infoHtml.push('<li><img src="http://ios.woaisezhan.com/uploads/siteConfig/photo/large/2016/03/09/14575161626732.jpg" alt=""></li>');
                // infoHtml.push('<li><img src="http://ios.woaisezhan.com/uploads/siteConfig/photo/large/2016/03/14/14579138068133.jpg" alt=""></li>');
								// infoHtml.push('<li><img src="http://ios.woaisezhan.com/uploads/siteConfig/photo/large/2016/03/09/14575162725879.jpg" alt=""></li>');
								// infoHtml.push('<li><img src="http://ios.woaisezhan.com/uploads/siteConfig/photo/large/2016/03/13/14578720665088.jpg" alt=""></li>');
								// infoHtml.push('<li><img src="http://ios.woaisezhan.com/uploads/siteConfig/photo/large/2016/03/09/14575161626732.jpg" alt=""></li>');
								// infoHtml.push('<li><img src="http://ios.woaisezhan.com/uploads/siteConfig/photo/large/2016/03/14/14579138068133.jpg" alt=""></li>');
								// infoHtml.push('<li><img src="http://ios.woaisezhan.com/uploads/siteConfig/photo/large/2016/03/09/14575162725879.jpg" alt=""></li>');
								// infoHtml.push('<li><img src="http://ios.woaisezhan.com/uploads/siteConfig/photo/large/2016/03/13/14578720665088.jpg" alt=""></li>');
								// infoHtml.push('<li class="more"><img src="' + templets + 'images/more_icon.png" alt=""></li>');
                // infoHtml.push('</ul>');
                infoHtml.push('<p class="clearfix"><span class="from">来自' + list[i].address + '</span></p>');
                // infoHtml.push('<span class="zan">102</span>');
                infoHtml.push('</div>');
                infoHtml.push('</div>');
              }
            }
						$('.loading').remove();
            $('.article').append(articleHtml.join(""));
            $('.huodong').append(huodongHtml.join(""));
            $('.tieba').append(tiebaHtml.join(""));
            $('.video').append(videoHtml.join(""));
            $('.info').append(infoHtml.join(""));


          }
        }
				loadMoreLock = false;

      }
    })



  }


	// 上滑下滑导航隐藏
	var upflag = 1, downflag = 1, fixFooter = $(".fixFooter, .navbar");
	//scroll滑动,上滑和下滑只执行一次！
	scrollDirect(function (direction) {
		var dom = $('.navbar').hasClass('fixed');
		if (direction == "down" && dom) {
			if (downflag) {
				fixFooter.hide();
				$('.gotop').hide();
				downflag = 0;
				upflag = 1;
			}
		}
		if (direction == "up") {
			if (upflag) {
				fixFooter.show();
				$('.gotop').show();
				downflag = 1;
				upflag = 0;
			}
		}
	});

	// 回到顶部
	$('.gotop').click(function(){
		$(window).scrollTop(navHeight + 2);
	})


})

var	scrollDirect = function (fn) {
  var beforeScrollTop = document.body.scrollTop;
  fn = fn || function () {
  };
  window.addEventListener("scroll", function (event) {
      event = event || window.event;

      var afterScrollTop = document.body.scrollTop;
      delta = afterScrollTop - beforeScrollTop;
      beforeScrollTop = afterScrollTop;

      var scrollTop = $(this).scrollTop();
      var scrollHeight = $(document).height();
      var windowHeight = $(this).height();
      if (scrollTop + windowHeight > scrollHeight - 10) {
          return;
      }
      if (afterScrollTop < 10 || afterScrollTop > $(document.body).height - 10) {
          fn('up');
      } else {
          if (Math.abs(delta) < 10) {
              return false;
          }
          fn(delta > 0 ? "down" : "up");
      }
  }, false);
}

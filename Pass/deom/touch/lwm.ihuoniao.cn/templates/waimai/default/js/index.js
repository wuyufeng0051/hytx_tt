$(function(){
  // banna轮播图
	var mySwiper1 = new Swiper('.swiper-container1', {pagination: '.pagination', slideClass: 'slideshow-item', paginationClickable: true, loop: true, autoplay: 5000});
  new Swiper('.swiper-container3', {pagination: '.pagination', slideClass: 'slideshow-item', paginationClickable: true, loop: true, autoplay: 5000});

  // 滑动导航
  if ($('.swiper-container2 .nav li').length > 8) {
    var mySwiper2 = new Swiper('.swiper-container2',{pagination : '.swiper-pagination',});
  }

  var chooseTab = $('.choose-tab');
  // 点击筛选
  $('.choose-tab li').click(function() {
    var thisli = $(this)
    var index = $(this).index();
    if ($('.choose-slide').eq(index).css("display") == "none") {
      $(this).addClass('active').siblings().removeClass('active');
      $('.mask,.white').show();
      $('.choose-slide').eq(index).show().siblings().hide();
      chooseTab.addClass('fixed');
    } else {
      $('.mask,.choose-slide,.white').hide();
      $('.choose-tab li').removeClass('active');
      chooseTab.removeClass('fixed');
    }
  })

  // 点击遮罩层
  $('.mask').on('click', function() {
    clickMask();
  })
  $('.mask').on('touchmove', function() {
    clickMask();
  })

  // 隐藏遮罩层
  function clickMask(){
    $('.mask').hide();
    chooseTab.removeClass('fixed');
    $('.mask,.choose-slide,.white').hide();
    $('.choose-tab li').removeClass('active');
  }

  // 筛选条件
  $('.choose-slide li').click(function(){
    var t = $(this), ul = t.closest('ul'), operate = ul.attr('data-type'), id = t.attr('data-id');
    t.addClass('active').siblings().removeClass('active');
    var val = $(this).find('a').text();
    $('.tab-'+operate+' span').text(val);
    clickMask();
    page = 1;
    getList();
  })

  var myscroll1 = myscroll2 = myscroll3 = null;
  $('.tab-typeid').click(function() {
    if(myscroll1 == null){
      myscroll1 = new iScroll("choose-classify", {vScrollbar: false});
    }
  })
  $('.tab-orderby').click(function(){
    if(myscroll2 == null){
      myscroll2 = new iScroll("choose-sort", {vScrollbar: false});
    }
  })
  $('.tab-yingye').click(function(){
    if(myscroll3 == null){
      myscroll3 = new iScroll("choose-screen", {vScrollbar: false});
    }
  })


  var hallList = $(".near-box"), atpage = 1, pageSize = 20, listArr = [], totalPage = 0, isload = false;
  function getList(){

    typeid = $("#choose-classify .active").data("id");
    orderby = $("#choose-sort .active").data("id");
    yingye = $("#choose-screen .active").data("id");

    isload = true;

		if(page == 1){
			$('.near-box').html('<div class="loading">加载中...</div>');
		}else{
			$('.near-box').append('<div class="loading">加载中...</div>');
		}

        $.ajax({
            url: '/include/ajax.php?service=waimai&action=shopList',
            data: {
                typeid: typeid,
                orderby: orderby,
                yingye: yingye,
                lng: lng,
                lat: lat,
                page: page,
                pageSize: pageSize
            },
            type: 'get',
            dataType: 'json',
            success: function(data){

                if(data.state == 100){
                    var list = [];
                    $('.near-box .loading').remove();

                    if(data.info.pageInfo.totalPage == page){
                        if(page == 1){
                            $('.near-box').html('<div class="loading">暂无相关数据！</div>');
                        }
                        return false;
                    }

                    var info = data.info.list;
                    for(var i = 0; i < info.length; i++){
                        var d = info[i];
                        list.push('<div class="near-list"><a href="'+d.url+'">');

                        var xx = '';


												list.push('<div class="near-list-img"><img src="'+d.pic+'" alt="'+d.shopname+'" onerror="this.src=\'/static/images/shop.png\'"></div>');
												list.push('<div class="near-list-txt"><h1 class="fn-clear"><span class="fn-left">'+d.shopname+'</span><em class="dist fn-right">'+d.juli+'</em></h1>');
												list.push('<div class="judge-box fn-clear">');
												if(d.yingye != 1){
                          list.push('<span class="xiuxi l">休息中</span>');
                        }else {
													list.push('<span class="sale-num fn-left">已售14单</span>');
                          if(d.delivery_service){
                            list.push('<b class="fn-right sale-song">'+d.delivery_service+'</b>');
                          }
                        }
												list.push('</div>');

                        list.push('<div class="starting-price"><span>起送价￥'+d.basicprice+'</span><em>|</em><span>配送费￥'+d.delivery_fee+'</span></div>');

                        if(d.is_first_discount == '1'){
                            list.push('<p class="gray"><i class="shou">首</i><span>新用户立减'+d.first_discount+'元</span></p>');
                        }
                        if(d.is_discount == '1'){
                          list.push('<p class="gray"><i class="zhe">折</i>可享受全店'+d.discount_value+'折</p>');
                        }
                        if(d.open_promotion == '1'){
                          list.push('<p class="gray"><i class="sale">减</i><span>');
                          for(var o = 0; o < d.promotions.length; o++){
                              if(d.promotions[o][0] && d.promotions[o][1]){
                                  list.push('满'+d.promotions[o][0]+'元减'+d.promotions[o][1]+'元；');
                              }
                          }
                          list.push('</span></p>');
                        }


                        if(d.description){
                            list.push('<p class="gray"><i class="te">特</i>可享受全店'+d.description+'折</p>');
                        }

                        list.push('</div>');
                        list.push('</a></div>');
                    }

                    if(page == 1){
                			$('.near-box').html(list.join(''));
                		}else{
                			$('.near-box').append(list.join(''));
                		}

                    isload = false;
                    page++;

                }else{
                    $('.near-box .loading').html(data.info);
                }

            },
            error: function(){
                $('.near-box .loading').html('网络错误，加载失败！');
            }
        })

	}



  var navHeight = chooseTab.offset().top;
  //滚动加载
  $(window).on("scroll", function(){
    var scrollTop = $(window).scrollTop(),
        allh = $('body').height(),
        w = $(window).height(),
        scroll = allh - w - 300;
    if (scrollTop > scroll && !isload) {
      atpage++;
      getList();
    };
    if (scrollTop > navHeight) {
      chooseTab.addClass('fixed');
    }else {
      chooseTab.removeClass('fixed');
    }
  });

  // 定位

var localData = utils.getStorage('waimai_local');
  if(localData){
    lat = localData.lat;
    lng = localData.lng;
    $('.header-address em').html(localData.address);

    getList();
  }else{
    var geolocation = new BMap.Geolocation();
      geolocation.getCurrentPosition(function(r){
        if(this.getStatus() == BMAP_STATUS_SUCCESS){
            lat = r.point.lat;
            lng = r.point.lng;

            var myGeo = new BMap.Geocoder();
            myGeo.getLocation(r.point, function mCallback(rs){
    	        var allPois = rs.surroundingPois;
    	        if(allPois == null || allPois == ""){
                    $('.header-address em').html('定位失败');
    	            return;
    	        }
                utils.setStorage('waimai_local', JSON.stringify({'lng': lng, 'lat': lat, 'address': allPois[0].title}));
                $('.header-address em').html(allPois[0].title);
    	    }, {
    	        poiRadius: 1000,  //半径一公里
    	        numPois: 1
    	    });

            getList();

        }else {
          alert('failed'+this.getStatus());
        }
      },{enableHighAccuracy: true})
  }





})

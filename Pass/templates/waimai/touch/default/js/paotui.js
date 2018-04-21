$(function(){
  // 清除cookie
  $.cookie(cookiePre+'paotui_shop', null);
  $.cookie(cookiePre+'paotui_buyfrom', null);
  $.cookie(cookiePre+'paotui_buyaddress', null);
  $.cookie(cookiePre+'paotui_buyaddress_lng', null);
  $.cookie(cookiePre+'paotui_buyaddress_lat', null);
  // banna轮播图
	var mySwiper1 = new Swiper('.swiper-container1', {pagination: '.pagination', slideClass: 'slideshow-item', paginationClickable: true, loop: true,});
  new Swiper('.swiper-container3', {pagination: '.pagination', slideClass: 'slideshow-item', paginationClickable: true, loop: true,});

  var activeIndex = 0;
  // tab切换
  var tabsSwiper = new Swiper('#tabs-container',{
    speed:500,
    autoHeight: true,
    onSlideChangeStart: function(){
      activeIndex = tabsSwiper.activeIndex;
      $(".tabs a").eq(activeIndex).addClass('active').siblings().removeClass('active');
    },
    onSliderMove: function(){
    },
    onSlideChangeEnd: function(){
    }
  })
  $(".tabs a").on('touchstart mousedown',function(e){
    e.preventDefault();
    $(".tabs .active").removeClass('active')
    $(this).addClass('active')
    tabsSwiper.slideTo( $(this).index() )
  })
  $(".tabs a").click(function(e){
    e.preventDefault()
  })

  //下拉菜单
  $('.demo-test-select').scroller(
    $.extend({preset: 'select'})
  );

  // 帮我买 自定义商品
  $(".buy .submit").click(function(){
    $(this).parent().submit();
  })

  // 帮我送 选择分类
  $("#shoptype2 li").click(function(){
    var t = $(this);
    t.addClass("active").siblings().removeClass("active");
  })


  // 帮我送
  $("#submit2").click(function(){
    var t = $(this);
    if(t.hasClass("disabled")) return;

    var type = $("#shoptype2 li.active").attr("data-type");
    $("#song_shop").val(type);
    // $(".songFrom").submit();
    var data = [];
    data.push("shop="+type);
    data.push("weight="+$("#weight").val());
    data.push("price="+$("#price").val());

    var url = t.attr("data-url");
    url = url.replace("#shop", $("#shoptype2 li.active").attr('data-type')).replace("#weight", $("#weight").val()).replace("#price", $("#price").val());
    t.attr("href", url);

  })

  function getLastOrder(){
    $.ajax({
      url: '/include/ajax.php?service=waimai&action=paotuiOrder&u=1&state=1',
      type: 'get',
      dataType: 'json',
      success: function(data){
        if(data && data.state == 100){
          var list = data.info.list, html = [];
          if(list.length > 0){
            for(var i = 0; i < list.length; i++){
              var obj = list[i];

              html.push('<div class="swiper-slide"><span>'+langData['waimai'][2][108]+'</span><em>'+obj.time+langData['siteConfig'][22][93]+'</em><font>'+obj.username+langData['waimai'][2][109]+obj.shop+'</font></div>');
            }

            $(".swiper-container3").html('<div class="swiper-wrapper">'+html.join("")+'</div>');
            new Swiper('.swiper-container3', {
              direction : 'vertical',
              loop: true,
              autoplay : 2000
            });
          }
        }
      }
    })
  }
  getLastOrder();


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


  // 定位

/*var localData = utils.getStorage('waimai_local');
  if(localData){
    lat = localData.lat;
    lng = localData.lng;
    $('.header-address em').html(localData.address);

  }else{
    var geolocation = new BMap.Geolocation();
      geolocation.getCurrentPosition(function(r){
        if(this.getStatus() == BMAP_STATUS_SUCCESS){
          lat = r.point.lat;
          lng = r.point.lng;

        var geoc = new BMap.Geocoder();
        geoc.getLocation(r.point, function(rs){
          var rs = rs.addressComponents;
          $('.header-address em').html(rs.district + rs.street + rs.streetNumber)
        });

        }
        else {
          alert('failed'+this.getStatus());
        }
      },{enableHighAccuracy: true})
  }
*/




})

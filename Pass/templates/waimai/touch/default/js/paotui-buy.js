$(function(){

  $("#tip").prop("checked", false);

  var totalPrice = 5;

  // 选择商品
  var shop = $("#shop");
  $(".fastchose a").click(function(){
    var t = $(this), val = t.text().replace("+",""), last = shop.val();
    var now = last == "" ? val : (last + ' ' + val);
    if(now.length > 100){
      alert(langData['waimai'][3][86]);
    }else{
      shop.val(now);

      init.set('shop', now);
    }

  })

  shop.on("input propertychange",function(){
    var val = shop.val();
    if(val.length > 100){
      val = val.substr(0, 100);
      shop.val(val);
      alert(langData['waimai'][3][86]);
    }

    init.set('shop', val);
  })


  // 切换购买方式
  $(".buyfrom label").click(function(){
    var t = $(this), index = t.index();
    if(t.hasClass("checked")) return;

    init.set('buyfrom', index);

    t.addClass("checked").siblings().removeClass("checked");
    if(index == 1){
      $(".buyfrom1").removeClass('show');
    }else{
      $(".buyfrom1").addClass('show');
    }

  })

  // 指定地址
  $("#buyaddress").on("keyup",function(){
    var val = $.trim($(this).val());
    init.set('buyaddress', val);
    if(val){
      getPoint(val, function(pos){
        if(pos){
          $('#buylat').val(pos.lat);
          $('#buylng').val(pos.lng);
        }else{
          $('#buylat').val(0);
          $('#buylng').val(0);
        }
      })
    }else{
      $('#buylat').val(0);
      $('#buylng').val(0);
    }
  })

  $("#price").on("input propertychange",function(){
    init.set('price', $(this).val());
  })

  // 小费
  $(".tip label").click(function(){
    var t = $(this), inp = t.children("input");
    if(inp.is(":checked")){
      t.addClass("open");
      $(".tipc").show();
      init.set('tipswitch', '1');
    }else{
      t.removeClass("open");
      $(".tipc").hide();
      init.set('tipswitch', '0');
    }
    getMoney();
  })

  // 切换小费金额
  $(".tipc .set a").click(function(){
    var t = $(this), tip = t.attr("data-tip");
    if(tip == "0"){
      $(".tipc .inp").show();
      if($(".tipc .inp").children("input").val() == ''){
        $(".tipc .inp").children("input").focus();
        init.set('tip', '0');
      }
    }else{
      $(".tipc .inp").hide();
      init.set('tip', tip);
    }
    t.addClass("curr").siblings().removeClass("curr");
    getMoney();
  })

  $("#tipcur").keyup(function(){
    init.set('tip', $(this).val());
    getMoney();
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


  // 计算费用
  function getMoney(){
    totalPrice = 5;
    var tip = 0;
    if($("#tip").is(":checked")){
      var tip_ = $(".tipc a.curr").attr("data-tip");
      if(tip_ == 0){
        tip_ = $("#tipcur").val();
        if(tip_ == '' || tip_ == 0){
          tip = 0;
        }else{
          tip = tip_ ;
        }
      }else{
        tip = tip_;
      }
    }

    totalPrice += parseInt(tip);
    $(".money2").html(echoCurrency("symbol")+totalPrice.toFixed(2));

    if($(".paytype label.checked").attr("data-type") == "money"){
      $('.paypassword').addClass('show');
      if(myMoney < totalPrice){
        $(".paytype").next(".info").html(langData['waimai'][3][87]+echoCurrency("symbol")+myMoney+'，'+langData['waimai'][3][88]+'<a href="'+depositUrl+'">'+langData['waimai'][2][107]+'</a>');
        return;
      }else{
        $(".paytype").next(".info").html("");
        setTimeout(function(){
          $(window).scrollTop(9999);
        },300)
      }
    }else{
      $(".paytype").next(".info").html("");
      $('.paypassword').removeClass('show');
    }

  }

  // 提交订单
  $(".pay").click(function(){
    if(yingyeState == -1){
      alert(langData['waimai'][3][60]+begantime+"-"+endtime);
      return;
    }
    var t = $(this);
    if(t.hasClass("disabled")) return;
    var addr = $(".buyfrom1");
    var buyfrom = $(".buyfrom .checked").index(),
        buyaddress = $.trim($("#buyaddress").val()),
        address = myaddress,
        shopdes = $.trim(shop.val()),
        price = $("#price").val(),
        hastip = $("#tip").is(":checked") ? 1 : 0,
        tip = 0,
        buylng = $('#buylng').val(),
        buylat = $('#buylat').val();

    if(shopdes == ''){
      alert(langData['waimai'][3][89]);
      return;
    }

    if(buyfrom == 0){
      if(buyaddress == ''){
        alert(langData['waimai'][3][90]);
        return;
      }
    }else{
      buyaddress = langData['siteConfig'][17][19];
    }

    if(!myaddress){
      alert(langData['waimai'][3][91]);
      return;
    }

    if(hastip){
      var tip_ = $(".tipc a.curr").attr("data-tip");
      if(tip_ == 0){
        tip_ = $("#tipcur").val();
        if(tip_ == '' || tip_ == 0){
          tip = 0;
          hastip = 0 ;
        }else{
          tip = tip_ ;
        }
      }else{
        tip = tip_;
      }
    }

    var data = [];
    data.push("type=1");
    data.push("shop="+shopdes);
    data.push("buyfrom="+buyfrom);
    data.push("buyaddress="+buyaddress);
    data.push("buylng="+buylng);
    data.push("buylat="+buylat);

    data.push("address="+address);
    data.push("price="+price);
    data.push("hastip="+hastip);
    data.push("tip="+tip);

    t.addClass("disabled").text(langData['siteConfig'][6][35]);

    $.ajax({
      url: '/include/ajax.php?service=waimai&action=paotuiDeal',
      data: data.join("&"),
      type: 'post',
      dataType: 'json',
      success: function(data){
        if(data && data.state == 100){
          // 清除页面数据
          shoptype = '-';
          init.get();
          location.href = payUrl.replace("#ordernum", data.info);
        }else{
          alert(data.info);
          t.removeClass("disabled").text(langData['waimai'][2][40]);
        }
      },
      error: function(){
        alert(langData['siteConfig'][20][183]);
        t.removeClass("disabled").text(langData['waimai'][2][40]);
      }

    })



  })

//   var map = new BMap.Map("container");
//   var localSearch = new BMap.LocalSearch(map);
//   function getPoint(keyword, callback){
// 　　localSearch.setSearchCompleteCallback(function (searchResult) {
// 　　　var poi = searchResult.getPoi(0);
//       callback(poi ? poi.point : '');
//       // callback(poi);
// 　　});
//     if(keyword.indexOf(district) == -1){
//       keyword = district + keyword;
//     }
// 　　localSearch.search(keyword);
//   }

  // 定位
  // function getLocation(){
  //   if(city || district){
  //     var geolocation = new BMap.Geolocation();
  //     geolocation.getCurrentPosition(function(r){
  //       if(this.getStatus() == BMAP_STATUS_SUCCESS){
  //           lat = r.point.lat;
  //           lng = r.point.lng;
  //
  //
  //           var myGeo = new BMap.Geocoder();
  //             myGeo.getLocation(r.point, function mCallback(rs){
  //               var allPois = rs.surroundingPois;
  //               if(allPois == null || allPois == ""){
  //                 $(".pay").removeClass("disabled");
  //                 // console.log('定位失败');
  //                 return;
  //               }
  //
  //               var address = rs.addressComponents;
  //
  //               if(city != address.city || district != address.district){
  //                 alert('抱歉，您当前所在位置无法下单');
  //               }else{
  //                 $(".pay").removeClass("disabled");
  //               }
  //
  //           }, {
  //               poiRadius: 1000,  //半径一公里
  //               numPois: 1
  //           });
  //
  //       }else {
  //         console.log('failed'+this.getStatus());
  //       }
  //     },{enableHighAccuracy: true})
  //   }else{
  //     $(".pay").removeClass("disabled");
  //   }
  //
  // }
  //
  // getLocation();

  init.get();
  getMoney();

})

var init = {
  get: function(){
    var typeList = ['shop','buyfrom','buyaddress','price','tipswitch','tip','paytype','paypwd'];

    var lastshop = utils.getStorage('paotui_buy_lastshop');
    this.set('lastshop', shoptype);

    if(lastshop && lastshop != shoptype){
      for(var i = 0; i < typeList.length; i++){
        utils.removeStorage('paotui_buy_'+typeList[i]);
      }
      return;
    }

    for(var i = 0; i < typeList.length; i++){
      var type = typeList[i];
      var storage = utils.getStorage('paotui_buy_'+type);

      if(type == 'shop' && storage){
        $("#shop").html(storage);
      }

      if(type == 'buyfrom' && storage == '1'){
        $('.buyfrom label').eq(storage).click();
      }

      if(type == 'buyaddress' && storage){
        $("#buyaddress").val(storage).keyup();
      }

      if(type == 'price' && storage){
        $("#price").val(storage);
      }

      if(type == 'tipswitch' && storage == '1'){
        $(".tip label").click();
      }

      if(type == 'tip' && storage){
        var tipObj = $(".tipc .set a[data-tip='"+storage+"']");
        if(tipObj.length == 0){
          $("#tipcur").val(storage);
          $(".tipc .set a:last-child").click();
        }else{
          tipObj.click();
        }
      }

      if(type == 'paytype' && storage){
        $("#paytype label[data-type='"+storage+"']").click();
      }

      if(type == 'paypwd' && storage){
        $(".paypwd").val(storage);
      }

    }
  },
  set: function(type, value){
    utils.setStorage('paotui_buy_'+type, JSON.stringify(value));
  }
}

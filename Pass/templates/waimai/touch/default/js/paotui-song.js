$(function(){
  //验证是否在客户端访问
  setTimeout(function(){
    if(appInfo.device == ""){
    }else{
      payUrl = payUrl.replace('app=', 'app=1');
    }
  }, 500);
  $("#tip").prop("checked", false);

  var totalPrice = 5;

  //年月日
  $('.demo-test-date').scroller(
    $.extend({preset: 'datetime', stepMinute: 10, dateFormat: 'yyyy-mm-dd'})
  );

  //下拉菜单
  $('.demo-test-select').scroller(
    $.extend({preset: 'select'})
  );


  $("#faaddress").bind("keyup", function(){
    var val = $.trim($(this).val());
    init.set('faaddress', val);
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

  $("#shouaddress").bind("keyup", function(){
    var val = $.trim($(this).val());
    init.set('shouaddress', val);
    if(val){
      getPoint(val, function(pos){
        if(pos){
          $('#lat').val(pos.lat);
          $('#lng').val(pos.lng);
        }else{
          $('#lat').val(0);
          $('#lng').val(0);
        }
      })
    }else{
      $('#lat').val(0);
      $('#lng').val(0);
    }
  })

  $("#gettime").bind("change",function(){
    init.set('gettime', $(this).val());
  })

  // 切换支付方式
  $(".paytype label").click(function(){
    var t = $(this);
    t.addClass("checked").siblings().removeClass("checked");
    init.set('paytype', t.attr('data-type'));
    getMoney();
  })

  // 小费
  $(".tip label").click(function(){
    var t = $(this), inp = t.children("input");
    if(inp.is(":checked")){
      t.addClass("open");
      $(".tipc").show();
    }else{
      t.removeClass("open");
      $(".tipc").hide();
    }
    getMoney();
  })

  // 切换小费金额
  $(".tipc .set a").click(function(){
    var t = $(this), tip = t.attr("data-tip");
    if(tip == "0"){
      $(".tipc .inp").show().children("input").focus();
    }else{
      $(".tipc .inp").hide();
    }
    t.addClass("curr").siblings().removeClass("curr");
    getMoney();
  })

  $("#tipcur").keyup(function(){
    getMoney();
  })

  $("#note").keyup(function(){
    init.set('note', $(this).val());
  })

  // 支付密码
  $(".paypwd").keyup(function(){
    init.set('paypwd', $(this).val());
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

  $(".pay").click(function(){

    if(yingyeState == -1){
      alert(langData['waimai'][3][60]+begantime+"-"+endtime);
      return;
    }
    var t = $(this);
    if(t.hasClass("disabled")) return;

    var faaddress = $.trim($("#faaddress").val()),
        shouaddress = $.trim($("#shouaddress").val()),
        gettime = $("#gettime").val(),
        note = $("#note").val(),
        hastip = $("#tip").is(":checked") ? 1 : 0,
        tip = 0,
        buylng = $('#buylng').val(),
        buylat = $('#buylat').val(),
        lng = $('#lng').val(),
        lat = $('#lat').val();

    if(faaddress == ''){
      alert(langData['waimai'][3][92]);
      return;
    }
    if(shouaddress == ''){
      alert(langData['waimai'][3][93]);
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
    data.push("type=2");
    data.push("shop="+shoptype);
    data.push("weight="+weight);
    data.push("price="+price);
    data.push("faaddress="+faaddress);
    data.push("shouaddress="+shouaddress);
    data.push("buylng="+buylng);
    data.push("buylat="+buylat);
    data.push("lng="+lng);
    data.push("lat="+lat);
    data.push("gettime="+gettime);
    data.push("hastip="+hastip);
    data.push("tip="+tip);
    data.push("note="+note);

    t.addClass("disabled").text(langData['siteConfig'][6][35]);

    $.ajax({
      url: '/include/ajax.php?service=waimai&action=paotuiDeal',
      data: data.join("&"),
      type: 'post',
      dataType: 'json',
      success: function(data){
        if(data && data.state == 100){
          // t.removeClass("disabled").text("去支付");
          // 清除页面数据
          shoptype = '-';
          init.get();
          location.href = payUrl.replace("#ordernum", data.info);
        }else{
          alert(data.info);
          t.removeClass("disabled").text(langData['siteConfig'][19][665]);
        }
      },
      error: function(){
        alert(langData['siteConfig'][20][183]);
        t.removeClass("disabled").text(langData['siteConfig'][19][665]);
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
  function getLocation(){
    if(city || district){
      var geolocation = new BMap.Geolocation();
      geolocation.getCurrentPosition(function(r){
        if(this.getStatus() == BMAP_STATUS_SUCCESS){
            lat = r.point.lat;
            lng = r.point.lng;

            var myGeo = new BMap.Geocoder();
              myGeo.getLocation(r.point, function mCallback(rs){
                var allPois = rs.surroundingPois;
                if(allPois == null || allPois == ""){
                  $(".pay").removeClass("disabled");
                  return;
                }

                var address = rs.addressComponents;

                if(city != address.city || district != address.district){
                  alert(langData['waimai'][3][94]);
                }else{
                  $(".pay").removeClass("disabled")
                }

            }, {
                poiRadius: 1000,  //半径一公里
                numPois: 1
            });

        }else {
          console.log('failed'+this.getStatus());
        }
      },{enableHighAccuracy: true})
    }else{
      $(".pay").removeClass("disabled");
    }

  }

  getLocation();

  init.get();
  getMoney();


})


var init = {
  get: function(){
    var typeList = ['faaddress','shouaddress','gettime','tipswitch','tip','note','paytype','paypwd'];

    var lastshop = utils.getStorage('paotui_song_lastshop');
    this.set('lastshop', shoptype);

    if(lastshop && lastshop != shoptype){
      for(var i = 0; i < typeList.length; i++){
        utils.removeStorage('paotui_song_'+typeList[i]);
      }
      return;
    }

    for(var i = 0; i < typeList.length; i++){
      var type = typeList[i];
      var storage = utils.getStorage('paotui_song_'+type);

      // console.log(storage)

      if(type == 'faaddress' && storage){
        $("#faaddress").val(storage).keyup();
      }

      if(type == 'shouaddress' && storage){
        $('#shouaddress').val(storage);
        setTimeout(function(){
          $('#shouaddress').keyup();
        },1000)
      }

      if(type == 'gettime' && storage){
        $("#gettime").val(storage);
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

      if(type == 'note' && storage){
        $("#note").val(storage);
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
    utils.setStorage('paotui_song_'+type, JSON.stringify(value));
  }
}

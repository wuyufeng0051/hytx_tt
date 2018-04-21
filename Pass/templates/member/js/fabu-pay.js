$(function(){

  var reduceyue = $('.reduce-yue');

  // 发布信息支付框
	$('.fabuPay .payway li').click(function(){
		var t = $(this);
		t.addClass('active').siblings('li').removeClass('active');
    calculationPayPrice();
	})

	// 选择余额
	$('.yue-btn').click(function(){
    var t = $(this), yue = $('.payPrice').text();
    if (t.hasClass('active')) {
      t.removeClass('active');
      reduceyue.text('0.00');
    }else {
      t.addClass('active');
      reduceyue.text(yue);
    }
    calculationPayPrice();
  })

	// 关闭支付框
	$('.fabuPay .payClose').click(function(){
		$('.fabuPay, .mask').hide();
    fabuPay.close();
	})

  calculationPayPrice();

  //计算总价
  function calculationPayPrice(){

    //改变表单内容
    $('#paytype').val($('.payway .active').data('id'));
    $('#amount').val($('.payPrice').text());
    $("#useBalance").val($(".yue-btn").hasClass("active") ? 1 : 0);


    var totalPrice = $('.payPrice').text();
    if($('.yue-btn').hasClass('active')){
      reduceyue.text(totalBalance > totalPrice ? totalPrice : totalBalance);
      balance = totalBalance > totalPrice ? totalPrice : totalBalance;
      $('.pay-total').html((totalPrice-balance).toFixed(2));

      if(totalPrice-balance <= 0){
        $('#paytypeObj').hide();
      }else{
        $('#paytypeObj').show();
      }
    }else{
      $('#paytypeObj').show();
      $('.pay-total').html(totalPrice);
    }

  }


  //支付
  $(".paySubmit").bind("click", function(){
    fabuPay.sub();
  });


  // manage页面继续支付
  $("body").delegate(".delayPay", "click", function(){
    var t = $(this), aid = t.closest(".item").attr("data-id");
    fabuPay.checkLevel(t, aid);
  })

})


// 普通会员发布信息支付费用
var fabuPay = {
  payform: $("#payform"),
  btn: null,
  url: '',
  check: function(data, url, btn){
    url = url.split('#')[0];
    this.btn = btn;
    this.url = url;
    var tip = langData['siteConfig'][20][341], icon = "success.png";
    // 修改
    if(id){
      tip = langData['siteConfig'][20][229];
    }else{
      // 付费
      if(data.info.amount > 0){
        fabuPay.show(data);
        return;
      }
    }

    $.dialog({
      title: langData['siteConfig'][19][287],
      icon: icon,
      content: tip,
      close: false,
      ok: function(){
        location.href = url;
      },
      cancel: function(){
        location.href = url;
      }
    });
  },
  show: function(data){
    $("#aid").val(data.info.aid);

    var auth = data.info.auth;
    // 付费会员更新提示信息
    if(auth.level != 0){
      $(".payNotice").text(langData['siteConfig'][19][826].replace('1', auth.levelname).replace('2', auth.maxcount).replace('3', auth.alreadycount));
    }

    $("#tourl").val(this.url);
    $('.fabuPay, .mask').show();
  },
  sub: function(){
    var F = this;
    // var url = F.payform.attr("action"), data = F.payform.serialize();

    this.payform.submit();

  },
  close: function(){
    window.location.href = this.url;
  },
  checkLevel: function(t, aid){
    var F = this;
    if(t.hasClass('load')) return;
    t.addClass("load");
    $.ajax({
      url: '/include/ajax.php?service=member&action=checkFabuAmount&module='+module,
      type: 'post',
      dataType: 'json',
      success: function(data){

        if(data){
          // 需要支付
          if(data.info.needpay == "1"){
            data.info.aid = aid;
            F.url = document.URL;
            F.show(data);

          // 已升级为会员
          }else{
            var auth = data.info.auth;
            jQuery.dialog({
              id: "updatePayState",
              title: langData['siteConfig'][23][107],
              content: langData['siteConfig'][19][827].replace('1', auth.levelname).replace('2', auth.alreadycount).replace('3', auth.maxcount),
              width: 450,
              ok: function(){
                $.ajax({
                  url: '/include/ajax.php?service=member&action=updateFabuPaystate&module='+module+'&type='+type+'&aid='+aid,
                  type: 'post',
                  dataType: 'json',
                  success: function(data){
                    if(data && data.state == 100){
                      location.reload();
                    }else{
                      $.dialog.alert(data.info);
                      t.removeClass('load')
                    }
                  },
                  error: function(){
                    $.dialog.alert(langData['siteConfig'][20][183]);
                    t.removeClass('load')
                  }
                })
              },
              cancel: function(){
                t.removeClass('load');
              }
            });
          }
        }
      },
      error: function(){
        $.dialog.alert(langData['siteConfig'][20][183]);
        t.removeClass("load");
      }
    })
  }
}

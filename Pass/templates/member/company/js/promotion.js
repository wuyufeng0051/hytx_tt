$(function(){

  var reduceyue = $('.reduce-yue');

  // 选择提取原因
  $('.select-tit').click(function(){
    $('.select ul').css('display') == 'none' ? $('.select ul').show() : $('.select ul').hide();
    return false;
  })

  $('.select ul li').click(function(){
    var t = $(this), txt = t.text(), id = t.attr('data-id');
    t.addClass('active').siblings('li').removeClass('active');
    $('.select-tit').attr('data-id', id).find('span').text(txt);
    $('.extract .error').text('');
  })

  $(document).click(function(){
    $('.select ul').hide();
  })

  // 选择保障金
  $('.select-ul li').click(function(){
    var t = $(this);
    t.addClass('active').siblings('li').removeClass('active');
    $('#amount').val('');
  })

  // 自定义金额
  $('#amount').bind('input properchange', function(){
    var val = $(this).val();
    if (val != "") {
      $('.select-ul li').removeClass('active');
    }
  })


  //计算总价
  function calculationPayPrice(){
    var selected = $('.select-ul li.active'), length = selected.length;
    var totalPrice = length > 0 ? selected.find('em').text() : $('#amount').val();
    totalPrice = parseFloat(totalPrice);

    if($('.yue-btn').hasClass('active')){
      reduceyue.text(totalBalance > totalPrice ? totalPrice.toFixed(2) : totalBalance.toFixed(2));
      balance = totalBalance > totalPrice ? totalPrice : totalBalance;
      $('.pay-total').html((totalPrice-balance).toFixed(2));

      if(totalPrice-balance <= 0){
        $('#paytypeObj').hide();
        $('.next-btn').html(langData['siteConfig'][19][673]);
      }else{
        $('#paytypeObj').show();
        $('.next-btn').html(langData['siteConfig'][19][665]);
      }
    }else{
      $('#paytypeObj').show();
      $('.pay-total').html(totalPrice.toFixed(2));
      $('.next-btn').html(langData['siteConfig'][19][665]);
    }

    $("#totalPrice").val(totalPrice);
    $("#balance").val($(".yue-btn").hasClass("active") ? 1 : 0);
    $("#paytype").val($(".payway .active").data("id"));

  }

  // 缴纳提交
  $('.payment .submit').click(function(){
    var length = $('.select-ul li.active').length;
    var val = $('.select-ul li.active').val() == undefined ? $('#amount').val() : $('.select-ul li.active em').val();
    if (val == "" && length <= 0) {
      $('.payment .error').text(langData['siteConfig'][20][455]);
    }else if (val != "" && val < 1000) {
      $('.payment .error').text(langData['siteConfig'][20][456]);
    }else {
      $('.payment .error').text('');
      calculationPayPrice();
      $('.paybox, .mask').show();
    }
  })

  // 提取提交
  $('.extract .submit').click(function(){
    var t = $(this);
    if(t.hasClass("disabled")) return false;
    var select = $('.extract .select ul').find('.active');
    if (select.length == 0) {
      $('.extract .error').text(langData['siteConfig'][27][121]);
    }else {

      t.addClass("disabled").html(langData['siteConfig'][6][35]+"...");
      $.ajax({
        url: masterDomain+"/include/ajax.php?service=member&action=extract",
        data: {"title": select.text(), "note": $('.extract textarea').val()},
        type: "POST",
        dataType: "jsonp",
        success: function (data) {
          if(data.state == 100){
            $('.extract-success, .mask').show();
            setTimeout(function(){
              location.reload();
            }, 2000);
          }else{
            $.dialog.alert(data.info);
            t.removeClass("disabled").html(langData['siteConfig'][19][674]);
          }
        },
        error: function(){
          $.dialog.alert(langData['siteConfig'][20][183]);
          t.removeClass("disabled").html(langData['siteConfig'][19][674]);
        }
      });

    }
  })

  // 关闭提示层
  $('.extract-success .close').click(function(){
    $('.extract-success, .mask').hide();
  })

  // 关闭弹出层
  $('.paybox .close').click(function(){
    $('.paybox, .mask').hide();
  })

  // 点击选择支付方式
  $('.payway li').click(function(){
    $(this).addClass('active').siblings('li').removeClass('active');
    $("#paytype").val($(this).data("id"));
  })

  // 账户余额
  $('.yue-btn').click(function(){
    var t = $(this), yue = t.find('em').text();
    if (t.hasClass('active')) {
      t.removeClass('active');
      reduceyue.text('0.00');
    }else {
      t.addClass('active');
      reduceyue.text(yue);
    }
    calculationPayPrice();
  })

  $("#amount").keyup(function () {
      var reg = $(this).val().match(/\d+\.?\d{0,2}/);
      var txt = '';
      if (reg != null) {
          txt = reg[0];
      }
      $(this).val(txt);
  }).change(function () {
      $(this).keypress();
      var v = $(this).val();
      if (/\.$/.test(v))
      {
        $(this).val(v.substr(0, v.length - 1));
      }
  });

  // 选择记录类型
  $('.main-tit .select-type em').click(function(){
     var t = $(this).parent();
     if (t.hasClass('show')) {
       t.removeClass('show');
     }else {
       t.addClass('show');
     }
     return false;
   })

   $('body').click(function(){
     $('.main-tit .select-type').removeClass('show');
   })

   //支付签约
   $(".next-btn").bind("click", function(){
     $("#pay").submit();
   });


})

$(function(){

  var reduceyue = $('.reduce-yue');

  // 选择会员类型
  $('.grade li').click(function(){
    var t = $(this), index = t.index();
    t.addClass('active').siblings('li').removeClass('active');
    $('.special .specbox').eq(index).show().siblings().hide();
    $('.choose .pricebox').eq(index).addClass('show').siblings().removeClass('show');
    calculationPayPrice();
  })

  // 选择开通类型
  $('.pricebox li').click(function(){
    $(this).addClass('active').siblings('li').removeClass('active');
    calculationPayPrice();
  })

  // 选择支付方式
  $('.payway li').click(function(){
    $(this).addClass('active').siblings('li').removeClass('active');
    calculationPayPrice();
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


  $('.next-btn').bind("click", function(){
    $('#payform').submit();
  });


  calculationPayPrice();

  //计算总价
  function calculationPayPrice(){

    //改变表单内容
    if($('.payway .active').length > 0){
      $('#paytype').val($('.payway .active').data('id'));
    }
    $('#amount').val($('.choose .show .active').data('amount'));
    $('#day').val($('.choose .show .active').data('day'));
    $('#daytype').val($('.choose .show .active').data('daytype'));
    $('#level').val($('.choose .show .active').data('level'));
    $("#useBalance").val($(".yue-btn").hasClass("active") ? 1 : 0);


    var totalPrice = $('.pricebox.show .active').data("amount");
    if($('.yue-btn').hasClass('active')){
      reduceyue.text(totalBalance > totalPrice ? totalPrice : totalBalance);
      balance = totalBalance > totalPrice ? totalPrice : totalBalance;
      $('.pay-total').html((totalPrice-balance).toFixed(2));

      if(totalPrice-balance <= 0){
        $('#paytypeObj').hide();
        $('.next-btn').html(langData['siteConfig'][6][185]);
      }else{
        $('#paytypeObj').show();
        $('.next-btn').html(langData['siteConfig'][19][665]);
      }
    }else{
      $('#paytypeObj').show();
      $('.pay-total').html(totalPrice);
      $('.next-btn').html(langData['siteConfig'][19][665]);
    }

  }

})

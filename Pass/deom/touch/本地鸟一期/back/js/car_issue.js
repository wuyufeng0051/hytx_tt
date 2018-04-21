$(function(){


    // 货车选择 性别选择
    $('.choice_box ul li').click(function(){
        var x = $(this);
        x.addClass('CB_bc').siblings().removeClass('CB_bc');
    })
    $('.bag').click(function(){
        var x = $(this);
        if (x.hasClass("bag")) {
            x.removeClass('bag');
            x.find('.arrow img').removeClass('bag_bc');
            $('.bag_1').show();
        }else{
            x.addClass('bag');
            x.find('.arrow img').addClass('bag_bc');
            $('.bag_1').hide();
        }
    })
    $('.sex').click(function(){
        var x = $(this);
        if (x.hasClass("sex")) {
            x.removeClass('sex');
            x.find('.arrow img').removeClass('sex_bc');
            $('.sex_choice').show();
        }else{
            x.addClass('sex');
            x.find('.arrow img').addClass('sex_bc');
            $('.sex_choice').hide();
        }
    })
  // 支付方式选择
  $('.wei_pay ul li').click(function(){
    var x = $(this);
    x.addClass('re_check').siblings().removeClass('re_check');
    $('.cash_pay ul li').removeClass('re_check');
  })
  $('.cash_pay ul li').click(function(){
    var x = $(this);
    x.addClass('re_check').siblings().removeClass('re_check');
    $('.wei_pay ul li').removeClass('re_check');
  })
    // 接受入驻条款
    $('.agree').click(function(){
        var x = $(this);
        if (x.hasClass('agree_bc')) {
            x.removeClass('agree_bc');
        }else{
            x.addClass('agree_bc');
        }
    })
  //年月日

  var currYear = (new Date()).getFullYear();  
  var opt={};
  opt.date = {preset : 'date'};
  opt.datetime = {preset : 'datetime', minDate: new Date()};
  opt.time = {preset : 'time'};
  opt.default = {
    theme: 'android-holo light', //皮肤样式
    display: 'bottom', //显示方式 
    mode: 'scroller', //日期选择模式
    dateFormat: 'yyyy-mm-dd',
    lang: 'zh',
    showNow: true,
    nowText: "今天",
    stepMinute: 1,
    // defaultValue: [ new Date(2013, 6, 12), new Date(2013, 6, 18, 23, 59) ],
    startYear: currYear-0, //开始年份
    endYear: currYear +3//结束年份
  };
  var optDateTime = $.extend(opt['datetime'], opt['default']);
  var optTime = $.extend(opt['time'], opt['default']);
  $(".demo-test-date").mobiscroll(optDateTime).datetime(optDateTime);

   
    $('.delete .cancel').click(function(){
        $('.delete').hide();
        $('.disk').hide();
    })
    $('.disk').click(function(){
        $('.delete').hide();
        $('.cheng').hide();
        $('.disk').hide();
    })
     
})
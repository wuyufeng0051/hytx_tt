$(function(){


  $('.orderbtn').click(function(){

    var t = $(this);
    if (!t.hasClass('on')) {
      t.addClass('on');
      $('.orderbox').animate({"top":".9rem"},200);
      $('.mask').show().animate({"opacity":"1"},200);
      $('body').addClass('fixed');
    }else {
      t.removeClass('on');
      $('.orderbox').animate({"top":"-100%"},200);
      $('.mask').hide().animate({"opacity":"0"},200);
      $('body').removeClass('fixed');
    }

  })

  $('.mask').click(function(){
    $('body').removeClass('fixed');
    $('.orderbtn').removeClass('on');
    $('.orderbox').animate({"top":"-100%"},200);
    $('.mask').hide().animate({"opacity":"0"},200);
  })


})

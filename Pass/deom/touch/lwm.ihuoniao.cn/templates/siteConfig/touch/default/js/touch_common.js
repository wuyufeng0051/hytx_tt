$(function(){


  var myscroll_nav = new iScroll("navlist", {vScrollbar: false});
  $('.header-search .dropnav').click(function(){
    var a = $(this);
    if(!a.hasClass('open')) {
      a.addClass('open');
      $('body').addClass('fixed');
      $('#navBox').css({'top':'0.8rem', 'bottom':'0'});
      $('#navBox .bg').css({'height':'100%','opacity':1});
      myscroll_nav.refresh();
    }else {
      a.removeClass('open');
      closeShearBox();
    }
  })


  $('#cancelNav').click(function(){
      closeShearBox();
  })


  $('#shearBg').click(function(){
      closeShearBox();
  })


  function closeShearBox(){

    $('body').removeClass('fixed');
    $('.header-search').removeClass('open');
    $('#navBox').css({'top':'-200%', 'bottom':'200%'});
    $('#navBox .bg').css({'height':'0','opacity':0});
  }



})

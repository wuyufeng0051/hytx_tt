$(function(){

  // 点击签到
  $('.qian').click(function(){
    var t = $(this), disabled = t.hasClass('disabled');
    if (!disabled) {
      var last = $('.lumian .active:last');
      if (last.hasClass('first')) {
        last.removeClass('active');
      }
      last.next().addClass('active');
      t.addClass('disabled');
    }
  })


})

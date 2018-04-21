$(function(){
  $('.box_tghb_li').click(function() {
            $('.box_tghb_li').children('div').removeClass('on');
            $(this).children('div').addClass('on');
            id = $(this).attr('data');
          });
})
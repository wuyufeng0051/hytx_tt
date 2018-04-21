$(function(){
  $('.nav a').click(function(){
    var x = $(this),index = x.index();
    $('.ab .table_list').eq(index).show();
    $('.ab .table_list').eq(index).siblings().hide();
    x.addClass('nav_bs');
    x.siblings().removeClass('nav_bs');
  })
})
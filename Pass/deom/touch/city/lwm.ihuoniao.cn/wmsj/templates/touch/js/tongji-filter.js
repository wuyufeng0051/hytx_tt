$(function(){

  //年月日
  $('.demo-test-date').scroller(
    $.extend({preset: 'datetime', stepMinute: 10, dateFormat: 'yyyy-mm-dd'})
  );


  //下拉菜单
  $('.demo-test-select').scroller(
    $.extend({preset: 'select'})
  );

  // 提交
  $(".submit").click(function(){
  	$(this).parent().submit();
  })


})

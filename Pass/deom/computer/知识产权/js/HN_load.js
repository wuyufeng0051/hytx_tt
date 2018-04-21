$(function(){

  $(".load").click(function () {
    $(".load").on("change",function(){
      var objUrl = getObjectURL(this.files[0]) ; 
      if (objUrl) {
        $(".swiper-slide img").attr("src", objUrl) ;
        $('.load').closest('dd').find('.file-panel').show();
      }
    });
  });
  $('.del').click(function(){
	  $('.swiper-slide img').attr("src", '');
	  $('.del').closest('.file-panel').hide();
  })
  $(".load1").click(function () {
    $(".load1").on("change",function(){
      var objUrl = getObjectURL(this.files[0]) ; 
      if (objUrl) {
        $(".desc-box img").attr("src", objUrl) ; 
        $('.load1').closest('dd').find('.file-panel').show();
      }
    });
  });
  $('.cancel').click(function(){
	  $('.desc-box img').attr("src", '');
	  $('.cancel').closest('.file-panel').hide();
  })
   function getObjectURL(file) {
      var url = null ;
      if (window.createObjectURL!=undefined) { // basic
        url = window.createObjectURL(file) ;
      }else if (window.URL!=undefined) { // mozilla(firefox)
        url = window.URL.createObjectURL(file) ;
      }else if (window.webkitURL!=undefined) { // webkit or chrome
        url = window.webkitURL.createObjectURL(file) ;
      }
      return url ;
    }

  $('.load3').change(function(){
  var str=$(this).val(),
      arr=str.split('\\'),//注split可以用字符或字符串分割 
      my=arr[arr.length-1];//这就是要取得的图片名称 
      $('.pic_box_2 p').text(my);
      $('.pic_box_2').show();
  }) 
  $('.pic_box_2 em').click(function(){
    var x = $(this);
    x.hide();
    $('.pic_box_2').hide();
  })


})
